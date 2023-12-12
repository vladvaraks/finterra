<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:users,name'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле Логин обязательно для заполнения.',
            'name.string' => 'Поле Логин должно быть строкой.',
            'name.unique' => 'Такой логин уже существует.',
            'email.required' => 'Поле Email обязательно для заполнения.',
            'email.email' => 'Поле Email должно содержать действительный адрес электронной почты.',
            'email.unique' => 'Такой Email уже существует.',
            'password.required' => 'Поле Пароль обязательно для заполнения.',
            'password.min' => 'Поле Пароль должно иметь минимальную длину :min символов.',
            'password.confirmed' => 'Поля Пароль и Подтверждение пароля должны совпадать.',
        ];
    }
}
