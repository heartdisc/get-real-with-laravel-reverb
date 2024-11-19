<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ $title ?? "Reverb" }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Anuphan:wght@100..700&family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

        <link
            rel="apple-touch-icon"
            sizes="76x76"
            href="{{ asset("images/apple-touch-icon.png") }}"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="32x32"
            href="{{ asset("images/favicon-32x32.png") }}"
        />
        <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="{{ asset("images/favicon-16x16.png") }}"
        />
        <link
            rel="icon"
            type="image/x-icon"
            href="{{ asset("images/favicon.ico") }}"
        />

        @vite(["resources/css/app.css", "resources/js/app.js"])
        @stack("scripts")
    </head>

    <body class="h-screen w-screen antialiased">
        <div
            class="flex h-full w-full flex-col items-center justify-center bg-gradient-to-tr from-lime-600 from-10% to-lime-900 p-1"
        >
            @yield("content")
        </div>
    </body>
</html>
