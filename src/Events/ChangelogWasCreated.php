<?php

namespace Seche\LaravelChangelog\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Seche\LaravelChangelog\Models\Changelog;

class ChangelogWasCreated
{
    use SerializesModels, Dispatchable;

    public $changelog;

    public function __construct(Changelog $changelog)
    {
        $this->changelog = $changelog;
    }

}

