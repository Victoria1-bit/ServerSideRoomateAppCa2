<!DOCTYPE html>
<!-- Declares this as an HTML5 document -->

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- Starts the HTML page
     Sets the language dynamically (e.g. en_US → en-US) -->

<head>
    <!-- Head contains setup info (not visible on the page) -->

    <meta charset="utf-8">
    <!-- Sets character encoding so text displays correctly -->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Makes the layout responsive on all screen sizes -->

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Security token used to protect forms and requests -->

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Page title shown in the browser tab
         Uses app name from config, defaults to "Laravel" -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <!-- Improves loading speed for external fonts -->

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Loads the Figtree font with different weights -->

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Loads main CSS and JavaScript files using Vite -->
</head>

<body class="font-sans text-gray-900 antialiased">
<!-- Body contains everything visible on the page
     Classes set font style, text color, and smoother text -->

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <!-- Main container:
         - min-h-screen = full screen height
         - flex flex-col = vertical layout
         - justify-center = center content (on small screens and up)
         - items-center = horizontal center
         - padding and background color -->

    <div>
        <!-- Container for the logo -->

        <a href="/">
            <!-- Clicking the logo takes the user to the homepage -->

            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            <!-- Blade component for the app logo
                 Sets size and color using Tailwind classes -->
        </a>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <!-- Card container for the main content:
             - width full but limited on small screens
             - margin top for spacing
             - padding inside
             - white background with shadow
             - rounded corners on small screens -->

        {{ $slot }}
        <!-- Placeholder for page-specific content (like login/register forms) -->
    </div>
</div>

</body>
</html>