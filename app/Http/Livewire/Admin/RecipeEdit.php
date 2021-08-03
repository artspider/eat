<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Recipe;
use App\Models\Unit;
use App\Models\Product;
use App\Models\RecipeCategory;
use App\Models\RecipeIngredient;
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
        array_push(
            $this->ingredientList,array(
                'qty' => $this->ingredientQty,
                'unit' => $this->unitName,
                'product' => $this->productName
            )
        );
        
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

        $nutritionInformation = NutritionInformation::where('recipe_id',$this->recipe->id)->get();
        
        foreach($nutritionMap as $key => $nutritionItem)
        {
            if(!empty($nutritionInformation[0]->$nutritionItem))
            {
                
                $this->nutritionList[$nutritionItem] = $nutritionInformation[0]->$nutritionItem;
                
            }
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
        unset($this->ingredientList[$key]);
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
            $deleteIngredients = RecipeIngredient::where('recipe_id',$this->recipe->id)->delete();
            foreach($this->ingredientList as $ingredient) {
                $product = Product::where('name',$ingredient['product'])->first();
                
                $unit = Unit::where('unit',$ingredient['unit'])->first();
                $ingredientItem = RecipeIngredient::create([
                    'recipe_id' => $this->recipe->id,
                    'product_id' => $product->id,
                    'qty' => $ingredient['qty'],
                    'unit_id' => $unit->id
                ]);
            }
        }
        
        if($this->nutritionList){
            $nutritionInfo = NutritionInformation::where('recipe_id',$this->recipe->id)->first();
            
            foreach($this->nutritionList as $key => $nutritionItem){
                if($key == 'calories') { $nutritionInfo->calories =  $nutritionItem; }
                if($key == 'carbohydrateContent') { $nutritionInfo->carbohydrateContent =  $nutritionItem; }
                if($key == 'cholesterolContent') { $nutritionInfo->cholesterolContent =  $nutritionItem; }
                if($key == 'fatContent') { $nutritionInfo->fatContent =  $nutritionItem; }
                if($key == 'fiberContent') { $nutritionInfo->fiberContent =  $nutritionItem; }
                if($key == 'proteinContent') { $nutritionInfo->proteinContent =  $nutritionItem; }
                if($key == 'saturatedFatContent') { $nutritionInfo->saturatedFatContent =  $nutritionItem; }
                if($key == 'servingSize') { $nutritionInfo->servingSize =  $nutritionItem; }
                if($key == 'sodiumContent') { $nutritionInfo->sodiumContent =  $nutritionItem; }
                if($key == 'sugarContent') { $nutritionInfo->sugarContent =  $nutritionItem; }
                if($key == 'transFatContent') { $nutritionInfo->transFatContent =  $nutritionItem; }
                if($key == 'unsaturatedFatContent') { $nutritionInfo->unsaturatedFatContent =  $nutritionItem; }
            }
            $nutritionInfo->save();
        }

        $this->emit('success', 'Se ha moificado la receta');
    }
}
