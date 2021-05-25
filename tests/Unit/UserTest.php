<?php

namespace Tests\Unit;

/* use PHPUnit\Framework\TestCase; */
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    
    /** @test */
    public function a_default_user_is_not_an_admin()
    {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'chef']);
        $chef = User::factory()->create();
        $chef->assignRole('chef');

        $this->assertFalse($chef->isAdmin());
    }

    /** @test */
    public function an_admin_user_is_an_admin()
    {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'superadmin']);
        $admin = User::factory()->create();
        $admin->assignRole('superadmin');

        $this->assertTrue($admin->isAdmin());
    }

}
