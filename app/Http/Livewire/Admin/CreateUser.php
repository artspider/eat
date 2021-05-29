<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

use App\Models\User;

class CreateUser extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $phone;
    public $address;
    public $role="manager";
    public $photo;

    protected $rules = [
        'name' => 'required|min:7',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:8',
        'phone' => 'required|numeric|min:11',
        'address' => 'required|min:8',
        'photo' => 'image|max:1024',
        'role' => 'required',

    ];

    public function render()
    {
        return view('livewire.admin.create-user');
    }

    public function save()
    {
        $this->validate();

        $url_foto = $this->photo->store('profile-photos', 'public');
        
        $ruta = str_replace("public","storage", $url_foto);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
            'address' => $this->address,
            'profile_photo_path' => $ruta,
        ]);

        $user->assignRole($this->role);
        $this->emit('success', 'Se ha creado un nuevo usuario');

        /* return redirect()->to('admin/users'); */
    }
}
