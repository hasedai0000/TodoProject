<?php

namespace App\Services;

use App\Domain\Entity\Todo as EntityTodo;
use App\Domain\Interfaces\TodoRepositoryInterface;

class TodoService
{
  private $repository;

  public function __construct(
    TodoRepositoryInterface $repository
  ) {
    $this->repository = $repository;
  }

  public function getTodos(): array
  {
    $todos = $this->repository->findAll();
    $todos = array_map(function ($todo) {
      return [
        'id' => $todo['id'],
        'user_id' => $todo['user_id'],
        'title' => $todo['title'],
        'content' => $todo['content'],
        'is_completed' => $todo['is_completed'],
        'is_deleted' => $todo['is_deleted'],
      ];
    }, $todos);
    return $todos;
  }

  public function storeTodo(int $userId, string $title, string $content): EntityTodo
  {
    $todo = new EntityTodo(null, $userId, $title, $content, false, false);
    return $this->repository->store($todo);
  }
}
