<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'brand',
        'model',
        'category_id'
    ];

    public static function create(array $array): void
    {
        //save the product
        $product = static::query()->create($array);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
