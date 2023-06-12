<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'email', 'max:191'],
            'password' => ['nullable','string'],
            'date_naissance'  => ['required','string'],
            'adresse'  => ['required','string'],
            'telephone'  => ['required','string'],
            'photo_profil'  => ['sometimes','string','nullabe'],
            'numero_permis'  => ['nullable','string'],
            'numero_voiture'  => ['nullable','string'],
            'couleur_voiture'  => ['nullable','string'],
            'photo_permis'  => ['nullable','string'],
            'role'  => ['required','string'],
        ];
    }
}
