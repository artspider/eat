<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Supplier;

class ProductCreate extends Component
{
    use WithFileUploads;

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
    public $other;
    public $content;

    public $categories;
    public $categoryName="Selecciona categoria";
    public $units;
    public $unitName="Selecciona unidad";
    public $suppliers;
    public $supplierName="Seleccione proveedor";

    public function mount()
    {
        $this->categories = Category::all();
        $this->units = Unit::all();
        $this->suppliers = Supplier::all();
    }

    public function render()
    {
        return view('livewire.admin.product-create',[
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

    public function save()
    {
        logger($this->unit_id);
        $this->validate([
            'name' => 'required|string',
            'category_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'supplier_id' => 'required|numeric',
            'presentation' => 'required|string',
            'photo' => 'required',
        ]);

        $url_foto = $this->photo->store('product-photos', 'public');
        $path = str_replace("public","storage", $url_foto);

        $slug = $this->name . ' ' . $this->brand . ' ' . $this->presentation;
        $product = Product::create([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'unit_id' => $this->unit_id,
            'price' => $this->price,
            'stock' => $this->stock,
            'supplier_id' => $this->supplier_id,
            
            'slug' => Str::slug($slug, '-'),
            'presentation' => $this->presentation,
            'other' => $this->other,
            'brand' => $this->brand,
            'content' => $this->content,
            'photo' => $path,
        ]);

        $this->clearValues();
        $this->emit('success', 'Se ha creado un nuevo producto');
    }

    public function clearValues()
    {
        $this->name = '';
        $this->category_id = 0;
        $this->unit_id = 0;
        $this->price = '';
        $this->stock = '';
        $this->supplier_id = 0;
        $this->slug = '';
        $this->presentation = '';
        $this->brand = '';
        $this->photo = '';
        $this->other = '';
        $this->content = '';        
        $this->categoryName="Selecciona categoria";
        $this->unitName="Selecciona unidad";
        $this->supplierName="Seleccione proveedor";
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

    public function mensaje()
    {
        //$this->emit('prueba', 'Mensaje'); 
        $this->emit('success', 'Otro mensaje');
    }
}
