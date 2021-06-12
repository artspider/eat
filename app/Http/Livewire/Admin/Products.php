<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;

class Products extends Component
{
    public $products;

    protected $listeners = [
        'success' => 'newProduct',
        'deleteProduct' => 'remove'
    ];

    public function newProduct()
    {
        $this->products = Product::all();
    }

    public function mount()
    {
        $this->products = Product::all();
    }

    public function render()
    {
        return view('livewire.admin.products',[
            'products' => $this->products
        ])
        ->layout('components.layouts.master');
    }

    public function remove(Product $product)
    {
        $product->delete();
        $this->emit('success', 'Se elimino el producto');      
    }

    public function mensaje()
    {
        //$this->emit('prueba', 'Mensaje'); 
        $this->emit('redirect', 'Otro mensaje');
    }
}
