<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;
Use App\Models\Customer;
Use App\Models\Order;
Use App\Models\Dish;
Use App\Models\Kitchen;
use App\Models\DishOrder;
use App\Models\OrderStatus;

class OrderCreate extends ModalComponent
{
    public $customers;
    public $ordercustomer;
    public $dishes;
    public $dish_id;
    public $customer_id;
    public $queryDish = '';
    public $queryCustomer = '';
    public $addCustomer = false;
    public $addDish = false;
    public $addAddressInput = false;
    public $street;
    public $suburb;
    public $phone;
    public $dishList=[];
    public $prices=[1,1,1];
    public $total = 0;
    public $deliveryGuy;
    public $mesa = ["MESA 1","MESA 2","MESA 3","MESA 4","MESA 5",'A DOMICILIO','PARA LLEVAR'];
    public $selectedtable;
    public $note;
    public $waiter;
    public $delivery_time;
    public $buttonOrderEnabled = false;

    public function mount()
    {
        $this->waiter = Auth::user()->name;
        $this->customers = Customer::where('name', 'like', '%' . $this->queryCustomer . '%')->get();
        $this->dishes = Dish::where('name', 'like', '%' . $this->queryDish . '%')->get();
    }

    public function render()
    {
        return view('livewire.order-create',[
            'customers' => $this->customers,
            'dishes' => $this->dishes
        ]);
    }

    public function updatedqueryCustomer()
    {
        $this->customers = Customer::where('name', 'like', '%' . $this->queryCustomer . '%')->get();
        if(count($this->customers) === 0){
            $this->addCustomer = true;
        }else{
            $this->addCustomer = false;
        }        
    }

    public function updatedqueryDish()
    {
        $this->dishes = Dish::where('name', 'like', '%' . $this->queryDish . '%')->get();
        if(count($this->dishes) === 0){
            $this->addDish = true;
        }else{
            $this->addDish = false;
        }        
    }

    public function editCustomer()
    {
        $this->addAddressInput = true;
    }

    public function SelectCustomer(Customer $customer)
    {
        $this->customer_id = $customer->id;
        $this->queryCustomer = $customer->name;
        $this->ordercustomer = $customer;
    }

    public function SelectDish(Dish $dish)
    {
        $this->dish_id = $dish->id;
        $this->queryDish = $dish->name;
    }

    public function CancelSaveCustomer()
    {
        $this->queryCustomer = '';
        $this->customer_id = null;
        $this->addAddressInput = false;
        $this->addCustomer = false;
    }

    public function SaveCustomer()
    {
        $validatedData = $this->validate([
            'queryCustomer' => 'required|min:6',
            'street' => 'required|min:6',
            'suburb' => 'nullable|min:5',
            'phone' => 'required|min:10',
        ]);

        $customer = new Customer();
        $customer->name = $this->queryCustomer;
        $customer->street = $this->street;
        $customer->suburb = $this->suburb;
        $customer->phone = $this->phone;
        $customer->save();

        $this->customers = Customer::where('name', 'like', '%' . $this->queryCustomer . '%')->get();
        $this->customer_id = $customer->id;
        $this->ordercustomer = $customer;
        $this->addAddressInput = false;
        $this->addCustomer = false;
        $this->emit('success','Cliente agregado...');
    }

    public function addDishToOrder(Dish $dish)
    {
        $dish = Dish::find($this->dish_id);
        $this->total = 0;
        if(!$dish){
            $this->emit('error','Platillo no encontrado...');
            return;
        }

        foreach ($this->dishList as $key => $item) {
            if(in_array($dish->id, $item)){
                $this->emit('error', 'El platillo ya esta en la orden');
                return;
            }    
        }
        array_push(
            $this->dishList,array(
                'id' => $dish->id,
                'qty' => 1,
                'name' => $dish->name,
                'price' => $dish->price
            )
        );

        logger($dish->id);
        logger($this->dishList);

        $this->dish_id = null;
        $this->queryDish = '';
        $this->updatedqueryDish();
        foreach ($this->dishList as $key => $dish) {
            $this->prices[$key] = $dish['qty']*$dish['price'];
            $this->total = $this->total + $this->prices[$key];
        }
        $this->buttonOrderEnabled = true;
    }

    public function changeQty()
    {
        logger($this->dishList[0]);
    }

    public function AddToTotal($price)
    {
        $this->total = $this->total + $price;
    }

    public function updated($name, $value)
    {
        $this->total = 0;
        if($value){
            foreach ($this->dishList as $key => $dish) {
                $this->prices[$key] = $dish['qty']*$dish['price'];
                $this->total = $this->total + $this->prices[$key];
            }
        }
    }

    public function ordenar()
    {        
        $validatedData = $this->validate([
            'customer_id' => 'required',
            'selectedtable' => 'required',
            'note' => 'nullable|min:10',
            'total' => 'required',
            'deliveryGuy' => 'nullable|min:5',
            'waiter' => 'required'
        ]);

        $order = new Order();
        $order->customer_id = $this->customer_id;
        $order->delivery_time = 20;
        $order->waiter = $this->waiter;
        $order->delivery_guy = $this->deliveryGuy;
        $order->table = $this->selectedtable;
        $order->note = $this->note;
        $order->total = $this->total;
        
        $order->save();
        
        foreach($this->dishList as $dish) {
            $DishOrderItem = DishOrder::create([
                'dish_id' => $dish['id'],
                'order_id' => $order->id,
                'qty' => $dish['qty'],
                'price' => $dish['price'],
                'total' => ($dish['price'] * $dish['qty'])
            ]);
            $this->updateDishStock($dish['id']);
        }

        $status = new OrderStatus();
        $status->order_id = $order->id;
        $status->status = 'PENDING';
        $status->done = false;
        $status->save();

        $this->emit('success', 'orden creada...');
    }

    public function updateDishStock($dish_id)
    {
        $dish = Dish::find($dish_id);
        $this->subFromProduct($dish->products);
        $this->subFromKitchen($dish->recipes);        
    }

    public function subFromProduct($products)
    {
        $base_unit = 1000; //gramo
        $stock;
        foreach ($products as $key => $product) {
            if ($product->unit_id == $product->pivot->unit_id) {
                $product_qty = $product->content * $product->stock;
                $product_qtyleft = $product_qty - $product->pivot->qty;
                $stock = (($product_qtyleft * $product->stock ) / $product->content) / $product->stock;
            }else{
                $product_qty = ($product->content * $base_unit) * $product->stock;
                $product_qtyleft = $product_qty - $product->pivot->qty;
                $stock = (($product_qtyleft * $product->stock ) / ($product->content * $base_unit)) / $product->stock;
            }
            $product->stock = $stock;
            $product->save();
        }        
    }

    public function subFromKitchen($recipes)
    {
        $stock;
        foreach ($recipes as $key => $recipe) {            
            $stock = $recipe->kitchen->qtyleft - $recipe->pivot->qty;            
            $kitchen = Kitchen::find($recipe->kitchen->id);
            $kitchen->qtyleft = $stock;
            $kitchen->save();
        }
    }

}
