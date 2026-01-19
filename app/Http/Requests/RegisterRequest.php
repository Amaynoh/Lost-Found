<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
        ];
    }
    public function messages()
    {
        return [
            'name.required'     => 'Le nom est obligatoire',
            'name.string'       => 'Le nom doit être une chaîne de caractères',
            'name.max'          => 'Le nom ne doit pas dépasser 255 caractères',
            'email.required'    => 'L’email est obligatoire',
            'email.email'       => 'Le format de l’email est invalide',
            'email.unique'      => 'Cet email est déjà utilisé',
            'password.required' => 'Le mot de passe est obligatoire',
            'password.min'      => 'Le mot de passe doit contenir au moins 6 caractères',
        ];
    }
}
