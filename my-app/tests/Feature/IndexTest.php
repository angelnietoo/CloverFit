<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test index page loads without authentication
     */
    public function test_index_loads_without_authentication(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('index');
        // Should show login/register buttons
        $response->assertSee('Iniciar sesión');
        $response->assertSee('Regístrate');
    }

    /**
     * Test index page shows user info when authenticated
     */
    public function test_index_shows_user_info_when_authenticated(): void
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('index');
        // Should show user greeting and logout button
        $response->assertSee('¡Bienvenido!');
        $response->assertSee('John Doe');
        $response->assertSee('Cerrar sesión');
    }

    /**
     * Test complete registration and redirect to index
     */
    public function test_complete_registration_flow(): void
    {
        // Step 1: Access registration page
        $registerPage = $this->get('/register');
        $registerPage->assertStatus(200);
        $registerPage->assertViewIs('auth.register');

        // Step 2: Register new user
        $response = $this->post('/register', [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Should redirect to index
        $response->assertRedirect('/');

        // Step 3: Follow redirect and verify we're logged in
        $indexResponse = $this->get('/');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('¡Bienvenido!');
        $indexResponse->assertSee('New User');
        $indexResponse->assertSee('Cerrar sesión');
    }

    /**
     * Test complete login flow
     */
    public function test_complete_login_flow(): void
    {
        // Create a user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Step 1: Access login page
        $loginPage = $this->get('/login');
        $loginPage->assertStatus(200);
        $loginPage->assertViewIs('auth.login');

        // Step 2: Login
        $response = $this->post('/login', [
            'email' => 'testuser@example.com',
            'password' => 'password123',
        ]);

        // Should redirect to index
        $response->assertRedirect('/');

        // Step 3: Follow redirect and verify we're logged in
        $indexResponse = $this->get('/');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('¡Bienvenido!');
        $indexResponse->assertSee('Test User');
        $indexResponse->assertSee('Cerrar sesión');
    }
}
