<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['string','required'],
            'email' => [ 'required', 'unique:users,email,' . request()->route('user')->id,],
            'roles.*' => [ 'integer' ],
            'roles' => ['required', 'array',],
            'birthdate' => ['date'],
            'deathdate' => ['date'],
            'phone' => ['regex:/^\d{7,15}$/'],
            'profile_photo_path' => 'image|mimes:jpeg,png,jpg,gif',
            'description' => ['max:1500'],
        ];
    }

    public function authorize()
    {
        return Gate::allows('user_access');
    }
}