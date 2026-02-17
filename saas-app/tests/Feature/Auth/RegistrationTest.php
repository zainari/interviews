<?php

use App\Models\User;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');
    $response->assertStatus(200);
});

test('new users can register', function () {
    // Agar ye fail ho raha hai, toh ye line batayegi KYUN fail ho raha hai
    $this->withoutExceptionHandling(); 

    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});