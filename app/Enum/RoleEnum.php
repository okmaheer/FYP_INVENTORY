<?php

declare(strict_types=1);

namespace App\Enum;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class RoleEnum extends AbstractEnum
{
    public const ROLE_SUPER_ADMIN = 'super-admin';


    public static function getUserRolePermissions($user)
    {
        return Cache::remember(CacheEnum::AUTH_ROLES_PERMISSIONS,'86400', function () use($user){
            return $user->roles->load('permissions');
        });
    }

    public static function getValues(): array
    {
        return [];
    }

    public static function getTranslationKeys(): array
    {
        return [

        ];
    }

    public static function checkPermission($user, $permission)
    {
        $permissions = self::getAllPermissionForAllRoles($user);
        if ($permissions === true) {
            return true;
        }
        $permissionArray = is_array($permission) ? $permission : [$permission];
        return count(array_intersect($permissions, $permissionArray));
    }

    public static function getAllPermissionForAllRoles($user)
    {
        $permissions = array();
        $roles = self::getUserRolePermissions($user);
        if (!$roles) {
            return true;
        }
        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                $permissions[] = $permission->toArray();
            }
        }
        return array_map('strtolower', array_unique(self::array_flatten(array_map(function ($permission) {
            return $permission['name'];
        }, $permissions))));
    }

    private static function array_flatten(array $array_map): array
    {
        $result = array();
        foreach ($array_map as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, self::array_flatten($value));
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }


}
