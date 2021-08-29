<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Dish;
use App\Models\Recipe;
use App\Models\Unit;
use App\Models\Product;
use App\Models\DishProduct;
use App\Models\DishRecipe;
use App\Models\DishImage;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class DishCreate extends Component
{
    use WithFileUploads;

    public $photos = [];
    public $name;
    public $description;
    public $servTime=0;
    public $dishYield;
    public $dishCuisine;
    public $price=0;
    public $cost=0;
    public $costPriceRatio;
    public $mc;
    public $profitableness;
    public $deliveryCharges;
    public $inStock=false;
    public $unit_id;
    public $product_id;
    public $recipe_id;
    public $recipeUnit_id;    

    public $units;
    public $unitName="Unidad...";
    public $unitRecipeName="unidad";
    public $products;
    public $productName="Producto...";
    public $ingredientList=[];
    public $ingredientQty=1;

    public $recipes;
    public $recipeName="Receta...";
    public $recipeList=[];
    public $recipeQty=1;

    public $queryProduct;
    public $queryRecipe;
    public $tabSelection=0;

    public $menus = ['DESAYUNO', 'COMIDA', 'BEBIDAS'];
    public $breakfast = ['HUEVOS', 'DULCE', 'QUESADILLA', 'ESPECIALIDADES'];
    public $lunch = ['ENSALADAS', 'TORTAS', 'PIZZA', 'ESPECIALIDADES'];
    public $beberages = ['SMOOTHIES', 'JUGOS', 'DRINKS', 'BASICOS'];
    public $selectedMenu = null;
    public $selectedSection = null;
    public $section;

    public function mount()
    {
        $this->units = Unit::all();
        $this->products = Product::all();
        $this->recipes = Recipe::all();
    }

    public function render()
    {
        return view('livewire.admin.dish-create',[            
            'units' => $this->units,
            'products' => $this->products,
            'recipes' => $this->recipes,
        ])
        ->layout('components.layouts.master');
    }

    public function updatedqueryProduct()
    {
        $this->products = Product::where('name', 'like', '%' . $this->queryProduct . '%')->get();
    }

    public function updatedqueryRecipe()
    {
        $this->recipes = Recipe::where('name', 'like', '%' . $this->queryRecipe . '%')->get();
    }

    public function changeStock()
    {
        $this->inStock = !$this->inStock;
    }

    public function SelectUnit(Unit $unit)
    {
        $this->unit_id = $unit->id;
        $this->unitName = $unit->unit;
    }

    public function SelectProduct(Product $product)
    {
        $this->product_id = $product->id;
        $this->productName = $product->name;
        $this->queryProduct = $product->name;
    }

    public function addIngredient()
    {
        $product = Product::where('name', $this->productName)->first();
        if($product)
        {
            $total = $this->AddToCost($product);
            array_push(
                $this->ingredientList,array(
                    'qty' => $this->ingredientQty,
                    'unit' => $this->unitName,
                    'product' => $this->productName,
                    'total' => $total
                )
            );

            
            $this->ingredientQty = 1;
            $this->unitName = 'Unidad...';
            $this->productName = 'Producto...';
        }else{
            $this->emit('error', 'El producto no existe...');    
        }
    }

    public function SelectRecipe(Recipe $recipe)
    {
        $this->recipe_id = $recipe->id;
        $this->recipeName = $recipe->name;
        $this->queryRecipe = $recipe->name;
    }

    public function SelectRecipeUnit(Unit $unit)
    {
        $this->recipeUnit_id = $unit->id;
        $this->unitRecipeName = $unit->unit;
    }

    public function addRecipe()
    {        
        $recipe = Recipe::where('name', $this->recipeName)->first();
        if($recipe)
        {
            $total = $this->AddRecipeToCost($recipe);
            array_push(
                $this->recipeList,array(
                    'qty' => $this->recipeQty,
                    'unit' => $this->unitRecipeName,
                    'recipe' => $this->recipeName,
                    'total' => $total
                )
            );

            
            $this->recipeQty = 1;
            $this->unitRecipeName = 'Unidad...';
            $this->recipeName = 'Receta...';
        }else{
            $this->emit('error', 'LA receta no existe...');    
        }
    }

    public function deleteIngredient($key)
    {
        unset($this->ingredientList[$key]);
    }

    public function deleteRecipe($key)
    {
        unset($this->recipeList[$key]);
    }

    public function selectIngredient()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:6',
            'description' => 'required|min:6',
            'servTime' => 'required',
            'dishYield' => 'required',
            'price' => 'required|numeric',
            'cost' => 'required|numeric',
            'inStock' => 'required',
        ]);
        $this->tabSelection = 1;
    }

    public function selectImages()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:6',
            'description' => 'required|min:6',
            'servTime' => 'required',
            'dishYield' => 'required',
            'price' => 'required|numeric',
            'cost' => 'required|numeric',
            'inStock' => 'required',
        ]);
        $this->tabSelection = 2;
    }

    public function updatedselectedMenu($key)
    {
        if($key == 0) $this->section = $this->breakfast;
        if($key == 1) $this->section = $this->lunch;
        if($key == 2) $this->section = $this->beberages;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:6',
            'description' => 'required|min:6',
            'servTime' => 'required',
            'dishYield' => 'required',
            'price' => 'required|numeric',
            'cost' => 'required|numeric',
            'inStock' => 'required',
        ]);

        if( $this->price <= $this->cost){
            $this->emit('error','El precio publico es erroneo');
            return;
        }
        
        $dish = new Dish();
        $dish->name = $this->name;
        $dish->slug = Str::slug($this->name, '-');
        $dish->description = $this->description;
        $dish->servTime = $this->servTime;
        $dish->recipeYield = $this->dishYield;
        $dish->price = $this->price;
        $dish->cost = $this->cost;
        $dish->costPriceRatio = ($this->cost*100)/$this->price;
        $dish->mc = $this->cost*0.7;
        $calcAnt= ($dish->mc + $dish->cost)*1.16;
        $dish->profitableness = ($dish->price - $calcAnt);
        $dish->rating = 5;
        $dish->inStock = $this->inStock;
        $dish->menu = $this->menus[$this->selectedMenu];
        $dish->section = $this->section[$this->selectedSection];
        $dish->save();

        if($this->photos)
        {
            $this->validate([
                'photos.*' => 'image|max:1024', // 1MB Max
            ]);

            foreach ($this->photos as $photo) {
                $url_foto = $photo->store('product-photos', 'public');
                $path = str_replace("public","storage", $url_foto);

                $image = DishImage::create([
                    'dish_id' => $dish->id,
                    'image' => $path,
                ]);
            }
        }else{
            $image = DishImage::create([
                'dish_id' => $dish->id,
                'image' => 'fotos/no_disponible.png',
            ]);
        }

        if($this->ingredientList)
        {
            foreach($this->ingredientList as $ingredient) {
                $product = Product::where('name',$ingredient['product'])->first();
                logger($product);
                $unit = Unit::where('unit',$ingredient['unit'])->first();
                $ingredientItem = DishProduct::create([
                    'dish_id' => $dish->id,
                    'product_id' => $product->id,
                    'qty' => $ingredient['qty'],
                    'unit_id' => $unit->id
                ]);
            }
        }

        if($this->recipeList)
        {
            foreach($this->recipeList as $recipe) {
                $recipeM = Recipe::where('name',$recipe['recipe'])->first();
                logger($recipeM);
                
                $recipeItem = DishRecipe::create([
                    'dish_id' => $dish->id,
                    'recipe_id' => $recipeM->id,
                    'qty' => $recipe['qty'],
                ]);
            }
        }

        $this->photos = [];
        $this->name = '';
        $this->description = '';
        $this->servTime=0;
        $this->dishYield = 0;
        $this->dishCuisine = '';
        $this->price=0;
        $this->cost=0;
        $this->ingredientList=[];
        $this->recipeList=[];
        $this->emit('success', 'Se ha creado un nuevo producto');
    }

    private function AddToCost(Product $product)
    {
        $unit = $product->unit()->first()->unit;
        $measure = 1;
        $multiply = $measure * $product->content;
        $cost_per_gr_ml=0;
        if($unit == 'Kilogramo' || $unit == 'Litro'){
            $measure = $multiply * 1000;
            $cost_per_gr_ml = $product->price / $measure;            
        }elseif($unit == 'Gramo' || $unit == 'Mililitro'){
            $cost_per_gr_ml = $product->price / $multiply;
        }else{
            $cost_per_gr_ml = $product->price;
        }
        if($this->unitName == 'Kilogramo' || $this->unitName == 'Litro'){
            $ingredient_cost = $cost_per_gr_ml * ($this->ingredientQty*1000);
            $this->cost = $this->cost + $ingredient_cost;
        }else{
            $ingredient_cost = $cost_per_gr_ml * $this->ingredientQty;
            $this->cost = $this->cost + $ingredient_cost;
        }
        
        return $ingredient_cost;
    }

    private function AddRecipeToCost(Recipe $recipe)
    {
        $cost_per_gr_ml=0;
        $cost_per_gr_ml = $recipe->cost / $recipe->nutrition->servingSize;
        $ingredient_cost = $cost_per_gr_ml * $this->recipeQty;
        $this->cost = $this->cost + $ingredient_cost;
        return $ingredient_cost;
    }
}
