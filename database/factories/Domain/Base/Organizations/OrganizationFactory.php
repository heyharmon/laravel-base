<?php

namespace Database\Factories\Domain\Base\Organizations;

use Illuminate\Database\Eloquent\Factories\Factory;
use DDD\Domain\Base\Organizations\Organization;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\DDD\Model>
 */
class OrganizationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Organization::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->company(),
        ];
    }
}
