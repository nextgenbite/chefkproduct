@extends('layouts.app')
@push('title')
    {{ $settings['app_name'] ?? '' . ' ' . $title[0] }}
@endpush
@section('content')
  
    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ url('/admin') }}"
                                class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                                <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <a href="#"
                                    class="ml-1 text-gray-700 hover:text-primary md:ml-2 dark:text-gray-300 dark:hover:text-white">{{ $title[0] }}</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">List</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ $title[0] }} List</h1>
            </div>

        </div>
    </div>

    <div class="container mx-auto">

        <!-- Vertical Form -->
        <form class="form p-2" action="{{ Route('settings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
  
    <div class="p-6 space-y-6">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
                @include('components.input-text' , [ 'name'=> 'key[facebook]', 'label'=> 'facebook' , 'value'=> old('facebook', $settings['facebook'] ?? '')])
            </div>
            <div class="col-span-6 sm:col-span-3">
                @include('components.input-text' , [ 'name'=> 'key[twitter]', 'label'=> 'twitter' , 'value'=> old('twitter', $settings['twitter'] ?? '')])
            </div>
            <div class="col-span-6 sm:col-span-3">
                @include('components.input-text' , [ 'name'=> 'key[instagram]', 'label'=> 'instagram' , 'value'=> old('instagram', $settings['instagram'] ?? '')])
            </div>
            
            <div class="col-span-6 sm:col-span-3">
                @include('components.input-text' , [ 'name'=> 'key[linkedin]', 'label'=> 'linkedin' , 'value'=> old('linkedin', $settings['linkedin'] ?? '')])
            </div>
            
        
        </div>
@include('components.btn-loading',  ['type'=>'submit'])
    </div>
    {{-- <div class="row">

        <h5 class="text-muted">Theme</h5>
     
        <div class="text-center mt-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div> --}}
        </form><!-- Vertical Form -->

    </div>
    <!-- Add Data Modal -->
 
    </div>
@endsection

@push('scripts')

    <script>

            // Preview image on file selection for each file input
            $('input[type="file"]').on('change', function() {
                var file = this.files[0];
                var $preview = $(this).closest('.relative').find(
                '.preview'); // Find the corresponding preview image
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $preview.attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                } 
            });

            // Trigger change event for each file input if there's already a file selected (for initial preview)
            $('input[type="file"]').trigger('change');


         
    </script>
@endpush
