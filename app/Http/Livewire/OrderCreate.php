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
    public $name;
    public $addCustomer = false;
    public $addDish = false;
    public $addAddressInput = false;
    public $street;
    public $suburb;
    public $phone;
    public $dishList=[];
    public $prices=[1,1,1];
    public $total = 0;
    public $delivery_guy;
    public $mesa = ["MESA 1","MESA 2","MESA 3","MESA 4","MESA 5",'A DOMICILIO','PARA LLEVAR'];
    public $selectedtable;
    public $table;
    public $note;
    public $waiter;
    public $delivery_time;
    public $buttonOrderEnabled = false;

    protected $listeners = ['deleteDish' => 'removeDish'];

    public function removeDish($key)
    {
        $this->total = $this->total - $this->prices[$key];
        unset($this->prices[$key]);        
        unset($this->dishList[$key]);
    }

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
        (count($this->customers) === 0) ? $this->addCustomer = true : $this->addCustomer = false;
        /* if(count($this->customers) === 0){
            $this->addCustomer = true;
        }else{
            $this->addCustomer = false;
        }  */       
    }

    public function updatedqueryDish()
    {
        $this->dishes = Dish::where('name', 'like', '%' . $this->queryDish . '%')->get();
        (count($this->dishes) === 0) ? $this->addDish = true : $this->addDish = false;
        /* if(count($this->dishes) === 0){
            $this->addDish = true;
        }else{
            $this->addDish = false;
        }         */
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

    public function validateCustomerData()
    {
        $this->name = $this->queryCustomer;
        return $this->validate([
            'name' => 'required|min:6',
            'street' => 'required|min:6',
            'suburb' => 'nullable|min:5',
            'phone' => 'required|min:10',
        ]);
    }

    public function SaveCustomer()
    {
        $customer = Customer::create($this->validateCustomerData());
        $this->setDataAfterSaveCustomer($customer);        
        $this->emit('success','Cliente agregado...');
    }

    public function setDataAfterSaveCustomer(Customer $customer)
    {
        $this->customers = Customer::where('name', 'like', '%' . $this->queryCustomer . '%')->get();
        $this->customer_id = $customer->id;
        $this->ordercustomer = $customer;
        $this->addAddressInput = false;
        $this->addCustomer = false;
        return;
    }

    public function addDishToOrder()
    {
        if(! $this->dish_id) return $this->emit('error','Platillo no encontrado...');
        
        $dish = Dish::find($this->dish_id);        
        if ($this->dishIsInOrder($dish->id)) return true;

        $this->total = 0;
        array_push(
            $this->dishList,array(
                'id' => $dish->id,
                'qty' => 1,
                'name' => $dish->name,
                'price' => $dish->price
            )
        );

        $this->dish_id = null;
        $this->queryDish = '';
        $this->updatedqueryDish();
        $this->AddToTotal();
        /* foreach ($this->dishList as $key => $dish) {
            $this->prices[$key] = $dish['qty']*$dish['price'];
            $this->total = $this->total + $this->prices[$key];
        } */
        //$this->buttonOrderEnabled = true;
    }

    public function dishIsInOrder($dish_id)
    {
        foreach ($this->dishList as $key => $item) {            
            if($dish_id == $item['id']){
                $this->emit('error', 'El platillo ya esta en la orden');
                return true;
            }
        }
    }

    public function hasStock(Dish $dish, $qty = 1)
    {
        if (! $this->hasProduct($dish->products, $qty)) return false;
        $this->hasInKitchen($dish->recipes);

        return true;
    }

    public function hasProduct($products, $qty = 1)
    {
        $base_unit = 1000; //gramo
        $product_qtyleft = 0;
        foreach ($products as $key => $product) {
            if ($product->unit_id == $product->pivot->unit_id) {
                $product_qty = $product->content * $product->stock;
                $product_qtyleft = $product_qty - ($product->pivot->qty * $qty);
            }else{
                $product_qty = ($product->content * $base_unit) * $product->stock;
                $product_qtyleft = $product_qty - ($product->pivot->qty * $qty);
            }
            if($product_qtyleft < 0) return false;
        }

        return true;
    }

    public function hasInKitchen($recipes)
    {
        foreach ($recipes as $key => $recipe) {
            logger($recipe);
        }
        return true;
    }

    public function changeQty()
    {
        logger($this->dishList[0]);
    }

    public function AddToTotal()
    {        
        foreach ($this->dishList as $key => $dish) {
            $this->prices[$key] = $dish['qty']*$dish['price'];
            $this->total = $this->total + $this->prices[$key];
        }
    }

    public function updated($name, $value)
    {
        $arrayName = explode(".", $name);
        if($arrayName[0] == "selectedtable") return;
        $this->total = 0;
        if($value){
            $this->AddToTotal();
            /* foreach ($this->dishList as $key => $dish) {
                $this->prices[$key] = $dish['qty']*$dish['price'];
                $this->total = $this->total + $this->prices[$key];
            } */
        }
    }

    public function validateOrderData()
    {
        $this->table = $this->mesa[$this->selectedtable];
        return $this->validate([
            'customer_id' => 'required',
            'delivery_time' => 'nullable',
            'waiter' => 'required',
            'delivery_guy' => 'nullable|min:5',
            'table' => 'required',
            'note' => 'nullable|min:10',
            'total' => 'required',
        ]);
    }

    public function ordenar()
    {        
        if(count($this->dishList) == 0){
            return $this->emit('error','La orden no tien platillos...');
        }

        $order = Order::create($this->validateOrderData());
        /* $order = new Order();
        $order->customer_id = $this->customer_id;
        $order->delivery_time = $this->delivery_time;
        $order->waiter = $this->waiter;
        $order->delivery_guy = $this->delivery_guy;
        $order->table = $this->selectedtable;
        $order->note = $this->note;
        $order->total = $this->total;
        
        $order->save(); */
        $this->orderDetails($order->id);
        $this->orderStatus($order->id);        

        $this->emit('success', 'orden creada...');
        $this->closeModal();
    }

    public function orderDetails($order_id)
    {
        foreach($this->dishList as $dish) {
            $DishOrderItem = DishOrder::create([
                'dish_id' => $dish['id'],
                'order_id' => $order_id,
                'qty' => $dish['qty'],
                'price' => $dish['price'],
                'total' => ($dish['price'] * $dish['qty'])
            ]);
            $this->updateDishStock($dish['id']);
        }
    }

    public function orderStatus($order_id)
    {
        $status = new OrderStatus();
        $status->order_id = $order_id;
        $status->status = 'PENDING';
        $status->done = false;
        $status->save();
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