<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Reservations;

class ReservationsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservations::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'depart' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'destination' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'DateParcours' => $this->faker->dateTime(),
            'heureParcours' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'prixPayment' => $this->faker->numberBetween(-10000, 10000),
            'itineraires' => $this->faker->word,
        ];
    }
}
