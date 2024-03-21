<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
        'purchase_order_id',
    ];

    public static function create(array $array)
    {
        //save the interaction
        $interaction = static::query()->create($array);
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(Purchase_order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }


}
