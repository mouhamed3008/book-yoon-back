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
            'depart' => json_decode($this->depart),
            'destination' => json_decode($this->destination),
            'DateParcours' => $this->DateParcours,
            'heureParcours' => $this->heureParcours,
            'prixPayment' => $this->prixPayment,
            'itineraires' => $this->itineraires,
            'is_route_nat' => $this->is_route_nat,
            'payerPar' => $this->payerPar,
            'conducteur' => UserResource::make($this->conducteur),
        ];
    }
}
