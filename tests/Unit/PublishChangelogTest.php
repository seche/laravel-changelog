<?php

namespace Seche\LaravelChangelog\Tests\Unit;

use Illuminate\Support\Facades\Bus;
use Seche\LaravelChangelog\Jobs\PublishChangelog;
use Seche\LaravelChangelog\Models\Changelog;
use Seche\LaravelChangelog\Tests\TestCase;

class PublishChangelogTest extends TestCase
{
    /** @test */
    function it_publishes_a_changelog() {
        Bus::fake();

        $changelog = Changelog::factory()->create();

        $this->assertNull($changelog->published_at);

        PublishChangelog::dispatch($changelog);

        Bus::assertDispatched(PublishChangelog::class, function($job) use($changelog){
            return $job->changelog->id === $changelog->id;
        });
    }
}
