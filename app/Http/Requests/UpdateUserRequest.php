<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['string', 'email' , 'max:255' , Rule::unique('users')->ignore($this->user)],
            'password' => ['max:255'],
            'cin' => ['required','integer','digits:8',Rule::unique('users')->ignore($this->user)],
            'num_tel' => 'nullable|integer|digits:8',
            'role' => 'required',
        ];

        return $rules;
    }
}
