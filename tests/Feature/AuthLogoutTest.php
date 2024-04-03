<?php

use DDD\Domain\Base\Users\User;

it('logs the user out', function () {
    $user = User::factory()->create([
        'password' => bcrypt('meowimacat')
    ]);
    
    $this->post('/api/auth/login', [
        'email' => $user->email,
        'password' => 'meowimacat'
    ]);

    $this->assertAuthenticated();

    $this->post('/api/auth/logout')
        ->assertStatus(200)
        ->assertExactJson([
            'message' => 'Tokens Revoked'
        ]);
});

it('shows error if already not authenticated', function () {
    dd($this->post('/api/auth/logout'));
    $this->post('/api/auth/logout')
        ->assertStatus(401)
        ->assertExactJson([
            'message' => 'Unauthenticated.'
        ]);
});