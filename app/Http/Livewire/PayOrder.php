<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\Paymethod;
use App\Models\Orderstatus;
use App\Models\Payment;
use App\Models\BillscoinPayment;

class PayOrder extends Component
{
    public $order;
    public $total;
    public $payMethodSelected=1;
    public $moneyReceived = 0;
    public $change = 0;
    public $changeColected = 0;
    public $quarter = 0;
    public $one = 0;
    public $two = 0;
    public $five = 0;
    public $ten = 0;
    public $twenty = 0;
    public $fifty = 0;
    public $onehundred = 0;
    public $twohundred = 0;
    public $fivehundred = 0;
    public $thousand = 0;
    public $billcoinschange = [0,0,0,0,0,0,0,0,0,0];
    

    protected $listeners = ['changeOrder'];

    public function changeOrder(Order $order)
    {
        logger('Cambio order: ' . $order);
        $this->order = $order;
        $this->total = $order->dishes->sum('pivot.total');
    }

    public function mount($order)
    {        
        $this->order = $order;
        $this->total = $order->dishes->sum('pivot.total');
    }

    public function render()
    {
        return view('livewire.pay-order',[
            'paymethods' => Paymethod::all()
        ]);
    }

    public function updated($name, $value)
    {
      if($value == null) { 
       return;
      }
        $this->moneyReceived =  ($this->quarter * 0.50) +
                                ($this->one * 1) +
                                ($this->two * 2) + 
                                ($this->five * 5) +
                                ($this->ten * 10) +
                                ($this->twenty * 20) +
                                ($this->fifty * 50) +
                                ($this->onehundred * 100) + 
                                ($this->twohundred * 200) +
                                ($this->fivehundred * 500);
        $this->change = $this->moneyReceived - $this->total;

        $this->changeColected = ($this->billcoinschange[0] * 0.50) +
                                ($this->billcoinschange[1] * 1) +
                                ($this->billcoinschange[2] * 2) + 
                                ($this->billcoinschange[3] * 5) +
                                ($this->billcoinschange[4] * 10) +
                                ($this->billcoinschange[5] * 20) +
                                ($this->billcoinschange[6] * 50) +
                                ($this->billcoinschange[7] * 100) + 
                                ($this->billcoinschange[8] * 200) +
                                ($this->billcoinschange[9] * 500);
    }

    public function register()
    {
      if($this->moneyReceived < $this->total){        
        $this->emit('error','No se ha cubierto la cuenta...');
        return;
      }
      if($this->change != $this->changeColected){
        $this->emit('error','El cambio no es correcto...');
        return;
      }
      $this->order->payed = true;
      $this->order->save();

      $status = Orderstatus::where('order_id',$this->order->id)->first();
      $status->status = "CLOSED";
      $status->done = true;
      $status->save();   

      $payment = new Payment();
      $payment->order_id = $this->order->id;
      $payment->type = "PAYED";
      $payment->total = $this->moneyReceived;
      $payment->save();

      if($this->quarter > 0) {
          $billscoin = new BillscoinPayment();
          $billscoin->billscoin_id = 11;
          $billscoin->payment_id = $payment->id;
          $billscoin->qty = $this->quarter;
          $billscoin->total = $this->quarter * 0.50;
          $billscoin->save();
      }
      if($this->one > 0){
        $billscoin = new BillscoinPayment();
        $billscoin->billscoin_id = 1;
        $billscoin->payment_id = $payment->id;
        $billscoin->qty = $this->one;
        $billscoin->total = $this->one * 1;
        $billscoin->save();
      }
      if($this->two > 0){
        $billscoin = new BillscoinPayment();
        $billscoin->billscoin_id = 2;
        $billscoin->payment_id = $payment->id;
        $billscoin->qty = $this->two;
        $billscoin->total = $this->two * 2.0;
        $billscoin->save();
      }
      if($this->five > 0){
        $billscoin = new BillscoinPayment();
        $billscoin->billscoin_id = 3;
        $billscoin->payment_id = $payment->id;
        $billscoin->qty = $this->five;
        $billscoin->total = $this->five * 5.0;
        $billscoin->save();
      }
      if($this->ten > 0){
        $billscoin = new BillscoinPayment();
        $billscoin->billscoin_id = 4;
        $billscoin->payment_id = $payment->id;
        $billscoin->qty = $this->ten;
        $billscoin->total = $this->ten * 10.0;
        $billscoin->save();
      }
      if($this->twenty > 0){
        $billscoin = new BillscoinPayment();
        $billscoin->billscoin_id = 5;
        $billscoin->payment_id = $payment->id;
        $billscoin->qty = $this->twenty;
        $billscoin->total = $this->twenty * 20.0;
        $billscoin->save();
      }
      if($this->fifty > 0){
        $billscoin = new BillscoinPayment();
        $billscoin->billscoin_id = 6;
        $billscoin->payment_id = $payment->id;
        $billscoin->qty = $this->fifty;
        $billscoin->total = $this->fifty * 50.0;
        $billscoin->save();
      }
      if($this->onehundred > 0){
        $billscoin = new BillscoinPayment();
        $billscoin->billscoin_id = 7;
        $billscoin->payment_id = $payment->id;
        $billscoin->qty = $this->onehundred;
        $billscoin->total = $this->onehundred * 100.0;
        $billscoin->save();
      } 
      if($this->twohundred > 0){
        $billscoin = new BillscoinPayment();
        $billscoin->billscoin_id = 8;
        $billscoin->payment_id = $payment->id;
        $billscoin->qty = $this->twohundred;
        $billscoin->total = $this->twohundred * 200.0;
        $billscoin->save();
      }
      if($this->fivehundred > 0){
        $billscoin = new BillscoinPayment();
        $billscoin->billscoin_id = 9;
        $billscoin->payment_id = $payment->id;
        $billscoin->qty = $this->fivehundred;
        $billscoin->total = $this->fivehundred * 500.0;
        $billscoin->save();
      }

      $this->registerChange();

      $this->emit('success','Se registro el pago...');
    }

    public function registerChange()
    {
      $billcoinstype = [.50,1,2,5,10,20,50,100,200,500];
      $billscoinid = [11, 1, 2, 3,4,5,6,7,8,9,10];

      $payment = new Payment();
      $payment->order_id = $this->order->id;
      $payment->type = "CHANGE";
      $payment->total = $this->changeColected;
      $payment->save();

      for ($i=0; $i < 10 ; $i++) { 
        if($this->billcoinschange[$i] > 0) { 
          $billscoin = new BillscoinPayment();
          $billscoin->billscoin_id = $billscoinid[$i];
          $billscoin->payment_id = $payment->id;
          $billscoin->qty = $this->billcoinschange[$i];
          $billscoin->total = $billcoinstype[$i] * $billscoin->qty;
          $billscoin->save();
        }
      }
    }
    
}