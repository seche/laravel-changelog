<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangelogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('changelogs', function (Blueprint $table) {
            $table->id();

            $table->unsignedSmallInteger('major')
                ->comment('Major version MUST be incremented if any backwards incompatible changes are introduced to the public API.');
            $table->unsignedSmallInteger('minor')
                ->comment('Minor version MUST be incremented if new, backwards compatible functionality is introduced to the public API.');
            $table->unsignedSmallInteger('patch')
                ->comment('Patch version MUST be incremented if only backwards compatible bug fixes are introduced.');
            $table->tinyText('prerelease')
                ->nullable()
                ->comment('Pre-release indicates that the version is unstable and might not satisfy the intended compatibility requirements as denoted by its associated normal version.');
            $table->tinyText('build')
                ->nullable()
                ->comment('Alphanumeric value like MMDD');
            $table->tinyText('commit')
                ->nullable()
                ->comment('Git commit hash');

            $table->text('added')
                ->nullable()
                ->comment('Additions to the application');
            $table->text('changed')
                ->nullable()
                ->comment('Changes in existing functionality to the application');
            $table->text('deprecated')
                ->nullable()
                ->comment('Soon-to-be removed features to the application');
            $table->text('removed')
                ->nullable()
                ->comment('Removed features to the application');
            $table->text('fixed')
                ->nullable()
                ->comment('Bug fixes to the application');
            $table->text('security')
                ->nullable()
                ->comment('Vulnerabilities to the application');

            $table->json('feature_brief')
                ->nullable()
                ->comment('JSON language object');
            $table->json('feature_full')
                ->nullable()
                ->comment('JSON language object');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('changelogs');
    }
}
