<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
            'fantasy_name' => 'required|string|min:3|max:255',
            'company_name' => 'required|string|min:3|max:255',
            'contacts' => 'required|array',
            'contacts.*.name' => 'string|min:3|max:255',
            'contacts.*.email' => 'email',
            'contacts.*.call' => '',
            'contacts.*.whatsapp' => '',
        ];
    }

    public function messages(): array
    {
        return [
            'fantasy_name.required' => 'O campo nome fantasia é obrigatório.',
            'fantasy_name.string' => 'O campo nome fantasia deve ser uma string.',
            'fantasy_name.min' => 'O campo nome fantasia deve ter pelo menos 3 caracteres.',
            'fantasy_name.max' => 'O campo nome fantasia não pode ter mais de 255 caracteres.',
            'contacts.required' => 'É necessário pelo menos um contato.',
        ];
    }
}
