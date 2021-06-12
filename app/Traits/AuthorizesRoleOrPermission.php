<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Exceptions\UnauthorizedException;
use App\Models\User;

trait AuthorizesRoleOrPermission
{
    public function authorizeRoleOrPermission($roleOrPermission, $guard = null)
    {
        
        $authUser = Auth::guard($guard)->user();
        $user = User::find($authUser->id);
        
        if (Auth::guard($guard)->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $rolesOrPermissions = is_array($roleOrPermission)
            ? $roleOrPermission
            : explode('|', $roleOrPermission);

        if (! $user->hasAnyRole($rolesOrPermissions) && ! $user()->hasAnyPermission($rolesOrPermissions)) {
            throw UnauthorizedException::forRolesOrPermissions($rolesOrPermissions);
        }
    }
}