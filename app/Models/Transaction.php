<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'course_id', 'total_amount', 'transaction_id', 'payment_method', 'currency', 'payment_details', 'payment_time', 'status',
    ];
}
