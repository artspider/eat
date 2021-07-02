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

class MenuCreate extends Component
{
    use WithFileUploads;

    public $photos = [];
    public $name;
    public $recipeCategory_id;
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

    public function mount()
    {
        $this->recipeCategory = RecipeCategory::all();
        $this->units = Unit::all();
        $this->products = Product::all();
    }

    public function render()
    {
        return view('livewire.admin.menu-create',[
            'recipe_categories' => $this->recipeCategory,
            'units' => $this->units,
            'products' => $this->products,
        ])
        ->layout('components.layouts.master');
    }

    public function SelectCategory(RecipeCategory $category)
    {
        $this->recipeCategory_id = $category->id;
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
        logger($this->ingredientList);
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
        
        $recipe = new Recipe();
        $recipe->name = $this->name;
        $recipe->recipe_category_id = $this->recipeCategory_id;
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

        $recipe->save();

        if($this->photos)
        {
            $this->validate([
                'photos.*' => 'image|max:1024', // 1MB Max
            ]);

            foreach ($this->photos as $photo) {
                $url_foto = $photo->store('product-photos', 'public');
                $path = str_replace("public","storage", $url_foto);

                $image = RecipeImage::create([
                    'recipe_id' => $recipe->id,
                    'image' => $path,
                ]);
            }
        }
        
        if($this->ingredientList)
        {
            foreach($this->ingredientList as $ingredient) {
                $product = Product::where('name',$ingredient['product'])->first();
                logger($product);
                $unit = Unit::where('unit',$ingredient['unit'])->first();
                $ingredientItem = RecipeIngredient::create([
                    'recipe_id' => $recipe->id,
                    'product_id' => $product->id,
                    'qty' => $ingredient['qty'],
                    'unit_id' => $unit->id
                ]);
            }
        }
        
        if($this->nutritionList){
            $nutritionInfo = new NutritionInformation();
            $nutritionInfo->recipe_id = $recipe->id;
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
        $this->emit('success', 'Se ha creado un nuevo producto');
    }
}