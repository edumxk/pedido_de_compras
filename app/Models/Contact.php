<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    //as many as contacts can have one supplier

    public mixed $email;
    public mixed $call;
    /**
     * @var mixed|string
     */
    public mixed $adress;
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
