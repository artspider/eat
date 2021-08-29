<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    public $search;
    protected $queryString = ['search' => ['except' => '']];

    protected $listeners = [
        'newOrder' => '$refresh',
        'deleteOrder' => 'remove'
    ];

    public function render()
    {
        return view('livewire.orders',[
            'orders' => Order::paginate(5)
        ])
        ->layout('components.layouts.master');
    }
}
