<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="app-url" content="{{ config('app.url') }}">
<meta name="file-base-url" content="{{  config('app.url').'/public' }}">
<title>{{ ucwords($settings->app_name ?? config('app.name')) }}@if (!empty(trim($__env->yieldContent('title')))) | @yield('title')@endif</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="index, follow">
<meta name="description" content="{{ $meta['description'] ?? 'Laravel Ecommerce with POS' }}" />
<meta name="author" content="{{ $meta['author'] ?? 'Nexgenbite' }}" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

@yield('meta')

@if (isset($meta) && !empty($meta))
    
@foreach ($meta as $name => $content)
    @if (!in_array($name, ['description', 'author']) && !str_starts_with($name, 'og:'))
        <meta name="{{ $name }}" content="{{ $content }}" />
    @elseif (str_starts_with($name, 'og:'))
        <meta property="{{ $name }}" content="{{ $content }}" />
    @endif
@endforeach
@endif

<!-- App favicon -->
<link type="image/x-icon" rel="icon" href="{{isset($settings) && asset($settings->logo) ? asset($settings->logo) : asset('/favicon.ico') }}">


