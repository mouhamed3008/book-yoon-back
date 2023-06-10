<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'adresse' => $this->adresse,
            'date_naissance' => $this->date_naissance,
            'telephone' => $this->telephone,
            'is_active' => $this->is_active,
            'numero_permis' => $this->numero_permis,
            'numero_voiture' => $this->numero_voiture,
            'couleur_voiture' => $this->couleur_voiture,
            'photo_profil' => base64_encode($this->photo) != null ?  base64_encode($this->photo) : null,
            'photo_permis' => base64_encode($this->photo) != null ?  base64_encode($this->photo) : null,
            // 'role' =>  RoleResource::make($this->role_id),

        ];
    }
}
