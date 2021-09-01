<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\carbon;
use App\Models\Order;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    public $search;
    public $searchDate;
    protected $queryString = ['search' => ['except' => '']];

    protected $listeners = [
        'newOrder' => '$refresh',
        'deleteOrder' => 'remove'
    ];

    public function mount()
    {
        $this->searchDate = carbon::now();
        dd($this->searchDate);
    }

    public function render()
    {
        return view('livewire.orders',[
            'orders' => Order::when($this->search, function($query){
                return $query->where('id',$this->search);
            })            
            ->paginate(5)
        ])
        ->layout('components.layouts.master');
    }

    public function clear()
    {
        $this->search = null;
    }
}
