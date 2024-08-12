@extends('layouts.frontend')
@section('title','Profile of '. auth()->user()->name)
@section('content')
<!-- ---- BreadCrum ----- -->
<div class="container py-4 md:px-16 flex justify-between ">
    <div class="flex gap-3 items-center ">
        <a href="/" class="text-primary-light text-base">
            <i class="fas fa-home"></i>
        </a>
        <span class="text-sm text-gray-500 ">
            <i class="fas fa-chevron-right"></i>
        </span>
        <p class="text-gray-500 font-medium uppercase">My Profile</p>
    </div>

</div>
<!-- ---- End BreadCrum --->

<!-- ---- Account Wrapper--->

<div class="bg-white w-full flex flex-col gap-5 px-3 md:px-16  md:flex-row text-primary-light">
    <!-- ---- Sidbar--->
    @include('frontend.partials.user_sidebar')
    <!-- ---- End Sidbar--->

    <div class="w-full min-h-screen py-1 md:w-2/3 lg:w-3/4 mx-auto">
        <div class="p-2 md:p-4">
            <div class="w-full px-6 pb-8 mt-8 sm:max-w-xl sm:rounded-lg">
                <h2 class="text-base col-span-3 my-1 md:text-lg font-medium text-gray-800 capitalize">
                    Account Information
                    <hr class="w-1/3 h-0.5 my-1 bg-gray-200 border-0 dark:bg-gray-700">
                </h2>
                <form method="POST" accept="{{route('user.profile.update')}}" enctype="multipart/form-data"
                    class="grid max-w-2xl mx-auto mt-8">
                    @csrf
                    <div class="flex flex-col items-center space-y-5 sm:flex-row sm:space-y-0">

                        <img class="object-cover w-40 h-40 p-1 rounded-full ring-2 ring-indigo-300 dark:ring-indigo-500"
                            src="{{asset(auth()->user()->avatar ?? './images/no-image.png')}}" alt="Bordered avatar">

                        <div class="flex flex-col space-y-5 sm:ml-8">

                            <div class="relative">
                                <label title="Click to upload" for="button2"
                                    class="cursor-pointer flex items-center gap-2 py-3 px-6  rounded-lg border border-indigo-200 before:border-gray-400/60 hover:before:border-gray-300 group before:bg-gray-100 before:absolute before:inset-0 before:rounded-3xl before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
                                    <div class="w-max relative">
                                        <svg class="w-10 h-10" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 5v9m-5 0H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2M8 9l4-5 4 5m1 8h.01" />
                                        </svg>

                                    </div>
                                    <div class="relative">
                                        <span
                                            class="block text-base font-semibold relative text-blue-900 group-hover:text-blue-500">
                                            Change picture
                                        </span>
                                        <span class="mt-0.5 block text-sm text-gray-500">Max 2 MB</span>
                                    </div>
                                </label>
                                <input hidden="" accept="image/*" type="file" name="button2" id="button2">
                            </div>
                            {{-- <button type="button"
                                class="py-3 px-6 text-base font-medium text-primary-800 focus:outline-none bg-white rounded-lg border border-indigo-200 hover:bg-indigo-100 hover:text-primary-light  focus:z-10 focus:ring-4 focus:ring-indigo-200 ">
                                Delete picture
                            </button> --}}
                        </div>
                    </div>
                    <div class="items-center mt-8 sm:mt-14 text-primary-light ">
                        <div
                            class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">
                            <div class="w-full">
                                @include('components.input-text' , ['type'=>'text', 'name'=> 'name', 'label'=> 'Name',
                                'value'=> old('name', $data->name ?? '')])
                            </div>
                            <div class="w-full">
                                @include('components.input-text' , ['type'=>'tel', 'name'=> 'phone', 'label'=> 'Phone',
                                'value'=> old('phone', $data->phone ?? '')])
                            </div>
                        </div>
                        <div class="mb-2 sm:mb-6">
                            @include('components.input-text' , ['type'=>'email', 'name'=> 'email', 'label'=> 'Email',
                            'value'=> old('email', $data->email ?? '')])
                        </div>
                        <div class="mb-6">
                            @include('components.input-textarea' , ['name'=> 'address', 'label'=> 'Address', 'value'=>
                            old('address', $data->address ?? '')])
                        </div>

                        <div class="flex justify-end">
                            @include('components.btn-loading', ['type'=>'submit'])
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- ----End Account Content--->


</div>

<!-- ---- End Account Wrapper --->
@endsection