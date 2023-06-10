<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservations extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'depart',
        'destination',
        'DateParcours',
        'heureParcours',
        'prixPayment',
        'itineraires',
        'passager_id',
        'conducteur_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'DateParcours' => 'datetime',
    ];

    public function passenger(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function conducteur(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
