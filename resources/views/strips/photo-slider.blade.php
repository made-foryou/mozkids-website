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

                @php($image = ($live) ? asset("storage/{$photo['image']}") : asset('storage/' . array_pop($photo['image'])))

                <div 
                    class="swiper-slide 
                           relative
                           bg-cover bg-center bg-no-repeat
                           aspect-248/139 w-[88.92%]! md:w-[78.61%]!
                           rounded-lg" 
                    style="background-image: url('{{ $image }}')"
                >

                @if (!empty($photo['title']) && !empty($photo['description']))

                    <div 
                        class="swiper-slide-overlay 
                               absolute hidden md:block
                               top-2.5 left-2.5
                               rounded-lg drop-shadow opacity-0
                               w-1/3 p-7.5
                               bg-white
                               transition-opacity ease-in-out duration-450"
                    >
                        <span 
                            class="inline-block mb-3
                                   text-black text-base font-normal font-sans tracking-wide "
                        >
                            {{ $photo['title'] }}
                        </span>
                        <p 
                            class="text-black text-sm font-sans font-light"
                        >
                            {!! nl2br($photo['description']) !!}
                        </p>
                    </div>

                @endif

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