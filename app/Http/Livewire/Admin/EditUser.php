<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use App\Models\User;

class EditUser extends Component
{
    use WithFileUploads;

    public $user;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $phone;
    public $address;
    public $role;
    public $photo;
    public $resetPassword;
    public $photoHasChanged = false;

    protected $listeners = [
        'editUser' => 'edit',
        'cambioP' => 'cambioPhoto',
    ];    

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.admin.edit-user');
    }

    public function edit($id)
    {
        $this->user = User::find($id);
        $role = $this->user->getRoleNames()->first();
        $this->name=$this->user->name;
        $this->email=$this->user->email;
        /* $this->password=$this->user->password; */
        $this->phone=$this->user->phone;
        $this->address=$this->user->address;
        $this->role=$role;
        $this->resetPassword=false;
        $this->photoHasChanged = false;
        /* $this->photo=$this->user->profile_photo_path; */
    }

    public function updatedResetPassword()
    {        
        if($this->resetPassword){
            logger($this->resetPassword);
            
        }
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

    public function editUser()
    {

       $this->validate([
            'name' => 'required|min:7',
            'email' => 'required|email',
            'phone' => 'required|numeric|min:11',
            'address' => 'required|min:8',
            'role' => 'required',
        ]);
        
        logger('paso el validate');
        if($this->resetPassword){
            $validatedData = $this->validate([
                'password' => 'required|confirmed|min:8',
            ]);
            $this->user->password = Hash::make($this->password);
        }

        if($this->photoHasChanged){
            $url_foto = $this->photo->store('profile-photos', 'public');        
            $ruta = str_replace("public","storage", $url_foto);
            $this->user->profile_photo_path = $ruta;
        }        
        
        $this->user->name = $this->name;
        $this->user->email = $this->email;        
        $this->user->phone = $this->phone;
        $this->user->address = $this->address;        

        $this->user->save();

        $role = $this->user->getRoleNames()->first();
        $this->user->removeRole($role);
        $this->user->assignRole($this->role);
        
        $this->name="";
        $this->email="";
        $this->password="";
        $this->phone="";
        $this->address="";
        $this->role="";
        $this->photo="";
        $this->resetPassword=false;
        $this->photoHasChanged = false;
        
        $this->emit('success', 'Se ha actualizado el usuario');        
    }
}
