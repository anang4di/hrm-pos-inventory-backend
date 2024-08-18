<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
        'phone',
        'address',
        'status',
        'total_users',
        'clock_in_time',
        'clock_out_time',
        'early_clock_in_time',
        'allow_clock_out_till',
        'self_clocking',
    ];

    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function designations()
    {
        return $this->hasMany(Designation::class);
    }

    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }

    public function basicSalaries()
    {
        return $this->hasMany(BasicSalary::class);
    }
}
