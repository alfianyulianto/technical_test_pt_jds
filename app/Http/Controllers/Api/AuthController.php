<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    $validated = Validator::make(
      $request->all(),
      [
        'email' => ['required', 'email:dns'],
        'password' => ['required']
      ],
      [
        'email' => [
          'required' => 'Email must be filled',
          'email' => 'Email must be valid email'
        ],
        'password' => [
          'required' => 'Password must be filled'
        ]
      ]
    );

    if ($validated->fails()) {
      return $this->errorAuthenticated('failed login', $validated->errors());
    }

    // user finding
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
      // check admin or not
      $user = Auth::user();
      $resultUser = new UserResource($user);
      $token = $user->createToken($user->name)->accessToken;
      return $this->successAuthenticated($resultUser, 'success login', $token);
    }

    // // user not found
    return $this->errorResponse('failed login. make sure the email and password are correct');
  }
}
