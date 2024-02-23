<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IncreasingNumbers implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //remove spaces
        $value = str_replace(' ', '', $value);

        //verify if the string is a sequence of numbers
        if(!preg_match('/^(\d+,)*\d+$/', $value)){
            return false;
        }

        if ($value > 999) {
            return false;
        }
        if ($value < 0) {
            return false;
        }

        $numbers = explode(',', $value);
        for ($i = 0; $i < count($numbers) - 1; $i++) {

            if ($numbers[$i] < 0) {
                return false;
            }

            if ($numbers[$i] > 999) {
                return false;
            }

            if (!is_numeric($numbers[$i])) {
                return false;
            }

            if ($numbers[$i] >= $numbers[$i + 1]) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Os :attribute devem ser uma sequência de números crescentes. ex: 30,60,90';
    }
}
