<?php

use DDD\Domain\Base\Users\User;

it('it shows my user profile', function () {
    $user = User::factory()->create();
    
    $this->actingAs($user)
        ->get('/api/auth/me')
        ->assertStatus(200)
        ->assertSeeInOrder([$user->name, $user->email]);
});