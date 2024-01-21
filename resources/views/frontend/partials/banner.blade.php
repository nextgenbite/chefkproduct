<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

<div class="mx-2 md:container lg:container pt-8">

    <div class="banner-card lg:flex lg:h-fit space-y-[2%] lg:space-y-0 lg:space-x-[2%]  mb-[30px]">
        <swiper-container class="lg:w-[74%]  w-full h-full shadow-md rounded-md">
         @forelse ($mainBanner as $slider)
         <swiper-slide>
              <a href="/categories/{{ $slider->category_id}}" v-if="sliders && sliders.length || item.thumbnail">
    
                   {{-- <NuxtImg   :src="item.thumbnail" :alt="item.title" class="w-full max-w-full object-cover rounded-md" /> --}}
                   <img  src="{{  $slider->thumbnail}}" alt="{{  $slider->title}}" class="w-full max-w-full object-cover rounded-md" />
    
              </a>
         </swiper-slide>
         @empty
                    
         <swiper-slide>
              <div   role="status" class="space-y-8 lg:w-[74%] animate-pulse md:space-y-0 md:space-x-8 rtl:space-x-reverse md:flex md:items-center">
              <div class="flex items-center justify-center w-full h-48 md:h-full bg-gray-300 rounded dark:bg-gray-700">
                  <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                      <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
                  </svg>
              </div>
          
              <span class="sr-only">Loading...</span>
          </div>
          
          </swiper-slide>
         @endforelse
       </swiper-container>

    
    
    
    
    
    <div  class="w-full  flex-1 flex lg:flex-col flex-row space-x-[2%] lg:space-x-0 lg:space-y-[6%] aos-init aos-animate">
        <div class="w-full lg:h-full lg:flex-1 shadow-md rounded-md" >
     @if ($rightTopBanner && $rightTopBanner->count() > 0 )
     <a href="/categories/ {{  $rightTopBanner->category_id}}">
          <img  src="{{  $rightTopBanner->thumbnail}}" alt="{{  $rightTopBanner->title}}" class="w-full max-w-full h-auto object-cover rounded-md" />
     </a>
@else
     
<div  role="status" class="space-y-8 animate-pulse md:space-y-0 md:space-x-8 rtl:space-x-reverse md:flex md:items-center">
<div class="flex items-center justify-center w-full h-48 bg-gray-300 rounded sm:w-96 dark:bg-gray-700">
    <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
        <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
    </svg>
</div>

<span class="sr-only">Loading...</span>
</div>
@endif
        </div>
    
        <div class="w-full lg:h-full lg:flex-1 shadow-md rounded-md" >
         @if ($rightBottomBanner && $rightBottomBanner->count() > 0 )
              <a href="/categories/ {{  $rightBottomBanner->category_id}}">
                   <img  src="{{  $rightBottomBanner->thumbnail}}" alt="{{  $rightBottomBanner->title}}" class="w-full max-w-full h-auto object-cover rounded-md" />
              </a>
         @else
              
         <div  role="status" class="space-y-8 animate-pulse md:space-y-0 md:space-x-8 rtl:space-x-reverse md:flex md:items-center">
         <div class="flex items-center justify-center w-full h-48 bg-gray-300 rounded sm:w-96 dark:bg-gray-700">
             <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                 <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
             </svg>
         </div>
     
         <span class="sr-only">Loading...</span>
     </div>
         @endif
        </div>
    
    </div>
    </div>
              </div>