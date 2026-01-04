<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel Data Center') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <script src="{{ asset('js/main.js') }}" defer></script>
    </head>
    <body class="auth-page">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-logo">
                    <a href="/">
                        <span class="logo-text">DC-<span>Manager</span></span>
                    </a>
                </div>

                <div class="auth-content">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>