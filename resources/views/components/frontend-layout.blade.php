<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'ECO English and Counseling' }}</title>

        <link rel="icon" href="{{ asset('images/eco-logo.png') }}" type="image/png">
        
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 flex flex-col min-h-screen">

        {{-- Top Navigation Bar --}}
        <header class="bg-green-600 text-white p-4 shadow-md w-full">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                {{-- Logo/Brand --}}
                <div class="text-2xl font-bold">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <img src="{{ asset('images/eco-logo.png') }}" alt="ECO Logo" class="h-8">
                        <span>ECO English and Counseling Online</span>
                    </a>
                </div>

                {{-- Navigation Links --}}
                <nav class="flex items-center space-x-6 text-lg">
                    <a href="{{ route('home') }}" class="hover:underline">HOME</a>
                    <a href="{{ route('counseling.index') }}" class="hover:underline">LAYANAN</a>
                    <a href="{{ route('materials.index') }}" class="hover:underline">MATERI</a>

                    @auth
                        {{-- Logika baru untuk tombol Dashboard --}}
                        @php
                            $dashboardRoute = route('dashboard'); // Default ke dashboard user
                            if (Auth::user()->role === 'admin') {
                                $dashboardRoute = route('admin.dashboard');
                            } elseif (Auth::user()->role === 'mentor') {
                                $dashboardRoute = route('mentor.dashboard');
                            }
                        @endphp
                        <a href="{{ $dashboardRoute }}" class="px-4 py-2 bg-white text-green-600 rounded-md hover:bg-gray-100">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-white text-green-600 rounded-md hover:bg-gray-100">
                            Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-white text-green-600 rounded-md hover:bg-gray-100 ml-2">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            </div>
        </header>

        {{-- Main Content Slot --}}
        <main class="flex-grow">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="bg-gray-800 text-white py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    {{-- About Section --}}
                    <div>
                        <h3 class="text-xl font-bold mb-4">ECO English and Counseling</h3>
                        <p class="text-gray-400 text-sm">
                            Menyediakan layanan pembelajaran Bahasa Inggris yang disesuaikan untuk anak berkebutuhan khusus dan layanan konseling profesional untuk mendukung tumbuh kembang mereka.
                        </p>
                    </div>

                    {{-- Quick Links --}}
                    <div>
                        <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition duration-300">Home</a></li>
                            <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition duration-300">About Us</a></li>
                            <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition duration-300">Contact</a></li>
                            <li><a href="{{ route('articles.index') }}" class="text-gray-400 hover:text-white transition duration-300">Articles</a></li>
                        </ul>
                    </div>

                    {{-- Contact & Social Media --}}
                    <div>
                        <h3 class="text-xl font-bold mb-4">Contact Us</h3>
                        <p class="text-gray-400 text-sm mb-4">
                            Email: info@ecoenglish.com<br>
                            Phone: +62 812-3456-7890
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-facebook-f fa-lg"></i></a>
                            <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-twitter fa-lg"></i></a>
                            <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-instagram fa-lg"></i></a>
                            <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-linkedin-in fa-lg"></i></a>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-500 text-sm">
                    &copy; {{ date('Y') }} ECO English and Counseling. All rights reserved.
                </div>
            </div>
        </footer>

    </body>
</html>