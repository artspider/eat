<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;

class AssignRole extends Component
{
    public $user;
    public $role;
    
    public function render()
    {
        return view('livewire.admin.assign-role');
    }

    public function assign()
    {
        $this->user->assignRole($this->role);

        $this->emit('success', 'El usuario ahora es '.$this->role);
    }
}
