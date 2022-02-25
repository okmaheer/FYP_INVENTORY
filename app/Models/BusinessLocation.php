<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessLocation extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = "business_locations";

    protected $fillable = [
        'business_id',
        'name',
        'phone_1',
        'phone_2',
        'mobile_1',
        'mobile_2',
        'address_1',
        'address_2',
        'logo',
        'email',
        'website',
        'date_format',
    ];

    public static function MomentFormat($format)
    {
        $replacements = [
            'd' => 'dd',
            'D' => 'D',
            'j' => 'D',
            'l' => 'dddd',
            'N' => 'E',
            'S' => 'o',
            'w' => 'e',
            'z' => 'DDD',
            'W' => 'W',
            'F' => 'MMMM',
            'm' => 'mm',
            'M' => 'M',
            'n' => 'M',
            't' => '', // no equivalent
            'L' => '', // no equivalent
            'o' => 'yyyy',
            'Y' => 'yyyy',
            'y' => 'yy',
            'a' => 'a',
            'A' => 'A',
            'B' => '', // no equivalent
            'g' => 'h',
            'G' => 'H',
            'h' => 'hh',
            'H' => 'HH',
            'i' => 'mm',
            's' => 'ss',
            'u' => 'SSS',
            'e' => 'zz', // deprecated since version 1.6.0 of moment.js
            'I' => '', // no equivalent
            'O' => '', // no equivalent
            'P' => '', // no equivalent
            'T' => '', // no equivalent
            'Z' => '', // no equivalent
            'c' => '', // no equivalent
            'r' => '', // no equivalent
            'U' => 'X',
        ];
        $momentFormat = strtr($format, $replacements);
        return $momentFormat;
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function users() {
        return $this->hasMany(User::class, 'location_id');
    }

    public function customers() {
        return $this->hasMany(Customer::class, 'location_id');
    }

    public function transactions() {
        return $this->hasMany(Transaction::class, 'location_id');
    }

    public function suppliers() {
        return $this->hasMany(Supplier::class, 'location_id');
    }

    public function categories() {
        return $this->hasMany(Category::class, 'location_id');
    }

    public function units() {
        return $this->hasMany(Unit::class, 'location_id');
    }

    public function products() {
        return $this->hasMany(Product::class, 'location_id');
    }

    public function purchases() {
        return $this->hasMany(Purchase::class, 'location_id');
    }

    public function invoices() {
        return $this->hasMany(Invoice::class, 'location_id');
    }

    public function incomeHeads() {
        return $this->hasMany(IncomeHead::class, 'location_id');
    }

    public function incomes() {
        return $this->hasMany(Income::class, 'location_id');
    }

    public function expenseHeads() {
        return $this->hasMany(ExpenseHead::class, 'location_id');
    }

    public function expenses() {
        return $this->hasMany(Expense::class, 'location_id');
    }

    public function designations() {
        return $this->hasMany(Designation::class, 'location_id');
    }

    public function employees() {
        return $this->hasMany(Employee::class, 'location_id');
    }

    public function attendances() {
        return $this->hasMany(Attendance::class, 'location_id');
    }

    public function salaries() {
        return $this->hasMany(Salary::class, 'location_id');
    }

    public function employeeLoans() {
        return $this->hasMany(EmployeeLoan::class, 'location_id');
    }

    public function hardwareSettings() {
        return $this->hasMany(HardwareSetting::class, 'location_id');
    }

    public function settings() {
        return $this->hasMany(Setting::class, 'location_id');
    }

    public function accountHeads() {
        return $this->hasMany(AccountHead::class, 'location_id');
    }

    public function banks() {
        return $this->hasMany(Bank::class, 'location_id');
    }

    public function dailyClosings() {
        return $this->hasMany(DailyClosing::class, 'location_id');
    }

    public function fiscalYears() {
        return $this->hasMany(FiscalYear::class, 'location_id');
    }
}
