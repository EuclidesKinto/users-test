<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:60',
            'cpf' => 'required|max:11|min:11',
            'rg' => 'required|max:30|min:2',
            'email' => 'required|email',
            'whatsapp' => 'required',
            'city' => 'required',
            'street' => 'required',
            'zip_code' => 'required',
            'number' => 'required',
            'neighborhood' => 'required',
            'state_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute tem que ser um texto.',
            'min' => 'O campo deve ter no minímo :min caracteres.',
            'max' => 'O campo deve ter no maximo :max caracteres.',
        ];
    }
}
