<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Supplier;

class ProductEdit extends Component
{
    use WithFileUploads;

    public $product;
    public $name;
    public $category_id;
    public $unit_id;
    public $price;
    public $stock;
    public $supplier_id;
    public $slug;
    public $presentation;
    public $brand;
    public $photo;
    public $photo_path;
    public $other;
    public $content;

    public $categories;
    public $categoryName;
    public $units;
    public $unitName;
    public $suppliers;
    public $supplierName;
    public $photoHasChanged = false;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->categories = Category::all();
        $this->units = Unit::all();
        $this->suppliers = Supplier::all();

        $this->name = $this->product->name;
        $this->category_id = $this->product->category_id;
        $this->unit_id = $this->product->unit_id;
        $this->price = $this->product->price;
        $this->stock = $this->product->stock;
        $this->supplier_id = $this->product->supplier_id;
        $this->slug = $this->product->slug;
        $this->presentation = $this->product->presentation;
        $this->brand = $this->product->brand;
        $this->photo_path = $this->product->photo;
        $this->other = $this->product->other;
        $this->content = $this->product->content;
        $this->categoryName = $this->product->category->name;
        $this->unitName = $this->product->unit->unit;
        $this->supplierName = $this->product->supplier->company_name;
    }

    public function render()
    {
        return view('livewire.admin.product-edit',[
            'product' => $this->product,
            'categories' => $this->categories,
            'units' => $this->units
        ])
        ->layout('components.layouts.master');
    }

    public function updatedPhoto()
    {
        logger('cambio la foto');
        $this->validate([
            'photo' => 'image|max:1024',            
        ]);
        logger($this->photo);
        $this->photoHasChanged = true;
    }

    public function SelectCategory(Category $category)
    {
        $this->category_id = $category->id;
        $this->categoryName = $category->name;
    }

    public function SelectUnit(Unit $unit)
    {
        $this->unit_id = $unit->id;
        $this->unitName = $unit->unit;
    }

    public function SelectSupplier(Supplier $supplier)
    {
        $this->supplier_id = $supplier->id;
        $this->supplierName = $supplier->company_name;
    }

    public function edit()
    {
        logger($this->unit_id);
        $this->validate([
            'name' => 'required|string',
            'category_id' => 'required|numeric',
            'content' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'presentation' => 'required|string',
            'brand' => 'string|min:3',
            'supplier_id' => 'required|numeric',           
        ]);

        if($this->photoHasChanged){
            $url_foto = $this->photo->store('product-photos', 'public');
            $path = str_replace("public","storage", $url_foto);
            $this->product->photo = $path;
        }        

        $slug = $this->name . ' ' . $this->brand . ' ' . $this->presentation;       
        $this->product->name = $this->name;
        $this->product->category_id = $this->category_id;
        $this->product->unit_id = $this->unit_id;
        $this->product->price = $this->price;
        $this->product->stock = $this->stock;
        $this->product->supplier_id = $this->supplier_id;            
        $this->product->slug = Str::slug($slug, '-');
        $this->product->presentation = $this->presentation;
        $this->product->other = $this->other;
        $this->product->brand = $this->brand;
        $this->product->content = $this->content;

        try{
            $this->product->save();
        }catch(error $e)
        {
            $this->emit('error', 'Se ha presentado un error');
        }       

        $this->emit('success', 'Se ha moificado el producto');
    }
}
