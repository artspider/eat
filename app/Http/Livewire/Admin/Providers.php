<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Providers extends Component
{
    public function render()
    {
        return view('livewire.admin.providers')
        ->layout('components.layouts.master');
    }
}
