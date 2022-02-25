<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseHead extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'expense_head_name',
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
        return $this->id.'-'.$this->expense_head_name;
    }

    public function getExpenseHeadName($id){
        return $this->where('id', $id)->value('expense_head_name');
    }

    public function expenses(){
        return $this->hasMany(Expense::class,'expense_head','id');
    }

    public function hasChilds($parent_id) {
        return $this->whereParentId($parent_id)->count();
    }

    public function parent() {
        return $this->belongsTo(ExpenseHead::class, 'parent_id', 'id');
    }

    public static function modulePermissions($middleware = false, $route = null): array
    {

        if ($middleware) {

            switch ($route) {
                case 'index':
                case 'show':
                    return array('view_expense_head');
                    break;
                case 'create':
                case 'store':
                    return array('create_expense_head');
                    break;
                case 'edit':
                case 'update':
                    return array('edit_expense_head');
                    break;
                case 'delete':
                    return array('delete_expense_head');
                    break;
                default:
                    return array();
            }

        }

        return array(
            'view_expense_head',
            'create_expense_head',
            'edit_expense_head',
            'delete_expense_head',
        );
    }


}
