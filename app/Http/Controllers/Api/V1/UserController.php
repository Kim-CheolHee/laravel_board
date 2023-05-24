<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if( $request->name ) {
            $users = User::where('name', 'like', "%{$request->name}%")->get();
        }
        else {
            $users = User::all();
        }
        return response()->json($users);
    }
}
