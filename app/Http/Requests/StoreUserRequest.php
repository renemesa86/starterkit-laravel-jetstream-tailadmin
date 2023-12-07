<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('user_access');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'], 
            'email' => ['required', 'unique:users'], 
            'password' => ['required'], 
            'roles.*' => ['integer'], 
            'roles' => ['required','array'], 
            'birthdate' => ['date'],
            'deathdate' => ['date'],
            'phone' => ['regex:/^\d{7,15}$/'],
            'description' => ['max:1500'],
            //'profile_photo_path' => 'image|mimes:jpeg,png,jpg,gif', // Validación para imágenes,
        ];
    }
}
