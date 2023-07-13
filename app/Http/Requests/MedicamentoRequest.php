<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicamentoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => "required",
            'nome' => "required",
            'descricao' => "required",
            'quantidade_stock' => "required",
            'quantidade_minino_stock' => "required",
            'data_validade' => "required",
        ];
    }

}
