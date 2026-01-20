<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateObjetRequest extends FormRequest
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
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'type' => 'sometimes|required|in:perdu,trouvé',
            'location' => 'sometimes|required|string',
            'date' => 'sometimes|required|date',
            'status' => 'nullable|string'
        ];
    }
}
