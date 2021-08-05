<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Recipe;
use App\Models\Unit;
use App\Models\Product;
use App\Models\RecipeCategory;
use App\Models\ProductRecipe;
use App\Models\RecipeImage;
use App\Models\NutritionInformation;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class RecipeEdit extends Component
{
    use WithFileUploads;

    public $recipe;
    public $photos = [];
    public $photo_paths = [];
    public $name;
    public $recipe_category_id;
    public $description;
    public $prepTime=0;
    public $cookTime=0;
    public $totalTime=0;
    public $recipeYield;
    public $suitableForDiet;
    public $recipeCuisine;
    public $price;
    public $cost;
    public $costPriceRatio;
    public $mc;
    public $profitableness;
    public $deliveryCharges;
    public $inStock=false;
    public $unit_id;
    public $product_id;
    public $slug;

    public $recipeCategory;
    public $recipeCategoryName="Selecciona...";
    public $dietType=['Diabeticos', 'Libre de Gluten', 'Halal', 'Hindu', 'Kosher', 'Baja en Calorias', 'Baja en Grasas', 'Baja en Lactosa', 'Baja en Sal', 'Vegana', 'Vegetariana'];
    public $recipeSuitableForDiet;
    public $recipeSuitableForDietName="Dieta...";
    public $units;
    public $unitName="Unidad...";
    public $products;
    public $productName="Producto...";
    public $ingredientList=[];
    public $ingredientQty=1;
    public $nutritionInfo=['Tamaño de la porción','Calorias','Carbohidratos', 'Colesterol', 'Grasas', 'Grasas Saturadas', 'Grasas Trans', 'Grasas No Saturadas', 'Fibra', 'Proteína', 'Sodio', 'Azúcar'];
    public $nutritionItemName='Item...';
    public $nutritionUnits=['g', 'kcal', 'g', 'mg', 'g', 'g', 'g', 'g', 'g', 'g', 'mg', 'g'];
    public $nutritionUnitName;
    public $nutritionList=[];
    public $nutritionQty=1;
    public $photoHasChanged = false;

    public $servingSize;
    public $calories;
    public $carbohydrateContent;
    public $cholesterolContent;
    public $fatContent;
    public $saturatedFatContent;
    public $transFatContent;
    public $unsaturatedFatContent;
    public $fiberContent;
    public $proteinContent;
    public $sodiumContent;
    public $sugarContent;

    public $tam_porcion;
    public $calorias = 'Calorias';
    public $carbohidratos;
    public $colesterol;
    public $grasas;
    public $grasas_saturadas;
    public $grasas_trans;
    public $grasas_no_saturadas;
    public $fibra;
    public $proteina;
    public $sodio;
    public $azucar;

    public $queryProduct;

    public function mount(Recipe $recipe)
    {
        $this->recipe = $recipe;

        $this->name = $this->recipe->name;
        $this->recipe_category_id = $this->recipe->recipe_category_id;
        $this->recipeCategoryName = RecipeCategory::find($this->recipe_category_id)->name;
        $this->description = $this->recipe->description;
        $this->prepTime = $this->recipe->prepTime;
        $this->cookTime = $this->recipe->cookTime;
        $this->totalTime = $this->prepTime + $this->cookTime;
        $this->recipeYield = $this->recipe->recipeYield;
        $this->recipeSuitableForDietName = $this->recipe->suitableForDiet;
        $this->price = $this->recipe->price;
        $this->cost = $this->recipe->cost;
        $this->inStock = $this->recipe->inStock;
        $this->units = Unit::all();
        $this->products = Product::all();
        foreach($this->recipe->ingredients as $ingredient)
        array_push(
            $this->ingredientList,array(
                'qty' => $ingredient->pivot->qty,
                'unit' => Unit::find($ingredient->pivot->unit_id)->unit,
                'product' => $ingredient->name
            )
        );
        $this->mountNutritionList();
        $recipe_images = RecipeImage::where('recipe_id',$this->recipe->id)->get();
        foreach($recipe_images as $image)
        {
            array_push(
                $this->photo_paths,
                $image->image);
        }
    }

    public function render()
    {
        return view('livewire.admin.recipe-edit', [
            'recipe' => $this->recipe,
            'recipe_categories' => RecipeCategory::all(),
            'units' => $this->units,
            'products' => $this->products
        ])
        ->layout('components.layouts.master');
    }

    public function changeStock()
    {
        $this->inStock = !$this->inStock;
    }

    public function updatedqueryProduct()
    {
        $this->products = Product::where('name', 'like', '%' . $this->queryProduct . '%')->get();
    }

    public function SelectCategory(RecipeCategory $category)
    {
        $this->recipe_category_id = $category->id;
        $this->recipeCategoryName = $category->name;
    }

    public function SelectDiet($diet)
    {
        $dietMap = [
            'Diabeticos' => 'DiabeticDiet', 
            'Libre de Gluten' => 'GlutenFreeDiet', 
            'Halal' => 'HalalDiet', 
            'Hindu' => 'HinduDiet', 
            'Kosher' => 'KosherDiet', 
            'Baja en Calorias' => 'LowCalorieDiet', 
            'Baja en Grasas' => 'LowFatDiet', 
            'Baja en Lactosa' => 'LowLactoseDiet', 
            'Baja en Sal' => 'LowSaltDiet', 
            'Vegana' => 'VeganDiet', 
            'Vegetariana' => 'VegetarianDiet',
        ];

        //dd($dietMap[$diet]);
        $this->recipeSuitableForDietName = $diet;
        $this->suitableForDiet = $dietMap[$diet];
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
            array_push(
                $this->ingredientList,array(
                    'qty' => $this->ingredientQty,
                    'unit' => $this->unitName,
                    'product' => $this->productName
                )
            );

            $this->AddToCost($product);
            $this->AddToServingSize();
            $this->ingredientQty = 1;
            $this->unitName = 'Unidad...';
            $this->productName = 'Producto...';
        }else{
            $this->emit('error', 'El producto no existe...');    
        }                
    }

    public function SelectNutritionItem($nutritionItem, $key)
    {
        $this->nutritionItemName = $nutritionItem;
        $this->nutritionUnitName = $this->nutritionUnits[$key];
    }

    public function mountNutritionList()
    {
        $nutritionMap = [
            'Tamaño de la porción' => 'servingSize',
            'Calorias' => 'calories',
            'Carbohidratos' => 'carbohydrateContent',
            'Colesterol' => 'cholesterolContent',
            'Grasas' => 'fatContent',
            'Grasas Saturadas' => 'saturatedFatContent',
            'Grasas Trans' => 'transFatContent',
            'Grasas No Saturadas' => 'unsaturatedFatContent',
            'Fibra' => 'fiberContent',
            'Proteína' => 'proteinContent',
            'Sodio' => 'sodiumContent',
            'Azúcar' => 'sugarContent',
        ];

        $nutritionInformation = NutritionInformation::where('recipe_id',$this->recipe->id)->first();

        if(!empty($nutritionInformation->calories)) { 
            $this->calories = $nutritionInformation->calories;
            $this->calorias = 'Calorias';
        }
        if(!empty($nutritionInformation->carbohydrateContent)) { 
            $this->carbohydrateContent =  $nutritionInformation->carbohydrateContent; 
            $this->carbohidratos = 'Carbohidratos';
        }
        if(!empty($nutritionInformation->cholesterolContent)) { 
            $this->cholesterolContent =  $nutritionInformation->cholesterolContent;
            $this->colesterol = 'Colesterol';
        }
        if(!empty($nutritionInformation->fatContent)) { 
            $this->fatContent =  $nutritionInformation->fatContent;
            $this->grasas = 'Grasas';
        }
        if(!empty($nutritionInformation->fiberContent)) { 
            $this->fiberContent =  $nutritionInformation->fiberContent;
            $this->fibra = 'Fibra';
        }
        if(!empty($nutritionInformation->proteinContent)) { 
            $this->proteinContent =  $nutritionInformation->proteinContent; 
            $this->proteina = 'Proteina';
        }
        if(!empty($nutritionInformation->saturatedFatContent)) { 
            $this->saturatedFatContent =  $nutritionInformation->saturatedFatContent;
            $this->grasas_saturadas = "Grasas Saturadas";
        }
        if(!empty($nutritionInformation->servingSize)) { 
            $this->servingSize =  $nutritionInformation->servingSize;
            $this->tam_porcion = 'Tam_porcion';
        }
        if(!empty($nutritionInformation->sodiumContent)) { 
            $this->sodiumContent =  $nutritionInformation->sodiumContent;
            $this->sodio = 'Sodio';
        }
        if(!empty($nutritionInformation->sugarContent)) { 
            $this->sugarContent =  $nutritionInformation->sugarContent;
            $this->azucar = 'Azucar';
        }
        if(!empty($nutritionInformation->transFatContent)) { 
            $this->transFatContent =  $nutritionInformation->transFatContent;
            $this->grasas_trans = 'Grasas Trans';
        }
        if(!empty($nutritionInformation->unsaturatedFatContent)) { 
            $this->unsaturatedFatContent =  $this->unsaturatedFatContent;
            $this->grasas_no_saturadas = 'Grasas No Saturadas';
        }
        
    }

    public function addNutritionItem()
    {
        $nutritionMap = [
            'Tamaño de la porción' => 'servingSize',
            'Calorias' => 'calories',
            'Carbohidratos' => 'carbohydrateContent',
            'Colesterol' => 'cholesterolContent',
            'Grasas' => 'fatContent',
            'Grasas Saturadas' => 'saturatedFatContent',
            'Grasas Trans' => 'transFatContent',
            'Grasas No Saturadas' => 'unsaturatedFatContent',
            'Fibra' => 'fiberContent',
            'Proteína' => 'proteinContent',
            'Sodio' => 'sodiumContent',
            'Azúcar' => 'sugarContent',
        ];
        
        $this->nutritionList[$nutritionMap[$this->nutritionItemName]] = $this->nutritionQty;
        
    }

    public function updatedPrepTime()
    {
        if( $this->prepTime){
            $this->totalTime = $this->prepTime + $this->cookTime;
        }
        
    }

    public function updatedCookTime()
    {
        if( $this->cookTime){
            $this->totalTime = $this->prepTime + $this->cookTime;
        }
        
    }

    public function updatedPhotos()
    {
        logger('cambio la foto');
        $this->validate([
            'photos.*' => 'image|max:1024',            
        ]);
        
        $this->photoHasChanged = true;
    }

    public function deleteIngredient($key)
    {
        $product = Product::where('name', $this->ingredientList[$key]['product'])->first();        
        $qty = $this->ingredientList[$key]['qty'];
        if($product)
        {
            
            $this->SubToCost($product, $key);
            $this->SubToServingSize($key);
            unset($this->ingredientList[$key]);
        }else{
            $this->emit('error', 'El producto no existe...');    
        }                
    }

    public function deleteNutritionItem($key)
    {
        dd($key);
    }

    public function edit()
    {

        $validatedData = $this->validate([
            'name' => 'required|min:6',
            'recipe_category_id' => 'required',
            'description' => 'required|min:6',
            'prepTime' => 'required',
            'cookTime' => 'required',
            'recipeYield' => 'required',
            'price' => 'required|numeric',
            'cost' => 'required|numeric',
            'inStock' => 'required',
        ]);

        if($this->photoHasChanged) {
            foreach($this->photos as $photo) {
                $url_foto = $photo->store('product-photos', 'public');
                $path = str_replace("public","storage", $url_foto);

                $image = RecipeImage::create([
                    'recipe_id' => $this->recipe->id,
                    'image' => $path,
                ]);
            }
        }

        $this->recipe->name = $this->name;
        $this->recipe->slug = Str::slug($this->name, '-');
        $this->recipe->recipe_category_id = $this->recipe_category_id;
        $this->recipe->description = $this->description;
        $this->recipe->prepTime = $this->prepTime;
        $this->recipe->cookTime = $this->cookTime;
        $this->recipe->totalTime = $this->totalTime;
        $this->recipe->recipeYield = $this->recipeYield;
        if($this->suitableForDiet){
            $this->recipe->suitableForDiet = $this->suitableForDiet;
        }
        $this->recipe->price = $this->price;
        $this->recipe->cost = $this->cost;
        $this->recipe->costPriceRatio = ($this->cost*100)/$this->price;        
        $this->recipe->mc = $this->cost*0.7;
        $calcAnt= ($this->recipe->mc + $this->recipe->cost)*1.16;
        $this->recipe->profitableness = ($this->recipe->price - $calcAnt);
        $this->recipe->inStock = $this->inStock;

        logger($this->recipe);
        try{
            $this->recipe->save();
        }catch(error $e)
        {
            logger($e);
            $this->emit('error', $e);
        }

        if($this->ingredientList)
        {
            $deleteIngredients = ProductRecipe::where('recipe_id',$this->recipe->id)->delete();
            foreach($this->ingredientList as $ingredient) {
                $product = Product::where('name',$ingredient['product'])->first();
                
                $unit = Unit::where('unit',$ingredient['unit'])->first();
                $ingredientItem = ProductRecipe::create([
                    'recipe_id' => $this->recipe->id,
                    'product_id' => $product->id,
                    'qty' => $ingredient['qty'],
                    'unit_id' => $unit->id
                ]);
            }
        }
        
        $nutritionInfo = NutritionInformation::where('recipe_id',$this->recipe->id)->first();
        if($this->calorias) { $nutritionInfo->calories =  $this->calories; }
        if($this->carbohidratos) { $nutritionInfo->carbohydrateContent =  $this->carbohydrateContent; }
        if($this->colesterol) { $nutritionInfo->cholesterolContent =  $this->cholesterolContent; }
        if($this->grasas) { $nutritionInfo->fatContent =  $this->fatContent; }
        if($this->fibra) { $nutritionInfo->fiberContent =  $this->fiberContent; }
        if($this->proteina) { $nutritionInfo->proteinContent =  $this->proteinContent; }
        if($this->grasas_saturadas) { $nutritionInfo->saturatedFatContent =  $this->saturatedFatContent; }
        if($this->tam_porcion) { $nutritionInfo->servingSize =  $this->servingSize; }
        if($this->sodio) { $nutritionInfo->sodiumContent =  $this->sodiumContent; }
        if($this->azucar) { $nutritionInfo->sugarContent =  $this->sugarContent; }
        if($this->grasas_trans) { $nutritionInfo->transFatContent =  $this->transFatContent; }
        if($this->grasas_no_saturadas) { $nutritionInfo->unsaturatedFatContent =  $this->unsaturatedFatContent; }

        $nutritionInfo->save();

        $this->emit('success', 'Se ha moificado la receta');
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
        }
        if($this->unitName == 'Kilogramo' || $this->unitName == 'Litro'){
            $this->cost = $this->cost + ($cost_per_gr_ml * ($this->ingredientQty*1000));
        }else{
            $this->cost = $this->cost + ($cost_per_gr_ml * $this->ingredientQty);
        }
        /* $this->cost = $this->cost + ($cost_per_gr_ml * $this->ingredientQty); */
    }

    private function AddToServingSize()
    {
        $measure = 1;
        $ingredientQty = $this->ingredientQty;

        if($this->unitName == 'Kilogramo' || $this->unitName == 'Litro'){            
            $ingredientQty = $this->ingredientQty * 1000;
        }
        $this->servingSize = $this->servingSize + $ingredientQty;
    }

    private function SubToCost(Product $product, $key)
    {
        $unit = $product->unit()->first()->unit;
        $qty = $this->ingredientList[$key]['qty'];
        $dunit = $this->ingredientList[$key]['unit'];
        $measure = 1;
        $multiply = $measure * $product->content;
        $cost_per_gr_ml=0;
        if($unit == 'Kilogramo' || $unit == 'Litro'){
            $measure = $multiply * 1000;
            $cost_per_gr_ml = $product->price / $measure;
        }
        if($unit == 'Gramo' || $unit == 'Mililitro'){
            $cost_per_gr_ml = $product->price / $multiply;
        }
        
        if($dunit == 'Kilogramo' || $dunit == 'Litro'){
            $this->cost = $this->cost - ($cost_per_gr_ml * ($qty*1000));
        }else{
            $this->cost = $this->cost - ($cost_per_gr_ml * $qty);
        }
        /* $this->cost = $this->cost - ($cost_per_gr_ml * $qty); */
        if(count($this->ingredientList) <= 0){
            $this->cost = 0;
        }
    }

    private function SubToServingSize($key)
    {
        $qty = $this->ingredientList[$key]['qty'];
        $unit = $this->ingredientList[$key]['unit'];
        $measure = 1;

        if($unit == 'Kilogramo' || $unit == 'Litro'){            
            $qty = $qty * 1000;
        }
        $this->servingSize = $this->servingSize - $qty;
        if(count($this->ingredientList) == 0){
            $this->servingSize = 0;
        }
    }
}
