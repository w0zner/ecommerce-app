<x-app-layout>
    <x-container class="mt-12">
        <div class="grid gap-4">
            <div class="flex justify-center items-center mb-4">
                    <img src="{{ asset('images/gracios_por_su_compra.png') }}" alt="WhatsApp" class="h-40">
                </div>
            <div class="flex justify-center items-center">

                <a href="{{ $whatsappUrl }}" target="_blank" class="btn btn-primary text-white text-2xl">
                    <i class="fa-brands fa-whatsapp"></i>
                    Enviar orden vía WhatsApp
                </a>
            </div>
        </div>
    </x-container>
</x-app-layout>
