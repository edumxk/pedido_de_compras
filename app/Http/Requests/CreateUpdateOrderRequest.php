<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(auth()->check()) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'purchase_subject' => ['required', 'max:255', 'min:3'],
            'description' => ['required', 'min:30'],
            'department_id' => ['required', 'exists:departments,id'],
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
            'purchase_subject.required' => 'O campo assunto é obrigatório.',
            'purchase_subject.max' => 'O campo assunto deve ter no máximo 255 caracteres.',
            'purchase_subject.min' => 'O campo assunto deve ter no mínimo 3 caracteres.',
            'description.required' => 'O campo descrição é obrigatório.',
            'description.min' => 'O campo descrição deve ter no mínimo 30 caracteres.',
            'department_id.required' => 'O campo departamento é obrigatório.',
            'department_id.exists' => 'O departamento selecionado não existe.',
        ];
    }
}
