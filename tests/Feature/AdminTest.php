<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Livewire;
use App\Http\Livewire\Admin\CreateUser;
use App\Http\Livewire\Admin\AssignRole;
use App\Http\Livewire\Admin\DeleteUser;


class AdminTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_default_user_cannot_access_the_admin_section()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/admin')
            ->assertRedirect('home');
    }
    
    /** @test */
    public function an_admin_can_access_the_admin_section()
    {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'superadmin']);
        $admin = User::factory()->create();
        $admin->assignRole('superadmin');

        $this->actingAs($admin)
            ->get('/admin')
            ->assertStatus(200);
    }

    /** 
     * @test
     * @testdox  Crear un nuevo usuario
     */
    public function an_admin_can_create_a_new_user()
    {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'superadmin']);
        $admin = User::factory()->create();
        $admin->assignRole('superadmin');

        $this->actingAs($admin);

        Livewire::test(CreateUser::class)
            ->set('name', 'Arturo Rodriguez')
            ->set('email', 'arturo.itiguala@gmail.com')
            ->set('password', '12345678')
            ->call('save')
            ->assertEmitted('success', 'Se ha creado un nuevo usuario');

    }

    /** @test  */
    public function an_admin_can_delete_a_user()
    {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'superadmin']);
        $admin = User::factory()->create();
        $admin->assignRole('superadmin');

        $this->actingAs($admin);
        $user = User::factory()->create();

        Livewire::test(DeleteUser::class)
            ->set('user', $user)
            ->call('remove')
            ->assertEmitted('success', 'Se elimino el usuario')
            ->assertRedirect('admin/users');
    }
    
    /** @test  */
    function name_is_required()
    {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'superadmin']);
        $admin = User::factory()->create();
        $admin->assignRole('superadmin');

        $this->actingAs($admin);

        Livewire::test(CreateUser::class)
            ->set('name', '')
            ->set('email', 'arturo.itiguala@gmail.com')
            ->set('password', '12345678')
            ->call('save')
            ->assertHasErrors(['name' => 'required']);
    }

    /** @test  */
    function email_has_email_format()
    {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'superadmin']);
        $admin = User::factory()->create();
        $admin->assignRole('superadmin');

        $this->actingAs($admin);

        Livewire::test(CreateUser::class)
            ->set('name', 'Arturo Rodriguez')
            ->set('email', 'arturo.itiguala')
            ->set('password', '12345678')
            ->call('save')
            ->assertHasErrors(['email' => 'email']);
    }

    /** @test  */
    function email_is_required()
    {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'superadmin']);
        $admin = User::factory()->create();
        $admin->assignRole('superadmin');

        $this->actingAs($admin);

        Livewire::test(CreateUser::class)
            ->set('name', 'Arturo Rodriguez')
            ->set('email', '')
            ->set('password', '12345678')
            ->call('save')
            ->assertHasErrors(['email' => 'required']);
    }

    /** @test  */
    function password_is_required()
    {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'superadmin']);
        $admin = User::factory()->create();
        $admin->assignRole('superadmin');

        $this->actingAs($admin);

        Livewire::test(CreateUser::class)
            ->set('name', 'Arturo Rodriguez')
            ->set('email', 'arturo@gmail.com')
            ->set('password', '')
            ->call('save')
            ->assertHasErrors(['password' => 'required']);
    }

    /** @test  */
    function password_must_have_8_chars()
    {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'superadmin']);
        $admin = User::factory()->create();
        $admin->assignRole('superadmin');

        $this->actingAs($admin);

        Livewire::test(CreateUser::class)
            ->set('name', 'Arturo Rodriguez')
            ->set('email', 'arturo@gmail.com')
            ->set('password', '12345')
            ->call('save')
            ->assertHasErrors(['password' => 'min']);
    }

     /** @test  */
     function is_redirected_to_users_page_after_creation()
     {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'superadmin']);
        $admin = User::factory()->create();
        $admin->assignRole('superadmin');

        $this->actingAs($admin);
 
        Livewire::test(CreateUser::class)
            ->set('name', 'Arturo Rodriguez')
            ->set('email', 'arturo@gmail.com')
            ->set('password', '12345678')
            ->call('save')
            ->assertRedirect('admin/users');
     }

     /** @test */
     public function an_admin_can_assign_a_chef_role_to_a_user()
     {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'superadmin']);
        $admin = User::factory()->create();
        $admin->assignRole('superadmin');

        $this->actingAs($admin);

        $role = Role::create(['name' => 'chef']);
        $user = User::factory()->create();

        Livewire::test(AssignRole::class)
            ->set('user', $user)
            ->set('role', 'chef')
            ->call('assign')
            ->assertEmitted('success', 'El usuario ahora es chef');
     }

     public function an_admin_can_assign_a_waiter_role_to_a_user()
     {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'superadmin']);
        $admin = User::factory()->create();
        $admin->assignRole('superadmin');

        $this->actingAs($admin);

        $role = Role::create(['name' => 'waiter']);
        $user = User::factory()->create();

        Livewire::test(AssignRole::class)
            ->set('user', $user)
            ->set('role', 'waiter')
            ->call('assign')
            ->assertEmitted('success', 'El usuario ahora es waiter');
     }

     public function an_admin_can_assign_a_manager_role_to_a_user()
     {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'superadmin']);
        $admin = User::factory()->create();
        $admin->assignRole('superadmin');

        $this->actingAs($admin);

        $role = Role::create(['name' => 'manager']);
        $user = User::factory()->create();

        Livewire::test(AssignRole::class)
            ->set('user', $user)
            ->set('role', 'manager')
            ->call('assign')
            ->assertEmitted('success', 'El usuario ahora es manager');
     }

     public function an_admin_can_assign_a_ceo_role_to_a_user()
     {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'superadmin']);
        $admin = User::factory()->create();
        $admin->assignRole('superadmin');

        $this->actingAs($admin);

        $role = Role::create(['name' => 'ceo']);
        $user = User::factory()->create();

        Livewire::test(AssignRole::class)
            ->set('user', $user)
            ->set('role', 'ceo')
            ->call('assign')
            ->assertEmitted('success', 'El usuario ahora es ceo');
     }
     
}
