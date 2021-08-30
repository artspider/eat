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

class RecipeCreate extends Component
{
    use WithFileUploads;

    public $photos = [];
    public $name;
    public $recipe_category_id;
    public $description;
    public $prepTime=0;
    public $cookTime=0;
    public $totalTime=0;
    public $recipeYield=1;
    public $suitableForDiet;
    public $recipeCuisine;
    public $price=0;
    public $cost=0;
    public $costPriceRatio;
    public $mc;
    public $profitableness;
    public $deliveryCharges;
    public $inStock=false;
    public $unit_id;
    public $product_id;

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

    public $servingSize = 0;
    public $calories=0;
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

    public $tam_porcion ='Tam_porcion';
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
    public $tabSelection=0;

    public function mount()
    {
        $this->recipeCategory = RecipeCategory::all();
        $this->units = Unit::all();
        $this->products = Product::all();
    }

    public function render()
    {
        return view('livewire.admin.recipe-create',[
            'recipe_categories' => $this->recipeCategory,
            'units' => $this->units,
            'products' => $this->products,
        ])
        ->layout('components.layouts.master');
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
            $cost = $this->AddToCost($product);
            array_push(
                $this->ingredientList,array(
                    'qty' => $this->ingredientQty,
                    'unit' => $this->unitName,
                    'product' => $this->productName,
                    'cost' => $cost
                )
            );

            
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
        logger($this->nutritionList);
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

    public function changeStock()
    {
        $this->inStock = !$this->inStock;
    }

    public function selectIngredient()
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
        $this->tabSelection = 1;
    }

    public function selectInfo()
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
        $this->tabSelection = 2;
    }

    public function selectImages()
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
        $this->tabSelection = 3;
    }

    public function save()
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
        
        if( $this->price <= $this->cost){
            $this->emit('error','El precio publico es erroneo');
            return;
        }

        $recipe = new Recipe();
        $recipe->name = $this->name;
        $recipe->slug = Str::slug($this->name, '-');
        $recipe->recipe_category_id = $this->recipe_category_id;
        $recipe->description = $this->description;
        $recipe->prepTime = $this->prepTime;
        $recipe->cookTime = $this->cookTime;
        $recipe->totalTime = $this->totalTime;
        $recipe->recipeYield = $this->recipeYield;
        if($this->suitableForDiet){
            $recipe->suitableForDiet = $this->suitableForDiet;
        }
        
        $recipe->price = $this->price;
        $recipe->cost = $this->cost;
        $recipe->costPriceRatio = ($this->cost*100)/$this->price;
        $recipe->mc = $this->cost*0.7;
        $calcAnt= ($recipe->mc + $recipe->cost)*1.16;
        $recipe->profitableness = ($recipe->price - $calcAnt);
        $recipe->inStock = $this->inStock;
        $recipe->unit_id = 3;

        $recipe->save();

        if($this->photos)
        {
            $this->validate([
                'photos.*' => 'image|max:1024', // 1MB Max
            ]);

            foreach ($this->photos as $photo) {
                $url_foto = $photo->store('product-photosmy', 'public');
                $path = str_replace("public","storage", $url_foto);

                $image = RecipeImage::create([
                    'recipe_id' => $recipe->id,
                    'image' => $path,
                ]);
            }
        }else{
            $image = RecipeImage::create([
                'recipe_id' => $recipe->id,
                'image' => 'fotos/no_disponible.png',
            ]);
        }
        
        if($this->ingredientList)
        {
            foreach($this->ingredientList as $ingredient) {
                $product = Product::where('name',$ingredient['product'])->first();
                logger($product);
                $unit = Unit::where('unit',$ingredient['unit'])->first();
                $ingredientItem = ProductRecipe::create([
                    'recipe_id' => $recipe->id,
                    'product_id' => $product->id,
                    'qty' => $ingredient['qty'],
                    'unit_id' => $unit->id
                ]);
            }
        }
        
        
        $nutritionInfo = new NutritionInformation();
        $nutritionInfo->recipe_id = $recipe->id;

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
        
        $this->emit('success', 'Se ha creado un nuevo producto');
    }

    private function AddToCost(Product $product)
    {
        $productCost=0;
        $unit = $product->unit()->first()->unit;
        $measure = 1;
        $multiply = $measure * $product->content;
        $cost_per_gr_ml=0;
        if($unit == 'Kilogramo' || $unit == 'Litro'){
            $measure = $multiply * 1000;
            $cost_per_gr_ml = $product->price / $measure;            
        }elseif($unit == 'Gramo' || $unit == 'Mililitro'){
            $cost_per_gr_ml = $product->price / $multiply;
        }elseif($unit == 'Pieza'){
            $cost_per_gr_ml = $product->price * 1;
        }
        
        if($this->unitName == 'Kilogramo' || $this->unitName == 'Litro'){
            $productCost = $cost_per_gr_ml * ($this->ingredientQty*1000);
            $this->cost = $this->cost + $productCost;
        }else{
            $productCost = $cost_per_gr_ml * $this->ingredientQty;
            $this->cost = $this->cost + $productCost;
        }
        /* $this->cost = $this->cost + ($cost_per_gr_ml * $this->ingredientQty); */
        return $productCost;
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
}