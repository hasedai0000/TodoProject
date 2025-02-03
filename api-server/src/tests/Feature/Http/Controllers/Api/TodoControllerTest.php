<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class TodoControllerTest extends TestCase
{
  use RefreshDatabase;

  private const TEST_USER = [
    'id' => 1,
    'name' => 'test',
    'email' => 'test@example.com',
    'password' => 'password',
  ];

  private const TEST_TODO = [
    'id' => 1,
    'user_id' => 1,
    'title' => 'testTitle',
    'content' => 'testContent',
    'is_completed' => false,
    'is_deleted' => false,
  ];

  private User $user;
  private Todo $todo;

  protected function setUp(): void
  {
    parent::setUp();
    $this->user = User::factory()->create([
      'id' => self::TEST_USER['id'],
      'name' => self::TEST_USER['name'],
      'email' => self::TEST_USER['email'],
      'password' => Hash::make(self::TEST_USER['password']),
    ]);

    $this->todo = Todo::factory()->create([
      'id' => self::TEST_TODO['id'],
      'user_id' => $this->user->id,
      'title' => self::TEST_TODO['title'],
      'content' => self::TEST_TODO['content'],
      'is_completed' => self::TEST_TODO['is_completed'],
      'is_deleted' => self::TEST_TODO['is_deleted'],
    ]);
  }

  private function assertSuccessResponse(array $response, array $data, string $message): void
  {
    $this->assertTrue($response['success']);
    $this->assertEquals($data, $response['data']);
    $this->assertEquals($message, $response['message']);
  }

  private function assertErrorResponse(array $response, string $message): void
  {
    $this->assertFalse($response['success']);
    $this->assertEquals($message, $response['message']);
  }

  #[Test]
  public function testIndexSuccess(): void
  {
    $token = $this->user->createToken('AccessToken')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer ' . $token)
      ->getJson('/api/todos')
      ->assertStatus(200)
      ->assertJsonStructure([
        'success',
        'data' => ['todos'],
        'message'
      ]);

    $this->assertSuccessResponse(
      $response->json(),
      ['todos' => [self::TEST_TODO]],
      'Todos fetched successfully.'
    );
  }

  #[Test]
  public function testStoreSuccess(): void
  {
    $token = $this->user->createToken('AccessToken')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer ' . $token)
      ->postJson('/api/todos', [
        'user_id' => $this->user->id,
        'title' => self::TEST_TODO['title'],
        'content' => self::TEST_TODO['content'],
      ])
      ->assertStatus(200)
      ->assertJsonStructure([
        'success',
        'data' => ['todo'],
        'message'
      ]);

    $responseData = $response->json()['data']['todo'];

    $this->assertSuccessResponse(
      $response->json(),
      ['todo' => [
        'id' => $responseData['id'],
        'user_id' => $this->user->id,
        'title' => self::TEST_TODO['title'],
        'content' => self::TEST_TODO['content'],
        'is_completed' => self::TEST_TODO['is_completed'],
        'is_deleted' => self::TEST_TODO['is_deleted'],
      ]],
      'Todo created successfully.'
    );
  }
}
