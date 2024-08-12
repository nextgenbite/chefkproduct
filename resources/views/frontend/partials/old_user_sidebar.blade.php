<div class="col-span-3 bg-gray-100 shadow rounded divide-y">
    <!-- ---- User Profile --->
    <div class="px-4 py-2  flex  items-center gap-4 ">
        <div class="flex-shrink-0">
            <img src="{{asset(auth()->user()->avatar ? auth()->user()->avatar : '/images/no-image.png')}}"
                class="rounded-full w-14 h14 p-1 border border-gray-200 object-cover " />
        </div>
        <div>
            {{-- <p class="text-gray-600">Hello..</p> --}}
            <h4 class="text-gray-800 capitalize font-semibold">{{auth()->user()->name}}</h4>
        </div>

    </div>
    <!-- ----End User Profile --->

    <!-- ---- Profile Link --->
    <div class="mt-2    p-4 divide-y divide-gray-200 space-y-4 text-gray-600 ">
        <!-- ---- single Link --->
        <div class="space-y-1 pl-8">
            <a href="#"
                class="relative text-base font-medium capitalize hover:text-primary-light transition block text-primary">
                Manage Account
                <span class="absolute -left-8 top-0 text-base ">
                    <i class="far fa-address-card"></i>
                </span>
            </a>
            <a href="#" class="hover:text-primary-light transition capitalize block">Profile Information </a>
            <a href="#" class="hover:text-primary-light transition capitalize block">Manage Address </a>
            <a href="#" class="hover:text-primary-light transition capitalize block">Change password </a>
        </div>
        <!-- ---- End single Link --->


        <!-- ---- single Link --->
        <div class="space-y-1 pl-8 pt-4">
            <a href="#"
                class="relative text-base font-medium capitalize hover:text-primary-light transition block text-primary">
                My order History
                <span class="absolute -left-8 top-0 text-base ">
                    <i class="fas fa-gift"></i>
                </span>
            </a>
            <a href="#" class="hover:text-primary-light transition capitalize block">My returns </a>
            <a href="#" class="hover:text-primary-light transition capitalize block">my cancellations </a>
            <a href="#" class="hover:text-primary-light transition capitalize block">my review </a>
        </div>
        <!-- ---- End single Link --->


        <!-- ---- single Link --->
        <div class="space-y-1 pl-8 pt-4">
            <a href="#"
                class="relative text-base font-medium capitalize hover:text-primary-light transition block text-primary">
                Payment Method
                <span class="absolute -left-8 top-0 text-base ">
                    <i class="far fa-credit-card"></i>
                </span>
            </a>
            <a href="#" class="hover:text-primary-light transition capitalize block">Voucher</a>

        </div>
        <!-- ---- End single Link --->


        <!-- ---- single Link --->
        <div class="space-y-1 pl-8 pt-4">
            <a href="#"
                class="relative text-base font-medium capitalize hover:text-primary-light transition block text-primary">
                My wishlist
                <span class="absolute -left-8 top-0 text-base ">
                    <i class="far fa-heart"></i>
                </span>
            </a>

        </div>
        <!-- ---- End single Link --->


        <!-- ---- single Link --->
        <div class="space-y-1 pl-8 pt-4">
            <a href="{{route('user.logout')}}"
                class="relative text-base font-medium capitalize hover:text-primary-light transition block text-primary">
                Logout
                <span class="absolute -left-8 top-0 text-base ">
                    <i class="fas fa-sign-out-alt"></i>
                </span>
            </a>

        </div>
        <!-- ---- End single Link --->
    </div>

    <!-- ----End Profile Link --->
</div>