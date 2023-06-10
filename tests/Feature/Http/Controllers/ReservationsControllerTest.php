<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Reservation;
use App\Models\Reservations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ReservationsController
 */
class ReservationsControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $reservations = Reservations::factory()->count(3)->create();

        $response = $this->get(route('reservation.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReservationsController::class,
            'store',
            \App\Http\Requests\ReservationsStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $depart = $this->faker->word;
        $destination = $this->faker->word;
        $DateParcours = $this->faker->dateTime();
        $heureParcours = $this->faker->word;
        $prixPayment = $this->faker->numberBetween(-10000, 10000);
        $itineraires = $this->faker->word;

        $response = $this->post(route('reservation.store'), [
            'depart' => $depart,
            'destination' => $destination,
            'DateParcours' => $DateParcours,
            'heureParcours' => $heureParcours,
            'prixPayment' => $prixPayment,
            'itineraires' => $itineraires,
        ]);

        $reservations = Reservation::query()
            ->where('depart', $depart)
            ->where('destination', $destination)
            ->where('DateParcours', $DateParcours)
            ->where('heureParcours', $heureParcours)
            ->where('prixPayment', $prixPayment)
            ->where('itineraires', $itineraires)
            ->get();
        $this->assertCount(1, $reservations);
        $reservation = $reservations->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $reservation = Reservations::factory()->create();

        $response = $this->get(route('reservation.show', $reservation));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReservationsController::class,
            'update',
            \App\Http\Requests\ReservationsUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $reservation = Reservations::factory()->create();
        $depart = $this->faker->word;
        $destination = $this->faker->word;
        $DateParcours = $this->faker->dateTime();
        $heureParcours = $this->faker->word;
        $prixPayment = $this->faker->numberBetween(-10000, 10000);
        $itineraires = $this->faker->word;

        $response = $this->put(route('reservation.update', $reservation), [
            'depart' => $depart,
            'destination' => $destination,
            'DateParcours' => $DateParcours,
            'heureParcours' => $heureParcours,
            'prixPayment' => $prixPayment,
            'itineraires' => $itineraires,
        ]);

        $reservation->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($depart, $reservation->depart);
        $this->assertEquals($destination, $reservation->destination);
        $this->assertEquals($DateParcours, $reservation->DateParcours);
        $this->assertEquals($heureParcours, $reservation->heureParcours);
        $this->assertEquals($prixPayment, $reservation->prixPayment);
        $this->assertEquals($itineraires, $reservation->itineraires);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $reservation = Reservations::factory()->create();
        $reservation = Reservation::factory()->create();

        $response = $this->delete(route('reservation.destroy', $reservation));

        $response->assertNoContent();

        $this->assertModelMissing($reservation);
    }
}
