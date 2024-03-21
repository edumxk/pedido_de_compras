<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
        'purchase_order_id',
        'supplier_id',
    ];

    public function purchase_order()
    {
        return $this->belongsTo(Purchase_order::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()

    {
        return $this->hasMany(Payment::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function getTotal()
    {
        $total = 0;
        if($this->prices->isEmpty()){
            return 1;
        }

        foreach ($this->prices as $price) {
            $total += $price->price * $price->quantity;
        }

        return $total;
    }

    public function showRangePrice(array $range): string
    {
        if (empty($range)) {
            return "R$ 0,00";
        }
        if(count($range) == 1)
            return "R$ " . number_format($range[0], 2, ',', '.') ;

        try {
            $menorValor = min($range);
            $maiorValor = max($range);
        } catch (\Exception $e) {
            \Log::info('Erro ao calcular valores: ', ['error' => $e->getMessage()]);
            return "R$ 0,00";
        }

        return "R$ " . number_format($menorValor, 2, ',', '.') . " - R$ " . number_format($maiorValor, 2, ',', '.');
    }



}
