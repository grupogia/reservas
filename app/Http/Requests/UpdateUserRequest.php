<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('edit.user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'             => 'required|min:4|max:25',
            'email'            => 'required|email|unique:users,email,'. $this->route('user')->id,
            'password'         => 'nullable|min:6|max:25|confirmed',
            'password_confirmation' => 'required_with:password',
        ];
    }
}
