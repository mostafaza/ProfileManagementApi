<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Administrator;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
   

    public function test_admin_login_with_correct_credentials()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'admin@example.com',
            'password' => 'test',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['token']);
    }

    public function test_admin_login_with_incorrect_credentials()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'admin@example.com',
            'password' => 'test123',
        ]);

        $response->assertStatus(401);
        $response->assertJsonStructure(['message']);
    }
}
