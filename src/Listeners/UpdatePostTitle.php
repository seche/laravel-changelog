<?php

namespace Seche\LaravelChangelog\Listeners;

use Seche\LaravelChangelog\Events\ChangelogWasCreated;

class UpdatePostTitle
{
    public function handle(ChangelogWasCreated $event)
    {
        $event->changelog->update([
            'feature_full' => 'New: ' . $event->changelog->feature_full,
        ]);
    }
}

