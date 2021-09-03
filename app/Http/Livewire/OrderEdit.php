<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
Use App\Models\Customer;
Use App\Models\Order;
Use App\Models\Dish;
Use App\Models\Product;
Use App\Models\Recipe;
Use App\Models\Kitchen;
use App\Models\DishOrder;
use App\Models\OrderStatus;

class OrderEdit extends ModalComponent
{
    public $selectedOrder;

    public $customers;
    public $ordercustomer;
    public $dishes=null;
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
    public $command = 1;
    public $delivery_time;
    public $buttonOrderEnabled = false;

    public $menus = ['DESAYUNO', 'COMIDA', 'BEBIDAS'];
    public $breakfast = ['HUEVOS', 'DULCE', 'QUESADILLA', 'ESPECIALIDADES'];
    public $lunch = ['ENSALADAS', 'TORTAS', 'PIZZA', 'ESPECIALIDADES'];
    public $beberages = ['SMOOTHIES', 'JUGOS', 'DRINKS', 'BASICOS'];
    public $selectedMenu = null;
    public $selectedSection = null;
    public $section;

    protected $listeners = ['deleteDish' => 'removeDish'];

    public function mount (Order $order)
    {
        $this->selectedOrder = $order;
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function render()
    {        
        return view('livewire.order-edit');
    }
}
