<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Inventory;
use Illuminate\Http\Request;


class InventarioController extends Controller
{
    /**
     * 
     */
    public function list (Request $request) {
        $user_id = Auth::user()->id;
        $inventory = Inventory::all()->where("user_id", $user_id);
        return response()->json($inventory, 200);
    }
    
    public function create (Request $request) {
        $data = $request->json()->all();
        $user_id = Auth::user()->id;
        $new_code_seed = ($user_id - 1) * 500 + Inventory::all()->count() + 1;
        $new_code_generate = sprintf("%05d", $new_code_seed);
        $data["new_code"] = $new_code_generate;
        $data["user_id"] = $user_id;
        $inventory = Inventory::create($data);
        return response()->json($inventory, 201);
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
