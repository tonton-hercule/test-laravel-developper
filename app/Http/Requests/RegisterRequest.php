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
    public function rules(): array
    {
        return [
            'email' => 'required|unique:users,email|max:255',
            'password' => 'required|min:5',
            'name' => 'required|max:255',
            'age' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'L\'email est obligatoire.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'email.max' => 'Le nombre de caractère autorisé est de 255.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'name.required' => 'Le nom est obligatoire.',
            'age.required' => 'L\'âge est obligatoire.',
            'age.integer' => 'L\'âge doit être un entier.',
        ];
    }
}
