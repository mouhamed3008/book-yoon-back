<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Http\Requests\UserStoreRequest;

class AuthController extends Controller
{

    public function register(UserStoreRequest $request) {


        $role = Roles::where('libelle', $request->role)->first();
        if ($role  === null) {
            return response()->json([
                'message' => 'Le role n\'existe pas',
            ], 404);
        }
        $profilPic = $this->getImageResize($request);
        $permisPic = $this->getImageResize($request);


        $tab = array_merge($request->validated(),[ 'role_id'=>$role->id]);
        $tab['photo_profil'] = count($profilPic) > 0 ? $profilPic['photo_profil'] : null;
        $tab['photo_permis'] = count($permisPic) > 0 ? $permisPic['photo_permis'] : null;

        $user = User::create($tab);
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => new UserResource( $user),
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'telephone' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('telephone', $fields['telephone'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' =>  new UserResource( $user),
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public static function getImageResize(Request $request)
    {
        $img = [];
        if (  count($request->files->keys()) > 0 && $request->hasFile($request->files->keys()[0])) {
            $file = $request->file($request->files->keys()[0]);
            $imageType = $file->getClientOriginalExtension();
            $image_resize = Image::make($file)->resize( 100, 100, function ( $constraint ) {
                $constraint->aspectRatio();
            })->encode( $imageType );
            $img[$request->files->keys()[0]] = $image_resize;
        }
        return $img;
    }

}
