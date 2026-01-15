<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return $this->sendError('Unauthorised.', ['error' => 'Credencials incorrectes'], 401);
        }

        $authUser = $request->user();
        $result['token'] = $authUser->createToken('MyAuthApp')->plainTextToken;
        $result['name'] = $authUser->name;

        return $this->sendResponse($result, 'User signed in');
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        try {
            $input = $validator->validated();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $result['token'] = $user->createToken('MyAuthApp')->plainTextToken;
            $result['name'] = $user->name;

            return $this->sendResponse($result, 'User created successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Registration Error', $e->getMessage());
        }
    }
    public function logout(Request $request)
    {

        $user = request()->user(); //or Auth::user()
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        $success['name'] = $user->name;
        return $this->sendResponse($success, 'User successfully signed out.');
    }

    public function profile(Request $request)
    {
        $user = $request->user();

        $permissions = [];
        if ($user->role === 'administrador') {
            $permissions = ['create', 'read', 'update', 'delete'];
        } elseif ($user->role === 'manager') {
            $permissions = ['manage_team'];
        } elseif ($user->role === 'arbitre') {
            $permissions = ['manage_match'];
        }

        $data = [
            'user' => $user,
            'role' => $user->role,
            'permissions' => $permissions
        ];

        return $this->sendResponse($data, 'User profile retrieved successfully.');
    }
}
