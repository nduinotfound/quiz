<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <span class="font-bold text-xl text-gray-800">Admin Panel</span>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('admin.dashboard') }}"
                               class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out {{ request()->routeIs('admin.dashboard') ? 'border-indigo-400 text-gray-900' : '' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('berita.index') }}"
                               class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out {{ request()->routeIs('berita.*') ? 'border-indigo-400 text-gray-900' : '' }}">
                                Kelola Berita
                            </a>
                        </div>
                    </div>
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="ml-3 relative">
                            <span class="text-sm text-gray-500">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline ml-4">
                                @csrf
                                <button type="submit" class="text-sm text-gray-500 hover:text-gray-700">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    @yield('title')
                </h1>
            </div>
        </header>

        <main class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
