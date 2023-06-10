<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'depart' => $this->depart,
            'destination' => $this->destination,
            'DateParcours' => $this->DateParcours,
            'heureParcours' => $this->heureParcours,
            'prixPayment' => $this->prixPayment,
            'itineraires' => $this->itineraires,
            'conducteur_id' => $this->conducteur_id,
        ];
    }
}
