@extends('layouts.app')
@push('title')
{{ isset($settings['app_name']) ? $settings['app_name'] : config('app.name') .' | Dashboard'}}
@endpush
@section('content')
<div class=" container h-screen flex justify-center items-center">
<div class=" leading-6 text-3xl">welcome</div>
  </div>
@endsection
