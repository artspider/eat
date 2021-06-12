<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    protected $queryString = ['search' => ['except' => '']];

    public $search;

    protected $listeners = [
        'success' => 'newProduct',
        'deleteProduct' => 'remove'
    ];

    public function newProduct()
    {
        
    }

    public function mount()
    {
        
    }

    public function render()
    {
        return view('livewire.admin.products',[
            'products' => Product::where('name', 'LIKE', "%{$this->search}%")
                                    ->paginate(5)
        ])
        ->layout('components.layouts.master');
    }

    public function remove(Product $product)
    {
        $product->delete();
        $this->emit('success', 'Se elimino el producto');      
    }

    public function clear()
    {
        $this->search = '';
        $this->page = 1;
    }
}
