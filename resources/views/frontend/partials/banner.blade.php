

<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<style>
    .my-swiper .swiper-button-prev,.my-swiper .swiper-button-next {
    position: absolute;
    width: 1.5rem;
    height: 1.5rem;
    background-color: #fff;
    color: #475569!important;
    border-radius: 0.6rem !important;
    margin-top: auto
}

.my-swiper .swiper-button-next {
    left: auto;
    right: .2rem;
    bottom: .2rem
}

.my-swiper .swiper-button-prev {
    left: auto;
    right: 2rem;
    bottom: .2rem
}

.my-swiper .swiper-button-prev:after,.my-swiper .swiper-button-next:after {
    font-size: 0.7rem!important
}

.my-swiper .swiper-pagination-bullet-active {
    height: .5rem;
    width: 1.5rem;
    border-radius: .25rem;
    background-color: var(--primary-700)
}

</style>
<div class="container mt-3 grid grid-cols-4 gap-3 lg:gap-3">
    <div class="col-span-4 lg:col-span-3">
        <div class="swiper my-swiper">
            <div class="swiper-wrapper">
                @forelse ($mainBanner as $slider)
                <div class="swiper-slide">
                    <a href="/categories/{{ $slider->category_id }}">
                        <img src="{{ asset('/images/placeholder-image.png') }}" data-src="{{ asset($slider->thumbnail) }}"
                            loading="lazy" alt="{{ $slider->title }}" class="w-full object-cover rounded aspect-[9/4]">
                    </a>
                </div>
                @empty
                <div class="swiper-slide">
                    <div role="status" class="space-y-8 lg:w-full animate-pulse md:space-y-0 md:space-x-8 rtl:space-x-reverse md:flex md:items-center">
                        <div class="flex items-center justify-center w-full h-48 md:h-[26.5rem] bg-gray-300 rounded dark:bg-gray-700">
                            <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                            </svg>
                        </div>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                @endforelse
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    <div class="col-span-4 lg:col-span-1 flex  sm:flex-row lg:flex-col gap-2 lg:gap-3">
        <div class="flex-1">
            @if ($rightTopBanner && $rightTopBanner->count() > 0)
            <a href="/categories/{{ $rightTopBanner->category_id }}" class="block overflow-hidden">
                <img src="{{ asset('/images/placeholder-image.png') }}" height="100" width="100" data-src="{{ $rightTopBanner->thumbnail }}"
                    alt="{{ $rightTopBanner->title }}" loading="lazy" class="w-full h-auto object-cover aspect-[9/6] rounded-xl">
            </a>
            @else
            <div role="status" class="space-y-8 animate-pulse md:space-y-0 md:space-x-8 rtl:space-x-reverse md:flex md:items-center">
                <div class="flex items-center justify-center w-full h-[12.5rem] bg-gray-300 rounded sm:w-96 dark:bg-gray-700">
                    <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                    </svg>
                </div>
                <span class="sr-only">Loading...</span>
            </div>
            @endif
        </div>
        <div class="flex-1">
            @if ($rightBottomBanner && $rightBottomBanner->count() > 0)
            <a href="/categories/{{ $rightBottomBanner->category_id }}" class="block overflow-hidden">
                <img src="{{ asset('/images/placeholder-image.png') }}" data-src="{{ $rightBottomBanner->thumbnail }}" height="100" width="100"
                    alt="{{ $rightBottomBanner->title }}" loading="lazy" class="w-full h-auto object-cover aspect-[9/6] rounded-lg">
            </a>
            @else
            <div role="status" class="space-y-8 animate-pulse md:space-y-0 md:space-x-8 rtl:space-x-reverse md:flex md:items-center">
                <div class="flex items-center justify-center w-full h-[12.5rem] bg-gray-300 rounded sm:w-96 dark:bg-gray-700">
                    <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                    </svg>
                </div>
                <span class="sr-only">Loading...</span>
            </div>
            @endif
        </div>
    </div>
</div>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var swiper = new Swiper('.my-swiper', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            lazy: {
                loadPrevNext: true,
            },
        });
    });
</script>