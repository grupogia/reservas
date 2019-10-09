<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePermission extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create.permission');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug'        => 'required|string|min:3|unique:permissions,slug',
            'name'        => 'required|string|min:3|unique:permissions,name',
            'description' => 'required|string|min:3',
        ];
    }
}
