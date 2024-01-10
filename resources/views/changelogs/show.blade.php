<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ __('changelog::app.index-title') }}</title>

    <link href="{{asset('vendor/changelog/css/app.css')}}" rel="stylesheet" />
</head>
<body>
<div>
    <h1>{{ __('changelog::app.index-title') }}</h1>
    <h1>Changelog</h1>
    <h2>[{{ \Seche\LaravelChangelog\Facades\Version::setChangelog($changelog)->getFullVersion() }}] - {{$changelog->created_at->format('Y-m-d')}}</h2>


    <h3>Added</h3>
    {!! $changelog->added !!}

    <h3>Changed</h3>
    {{$changelog->changed}}

    <h3>Deprecated</h3>
    <p>{{$changelog->deprecated}}</p>

    <h3>Removed</h3>
    <p>{{$changelog->removed}}</p>

    <h3>Fixed</h3>
    <p>{{$changelog->fixed}}</p>

    <h3>Security</h3>
    <p>{{$changelog->security}}</p>

    <h2>Feature</h2>
    <h3>Brief</h3>
    <p>{{$changelog->feature_brief}}</p>

    <h3>Full</h3>
    {!! $changelog->feature_full !!}

    <p>Version @version</p>

    @forelse($changelogs as $log)
        <li>{{ $log->title }}</li>
    @empty
        <p>{{ __('changelog::error.no-logs') }}</p>
    @endforelse

    @version
</div>

<script src="{{asset('vendor/changelog/js/app.js')}}"></script>
</body>
</html>
