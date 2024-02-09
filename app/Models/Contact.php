<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    //as many as contacts can have one supplier

    protected $fillable = [
        'name',
        'email',
        'call',
        'whatsapp',
        'supplier_id',
    ];

    public function supplier(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
