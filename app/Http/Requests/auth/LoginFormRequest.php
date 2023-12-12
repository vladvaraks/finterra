<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'password' => ['required', 'string']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле Логин обязательно для заполнения.',
            'name.string' => 'Поле Логин должно быть строкой.',
            'password.required' => 'Поле Пароль обязательно для заполнения.',
            'password.min' => 'Поле Пароль должно иметь минимальную длину :min символов.'
        ];
    }
}
