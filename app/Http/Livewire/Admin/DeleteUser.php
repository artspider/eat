<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\User;

class DeleteUser extends Component
{
    public $user;

    public function render()
    {
        return view('livewire.admin.delete-user');
    }

    public function remove()
    {
        $this->user->delete();

        $this->emit('success', 'Se elimino el usuario');
        return redirect()->to('admin/users');
    }
}
