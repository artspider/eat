<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kitchen;
use App\Models\Recipe;
use Livewire\WithPagination;

class ChefOnKitchen extends Component
{
    use WithPagination;

    public $recipesInKitchen;
    public $queryProduct;
    public $recipes;
    public $recipesInUse;

    public $recipe_id;
    public $recipeName;
    public $qty;
    public $queryRecipe;

    protected $listeners = ['toChef' => 'recibeRecipe'];

    public function recibeRecipe()
    {
        $this->recipes = Recipe::all();
        $this->recipesInKitchen = Kitchen::where('qtyleft','>',0)
                                            ->where('status', '<', 4 )
                                            ->get();
    }

    public function mount()
    {
        $this->recipes = Recipe::all();
        $this->recipesInKitchen = Kitchen::where('qtyleft','>',0)
                                            ->where('status', '<', 4 )
                                            ->get();
        //$this->recipesInUse = Kitchen::where('status',4)->paginate(5);
    }

    public function render()
    {
        return view('livewire.chef-on-kitchen',[
            'recipesInKitchen' => $this->recipesInKitchen,
            'recipe ' => $this->recipes,
            'recipesUsing' => Kitchen::where('status',4)->paginate(5)
        ]);
    }

    public function SelectRecipe(Recipe $recipe)
    {
        $this->recipe_id = $recipe->id;
        $this->recipeName = $recipe->name;
        $this->qty = $recipe->nutrition->servingSize;
        $this->queryRecipe = $recipe->name;
    }

    public function updatedqueryRecipe()
    {
        $this->recipes = Recipe::where('name', 'like', '%' . $this->queryRecipe . '%')->get();
    }

    public function addRecipe()
    {        
        $recipe = Recipe::where('name', $this->recipeName)->first();
        if($recipe)
        {
            $existInKitchen = Kitchen::where('recipe_id',$recipe->id)->first();
            if($existInKitchen){
                $this->recipeName = 'Receta...';
                $this->qty = 0;
                $this->queryRecipe = '';
                return $this->emit('error', 'La receta esta en estado '.$existInKitchen->status);
            }

            foreach ($recipe->ingredients as $key => $product) {
                if ($product->unit_id == $product->pivot->unit_id){
                    $product_qty = $product->content * $product->stock;
                    if( $product_qty <= $product->pivot->qty){
                        $this->emit('error', 'No existe suficiente '. $product->name .' para esa receta ');
                        return;
                    }
                }
                $product_qty = ($product->content * 1000) * $product->stock;
                if( $product_qty <= $product->pivot->qty){
                    $this->emit('error', 'No existe suficiente '. $product->name .' para esa receta ');
                    return;
                }
            }

            $kitchen = new Kitchen();
            $kitchen->recipe_id = $recipe->id;
            $kitchen->qty = 0;
            $kitchen->qtyleft = 0;
            $kitchen->waste = 0;
            $kitchen->status = 1;
            $this->qty = 0;
            $kitchen->save();

            $this->stockUpdate($kitchen);

            $this->recipeName = 'Receta...';
            $this->queryRecipe = '';
            $this->recipesInKitchen = Kitchen::where('qtyleft','>',0)
                                            ->where('status', '<', 4 )
                                            ->get();
            $this->emit('toKitchen');
            $this->emit('success', 'Se envió tu pedido a la cocina');
        }else{
            $this->emit('error', 'La receta no existe...');    
        }
    }

    public function Recibir(Kitchen $kitchen)
    {
        $kitchen->status = 4;
        $kitchen->save();
        $this->recipesInKitchen = Kitchen::where('qtyleft','>',0)
                                            ->where('status', '<', 4 )
                                            ->get();
        $productsFromRecipe = $kitchen->recipe->ingredients;
        $this->emit('success', 'Receta recibida y lista para usarse...');
    }

    public function stockUpdate(Kitchen $kitchen)
    {
        $base_unit = 1000; //gramo
        $stock;
        foreach ($kitchen->recipe->ingredients as $key => $ingredient) {
            if ($ingredient->unit_id == $ingredient->pivot->unit_id) {
                $product_qty = $ingredient->content * $ingredient->stock;
                $product_qtyleft = $product_qty - $ingredient->pivot->qty;
                $stock = (($product_qtyleft * $ingredient->stock ) / $ingredient->content) / $ingredient->stock;
            }else{
                $product_qty = ($ingredient->content * $base_unit) * $ingredient->stock;
                $product_qtyleft = $product_qty - $ingredient->pivot->qty;
                $stock = (($product_qtyleft * $ingredient->stock ) / ($ingredient->content * $base_unit)) / $ingredient->stock;
            }
            $ingredient->stock = $stock;
            $ingredient->save();
        }
    }
}
