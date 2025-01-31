<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends BaseController
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
      /** @var \App\Models\User $user **/
      $user = Auth::user();
      $success['token'] = $user->createToken('AccessToken')->plainTextToken;
      $success['name'] = $user->name;

      return $this->sendResponse($success, 'User login successfully.');
    } else {
      return $this->sendError('Unauthorized.', ['error' => 'Unauthorized.']);
    }
  }

  /**
   * Logout api
   *
   * @return \Illuminate\Http\Response
   */
  public function logout(Request $request)
  {
    $request->user()->currentAccessToken()->delete();
    return $this->sendResponse([], 'User logout successfully.');
  }
}
