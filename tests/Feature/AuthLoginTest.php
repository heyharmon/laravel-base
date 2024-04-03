<?php

use DDD\Domain\Base\Users\User;

it('logs the user in', function () {
    $user = User::factory()->create([
        'password' => bcrypt('meowimacat')
    ]);
    
    $this->post('/api/auth/login', [
        'email' => $user->email,
        'password' => 'meowimacat'
    ])->assertStatus(200);

    $this->assertAuthenticated();
});

it('shows errors if the details are not provided')
    ->post('/api/auth/login')
    ->assertStatus(422)
    ->assertSee('errors')
    ->assertInvalid([
        'email' => 'required',
        'password' => 'required'
    ]);
