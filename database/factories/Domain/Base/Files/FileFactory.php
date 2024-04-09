<?php

namespace Database\Factories\Domain\Base\Files;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use DDD\Domain\Base\Files\File;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organization_id' => 1,
            'user_id' => 1,
            'name' => 'The seeded file name',
            'filename' => 'the-seeded-file-name.png',
            'path' => 'https://placehold.co/450x350',
            'extension' => 'png',
            'mime' => 'image/png',
            'disk' => 'r2',
        ];
    }
}
