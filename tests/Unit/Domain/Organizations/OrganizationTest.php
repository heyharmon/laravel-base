<?php

namespace Tests\Unit\Domain\Organizations;

use DDD\Domain\Base\Media\Media;
// Models
use DDD\Domain\Base\Organizations\Organization;
use DDD\Domain\Base\Teams\Team;
use DDD\Domain\Base\Users\User;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_has_a_slug()
    {
        $organization = Organization::factory()->create();

        $this->assertNotNull($organization->slug);
    }

    /** @test */
    public function it_uses_the_slug_for_the_route_key_name()
    {
        $organization = Organization::factory()->create();

        $this->assertEquals($organization->getRouteKeyName(), 'slug');
    }

    /** @test */
    public function it_has_many_users()
    {
        $organization = Organization::factory()
            ->has(User::factory())
            ->create();

        $this->assertInstanceOf(User::class, $organization->users->first());
    }

    /** @test */
    public function it_has_many_teams()
    {
        $organization = Organization::factory()
            ->has(Team::factory())
            ->create();

        $this->assertInstanceOf(Team::class, $organization->teams->first());
    }

    /** @test */
    public function it_has_many_media()
    {
        $organization = Organization::factory()
            ->has(Media::factory())
            ->create();

        $this->assertInstanceOf(Media::class, $organization->media->first());
    }
}
