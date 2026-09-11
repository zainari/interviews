<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(){
        $get_user = User::all();
        return response()->json([
            'success' => true,
            'data' => $get_user,
            'message' => 'Fetch all User Record',
        ]);
    }

    public function userget($id)
    {
        $user = User::find($id);
    
        if ($user) {
            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'User fetched successfully',
            ], 200);
        }
    
        return response()->json([
            'success' => false,
            'data' => null,
            'message' => 'User not found',
        ], 404);
    }

    public function usercreate(UserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        
        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User created successfully',
        ], 201);
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'data' => $user,
                'message' => 'User not found',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'User deleted successfully',
        ], 200);
    }
}
