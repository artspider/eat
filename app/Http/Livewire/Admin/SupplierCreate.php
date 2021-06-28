<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierCreate extends Component
{
    public $company_name;
    public $contact_name;
    public $contact_title;
    public $address;
    public $suburb;
    public $city;
    public $state;
    public $zip;
    public $phone;
    public $website;

    protected $rules = [
        'company_name' => 'required|min:6',
        'address' => 'required',
        'suburb' => 'required|min:6',
        'city' => 'required|min:6',
        'state' => 'required',
    ];

    public function render()
    {
        return view('livewire.admin.supplier-create')
        ->layout('components.layouts.master');
    }

    public function save()
    {
        $this->validate();
        
        $supplier = Supplier::create([
            'company_name' => $this->company_name,
            'contact_name' => $this->contact_name,
            'contact_title' => $this->contact_title,
            'address' => $this->address,
            'suburb' => $this->suburb,
            'city' => $this->city,
            'state' => $this->state,
            'zip' => $this->zip,
            'phone' => $this->phone,
            'website' => $this->website,
        ]);

        $this->emit('success', 'Se ha creado un nuevo provedor');
    }
}
