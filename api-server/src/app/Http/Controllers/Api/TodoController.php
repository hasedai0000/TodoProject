<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Services\TodoService;
use Illuminate\Http\Request;

class TodoController extends BaseController
{
  private $service;

  public function __construct(
    TodoService $service
  ) {
    $this->service = $service;
  }

  public function index()
  {
    $todos = $this->service->getTodos();
    $success['todos'] = $todos;

    return $this->sendResponse($success, 'Todos fetched successfully.');
  }
}
