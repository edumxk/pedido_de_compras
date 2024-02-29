<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provision extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'user_id',
        'interaction_id',
        'description',
        'status',
    ];

    public function purchase_order()
    {
        return $this->belongsTo(Purchase_order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function interaction()
    {
        return $this->belongsTo(Interaction::class);
    }

}
