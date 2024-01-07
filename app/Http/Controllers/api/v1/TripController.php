<?php

namespace App\Http\Controllers\api\v1;

use App\Events\TripAcceptedEvent;
use App\Events\TripCreatedEvent;
use App\Events\TripEndedEvent;
use App\Events\TripLocationUpdatedEvent;
use App\Events\TripStartedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\TripRequest;
use App\Models\Driver;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function store(TripRequest $request)
    {
        $trip = $request->user()->trips()->create($request->validated());
        broadcast(new TripCreatedEvent($trip, $request->user()));
        return $trip;
    }
    public function show(Request $request, Trip $trip)
    {
        if ($request->user()->id === $trip->user->id) {
            return $trip;
        }
        if ($trip->driver && $request->user()->driver) {
            if ($request->user()->driver->id === $trip->driver->id) {
                return $trip;
            }
        }
        return response()->json(['message' => 'trip not fond'], 404);
    }


    public function accept(Trip $trip, Request $request)
    {
        $request->validate([
            'driver_loction' => 'required',
        ]);
        $trip->update([
            'driver_loction' => $request->driver_loction,
            'driver_id' => $request->user()->driver->id
        ]);
        $trip->load('driver.user');

        broadcast(new TripAcceptedEvent($trip, $trip->user));
        return $trip;
    }


    public function start(Trip $trip, Request $request)
    {
        $trip->update([
            'is_started' => true
        ]);
        $trip->driver = Driver::find($trip->driver_id)->load('user');
        broadcast(new TripStartedEvent($trip, $trip->user));


        return $trip;
    }


    public function end(Trip $trip, Request $request)
    {
        $trip->update([
            'is_completed' => true
        ]);
        $trip->load('driver.user');
        broadcast(new TripEndedEvent($trip, $trip->user));


        return $trip;
    }


    public function location(Trip $trip, Request $request)
    {
        $request->validate([
            'driver_loction' => 'required',
        ]);
        $trip->update([
            'driver_loction' => $request->driver_loction,
        ]);
        $trip->load('driver.user');
        broadcast(new TripLocationUpdatedEvent($trip, $trip->user));
        return $trip;
    }
}
