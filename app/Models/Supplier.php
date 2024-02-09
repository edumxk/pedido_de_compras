<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'fantasy_name',
        'company_name',
        'cnpj',
        'address'
    ];
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
