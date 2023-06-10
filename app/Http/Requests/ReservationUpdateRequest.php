<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationUpdateRequest extends FormRequest
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
            'depart' => ['required', 'string', 'max:255'],
            'destination' => ['required', 'string', 'max:255'],
            'DateParcours' => ['required'],
            'heureParcours' => ['required', 'string', 'max:255'],
            'prixPayment' => ['required', 'integer'],
            'itineraires' => ['required', 'string'],
        ];
    }
}
