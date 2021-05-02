<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Task;

class UpdateTaskRequest extends FormRequest
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
            'name' => 'required',
            'deadline' => 'nullable|date',
            'user_id' => 'required|integer',
            'project_id' => 'required|integer',
            'status' => 'required|in:créé,en cours,en attente de validation,validée',
            'budget' => 'required|integer',
            'verification_file' => 'required_if:status,en attente de validation'
        ];

        return $rules;
    }
}
