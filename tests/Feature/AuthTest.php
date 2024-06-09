<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Administrator;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use RefreshDatabase;


    public function test_admin_login_with_correct_credentials()
    {
        Administrator::create([
            'adm_name' => 'Test Admin',
            'adm_email' => 'admin@test.com',
            'adm_password' => Hash::make('test'),
            
        ]);

        $response = $this->postJson('/api/login', [
            'adm_email' => 'admin@test.com',
            'adm_password' => 'test',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['token']);
    }

    public function test_admin_login_with_incorrect_credentials()
    {
        $response = $this->postJson('/api/login', [
            'adm_email' => 'admin@test.com',
            'adm_password' => 'test123',
        ]);

        $response->assertStatus(401);
        $response->assertJsonStructure(['message']);
    }
}
