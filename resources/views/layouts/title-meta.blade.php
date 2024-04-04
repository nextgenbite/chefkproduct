<meta charset="utf-8" />
<title>{{ ucwords($settings->app_name) ?: ucwords(config('app.name')) }}{{ $title ? ' | ' . ucwords($title) : '' }}
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta content="Laravel  Ecommerce with POS" name="description" />
<meta content="Nexgenbite" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!-- App favicon -->
<link type="image/x-icon" rel="icon"
    href="{{ isset($settings) && $settings->logo ? asset($settings->logo) : asset('/favicon.ico') }}">
