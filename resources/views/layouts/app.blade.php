<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
           
            @if (session('pop_enables'))
            <div id="warning-popup" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1000; display: flex; align-items: center; justify-content: center;">
                <div style="background-color: white; padding: 20px; border-radius: 10px; text-align: center;">
                    <p>You have been inactive for a while. Do you want to extend your session?</p>
                    <button onclick="continueSession()">Continue</button>
                    <button onclick="logoutUser()">Logout</button>
                </div>
            </div>   
            @endif

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </div>
    </body>
    <script>
        const inactivityLimit = 10 * 60 * 1000; // 10 minutes in milliseconds
        const warningTime = 1 * 60 * 1000; // 1 minute before auto logout
        let inactivityTimeout;
        let warningTimeout;

        // Start timers after page load
        window.onload = () => {
            resetTimers();
        };

        function resetTimers() {
            clearTimeout(inactivityTimeout);
            clearTimeout(warningTimeout);
            startTimers();
        }

        function startTimers() {
            // Timer for showing warning popup before auto logout
            warningTimeout = setTimeout(() => {
                showWarningPopup();
            }, inactivityLimit - warningTime);

            // Timer for auto logout
            inactivityTimeout = setTimeout(() => {
                logoutUser();
            }, inactivityLimit);
        }

        function showWarningPopup() {
            {{session(['pop_enable' => true])}}
            document.getElementById('warning-popup').style.display = 'flex';
        }

        function continueSession() {
            {{session('pop_enable', false)}}
            document.getElementById('warning-popup').style.display = 'none';
            resetTimers(); // Reset timers to continue session
        }

        function logoutUser() {
            document.getElementById('logout-form').submit(); // Submit the form to log out
        }

        // Detect user activity
        document.onmousemove = resetTimers;
        document.onkeydown = resetTimers;
        document.onclick = resetTimers;
        document.onscroll = resetTimers;

    </script>
</html>
