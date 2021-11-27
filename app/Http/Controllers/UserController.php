<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    /**
     * @return json
     */
    public function signup (Request $request) {
        $data = $request->json()->all();
        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => Hash::make($data["password"]),
            "api_token" => Str::random(60)
        ]);
        $user->save();
        return response()->json($user, 201);
    }

    public function list () {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function login(Request $request) {
        $data = $request->json()->all();
        $user = User::where("email", $data["email"])->first();
        if ($user && Hash::check($data["password"], $user->password)) {
            return response()->json([
                "isOk" => TRUE,
                "api_token" => $user->api_token
            ]);
        }
        return response()->json([
            "message" => "Wrong authentication credentials",
            "isOk" => FALSE
        ], 400);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //
}
