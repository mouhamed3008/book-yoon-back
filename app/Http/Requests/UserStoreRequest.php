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
            'email' =>'required|string|unique:users',
            'password' => 'required|confirmed|min:6',
            'date_naissance'  => ['required','string'],
            'adresse'  => ['required','string'],
            'telephone'  =>'required|string|unique:users',
            'photo_profil'  => ['sometimes','string'],
            'numero_permis'  => 'string|unique:users',
            'numero_voiture'  => 'string|unique:users',
            'couleur_voiture'  => ['string'],
            'photo_permis'  => ['string'],
        ];
    }
}
