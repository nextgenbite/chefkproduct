@extends('layouts.frontend')
@section('title','Change Password')
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
        <p class="text-gray-500 font-medium uppercase">Change Password</p>
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
                    Change Password
                    <hr class="w-1/3 h-0.5 my-1 bg-gray-200 border-0 dark:bg-gray-700">
                </h2>

                <form method="POST" accept="{{route('user.password.update')}}" class="grid max-w-2xl mx-auto mt-8">
                    @csrf


                    <div class="items-center  text-primary-light ">




                        <div class="mb-2 sm:mb-6">
                            @include('components.input-text' , ['type'=>'password', 'name'=> 'old_password', 'label'=>
                            'Old Password'])

                        </div>
                        <div class="mb-2 sm:mb-6">
                            @include('components.input-text' , ['type'=>'password', 'name'=> 'password', 'label'=> 'New Password'])

                        </div>
                        <div class="mb-6">
                            @include('components.input-text' , ['type'=>'password', 'name'=> 'password_confirmation',
                            'label'=> 'Confirm Password'])

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