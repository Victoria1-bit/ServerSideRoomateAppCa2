<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RoomMate') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="guest-shell">
        <div class="guest-card">
            <div class="guest-header">
                <div class="logo-box">⌂</div>
                <h1>RoomMate</h1>
                <p>Shared living made simple.</p>
            </div>

            @yield('content')
            {{ $slot ?? '' }}
        </div>
    </div>
</body>
</html>