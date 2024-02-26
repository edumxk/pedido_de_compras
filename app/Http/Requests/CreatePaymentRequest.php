<?php

namespace App\Http\Requests;

use App\Rules\IncreasingNumbers;
use Illuminate\Foundation\Http\FormRequest;


class CreatePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'budget_id' => 'required',
            'type' => 'required|in:boleto,credito,debito,pix,cheque,outros,dinheiro',
            'installments' => 'required|numeric|min:1|max:420',
            'days' => ['required', new IncreasingNumbers],
        ];
    }
}
