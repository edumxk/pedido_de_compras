<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'budget_id',
        'type',
        'installments',
        'days',
        'discount',
        'addition',
        'user_id',
        'status',
    ];

    public function budgets()
    {
        return $this->belongsTo(Budget::class);
    }

    public function getValue(): array
    {
        //if addiction have any value, string inclusive
        if($this->addition){
            $addition = str_replace(' ', '', $this->addition);
            $addition = str_replace(',', '.', $addition);

            //check if addition is a percentage
            if(str_contains($addition, '%')){
                $addition = str_replace('%', '', $addition);
                $addition = 1 + ($addition / 100);
                return ['value' => $addition, 'type' => 'percentage'];
            }

            return ['value' => $addition, 'type' => 'money'];
        }elseif($this->discount){
            $discount = str_replace(' ', '', $this->discount);
            $discount = str_replace(',', '.', $discount);

            //check if discount is a percentage
            if(str_contains($discount, '%')){
                $discount = str_replace('%', '', $discount);
                $discount = 1 - $discount / 100;
                return ['value' => $discount, 'type' => 'percentage'];
            }

            return ['value' => $discount*(-1), 'type' => 'money'];
        }
        return ['value' => 0, 'type' => 'none'];
    }

    public function getPrice(float $total = 0): float
    {
        $value = $this->getValue();
        if ($value)
            switch ($value['type']) {
                case 'percentage':
                    return $total * $value['value'];
                    break;
                case 'money':
                    return $total + $value['value'];
                    break;
                case 'none':
                    return $total;
                    break;
            }
        return 0;
    }

    public function showTypeValue()
    {
        $value = $this->getValue();
        if ($value)
            switch ($value['type']) {
                case 'percentage':

                    return number_format(($value['value']-1)*100, 2, ',', '.') . ' %';
                    break;
                case 'money':
                    return 'R$ ' . number_format($value['value'], 2, ',', '.');
                    break;
                case 'none':
                    return 'R$ 0,00';
                    break;
            }
        return '0';
    }
}
