<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Recipe;
use Livewire\WithPagination;

class Menus extends Component
{
    use WithPagination;

    protected $queryString = ['search' => ['except' => '']];

    public $search;

    protected $listeners = [
        'success' => 'newMenu',
        'deleteRecipe' => 'remove'
    ];

    public function render()
    {
        return view('livewire.admin.menus',[
            'recipes' => Recipe::where('name', 'LIKE', "%{$this->search}%")
                                    ->paginate(5)
        ])
        ->layout('components.layouts.master');
    }

    public function remove(Recipe $recipe)
    {
        $recipe->delete();
        $this->emit('success', 'Se elimino la receta');
    }
}
