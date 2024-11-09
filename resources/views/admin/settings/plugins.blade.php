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
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ $title[0] }}</h1>
            </div>

        </div>
    </div>

    <div class="container mx-auto">



        <div class="p-6 space-y-6 ">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <!-- Vertical Form -->
                    <form class="form p-2" action="{{ Route('settings.plugin.store') }}" method="POST">
                        @csrf
                        <div
                            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-7000">

                            <div class="flex items-center justify-between">
                                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Email Setup</h5>

                            </div>
                            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

                            @include('components.input-text', [
                                'name' => 'key[mail_mailer]',
                                'label' => 'Mail Driver',
                                'value' => old('mail_mailer', $data['mail_mailer'] ?? ''),
                            ])
                            @include('components.input-text', [
                                'name' => 'key[mail_host]',
                                'label' => 'Mail Host',
                                'value' => old('mail_host', $data['mail_host'] ?? ''),
                            ])
                            @include('components.input-text', [
                                'name' => 'key[mail_port]',
                                'type' => 'number',
                                'label' => 'Mail Port',
                                'value' => old('facebook', $data['mail_port'] ?? ''),
                            ])
                            @include('components.input-text', [
                                'name' => 'key[mail_from_address]',
                                'label' => 'Mail From Address',
                                'value' => old('mail_from_address', $data['mail_from_address'] ?? ''),
                            ])
                            @include('components.input-text', [
                                'name' => 'key[mail_username]',
                                'label' => 'Mail Username',
                                'value' => old('mail_username', $data['mail_username'] ?? ''),
                            ])
                            @include('components.input-text', [
                                'name' => 'key[mail_password]',
                                'type' => 'password',
                                'label' => 'Mail Password',
                                'value' => old('mail_password', $data['mail_password'] ?? ''),
                            ])
                            @include('components.input-text', [
                                'name' => 'key[mail_encryption]',
                                'label' => 'Mail Encryption Type',
                                'value' => old('mail_encryption', $data['mail_encryption'] ?? ''),
                            ])
                            @include('components.btn-loading', [
                                'type' => 'submit',
                                'label' => 'Save',
                                'class' => 'mt-2',
                            ])
                        </div>


                        <div
                            class="p-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-7000">

                            <div class="flex items-center justify-between">
                                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Fedex Setup</h5>

                            </div>
                            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

                            @include('components.input-text', [
                                'name' => 'key[fedex_client_id]',
                                'label' => 'Client Id',
                                'value' => old('fedex_client_id', $data['fedex_client_id'] ?? ''),
                            ])
                            @include('components.input-text', [
                                'name' => 'key[fedex_secret_id]',
                                'label' => 'Client Secret',
                                'value' => old('fedex_secret_id', $data['fedex_secret_id'] ?? ''),
                            ])
                            @include('components.input-text', [
                                'name' => 'key[fedex_account_number]',
                                'label' => 'Account Number',
                                'value' => old('fedex_account_number', $data['fedex_account_number'] ?? ''),
                            ])

                            @include('components.btn-loading', [
                                'type' => 'submit',
                                'label' => 'Save',
                                'class' => 'mt-2',
                            ])
                        </div>
                    </form><!-- Vertical Form -->
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <form class="form p-2" action="{{ Route('settings.store') }}" method="POST">
                        @csrf
                    <div
                        class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-7000">

                        <div class="flex items-center justify-between">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Pixel Setup</h5>
                            <label class="inline-flex items-center cursor-pointer">
                                <span class="me-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    @if (isset($settings['pixel_id']))
                                        Active
                                    @else
                                        Deactive
                                    @endif
                                </span>
                                <input type="checkbox" @if (isset($settings['pixel_id'])) checked @endif
                                    class="sr-only peer">
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                </div>
                            </label>
                        </div>
                        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

                        @include('components.input-text', [
                            'name' => 'key[pixel_id]',
                            'label' => 'Pixel Id',
                            'value' => old('pixel_id', $settings['pixel_id'] ?? ''),
                        ])

                        @include('components.btn-loading', [
                            'type' => 'submit',
                            'label' => 'Save',
                            'class' => 'mt-2',
                        ])
                    </div>
                    <div
                        class="p-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-7000">

                        <div class="flex items-center justify-between">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Google Tag Manager
                                Setup</h5>
                            <label class="inline-flex items-center cursor-pointer">
                                <span class="me-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    @if (isset($settings['gtm_id']))
                                        Active
                                    @else
                                        Deactive
                                    @endif
                                </span>
                                <input type="checkbox" @if (isset($settings['gtm_id'])) checked @endif
                                    class="sr-only peer">
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                </div>
                            </label>
                        </div>
                        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

                        @include('components.input-text', [
                            'name' => 'key[gtm_id]',
                            'label' => 'GTM Id',
                            'value' => old('gtm_id', $settings['gtm_id'] ?? ''),
                        ])

                        @include('components.btn-loading', [
                            'type' => 'submit',
                            'label' => 'Save',
                            'class' => 'mt-2',
                        ])
                    </div>
                </form><!-- Vertical Form -->
                </div>



            </div>
        </div>
        {{-- <div class="row">

        <h5 class="text-muted">Theme</h5>
     
        <div class="text-center mt-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div> --}}


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
