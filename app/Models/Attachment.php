<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    public mixed $file_path;
    protected $fillable = [
        'file_name',
        'file_path',
        'file_type',
        'file_extension',
        'file_size',
        'purchase_order_id',
        'budget_id',
        'interaction_id',
    ];

    public static function create(array $array)
    {
        //save the attachment
        $attachment = static::query()->create($array);
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(Purchase_order::class);
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function interaction()
    {
        return $this->belongsTo(Interaction::class);
    }

}
