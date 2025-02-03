<?php

namespace App\Domain\Interfaces;

use App\Domain\Entity\Todo as EntityTodo;

interface TodoRepositoryInterface
{
  public function findAll(): array;
  public function store(EntityTodo $todo): EntityTodo;
}
