<?php

namespace App\Models;

use App\Enum\RoleEnum;
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
        'avatar',
        'is_PettyCash',
        'location_id'
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

    public function location()
    {
        return $this->belongsTo(BusinessLocation::class);
    }

	public function invoices(){
        return $this->hasMany(Invoice::class,'user_id','id');
    }

    public function accountHead(){
        return $this->hasOne(AccountHead::class, 'pettycash_id', 'id');
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

    public function ability($permission = null): bool
    {
        return !is_null($permission) && RoleEnum::checkPermission($this, $permission);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'index':
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
