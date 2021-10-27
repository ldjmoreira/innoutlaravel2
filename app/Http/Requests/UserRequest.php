<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5',
            'email' => 'required|email:rfc,dns',
            'password'=>  'required|min:5',
            'confirm_password'=>  'required|min:5',
            'start_date'=>  'required',
        ];
    }
    //tradução das mensagens de erro

    public function messages()
    {
        return [
            'required' => 'Campo Obrigatório!',
            'min' => 'Campo deve ter no mínimo :min caracteres'
        ];
    }



}
