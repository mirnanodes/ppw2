<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="text-center space-y-4">
            <h1 class="text-4xl font-bold text-gray-900">Job Portal</h1>
            <p class="text-gray-600">Silakan masuk atau daftar untuk melanjutkan.</p>
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-white border border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-50">Register</a>
            </div>
        </div>
    </div>
</body>
</html>
