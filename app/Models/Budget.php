<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'budget_number',
        'status',
        'user_id',
        'payment_id',
        'purchase_order_id',
        'created_at',
    ];
}
