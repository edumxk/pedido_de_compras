<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

class Purchase_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_subject',
        'description',
        'status',
        'user_id',
        'department_id',
        'aprovacao_direta',
    ];

    public static function create(array $array): void
    {
        //save the purchase_order
        $purchase_order = static::query()->create($array);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

}
