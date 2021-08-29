<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Dish;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\Unit;

use App\Models\DishProduct;
use App\Models\DishRecipe;
use App\Models\DishImage;

class DishEdit extends Component
{
    use WithFileUploads;

    public Dish $dish;
    /***** Dish fields *****/
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
    public $rating;
    public $slug;
    public $photo_path;
    /********** ***********/
    public $photos = [];
    public $photoHasChanged = false;

    public $products;
    public $product_id;
    public $productName="Producto...";
    public $queryProduct;

    public $recipes;
    public $recipe_id;
    public $recipeUnit_id;
    public $recipeName="Receta...";
    public $recipeList=[];
    public $recipeQty=1;
    public $queryRecipe;

    public $units;    
    public $unit_id;
    public $unitName="Unidad...";
    public $unitRecipeName="unidad";

    public $ingredientList=[];
    public $ingredientQty=1;    

    public $tabSelection=0;
    public $selectedMenu = null;
    public $selectedSection = null;
    public $section;

    public $menus = ['DESAYUNO', 'COMIDA', 'BEBIDAS'];
    public $breakfast = ['HUEVOS', 'DULCE', 'QUESADILLA', 'ESPECIALIDADES'];
    public $lunch = ['ENSALADAS', 'TORTAS', 'PIZZA', 'ESPECIALIDADES'];
    public $beberages = ['SMOOTHIES', 'JUGOS', 'DRINKS', 'BASICOS'];

    public function mount(Dish $dish)
    {
        $this->dish = $dish;
        $this->name = $dish->name;
        $this->description = $dish->description;
        $this->servTime= $dish->servTime;
        $this->dishYield = $dish->recipeYield;
        $this->dishCuisine = $dish->recipeCuisine;
        $this->price= $dish->price;
        $this->cost= $dish->cost;
        $this->costPriceRatio = $dish->costPriceRatio;
        $this->mc = $dish->mc;
        $this->profitableness = $dish->profitableness;
        $this->deliveryCharges = $dish->deliveryCharges;
        $this->inStock= $dish->inStock;
        $this->rating = $dish->rating;
        $this->slug = $dish->slug;
        $this->photo_path = $dish->dishImages->first()->image;
        $this->selectedMenu = array_search($dish->menu, $this->menus);

        $menuNumber = array_search($dish->menu, $this->menus);
        if($menuNumber==0){
            $this->selectedSection = array_search($dish->section, $this->breakfast);
            $this->section = $this->breakfast;
        }
        if($menuNumber==1){
            $this->selectedSection = array_search($dish->section, $this->lunch);
            $this->section = $this->lunch;
        }
        if($menuNumber==2){
            $this->selectedSection = array_search($dish->section, $this->beberages);
            $this->section = $this->beberages;
        }
        

        $this->units = Unit::all();
        $this->products = Product::all();
        $this->recipes = Recipe::all();

        $this->mountIngredients($dish->products);
        $this->mountRecipes($dish->recipes);
    }

    public function mountIngredients($products)
    {
        foreach ($products as $key => $product) {
            $unit = Unit::find($product->pivot->unit_id);
            $total = $this->calcCost($product, $unit->unit);
            array_push(
                $this->ingredientList,array(
                    'qty' => $product->pivot->qty,
                    'unit' => $unit->unit,
                    'product' => $product->name,
                    'total' => $total
                )
            );
        }
        
    }

    private function mountRecipes($recipes)
    {
        foreach ($recipes as $key => $recipe) {
            $total = $this->calcRecipeCost($recipe);
            array_push(
                $this->recipeList,array(
                    'qty' => $recipe->pivot->qty,
                    'unit' => $recipe->unit()->first()->unit,
                    'recipe' => $recipe->name,
                    'total' => $total
                )
            );
        }
    }

    public function render()
    {
        return view('livewire.admin.dish-edit')
        ->layout('components.layouts.master');;
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

    public function changeStock()
    {
        $this->inStock = !$this->inStock;
    }

    private function calcCost(Product $product, $unitName)
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

        if($unitName == 'Kilogramo' || $unitName == 'Litro'){
            $ingredient_cost = $cost_per_gr_ml * ($product->pivot->qty*1000);            
        }else{
            $ingredient_cost = $cost_per_gr_ml * $product->pivot->qty;            
        }
        
        return $ingredient_cost;
    }

    private function calcRecipeCost(Recipe $recipe)
    {
        $cost_per_gr_ml=0;
        $cost_per_gr_ml = $recipe->cost / $recipe->nutrition->servingSize;
        $ingredient_cost = $cost_per_gr_ml * $recipe->pivot->qty;
        return $ingredient_cost;
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
        
        $this->cost = round($this->cost,2);
        return $ingredient_cost;
    }

    private function SubToCost(Product $product)
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
            $ingredient_cost = $cost_per_gr_ml * ($product->pivot->qty*1000);
            $this->cost = $this->cost - $ingredient_cost;
        }else{
            $ingredient_cost = $cost_per_gr_ml * $product->pivot->qty;
            $this->cost = $this->cost - $ingredient_cost;
        }

        $this->cost = round($this->cost,2);
        
        return $ingredient_cost;
    }

    private function AddRecipeToCost(Recipe $recipe)
    {
        $cost_per_gr_ml=0;
        $cost_per_gr_ml = $recipe->cost / $recipe->nutrition->servingSize;
        $ingredient_cost = $cost_per_gr_ml * $this->recipeQty;
        $this->cost = $this->cost + $ingredient_cost;
        $this->cost = round($this->cost,2);
        return $ingredient_cost;
    }

    public function updatedPhotos()
    {
        logger('cambio la foto');
        $this->validate([
            'photos.*' => 'image|max:1024', // 1MB Max
        ]);
        $this->photoHasChanged = true;
    }

    public function updatedqueryProduct()
    {
        $this->products = Product::where('name', 'like', '%' . $this->queryProduct . '%')->get();
    }

    public function updatedqueryRecipe()
    {
        $this->recipes = Recipe::where('name', 'like', '%' . $this->queryRecipe . '%')->get();
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
        $product = $this->dish->products->where('name', $this->ingredientList[$key]['product'])->first();
        $this->SubToCost($product);
        unset($this->ingredientList[$key]);
    }

    public function deleteRecipe($key)
    {
        unset($this->recipeList[$key]);
    }

    public function updatedselectedMenu($key)
    {
        if($key == 0) $this->section = $this->breakfast;
        if($key == 1) $this->section = $this->lunch;
        if($key == 2) $this->section = $this->beberages;
    }

    public function edit()
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

        $this->dish->name = $this->name;
        $this->dish->slug = Str::slug($this->name, '-');
        $this->dish->description = $this->description;
        $this->dish->servTime = $this->servTime;
        $this->dish->recipeYield = $this->dishYield;
        $this->dish->price = $this->price;
        $this->dish->cost = $this->cost;
        $this->dish->costPriceRatio = ($this->cost*100)/$this->price;
        $this->dish->mc = $this->cost*0.7;
        $calcAnt= ($this->dish->mc + $this->dish->cost)*1.16;
        $this->dish->profitableness = ($this->dish->price - $calcAnt);
        $this->dish->rating = 5;
        $this->dish->inStock = $this->inStock;
        $this->dish->menu = $this->menus[$this->selectedMenu];
        $this->dish->section = $this->section[$this->selectedSection];
        $this->dish->save();

        if($this->photoHasChanged){
            $imagesToRemove = DishImage::where('dish_id',$this->dish->id)->get();
            foreach ($imagesToRemove as $key => $image) {
                $image->delete();
            }
            foreach ($this->photos as $photo) {
                $url_foto = $photo->store('product-photos', 'public');
                $path = str_replace("public","storage", $url_foto);

                $image = DishImage::create([
                    'dish_id' => $this->dish->id,
                    'image' => $path,
                ]);
            }
        }

        $ingredientsToRemove = DishProduct::where('dish_id', $this->dish->id)->get();
        foreach ($ingredientsToRemove as $key => $product) {
            $product->delete();
        }

        if($this->ingredientList)
        {
            foreach($this->ingredientList as $ingredient) {
                $product = Product::where('name',$ingredient['product'])->first();
                logger($product);
                $unit = Unit::where('unit',$ingredient['unit'])->first();
                $ingredientItem = DishProduct::create([
                    'dish_id' => $this->dish->id,
                    'product_id' => $product->id,
                    'qty' => $ingredient['qty'],
                    'unit_id' => $unit->id
                ]);
            }
        }

        $recipesToRemove = DishRecipe::where('dish_id', $this->dish->id)->get();
        foreach ($ingredientsToRemove as $key => $product) {
            $product->delete();
        }

        if($this->recipeList)
        {
            foreach($this->recipeList as $recipe) {
                $recipeM = Recipe::where('name',$recipe['recipe'])->first();
                logger($recipeM);
                
                $recipeItem = DishRecipe::create([
                    'dish_id' => $this->dish->id,
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
        $this->emit('success', 'Se ha modificado el producto');
    }
}