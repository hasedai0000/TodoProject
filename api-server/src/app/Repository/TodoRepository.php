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

  public function findById(int $id): ?EntityTodo
  {
    $eloquentTodo = Todo::find($id);
    if ($eloquentTodo === null) {
      return null;
    }
    return new EntityTodo(
      $eloquentTodo->id,
      $eloquentTodo->user_id,
      $eloquentTodo->title,
      $eloquentTodo->content,
      $eloquentTodo->is_completed,
      $eloquentTodo->is_deleted
    );
  }

  public function store(EntityTodo $todo): EntityTodo
  {
    $eloquentTodo = Todo::create([
      'user_id' => $todo->getUserId(),
      'title' => $todo->getTitle(),
      'content' => $todo->getContent(),
      'is_completed' => $todo->getIsCompleted(),
      'is_deleted' => $todo->getIsDeleted(),
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

  public function update(EntityTodo $todo): EntityTodo
  {
    $eloquentTodo = Todo::find($todo->getId());
    if ($eloquentTodo !== null) {
      $eloquentTodo->title = $todo->getTitle();
      $eloquentTodo->content = $todo->getContent();
      $eloquentTodo->is_completed = $todo->getIsCompleted();
      $eloquentTodo->save();
    }

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
