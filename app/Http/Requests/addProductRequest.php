<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addProductRequest extends FormRequest
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
            'product_id' => 'required|min:1|max:9999999',
            'quantity' => ['required', 'min:0.01', 'max:9999999.99', 'regex:/^\d+([\.,]\d{1,2})?$/'],
            'price' => ['required', 'min:0.01', 'max:9999999.99', 'regex:/^\d+([\.,]\d{1,2})?$/'],
            'budget_id' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'product_id.required' => 'O campo produto é obrigatório',
            'product_id.min' => 'O campo produto deve ser maior que 0',
            'product_id.max' => 'O campo produto deve ser menor que 9999999',
            'quantity.required' => 'O campo quantidade é obrigatório',
            'quantity.min' => 'O campo quantidade deve ser maior que 0',
            'quantity.max' => 'O campo quantidade deve ser menor que 9999999.99',
            'quantity.regex' => 'O campo quantidade deve ser um número com até 2 casas decimais',
            'price.required' => 'O campo preço é obrigatório',
            'price.min' => 'O campo preço deve ser maior que 0',
            'price.max' => 'O campo preço deve ser menor que 9999999.99',
            'price.regex' => 'O campo preço deve ser um número com até 2 casas decimais',
            'budget_id.required' => 'O campo orçamento é obrigatório',
        ];
    }
}
