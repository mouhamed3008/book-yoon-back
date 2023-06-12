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
            'password' => 'required|confirmed|min:6',
            'date_naissance'  => ['required','string'],
            'adresse'  => ['required','string'],
            'telephone'  => ['required' , 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'photo_profil'  => ['sometimes','string'],
            'numero_permis'  => ['string'],
            'numero_voiture'  => ['string'],
            'couleur_voiture'  => ['string'],
            'photo_permis'  => ['string'],
        ];
    }
}
