<?php

namespace Seche\LaravelChangelog\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Seche\LaravelChangelog\Tests\TestCase;

class InstallChangelogPackageTest extends TestCase
{
    /** @test */
    function the_install_command_copies_the_configuration()
    {
        // make sure we're starting from a clean state
        if(File::exists(config_path('changelog.php')))
        {
            unlink(config_path('changelog.php'));
        };

        $this->assertFalse(File::exists(config_path('changelog.php')));

        Artisan::call('changelog:install');

        $this->assertTrue(File::exists(config_path('changelog.php')));
    }

    /** @test */
    public function when_a_config_file_is_present_users_can_choose_to_do_overwrite_it()
    {
        // Given we have already an existing config file
        File::put(config_path('changelog.php'), 'test contents');
        $this->assertTrue(File::exists(config_path('changelog.php')));

        // When we run the install command
        $command = $this->artisan('changelog:install');

        // We expect a warning that our configuration file exists
        $command->expectsConfirmation(
            'Config file already exists. Do you want to overwrite it?',
            // When answered with "yes"
            'yes'
        );

        // execute the command to force override
        $command->execute();

        $command->expectsOutput('Overwriting configuration file...');

        // Assert that the original contents are overwritten
        $this->assertEquals(
            file_get_contents(__DIR__.'/../config/config.php'),
            file_get_contents(config_path('changelog.php'))
        );

        // Clean up
        unlink(config_path('changelog.php'));
    }
}
