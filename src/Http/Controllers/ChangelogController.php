<?php

namespace Seche\LaravelChangelog\Http\Controllers;

use Seche\LaravelChangelog\Models\Changelog;
use Seche\LaravelChangelog\Events\ChangelogWasCreated;

class ChangelogController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        $changelogs = Changelog::all();

        return view('changelog::changelogs.index', compact('changelogs'));
    }

    public function show()
    {
        $changelog = Changelog::findOrFail(request('id'));

        return view('changelog::changelogs.show', compact('changelog'));
    }

    public function store()
    {
        // Let's assume we need to be authenticated
        // to create a new post
        if(!auth()->check()){
            abort(403, __('changelog::app.403'));
        }

/*        request()->validate([
            'title'=>'required',
            'body'=>'required',
        ]);*/

        // Assume the authenticated user is the post's @author ANQ
        $author = auth()->user();

        $changelog = $author->changelogs()->create([
            'title'=>request('title'),
            'body'=>request('body'),
        ]);

        event(new ChangelogWasCreated($changelog));

        return redirect(route('changelogs.show', $changelog));
    }
}
