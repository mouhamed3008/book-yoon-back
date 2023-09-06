<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;
use App\Models\Reservations;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\ReservationResource;
use App\Http\Resources\ReservationCollection;
use App\Http\Requests\ReservationStoreRequest;
use App\Http\Requests\ReservationUpdateRequest;
use App\Http\Resources\ReservationsConducteurCollection;

class ReservationsController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $reservations = null;


        if (User::isAdmin($user) || User::isSuperAdmin($user)) {
            $reservations = new ReservationCollection(Reservations::all());
        }elseif (User::isConducteur($user)) {
            $reservations = new ReservationsConducteurCollection(Reservations::where('conducteur_id',$user->id)->get());
        }else{
            $reservations = new ReservationCollection(Reservations::where('passager_id',$user->id)->get());
        }


        return $reservations;


    }

    public function store(ReservationStoreRequest $request)
    {
        $user = auth()->user();
        $reservation = Reservations::create(array_merge($request->validated(), ['passager_id' => $user->id,"depart"=>json_encode($request->depart),"destination"=>json_encode($request->destination)]));

        return new ReservationResource($reservation);
    }

    public function show(Request $request, Reservations $reservation)
    {
        return new ReservationResource($reservation);
    }

    public function update(ReservationUpdateRequest $request, Reservations $reservation)
    {
        $reservation->update($request->validated());

        return new ReservationResource($reservation);
    }

    public function destroy(Request $request, Reservations $reservation)
    {
        $reservation->delete();

        return response()->noContent();
    }
}
