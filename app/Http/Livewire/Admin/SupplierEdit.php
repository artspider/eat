<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Supplier;

class SupplierEdit extends Component
{
    public $supplier;
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

    public function mount(Supplier $supplier)
    {
        $this->supplier = $supplier;
        $this->company_name = $supplier->company_name;
        $this->contact_name = $supplier->contact_name;
        $this->contact_title = $supplier->contact_title;
        $this->address = $supplier->address;
        $this->suburb = $supplier->suburb;
        $this->city = $supplier->city;
        $this->state = $supplier->state;
        $this->zip = $supplier->zip;
        $this->phone = $supplier->phone;
        $this->website = $supplier->website;
    }

    public function render()
    {
        return view('livewire.admin.supplier-edit',[
            'supplier' => $this->supplier
        ])
        ->layout('components.layouts.master');
    }

    public function save()
    {
        $this->validate();

        $this->supplier->company_name = $this->company_name;
        $this->supplier->contact_name = $this->contact_name;
        $this->supplier->contact_title = $this->contact_title;
        $this->supplier->address = $this->address;
        $this->supplier->suburb = $this->suburb;
        $this->supplier->city = $this->city;
        $this->supplier->state = $this->state;
        $this->supplier->zip = $this->zip;
        $this->supplier->phone = $this->phone;
        $this->supplier->website = $this->website;

        try{
            $this->supplier->save();
        }catch(error $e)
        {
            $this->emit('error', 'Se ha presentado un error');
        }       

        $this->emit('success', 'Se ha moificado el proveedor');
    }
}
