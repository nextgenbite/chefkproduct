@extends('layouts.frontend')
@push('meta')
<title>{{ config('app.name', $settings->app_name.' | Shop') }}</title>
     
@endpush
@section('content')
 <!-- ---- BreadCrum ----- -->
 <div class="container py-4 flex justify-between " >
     <div class="flex gap-3 items-center ">
          <a href="{{url('/')}}" class="text-primary text-base">
              <i class="fas fa-home"></i>
          </a>
          <span class="text-sm text-gray-500 ">
              <i class="fas fa-chevron-right" ></i>
          </span>
          <p class="text-gray-500 font-medium">Checkout</p>
     </div>

</div>
 <!-- ---- End BreadCrum --->
 
          <!-- ---- Shpping Cart Wrapper--->

          <div v-if="carts.cartItems.length > 0" class="container items-start grid-cols-12 gap-6 pt-4 pb-16 lg:grid ">
            <!-- ---- Shipping Address--->
            <div class="xl:col-span-6 lg:col-span-6 ">

                 <form action="">
                      <InputValidate v-model="forms.name" label="Name" :isMessage="errors.name ? errors.name[0] : ''"
                           :isError="errors.name ? true : false" />

                      <InputValidate type="number" v-model="forms.phone" label="Phone"
                           :isMessage="errors.phone ? errors.phone[0] : ''" :isError="errors.phone ? true : false" />


                      <div class="relative mt-6">
                           <textarea rows="4" v-model="forms.address" id="floating_outlined"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" "></textarea>
                           <label for="floating_outlined"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Address</label>
                           {{-- <p v-if="errors.address" id="outlined_error_help"
                                class="mt-2 text-xs text-red-600 dark:text-red-400">{{ errors.address[0] }}</p> --}}

                      </div>


                      <label for="shipping_cost"
                           class="block mt-6 mb-2 text-sm font-medium text-gray-900 dark:text-white">Delivary Zone</label>
                      <select v-model="forms.shipping_cost" id="shipping_cost"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                           <option value="" selected disabled>Choose a zone</option>
                           @forelse ($shipping_cost as $item)
                               
                           <option  value="{{$item->cost}}">{{$item->title}}</option>
                           @empty
                               
                           @endforelse
                      </select>

                 </form>
            </div>

            <!-- ---- End Shipping Address--->


            <!-- ---- Order Summary--->
            <div
                 class="px-4 py-4 mt-6 bg-gray-100 border border-gray-200 rounded shadow-md xl:col-span-6 lg:col-span-6 lg:mt-0 card">


                 <!-- ---- Product Cart--->
                 <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
     <table
       class="w-full text-xs md:text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
     >
       <thead
         class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400"
       >
         <tr>
           <th scope="col" class="px-2 py-3 hidden md:inline">
             <span class="sr-only">Image</span>
           </th>
           <th scope="col" class="px-1 md:px-2 py-2">Product</th>
           <th scope="col" class=" md:px-2 py-2 text-center">Qty</th>
           <th scope="col" class="px-1 md:px-2 py-2">Price</th>
           <th scope="col" class="px-1 md:px-2 py-2 text-left">Action</th>
         </tr>
       </thead>
       <tbody>
         <tr
           class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
           v-for="item in carts.cartItems"
           :key="item.id"
         >
           <td class="p-2 hidden md:inline">
             <img
               :src="$config.public.IMAGE_URL + item.thumbnail"
               class="md:w-16 md:ml-2 max-w-full max-h-full rounded "
               :alt="item.title"
             />
           </td>
           <td
             class="md:px-2 py-1 font-semibold text-gray-900 dark:text-white text"
           >
           {{ item.title }}
           </td>
           <td class=" md:px-2 py-1">
             <div class="relative flex items-center max-w-[6rem]">
               <button
                 type="button"
                 @click="carts.itemDecrement(item.id)"
                 id="decrement-button"
                 data-input-counter-decrement="quantity-input"
                 class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-1 h-6  md:p-2 md:h-8 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none"
               >
                 <svg
                   class="w-2 h-2 md:w-3 md:h-3 text-gray-900 dark:text-white"
                   aria-hidden="true"
                   xmlns="http://www.w3.org/2000/svg"
                   fill="none"
                   viewBox="0 0 18 2"
                 >
                   <path
                     stroke="currentColor"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     stroke-width="2"
                     d="M1 1h16"
                   />
                 </svg>
               </button>
               <input
                 type="text"
                 id="quantity-input"
                 data-input-counter
                 aria-describedby="helper-text-explanation"
                 :value="item.quantity"
                 disabled
                 class="bg-gray-50 border-x-0 border-gray-300 h-6 md:h-8 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                 placeholder="999"
                 required
               />
               <button
                 type="button"
                 id="increment-button"
                 @click="carts.itemIncrement(item.id)"
                 data-input-counter-increment="quantity-input"
                 class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-2 h-6  md:p-2 md:h-8 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none"
               >
                 <svg
                   class="w-2 h-2 md:w-3 md:h-3 text-gray-900 dark:text-white"
                   aria-hidden="true"
                   xmlns="http://www.w3.org/2000/svg"
                   fill="none"
                   viewBox="0 0 18 18"
                 >
                   <path
                     stroke="currentColor"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     stroke-width="2"
                     d="M9 1v16M1 9h16"
                   />
                 </svg>
               </button>
             </div>
           </td>
           <td
             class="px-2 py-1 font-semibold text-gray-900 dark:text-white"
           >
           <strong class="">৳</strong>{{ parseFloat(item.price * item.quantity).toFixed(2) }}
           </td>
           <td class="px-1 md:px-2 py-1">
               <button type="button"  @click="carts.removeFromCart(item.id)" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-1.5 md:p-2.5 text-center inline-flex items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">

<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
</svg>
<span class="sr-only">Icon description</span>
</button>
           </td>
         </tr>
       </tbody>
     </table>
   </div>
                 <!-- ---- End Product Cart--->


                 <h3 class="mb-4 text-lg font-medium text-gray-800 uppercase ">Order Summary</h3>

                 <div class="pb-3 space-y-1 text-gray-600 border-b border-gray-200 ">
                      <div class="flex justify-between font-medium">
                           <p>Subtotal</p>
                           <p>৳{{ parseFloat(carts.cartTotal).toFixed(2) }}</p>
                      </div>

                      <div class="flex justify-between font-medium">
                           <p>Delivery</p>
                           <p>৳{{ parseFloat(forms.shipping_cost).toFixed(2) }}</p>
                      </div>
                      <!--
          <div class="flex justify-between font-medium">
               <p>Tax</p>
               <p>Free</p>
          </div>  -->
                 </div>

                 <div class="flex justify-between my-3 font-semibold text-gray-800 uppercase">
                      <h4>Total</h4>
                      <h4>৳{{ parseFloat(carts.cartTotal + forms.shipping_cost).toFixed(2) }}</h4>
                 </div>

                 <!-- ---- Coupon --->
                 <!-- <div class="flex mb-4">
     <input type="text" class="w-full px-3 py-2 pl-4 text-sm border border-r-0 border-primary-900 rounded-l-md focus:ring-primary-900 focus:border-primary-900 " placeholder="Coupon" />

     <button type="submit" class="bg-primary-900 border border-primary-900 text-white px-5 font-medium rounded-r-md hover\:bg-transparent hover\:text-primary-900 transition text-sm w-full block text-center " >Apply</button>

</div> -->
                 <!-- ---- End Coupon--->

                 <button type="submit" @click="orderSubmit()"
                      class="block w-full px-4 py-3 text-sm font-medium text-center text-white uppercase transition border rounded-md bg-primary-900 border-primary-900 hover:bg-transparent hover:text-primary-900 ">
                      Process to checkout
                 </button>


            </div>


            <!-- ---- End Order Summary--->
       </div>

       <div v-else class="container pt-4 pb-16">
            <div class="flex items-center justify-center">

                 <h2 class="font-mono text-3xl font-medium ">Your Cart is empty</h2>
            </div>
       </div>
       <!-- ---- End Cart Wrapper --->
@endsection