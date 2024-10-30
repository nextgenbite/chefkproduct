@extends('layouts.frontend')

@section('content')
          <!-- ---- Login Form Wrapper ----- -->

   <div class="container py-16">
    <div class="max-w-lg mx-auto px-6 py-7 shadow rounded overflow-hidden ">
         <h2 class="text-2xl uppercase font-medium mb-1">
              Login
         </h2>
         <p class="text-gray-600 mb-6 text-sm">Login if you are a returing customer</p>

 <form method="POST" action="{{ route('login') }}">
    @csrf
 <div class="space-y-4">
    <div >
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email <span class="text-red-500">*</span></label>
        <div class="flex">
          <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
          
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m3.5 5.5 7.893 6.036a1 1 0 0 0 1.214 0L20.5 5.5M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
              </svg>
              
          </span>
          <input type="email" id="email" name="email" placeholder="Enter your email" class=" rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        @error('email')
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
      @enderror
     </div>
    <div >
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password <span class="text-red-500">*</span></label>
        <div class="flex">
          <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1Z"/>
              </svg>
          </span>
          
          <input type="password" id="password" name="password"  autocomplete="current-password" placeholder="Enter your password" class=" rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        @error('password')
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
      @enderror
     </div>

 </div>


 


 <div class="flex items-center justify-between mt-6 ">
      <div class="flex items-center ">
           <input type="checkbox" id="remember_me" name="remember" class="text-primary-light focus:ring-0 rounded-sm cursor-pointer " />
           <label for="remember_me" class="text-gray-600 ml-3 cursor-pointer" >Remember Me</label>
      </div>
      @if (Route::has('password.request'))
      <a href="{{ route('password.request') }}" class="text-primary-light">Forgot Password?</a>
      @endif
 </div>

 <div class="mt-4">
      <button type="submit" class="block w-full py-2 text-center text-white bg-primary-light border border-primary-light rounded hover:bg-transparent hover:text-primary-light transition uppercase font-roboto font-medium ">Login </button> 
 </div>


<!-- ---- Login with Social ----- -->

 <div class="mt-6 flex justify-center relative">
      <div class="absolute left-0 top-3 w-full border-b-2 border-gray-200 "> </div>
      <div class="text-gray-600 uppercase px-3 bg-white relative z-10 ">
           OR LOGIN IN WITH
      </div> 
 </div>

 <div class="mt-4 flex gap-4 ">
      <a href="#" class="block w-1/2 py-2 text-center text-white bg-blue-800 rounded uppercase font-roboto font-medium text-sm ">
           Facebook 
      </a>

      <a href="{{Route('login.google')}}" class="block w-1/2 py-2 text-center text-white bg-red-600 rounded uppercase font-roboto font-medium text-sm ">
           Google  
      </a> 
 </div>

 <p class="mt-4 text-gray-600 text-center ">Don't have an account? <a href="#" class="text-primary-light" >Register Now </a> </p>



<!-- ---- End Login with Social ----- -->


 </form>

    </div>

</div>





 <!-- ---- End Login Form Wrapper ----- -->
@endsection