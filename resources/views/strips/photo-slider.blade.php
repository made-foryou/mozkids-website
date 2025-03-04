@php
    $live = $live ?? false;
@endphp

<section class="relative
                w-full
                py-12
                lg:py-18">

    <x-container class="max-w-7xl overflow-hidden rounded-lg" :full-screen-mobile="true">

        <!-- Swiper -->
        <div class="swiper made-photo-slider overflow-visible! mx-4! mx:mx-0! md:rounded-lg!">
            <div class="swiper-wrapper">
            
                @foreach ($photos as $photo)

                @if (empty($photo['image']))
                    @continue
                @endif

                @php($image = ($live) ? url($photo['image']) : url(array_pop($photo['image'])))

                <div 
                    class="swiper-slide 
                           bg-cover bg-center bg-no-repeat
                           aspect-248/139 w-[88.92%]! md:w-[78.61%]!
                           rounded-lg" 
                    style="background-image: url('{{ $image }}')"
                >
                </div>

                @endforeach
            </div>
            <div 
                class="absolute top-[50%] -left-[16px] -mt-[16px] z-10 w-[88.92%] md:w-[78.61%]"
            >
                <div 
                    class="swiper-button-next
                           absolute left-full
                           flex items-center justify-center
                           size-8.5 rounded-full
                           bg-primary hover:bg-primary-dark
                           text-white
                           transition-all ease-in-out duration-450ms"
                >
                    @include('svg.arrow-right')
                </div>
                <div 
                    class="swiper-button-prev 
                           absolute
                           flex items-center justify-center
                           size-8.5 rounded-full
                           bg-primary hover:bg-primary-dark
                           text-white
                           transition-all ease-in-out duration-450ms"
                >
                    @include('svg.arrow-right', ['rotate' => true])
                </div>
            </div>
        </div>

    </x-container>

</section>