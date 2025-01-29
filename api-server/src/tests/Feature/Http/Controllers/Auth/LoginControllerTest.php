<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     *
     */
    public function testSuccess(): void
    {
        User::factory()->create([
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $params = [
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        $response = $this->postJson('/api/login', $params)
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'name',
                    'token'
                ],
                'message'
            ]);

        $responseData = $response->json();
        $this->assertTrue($responseData['success']);
        $this->assertEquals('test', $responseData['data']['name']);
        $this->assertMatchesRegularExpression('/^\d+\|[A-Za-z0-9]+$/', $responseData['data']['token']);
        $this->assertEquals('User login successfully.', $responseData['message']);
    }

    /**
     * @return void
     */
    public function testUnauthorized(): void
    {
        $params = [
            'email' => 'testttt@example.com',
            'password' => 'password',
        ];

        $response = $this->postJson('/api/login', $params)
            ->assertStatus(404)
            ->assertJson([
                'success' => false,
                'message' => 'Unauthorized.',
                "data" => [
                    "error" => "Unauthorized."
                ]
            ]);

        $responseData = $response->json();
        $this->assertFalse($responseData['success']);
        $this->assertEquals('Unauthorized.', $responseData['message']);
    }

    /**
     * return void
     */
    public function testValidation(): void
    {
        $this->postJson('/api/login', [])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The email field is required. (and 1 more error)',
                'errors' => [
                    'email' => [
                        'The email field is required.',
                    ],
                    'password' => [
                        'The password field is required.',
                    ],
                ],
            ]);
    }
}
