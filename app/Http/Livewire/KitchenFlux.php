<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kitchen;
use App\Models\Recipe;

class KitchenFlux extends Component
{
    public $enviadas;
    public $recibidas;
    public $cocinando;
    public $entregadas;
    public $canceladas;
    public $sinstock;

    protected $listeners = ['toKitchen' => 'sendRecipeToKitchen'];

    public function sendRecipeToKitchen()
    {
        $this->enviadas = Kitchen::where('status',0)->get();
        $this->recibidas = Kitchen::where('status',1)->get();
        $this->cocinando = Kitchen::where('status',2)->get();
        $this->entregadas = Kitchen::where('status',3)->get();
        $this->canceladas = Kitchen::where('status',7)->get();
        $this->sinstock = Kitchen::where('status',8)->get();
    }

    public function mount()
    {
        $this->enviadas = Kitchen::where('status',0)->get();
        $this->recibidas = Kitchen::where('status',1)->get();
        $this->cocinando = Kitchen::where('status',2)->get();
        $this->entregadas = Kitchen::where('status',3)->get();
        $this->canceladas = Kitchen::where('status',7)->get();
        $this->sinstock = Kitchen::where('status',8)->get();
    }

    public function render()
    {
        return view('livewire.kitchen-flux',[
            'orders' => $this->enviadas,
            'recibidas' => $this->recibidas,
            'cocinando' => $this->cocinando,
            'entregadas' => $this->entregadas,
            'canceladas' => $this->canceladas,
            'sinstock' => $this->sinstock
        ]);
    }

    public function AcceptOrder(Kitchen $order)
    {
        $order->status = 1;
        $order->save();
        $this->actualizar();
        $this->emit('success', 'Se acepto orden del Chef...');
    }

    public function Cocinar(Kitchen $recibida)
    {
        $recibida->status = 2;
        $recibida->save();
        $this->actualizar();
        $this->emit('success', 'Se empieza a cocinar o preparar el platillo...');
    }

    public function SinStock(Kitchen $order)
    {
        $order->status = 8;
        $order->save();
        $this->actualizar();
        $this->emit('success', 'No se tienen todos los ingredientes...');
    }

    public function Cancelar(Kitchen $order)
    {
        $order->status = 7;
        $order->save();
        $this->actualizar();
        $this->emit('success', 'Se cancela orden...');
    }

    public function EnviarAlChef(Kitchen $order)
    {
        $order->status = 3;
        $order->qty = $order->recipe->nutrition->servingSize;
        $order->qtyleft = $order->recipe->nutrition->servingSize;
        $order->save();
        $this->actualizar();
        $this->emit('toChef');
        $this->emit('success', 'Se envía al chef...');
    }

    public function actualizar()
    {
        $this->enviadas = Kitchen::where('status',0)->get();
        $this->recibidas = Kitchen::where('status',1)->get();
        $this->cocinando = Kitchen::where('status',2)->get();
        $this->entregadas = Kitchen::where('status',3)->get();
        $this->canceladas = Kitchen::where('status',7)->get();
        $this->sinstock = Kitchen::where('status',8)->get();
    }

}
