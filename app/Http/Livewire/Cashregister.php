<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class Cashregister extends Component
{
    use WithPagination;

    public $showModal = false;
    public $seeAll = false;
    public $see = false;
    
    public function render()
    {
        return view('livewire.cashregister',[
            'orders' => Order::when(!$this->seeAll, function($query){
                return $query->where('payed', false);
            }, function ($query)
            {
                return $query->orderBy('id');
            })
            ->paginate(5)
        ])
        ->layout('components.layouts.master');
    }

    public function openModal(Order $order)
    {
        $this->emit('changeOrder', $order->id);
        $this->showModal = true;
    }

    public function updatedseeAll()
    {
        if($this->seeAll){$this->see = false; }
        else{$this->see = true; }        
    }
}
