<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'month',
        'year',
        'basic_salary',
        'gross_salary',
        'net_salary',
        'total_days',
        'working_days',
        'present_days',
        'total_office_time',
        'total_worked_time',
        'half_days',
        'late_days',
        'paid_leaves',
        'unpaid_leaves',
        'holiday_count',
        'payment_date',
        'status',
    ];
}
