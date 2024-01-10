<?php

namespace Seche\LaravelChangelog\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallChangelogPackage extends Command
{
    protected $signature = 'InstallChangelogPackage.php';

    protected $description = 'Install the Laravel Changelog package.';

    public function handle() {
        $this->info('Installing Changelog...');

        $this->info('Publishing configuration...');

        if(!$this->configExists('changelog.php')){
            $this->publishConfiguration();
            $this->info('Published configuration');
        }else{
            if ($this->shouldOverwriteConfig()){
                $this->info('Overwriting configuration file...');
                $this->publishConfiguration($force = true);
            }else {
                $this->info('Existing configuration was not overwritten');
            }
        }

        $this->info('Installed Laravel Changelog package');
    }

    private function configExists($fileName): bool
    {
        return File::exists(config_path($fileName));
    }

    private function shouldOverwriteConfig(): bool
    {
        return $this->confirm('Config file already exists. Do you want to overwrite it?', false);
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "Seche\LaravelChangelog\ChangelogServiceProvider",
            '--tag' => "config"
        ];

        if($forcePublish === true){
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }
}
