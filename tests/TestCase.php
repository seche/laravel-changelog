<?php

namespace Seche\LaravelChangelog\Tests;

use Seche\LaravelChangelog\ChangelogServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        //additional setup
    }

    protected function getPackageProviders($app): array
    {
        return [
            ChangelogServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        /*// import the CreatePostsTable class from the migration
        include_once __DIR__ . '/../database/migrations/2022_11_17_000828_create_changelogs_table.php';


        //run the up() method of that migration class
        (new \CreateChangelogsTable)->up();*/

    }

}
