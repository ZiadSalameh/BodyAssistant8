<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;




class RegisterController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required | email',
            'password' => 'required',
            'c_password' => 'required | same:password',
        ]);
        ////////






        //////////
        if ($validator->fails()) {
            return $this->sendError('please validate error', $validator->errors());
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $success['token'] = $user->createToken('myapp')->accessToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'User registered successfully.');
    }




    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            //$user = User::create($input);
            if ($user) {
                $success['token'] = $request->user()->createToken('token')->accessToken;
                $success['name'] =  $user->name;
            } else {
                return $this->sendError('User not found after login.', ['error' => 'User not found']);
            }
            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
}
