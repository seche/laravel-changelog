<?php

namespace Seche\LaravelChangelog\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Seche\LaravelChangelog\Tests\TestCase;
use Seche\LaravelChangelog\Models\Changelog;
use Seche\LaravelChangelog\Tests\User;

class ChangelogTest extends TestCase {
    use RefreshDatabase;

    /** @test */
    function a_changelog_has_a_major() {

        $changelog = Changelog::factory()->create(['major' => 2]);
        dd($changelog);
        $this->assertEquals(2, $changelog->major);
    }

    /** @test */
    function a_changelog_has_a_minor()
    {
        $changelog = Changelog::factory()->create(['minor' => 2]);
        $this->assertEquals(2, $changelog->minor);
    }

    /** @test */
    function a_changelog_has_a_patch()
    {
        $changelog = Changelog::factory()->create(['patch' => 2]);
        $this->assertEquals(2, $changelog->patch);
    }

    /** @test */
    function a_changelog_has_a_prerelease()
    {
        $changelog = Changelog::factory()->create(['prerelease' => 'alpha']);
        $this->assertEquals('alpha', $changelog->prerelease);
    }

    /** @test */
    function a_changelog_has_a_build()
    {
        $changelog = Changelog::factory()->create(['build' => '1227']);
        $this->assertEquals('1227', $changelog->build);
    }

    /** @test */
    function a_changelog_has_a_commit()
    {
        $changelog = Changelog::factory()->create(['commit' => '49ffe2']);
        $this->assertEquals('49ffe2', $changelog->commit);
    }

}
