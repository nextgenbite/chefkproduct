<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@stack('title')</title>
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset($settings['favicon'] ?? 'images/no-image.png') }}">

    <!-- Google fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&amp;display=swap" rel="stylesheet">    <!-- icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <style>
      :root {
        /* --primary-light: 30, 66, 159; */
        --primary-light: {{isset($settings['color']) ? $settings['color'] : '#1E429F'}};
        --primary-dark: #fff;
        --primary-700: {{isset($settings['color']) ? $settings['color'] : '#1E429F'}};
        --primary-800: {{isset($settings['hover_color']) ? $settings['hover_color'] : '#1E429F'}};
   }
</style>
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
    <script>
          @if (Session::has('messege'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            var message = "{{ Session::get('messege') }}";
            showFrontendAlert(type, message);
        @endif
    </script>
    @stack('custom-script')
</body>

</html>
