<?php

namespace Seche\LaravelChangelog\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Seche\LaravelChangelog\Models\Changelog;

class PublishChangelog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $changelog;

    function __construct(Changelog $changelog)
    {
        $this->changelog = $changelog;
    }

    function handle()
    {
        $this->changelog->publish();
    }
}
