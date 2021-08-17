<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class DishDestroy extends Component
{
    public $dish;

    protected $listeners = [
        'deleteDish' => 'destroy'
    ];

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.admin.dish-destroy');
    }

    public function destroy()
    {
        try {
            $this->dish->delete();
        } catch (Throwable  $e) {
            $this->emit('error','Ha ocurrido un problema, intentelo mas tarde: ' . $e);
        }
        
        $this->emit('success','Platillo eliminado correctamente');
        return redirect()->to('/admin/dishes');
    }
}
