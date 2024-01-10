<?php

namespace Seche\LaravelChangelog\Database\Seeders;

use Illuminate\Database\Seeder;
use Seche\LaravelChangelog\Models\Changelog;

class ChangelogSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Changelog::factory()
            ->count(50)
            ->create();
    }
}


