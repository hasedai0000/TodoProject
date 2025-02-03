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

  public function store(EntityTodo $data): EntityTodo
  {
    $eloquentTodo = Todo::create([
      'user_id' => $data->getUserId(),
      'title' => $data->getTitle(),
      'content' => $data->getContent(),
      'is_completed' => $data->getIsCompleted(),
      'is_deleted' => $data->getIsDeleted(),
    ]);

    return new EntityTodo(
      $eloquentTodo->id,
      $eloquentTodo->user_id,
      $eloquentTodo->title,
      $eloquentTodo->content,
      $eloquentTodo->is_completed,
      $eloquentTodo->is_deleted
    );
  }
}
