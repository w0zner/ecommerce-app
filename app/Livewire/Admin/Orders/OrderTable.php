<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class OrderTable extends DataTableComponent
{
    protected $model = Order::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("N° Orden", "id")
                ->sortable(),
            Column::make("Ticket")
                ->label(function($row) {
                    return view('admin.orders.ticket', ['order' => $row]);
                }),
            Column::make("Cantidad", "content")
                ->format(function($value) {
                    return count($value);
                })
                ->sortable(),
            Column::make("Total", "total")
                ->format(function($value) {
                    return "Gs. ".number_format($value, 0, null, '.');
                })
                ->sortable(),
            Column::make("Forma de pago", "payment_method")
                ->format(function($value) {
                    return $value->name;
                })
                ->sortable(),
            Column::make("Estado", "status")
                ->format(function($value) {
                    return $value->name;
                })
                ->sortable(),
            Column::make("Fecha Creación", "created_at")
                ->format(function($value) {
                    return $value->format('d/m/Y H:i:s');
                })
                ->sortable(),
            Column::make("Acciones")
                ->label(function($row) {
                    return view('admin.orders.actions', ['order' => $row]);
                }),
           /*  Column::make("Fecha Actualización", "updated_at")
            ->format(function($value) {
                    return $value->format('d/m/Y H:i:s');
                })
                ->sortable(), */
        ];
    }

    public function downloadTicket(Order $order){
        //dd($order->toArray());
        return Storage::download($order->pdf_path);
    }
}
