<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class Users extends Component
{
    public $users;

    protected $listeners = [
        'success' => 'newUser',
        'deleteUser' => 'remove'
    ];

    public function newUser()
    {
        $this->users = User::all();
    }

    public function mount()
    {
        $this->users = User::all();
        
    }

    public function render()
    {
        return view('livewire.admin.users',[
            'users' => $this->users
        ])
        ->layout('components.layouts.master');
    }

    public function remove(User $user)
    {
        $user->delete();
        $this->emit('success', 'Se elimino el usuario');        
    }

   
}
