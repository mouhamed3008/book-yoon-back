<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\UserResource;


use App\Http\Resources\UserCollection;


class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        return new UserCollection($users);
    }

    public function store(Request $request)
    {
        $user = User::create($request->validated());

        // return new UserResource($user);
    }

    public function show(Request $request, User $user)
    {
        // return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->validated());

        // return new UserResource($user);
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();

        return response()->noContent();
    }
}
