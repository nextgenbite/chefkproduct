@extends('layouts.app')
@push('title')
{{ config('app.name', $settings->app_name).' | Dashboard' }}
@endpush
@section('content')
<div class=" container h-screen flex justify-center items-center">
<div class=" leading-6 text-3xl">welcome</div>
  </div>
@endsection
