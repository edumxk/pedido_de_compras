<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
        'payment_id',
        'purchase_order_id',
        'supplier_id',
    ];

    public function purchase_order()
    {
        return $this->belongsTo(Purchase_order::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()

    {
        return $this->hasMany(Payment::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
