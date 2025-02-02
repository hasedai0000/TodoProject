<?php

namespace App\Repository;

use App\Domain\Entity\Todo as EntityTodo;
use App\Domain\Interfaces\TodoRepositoryInterface;
use App\Models\Todo;

class TodoRepository implements TodoRepositoryInterface
{
  public function findAll(): array
  {
    return Todo::all()->toArray();
  }
}
