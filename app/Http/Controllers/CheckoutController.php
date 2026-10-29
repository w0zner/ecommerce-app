<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Company;
use Binafy\LaravelCart\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index() {
         if(!Auth::check()){
            return redirect()->route('login');
        }

        $user=Auth::user();
        $cart = Cart::query()
            ->where('user_id', $user->id)
            ->first();

        $cartItems=[];
        $totalPrice=0;
        if($cart) {
            $cartItems = $cart->items()->with('itemable')->get();

            if(count($cartItems) > 0) {
                $totalPrice = $cartItems->sum(function($item){
                    return $item['itemable']['price'] * $item['quantity'];
                });
            } else {
                $totalPrice = 0;
            }
        }
        $precioEnvio = session('shipping_cost', 0);

        return view('checkout.index', compact('cartItems', 'totalPrice', 'precioEnvio'));
    }

      public function process(Request $request)
        {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->first();

            if (!$cart || $cart->items->isEmpty()) {
                return redirect()->route('cart.index');
            }

            $cartItems = $cart->items()->with('itemable')->get();

            $subtotal = $cartItems->sum(function ($item) {
                return $item->itemable->price * $item->quantity;
            });

            // 1. Obtener tipo y costo de envío desde la sesión
            $shippingType = session('shipping_type', 'delivery');
            $shippingCost = session('shipping_cost', ($shippingType === 'carry_out' ? 0 : 25000));
            $total = $subtotal + $shippingCost;

            // 2. Método de pago
            $metodosPago = [
                '1' => 'Transferencia Bancaria',
                '2' => 'Link de pago',
                '3' => 'Tarjeta de débito/crédito',
            ];
            $metodoPagoTexto = $metodosPago[$request->input('pago', '1')] ?? 'No especificado';

            // 3. Dirección de entrega (si es delivery)
            $direccion = Address::where('user_id', $user->id)->where('default', true)->first();

            // 4. Construir el texto del pedido
            $mensaje = "🛒 *NUEVO PEDIDO*\n";
            $mensaje .= "----------------------------------\n";
            $mensaje .= "👤 *Cliente:* {$user->name} {$user->last_name}\n";
            $mensaje .= "📞 *Teléfono:* " . ($user->phone ?? 'No especificado') . "\n";
            $mensaje .= "💳 *Método de pago:* {$metodoPagoTexto}\n";
            $mensaje .= "📦 *Tipo de entrega:* " . ($shippingType ==='delivery' ? 'Delivery' : 'Retiro en tienda (Carry out)') . "\n";

            if ($shippingType === 'delivery' && $direccion) {
                $mensaje .= "📍 *Dirección:* {$direccion->description}, {$direccion->district}\n";
                if ($direccion->reference) {
                    $mensaje .= "📝 *Referencia:* {$direccion->reference}\n";
                }
            }

            $mensaje .= "----------------------------------\n";
            $mensaje .= "🛍️ *Productos:*\n";

            foreach ($cartItems as $item) {
                $nombre = $item->itemable->name;
                $precio = number_format($item->itemable->price, 0, ',', '.');
                $subtotalItem = number_format($item->itemable->price * $item->quantity, 0, ',', '.');
                $mensaje .= "• {$item->quantity}x {$nombre} (Gs. {$precio}) =Gs. {$subtotalItem}\n";
            }

            $mensaje .= "----------------------------------\n";
            $mensaje .= "Subtotal: Gs. " . number_format($subtotal, 0, ',', '.') . "\n";
            $mensaje .= "Envío: Gs. " . number_format($shippingCost, 0, ',','.') . "\n";
            $mensaje .= "💰 *TOTAL A PAGAR: Gs. " . number_format($total, 0,',', '.') . "*\n";

            // 5. Opcional: Vaciar carrito o registrar pedido en base dedatos
            // $cart->items()->delete();
            $company = Company::query()->first();

            if(!$company) {
                return redirect()->route('cart.index')->with('error', 'No se encontró la información de la tienda para el envío de la orden, contacte con el Administrador de la tienda!');
            }

            $telefonoTienda = $company->whatsapp;

            $whatsappUrl = 'https://wa.me/' . $telefonoTienda . '?text=' . urlencode($mensaje);

            //return redirect()->away($whatsappUrl);
            //return view('checkout.send', compact('whatsappUrl'));
            return redirect()->back() // o a la ruta que prefieras
        ->with('whatsappUrl', $whatsappUrl)
        ->with('showWhatsappModal', true);
        }


}
