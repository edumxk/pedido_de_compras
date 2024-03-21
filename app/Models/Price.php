<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'quantity',
        'product_id',
        'supplier_id',
        'budget_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function getTotalPrice(): float
    {
        return $price->quantity * $price->price;
    }
}
