<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class EditProfile extends FormRequest
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
            'name'     => 'required|alpha_spaces|min:3',
            'email'    => 'required|email|unique:users,email,'. $this->user()->id,
            'password' => 'nullable|min:6|confirmed',
            'password_confirmation' => 'nullable|required_with:password',
        ];
    }
}
