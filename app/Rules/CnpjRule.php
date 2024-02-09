<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CnpjRule implements Rule
{
    public function passes($attribute, $value)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $value);
        if (strlen($cnpj) != 14) {
            return false;
        }
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }
        for ($t = 12; $t < 14; $t++) {
            $d = 0;
            $c = 0;
            for ($m = 0; $m < $t; $m++) {
                $c += $cnpj[$m] * (($t + 1) - $m);
            }
            $c = ($c % 11) < 2 ? 0 : 11 - ($c % 11);
            if ($c != $cnpj[$t]) {
                return false;
            }
            $d += $c * (($t == 12) ? 2 : 1);
        }
        $d = ($d % 11) < 2 ? 0 : 11 - ($d % 11);
        if ($d != $cnpj[13]) {
            return false;
        }
        return true;
    }

    public function message()
    {
        return 'O campo :attribute não é um CNPJ válido.';
    }
}
