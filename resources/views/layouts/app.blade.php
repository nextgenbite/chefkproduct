<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@stack('title')</title>
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset($settings->favicon) }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/dark-mood.js') }}" defer></script> --}}
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-white dark:bg-gray-800">
        {{-- navbar --}}
        @include('admin.includes.navbar')
        {{-- sidebar --}}
        @include('admin.includes.leftsidebar')

        <!-- Page Content -->
        <div class="p-1 lg:ml-64">

            <div
            class="border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14"
          >
           
            @yield('content')
          </div>
        </div>
    </div>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    @stack('custom-script')
</body>

</html>
