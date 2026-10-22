<div>
    <label class="mr-5 space-x-1 cursor-pointer">
        <input
            type="radio" name="shipping_type" wire:model.live="shippingType" value="delivery"
            class="radio bg-green-100 border-green-300 checked:bg-green-500 checked:text-green-600 checked:border-green-600" />
        <span>Delivery</span>
    </label>
    <label class="mr-5 space-x-1 cursor-pointer">
        <input
            type="radio" name="shipping_type" wire:model.live="shippingType" value="carry_out"
            class="radio bg-black-100 border-black-300 checked:bg-black-200 checked:text-black-600 checked:border-black-600" />
        <span>Carry out</span>
    </label>

    <div class="mt-2">
        <p class="text-sm">
            <span class="font-semibold">Tipo:</span>
            {{ $shippingType === 'delivery' ? 'Envío a domicilio' : 'Retiro en tienda' }}
        </p>
        <p class="text-sm">
            <span class="font-semibold">Costo de envío:</span>
            Gs. {{ number_format($shippingCost, 0, ',', '.') }}
        </p>
    </div>
</div>
