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








