<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem LKPS - UIKA Bogor</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#F3F4F6]">
            <div>
                <a href="/">
                    <img src="https://uika-bogor.ac.id/wp-content/uploads/2023/04/Logo-UIKA-Bogor.png" class="h-24 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-2xl border border-gray-100">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>