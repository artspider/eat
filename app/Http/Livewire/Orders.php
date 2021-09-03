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
    public $anyDay=false;
    protected $queryString = ['search' => ['except' => '']];

    protected $listeners = [
        'success' => '$refresh',
        'deleteOrder' => 'remove'
    ];

    public function mount()
    {
        $this->searchDate = carbon::now()->isoFormat('YYYY-MM-DD');
    }

    public function render()
    {
        return view('livewire.orders',[
            'orders' => Order::when($this->search, function($query){
                return $query->where('id',$this->search);
            })
            ->when($this->searchDate, function($query)
            {
                return $query->whereDate('created_at',$this->searchDate);
            })          
            ->paginate(5)
        ])
        ->layout('components.layouts.master');
    }

    public function clear()
    {
        $this->search = null;
    }

    public function updatedanyDay()
    {
        logger($this->anyDay);
        if($this->anyDay == true) {
            $this->searchDate = null;            
        }
        if($this->anyDay == false) {
            $this->searchDate = carbon::now()->isoFormat('YYYY-MM-DD');            
        }
    }
}
