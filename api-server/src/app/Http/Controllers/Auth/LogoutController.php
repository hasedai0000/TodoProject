<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class LogoutController extends BaseController
{
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
