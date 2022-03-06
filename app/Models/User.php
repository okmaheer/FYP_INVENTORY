<?php

namespace App\Models;

use App\Interfaces\Permissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;

class User extends Authenticatable implements Permissions
{
    use HasFactory, Notifiable;

    use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'avatar'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',

    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];
	
	public function invoices(){
        return $this->hasMany(Invoice::class,'user_id','id');
    }

    /**
     * @return BelongsToMany
     */

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($RoleName): bool
    {
        if (is_string($RoleName)) {
            return $this->roles->contains('name', $RoleName);
        }

        return !!$RoleName->intersect($this->roles);
    }

    public function ability($permissionName): bool
    {
        $permissions = $this->getAllPermissionsFromAllRoles();

        if ($permissionName && $permissions && in_array($permissionName, $permissions)) {
            return true;
        }

        return false;
    }

    public function getName(): string
    {
        return $this->name;
    }

    private function getAllPermissionsFromAllRoles(): array
    {
        $permissions = [];
        $roles = $this->roles->load('permissions');

        if (!$roles) {
            return [];
        }

        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                $permissions[] = $permission->toArray();
            }
        }

        return array_map('strtolower', array_unique(Arr::flatten(array_map(function ($permission) {
            return $permission['name'];
        }, $permissions))));
    }

    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'manage':
                case 'show':
                    return array('view_user');
                    break;
                case 'create':
                case 'store':
                    return array('create_user');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_user');
                    break;
                case 'delete':
                    return array('delete_user');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_user',
            'create_user',
            'edit_user',
            'delete_user',
        );
    }


}
