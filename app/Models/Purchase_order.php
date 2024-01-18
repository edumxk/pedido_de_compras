<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_subject',
        'description',
        'status',
        'user_id',
    ];

    public static function create(array $array)
    {
        //save the purchase_order
        $purchase_order = static::query()->create($array);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
