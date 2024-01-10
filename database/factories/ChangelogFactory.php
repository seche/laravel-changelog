<?php

namespace Seche\LaravelChangelog\Database\Factories;

use Seche\LaravelChangelog\Models\Changelog;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChangelogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Changelog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {

        return [
            'major' => $this->faker->numberBetween(1, 5),
            'minor' => $this->faker->numberBetween(1, 10),
            'patch' => $this->faker->numberBetween(1, 100),
            'prerelease' => $this->faker->word,
            'build' => $this->faker->randomNumber(4),
            'commit' => $this->faker->sha1,
            'added' => $this->faker->paragraph,
            'changed' => $this->faker->paragraph,
            'deprecated' => $this->faker->paragraph,
            'removed' => $this->faker->paragraph,
            'fixed' => $this->faker->paragraph,
            'security' => $this->faker->paragraph,
            'feature_brief' => $this->faker->sentence,
            'feature_full' => $this->faker->paragraph
        ];
    }
}
