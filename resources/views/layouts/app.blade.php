<!DOCTYPE html>
<!-- Tells the browser this is an HTML5 document -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!-- Starts the HTML page
         The lang attribute sets the page language using the app's current locale
         Example: en_US becomes en-US -->

    <head>
        <!-- Basic page setup information goes inside the head -->

        <meta charset="utf-8">
        <!-- Sets the character encoding to UTF-8
             This allows the page to correctly display most letters and symbols -->

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Makes the page responsive on phones, tablets, and desktops -->

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Stores the CSRF token for security
             This helps protect forms and requests from unauthorized actions -->

        <title>{{ config('app.name', 'Roommate Hub') }}</title>
        <!-- Sets the title shown in the browser tab
             It uses the app name from the config file
             If no app name is found, it uses "Roommate Hub" as the default -->

        <link rel="preconnect" href="https://fonts.bunny.net">
        <!-- Speeds up loading by making an early connection to the font website -->

        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
        <!-- Loads the Figtree font in different font weights -->

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Loads the main CSS and JavaScript files using Vite -->
    </head>

    <body class="font-sans antialiased">
        <!-- Starts the visible page content
             The classes apply a sans-serif font and smoother text rendering -->

        <div class="app-shell">
            <!-- Main wrapper for the whole page layout -->

            @include('layouts.navigation')
            <!-- Inserts the navigation bar from a separate Blade file -->

            @isset($header)
                <!-- Checks if a header section was provided -->

                <header class="page-wrap">
                    <!-- Page header area -->

                    <div class="card-soft" style="padding: 20px 24px;">
                        <!-- Styled container for the header content -->

                        {{ $header }}
                        <!-- Displays the header content passed into the layout -->
                    </div>
                </header>
            @endisset
            <!-- Ends the check for whether the header exists -->

            <main>
                <!-- Main content area of the page -->

                {{ $slot }}
                <!-- Displays the main page content that uses this layout -->
            </main>
        </div>
    </body>
</html>