<?php

namespace App\Domain\Interfaces;

interface TodoRepositoryInterface
{
  public function findAll(): array;
}
