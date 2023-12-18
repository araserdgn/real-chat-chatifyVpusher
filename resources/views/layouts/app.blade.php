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

        {{-- Fontawesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .unread_notification {
                margin-top: -35px;
                margin-left: 8px;
                background-color: red;
                color: #ffffff;
                height: 15px;
                width: 18px;
                text-align: center;
                border-radius: 50%;
                font-size: 12px
            }
        </style>
        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script>
      
          // Enable pusher logging - don't include this in production
          Pusher.logToConsole = true;
      
          var pusher = new Pusher('3ab47717248fe23002d1', {
            cluster: 'eu'
          });
      
          var channel = pusher.subscribe('my-channel');
          channel.bind('my-event', function(data) {
                $.ajax({
                    url:"{{ route('unreadcount') }}",
                    method:"GET",
                    success: function (data) {
                        $('.unread_notification').html(data.count);
                    }
                })
          });
        </script>
        @livewireScripts
    </body>
</html>
