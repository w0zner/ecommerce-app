<div class="flex flex-col space-y-2">
    @switch($order->status)
        @case(\App\Enums\OrderStatus::Pendiente)
            <button class="underline text-blue-500 hover:no-underline text-blue-600">
                Listo
            </button>
            @break
        @case(\App\Enums\OrderStatus::Procesando)
            <button class="underline text-blue-500 hover:no-underline text-blue-600">
                Asignar repartidor
            </button>
            @break
        @default
    @endswitch
    <button class="underline text-red-500 hover:no-underline text-red-600">
        Cancelar
    </button>
</div>
