<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'budget_id',
        'type',
        'installments',
        'days',
        'discount',
        'addition',
    ];

    public function budgets()
    {
        return $this->hasOne(Budget::class);
    }
}
