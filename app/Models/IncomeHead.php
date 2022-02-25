<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeHead extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'income_head_name',
        'parent_id',
        'location_id',
    ];

    public function location() {
        return $this->belongsTo(BusinessLocation::class);
    }

    public function accountHead(){
        return $this->hasOne(AccountHead::class);
    }

    public function headName()
    {
        return $this->id.'-'.$this->income_head_name;
    }

    public function getIncomeHeadName($id){
        return $this->where('id', $id)->value('income_head_name');
    }

    public function incomes(){
        return $this->hasMany(Income::class,'income_head','id');
    }

    public function hasChilds($parent_id) {
        return $this->whereParentId($parent_id)->count();
    }

    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'index':
                case 'show':
                    return array('view_income_head');
                    break;
                case 'create':
                case 'store':
                    return array('create_income_head');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_income_head');
                    break;
                case 'delete':
                    return array('delete_income_head');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_income_head',
            'create_income_head',
            'edit_income_head',
            'delete_income_head',
        );
    }
}
