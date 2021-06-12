<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Livewire;

use App\Models\User;
use App\Models\Product;
use App\Http\Livewire\Admin\Products;
use App\Http\Livewire\Admin\ProductCreate;
use App\Http\Livewire\Admin\ProductEdit;
use App\Http\Livewire\Admin\ProductDelete;

class ProductTest extends TestCase
{
    use RefreshDatabase;    

    /** Probar que existe una ruta para administrar productos */
    /** y que solo el admin, CEO, MANAGER y CHEF puedan acceder*/
    /** @test */
    public function an_admin_can_access_to_products_section()
    {
        $this->withoutExceptionHandling();

        $superadmin = User::factory()->create();
        $role = Role::create(['name' => 'superadmin']);
        $superadmin->assignRole('superadmin');

        $this->actingAs($superadmin)
            ->get('/admin/products')
            ->assertStatus(200);
    }

    public function a_chef_can_access_to_products_section()
    {
        $this->withoutExceptionHandling();

        $chef = User::factory()->create();
        $role = Role::create(['name' => 'chef']);
        $chef->assignRole('chef');

        $this->actingAs($chef)
            ->get('/admin/products')
            ->assertStatus(200);
    }

    /** 
     * @test
     * @testdox  Crear un nuevo producto
     */
    public function an_admin_can_create_a_new_product()
    {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'superadmin']);
        $admin = User::factory()->create();
        $admin->assignRole('superadmin');

        $this->actingAs($admin);

        Livewire::test(ProductCreate::class)
            ->set('name', 'Aceite')
            ->set('category_id', 5)
            ->set('unit_id', 9)
            ->set('price', 32.00)
            ->set('stock', 2)
            ->set('supplier_id', 1)
            ->set('slug', 'aceite')
            ->set('presentation', 'Botella plástica')
            ->set('brand', 'Nutrioli')
            ->call('save')
            ->assertEmitted('success', 'Se ha creado un nuevo producto');
    }
    
}
