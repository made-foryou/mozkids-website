@php
    $live = $live ?? false;
@endphp

<section class="relative
                w-full
                py-12
                lg:py-18">

    <x-container class="max-w-7xl overflow-hidden md:overflow-visible" :full-screen-mobile="true">

        <!-- Swiper -->
        <div class="swiper made-photo-slider overflow-visible! md:overflow-hidden! mx-4! mx:mx-0! md:rounded-lg!">
            <div class="swiper-wrapper">
            
                @foreach ($photos as $photo)

                @if (empty($photo['image']))
                    @continue
                @endif

                @php($image = ($live) ? url($photo['image']) : url(array_pop($photo['image'])))

                <div 
                    class="swiper-slide 
                           bg-primary bg-cover bg-center bg-no-repeat 
                           aspect-248/139 w-[88.92%]! md:w-[78.61%]!
                           rounded-lg" 
                    style="background-image: url('{{ $image }}')"
                >
                    
                </div>

                @endforeach
            </div>
        </div>

    </x-container>

</section>