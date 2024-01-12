<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supllier extends Model
{
    use HasFactory;
    //as many as suppliers can have many contacts
    public function contacts()
    {
        return $this->belongsToMany(Contact::class);
    }
    //fillables
    protected $fillable = [
        'fantasy_name',
        'company_name',
        'cnpj',
    ];
}
