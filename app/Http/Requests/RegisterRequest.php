<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'unique:users,username', 'regex:/^[a-zA-Z0-9_-]+$/'],
            'password' => ['required', 'min:8', 'alpha_num:ascii'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Введите логин.',
            'username.unique'   => 'Такой логин уже занят.',
            'username.regex'    => 'Логин может содержать только латинские буквы, цифры, дефис и нижнее подчёркивание.',

            'password.required'  => 'Введите пароль.',
            'password.min'       => 'Пароль должен содержать минимум :min символов.',
            'password.alpha_num' => 'Пароль может содержать только латинские буквы и цифры.',
        ];
    }
}
