<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    //as many as contacts can have one supplier
    public function supplier()
    {
        return $this->belongsTo(Supllier::class);
    }
    //fillables
    protected $fillable = [
        'name',
        'email',
        'call',
        'whatsapp',
        'supplier_id',
    ];
}
