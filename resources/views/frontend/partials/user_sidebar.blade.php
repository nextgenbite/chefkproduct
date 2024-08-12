<aside class="hidden py-4 md:w-1/3 lg:w-1/4 md:block">
    <div class="sticky flex flex-col gap-2 p-4 text-sm border-r border-indigo-100 top-12">

        <h2 class="pl-3 mb-4 text-2xl font-semibold">Settings</h2>

        <a href="{{url('/user/dashboard')}}" class="flex items-center px-3 py-2.5 {{ Request::is('user/dashboard') ? 'font-bold bg-white  text-primary-800 border rounded-full' : 'font-semibold hover:text-primary-800 hover:border hover:rounded-full' }}">
            Dashboard
        </a>
        <a href="{{url('/user/orders')}}" class="flex items-center px-3 py-2.5 {{ Request::is('user/orders') ? 'font-bold bg-white  text-primary-800 border rounded-full' : 'font-semibold hover:text-primary-800 hover:border hover:rounded-full' }}">
           Order History
        </a>
        <a href="{{url('/user/profile')}}" class="flex items-center px-3 py-2.5 {{ Request::is('user/profile') ? 'font-bold bg-white  text-primary-800 border rounded-full' : 'font-semibold hover:text-primary-800 hover:border hover:rounded-full' }}">
            Account Information
        </a>
        <a href="{{url('/user/password-change')}}" class="flex items-center px-3 py-2.5 {{ Request::is('user/password-change') ? 'font-bold bg-white  text-primary-800 border rounded-full' : 'font-semibold hover:text-primary-800 hover:border hover:rounded-full' }}">
            Password Change
        </a>
        <a href="{{route('user.logout')}}" class="relative inline-flex items-center justify-center  px-4 py-2 overflow-hidden font-medium text-primary-800 transition duration-300 ease-out border-2 border-red-600 rounded-full shadow-md group">
            <span class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-red-600 group-hover:translate-x-0 ease">
            <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2"/>
              </svg>
              
            </span>
            <span class="absolute flex items-center justify-center w-full h-full text-red-600 transition-all duration-300 transform group-hover:translate-x-full ease">Logout</span>
            <span class="relative invisible">Logout</span>
            </a>
    </div>
</aside>