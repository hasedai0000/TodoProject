<?php

namespace Tests\Unit\Services;

use App\Domain\Entity\Todo as EntityTodo;
use App\Domain\Interfaces\TodoRepositoryInterface;
use App\Models\Todo;
use App\Models\User;
use App\Repository\TodoRepository;
use App\Services\TodoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Mockery\MockInterface;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class TodoServiceTest extends TestCase
{
  use RefreshDatabase;

  private TodoService $service;

  private const TEST_USER = [
    'id' => 1,
    'name' => 'test',
    'email' => 'test@example.com',
    'password' => 'password',
  ];

  private const TEST_TODO = [
    'id' => 1,
    'userId' => 1,
    'title' => 'testTitle',
    'content' => 'testContent',
    'is_completed' => false,
    'is_deleted' => false,
  ];

  protected function setUp(): void
  {
    parent::setUp();

    $this->mock(
      TodoRepositoryInterface::class,
      function (MockInterface $mock) {
        $mock->shouldReceive('findAll')->andReturn([
          [
            'id' => self::TEST_TODO['id'],
            'user_id' => self::TEST_USER['id'],
            'title' => self::TEST_TODO['title'],
            'content' => self::TEST_TODO['content'],
            'is_completed' => self::TEST_TODO['is_completed'],
            'is_deleted' => self::TEST_TODO['is_deleted'],
          ]
        ]);

        $mock->shouldReceive('store')->andReturn(new EntityTodo(
          self::TEST_TODO['id'],
          self::TEST_USER['id'],
          self::TEST_TODO['title'],
          self::TEST_TODO['content'],
          self::TEST_TODO['is_completed'],
          self::TEST_TODO['is_deleted']
        ));
      }
    );

    $this->service = app(TodoService::class);
  }

  #[Test]
  public function testGetTodos(): void
  {
    $user = User::factory()->create([
      'id' => self::TEST_USER['id'],
      'name' => self::TEST_USER['name'],
      'email' => self::TEST_USER['email'],
      'password' => Hash::make(self::TEST_USER['password']),
    ]);

    $todo = Todo::factory()->create([
      'user_id' => $user->id,
      'title' => self::TEST_TODO['title'],
      'content' => self::TEST_TODO['content'],
      'is_completed' => self::TEST_TODO['is_completed'],
    ]);

    $expected = [
      'id' => $todo->id,
      'user_id' => $user->id,
      'title' => $todo->title,
      'content' => $todo->content,
      'is_completed' => $todo->is_completed,
      'is_deleted' => $todo->is_deleted,
    ];

    $todos = $this->service->getTodos();
    $this->assertEquals([$expected], $todos);
  }

  #[Test]
  public function testStoreTodo(): void
  {
    $user = User::factory()->create([
      'id' => self::TEST_USER['id'],
      'name' => self::TEST_USER['name'],
      'email' => self::TEST_USER['email'],
      'password' => Hash::make(self::TEST_USER['password']),
    ]);

    $todo = $this->service->storeTodo($user->id, self::TEST_TODO['title'], self::TEST_TODO['content']);

    $expected = new EntityTodo(
      self::TEST_TODO['id'],
      $user->id,
      self::TEST_TODO['title'],
      self::TEST_TODO['content'],
      self::TEST_TODO['is_completed'],
      self::TEST_TODO['is_deleted']
    );

    $this->assertEquals($expected, $todo);
  }
}
