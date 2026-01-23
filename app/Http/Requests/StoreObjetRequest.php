<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreObjetRequest extends FormRequest
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
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'type'        => 'required|in:perdu,trouvé',
            'location'    => 'required|string|max:255',
            'date'        => 'required|date',
            'status'      => 'nullable|string',
            'image'       => 'nullable|image|max:2048'
        ];
    }
        public function messages(): array
    {
        return [
            'title.required'       => 'Le titre est obligatoire.',
            'title.string'         => 'Le titre doit être une chaîne de caractères.',
            'title.max'            => 'Le titre ne peut pas dépasser 255 caractères.',
            'description.required' => 'La description est obligatoire.',
            'description.string'   => 'La description doit être une chaîne de caractères.',
            'type.required'        => 'Le type est obligatoire.',
            'type.in'              => 'Le type doit être "perdu" ou "trouvé".',
            'location.required'    => 'La localisation est obligatoire.',
            'location.string'      => 'La localisation doit être une chaîne de caractères.',
            'location.max'         => 'La localisation ne peut pas dépasser 255 caractères.',
            'date.required'        => 'La date est obligatoire.',
            'date.date'            => 'La date n’est pas valide.',
            'image.image'          => 'Le fichier doit être une image.',
            'image.max'            => 'L’image ne peut pas dépasser 2 Mo.',
            'status.string'        => 'Le statut doit être une chaîne de caractères.',
        ];
    }
}
