<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginController extends BaseController
{
  /**
   * Login api
   *
   * @return \Illuminate\Http\Response
   */
  public function login(LoginRequest $request)
  {
    if (Auth::attempt([
      'email' => $request->email,
      'password' => $request->password
    ])) {
      $user = Auth::user();
      $success['token'] = $user->createToken('AccessToken')->plainTextToken;
      $success['name'] = $user->name;

      return $this->sendResponse($success, 'User login successfully.');
    } else {
      return $this->sendError('Unauthorized.', ['error' => 'Unauthorized.']);
    }
  }
}
