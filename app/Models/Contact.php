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
        return $this->belongsTo(Supplier::class);
    }
    protected $fillable = [
        'name',
        'email',
        'call',
        'whatsapp',
        'supplier_id',
    ];

    public function create(array $data)
    {
        return Contact::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'call' => $data['call'],
            'whatsapp' => $data['whatsapp'],
            'supplier_id' => $data['supplier_id'],
        ]);
    }
}
