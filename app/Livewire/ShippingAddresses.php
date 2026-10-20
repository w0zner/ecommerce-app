<?php

namespace App\Livewire;

use App\Livewire\Forms\Shipping\CreateAddressForm;
use App\Livewire\Forms\Shipping\EditAddressForm;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShippingAddresses extends Component
{
    public $addresses;
    public $showForm = false;
    public CreateAddressForm $createAddress;
    public EditAddressForm $editAddress;

    public function mount() {
        if(!Auth::check()) {
            return redirect()->route('login');
        }
        $user=Auth::user();
        $this->addresses= Address::where('user_id', Auth::user()->id)->get();

        $this->createAddress->receiver_info=[
            'name' => $user->name,
            'last_name' => $user->last_name,
            'document_type' => $user->document_type,
            'document_number' => $user->document_number,
            'phone' => $user->phone,
        ];
        //dd($this->createAddress->receiver_info);
    }

    public function store() {
        $this->createAddress->save();
        $this->addresses= Address::where('user_id', Auth::user()->id)->get();
        $this->showForm = false;
        // if($this->addresses->count() > 0) {
        //     $this->showForm = true;
        // }
    }

    public function update() {
        $this->editAddress->update();
        $this->addresses= Address::where('user_id', Auth::user()->id)->get();
        $this->showForm = false;
    }

    public function delete($id) {
        $address=Address::find($id);
        $address->delete();
        $this->addresses= Address::where('user_id', Auth::user()->id)->get();
    }

    public function edit($id) {
        $address=Address::find($id);
        $this->editAddress->edit($address);
    }

    public function setDefault($addressId) {
        $this->addresses->each(function($address) use ($addressId) {
            $address->update(['default' => $address->id == $addressId]);
        });
    }

    public function render()
    {
        return view('livewire.shipping-addresses');
    }
}
