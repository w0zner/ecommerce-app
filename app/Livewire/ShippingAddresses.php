<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateAddressForm;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShippingAddresses extends Component
{
    public $addresses;
    public $showForm = true;
    public CreateAddressForm $createAddress;

    public function mount() {
        if(!Auth::check()) {
            return redirect()->route('login');
        }
        $user=Auth::user();
        $this->addresses= Address::where('user_id', Auth::user()->id)->get();

        $this->createAddress->receiver_info=[
            'name' => $user->name,
            'last_name' => $user->last_nameme,
            'document_type' => $user->document_type,
            'document_number' => $user->document_number,
            'phone' => $user->phone,
        ];
        //dd($this->createAddress->receiver_info);
    }

    public function render()
    {
        return view('livewire.shipping-addresses');
    }
}
