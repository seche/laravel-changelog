<?php

namespace Seche\LaravelChangelog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Seche\LaravelChangelog\Database\Factories\ChangelogFactory;
use Spatie\Translatable\HasTranslations;

class Changelog extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['feature_brief', 'feature_full'];

    protected $table = 'changelogs';

    public $fillable = [
        'major',
        'minor',
        'patch',
        'prerelease',
        'build',
        'commit',
        'added',
        'changed',
        'deprecated',
        'removed',
        'fixed',
        'security',
        'feature_brief',
        'feature_full'
    ];

    //Disable Laravel's mass assignment protection
    protected $guarded = [];

    protected static function newFactory(): Factory
    {
        return \Seche\LaravelChangelog\Database\Factories\ChangelogFactory::new();
    }


}
