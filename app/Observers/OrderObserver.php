<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class OrderObserver
{
    public function created(Order $order)
    {
        $user = User::find($order->user_id);
        
        $pdf = Pdf::loadView('orders.ticket', compact('order', 'user'))->setPaper('a5');

        $pdf->save(storage_path('app/public/tickets/ticket-'.$order->id.'.pdf'));
        $order->pdf_path = 'tickets/ticket-'.$order->id.'.pdf';
        $order->save();
    }
}
