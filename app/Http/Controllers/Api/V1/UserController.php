<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            if( $request->name ) {
                $users = User::where('name', 'like', "%{$request->name}%")->get();
            }
            else {
                $users = User::all();
            }

            if(count($users) === 0) {
                return response()->json(['error' => 'No users found'], 404);
            }
            return response()->json($users, 200);
        }
        catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve users'], 500);
        }
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function show($email)
    {
        try {
            $user = User::where('email', $email)->firstOrFail();
            return response()->json($user, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function update(Request $request, $email)
    {
        try {
            $user = User::where('email', $email)->firstOrFail();
            $user->update($request->all());
            return response()->json($user, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function destroy($email)
    {
        try {
            $user = User::where('email', $email)->firstOrFail();
            $user->delete();
            return response()->json(['status' => 'User deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

}
