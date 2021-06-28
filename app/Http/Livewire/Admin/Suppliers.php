<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\WithPagination;

class Suppliers extends Component
{
    protected $listeners = [
        'deleteSupplier' => 'remove'
    ];

    public function render()
    {
        return view('livewire.admin.suppliers',[
        'suppliers' => Supplier::paginate(5)
        ])
        ->layout('components.layouts.master');
    }

    public function remove(Supplier $supplier)
    {
        $supplier->delete();
        $this->emit('success', 'Se elimino el proveedor');      
    }
}
