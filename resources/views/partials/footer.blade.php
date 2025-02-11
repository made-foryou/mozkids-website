<div class="flex flex-col items-stretch space-y-15
            sm:flex-row sm:items-start sm:space-x-5.5">
    <div class="sm:w-1/3">
        <x-footer-title>
            Contactgegevens
        </x-footer-title>
        <span class="inline-block w-full text-primary text-xs lg:text-sm font-sans font-bold">
            Adres
        </span>
        <span class="inline-block w-full text-black text-xs/4 lg:text-sm/5.5 font-sans">
            Zevenhovenstraat 2<br />
            2971 AZ, Bleskensgraaf<br />
            Nederland
        </span>
        <div class="mt-7.5 space-y-2.5">
            <x-button :color="'secondary'">
                + 31(0) 6 27 82 35 95
            </x-button>
            <x-button>
                contact@mozkids.nl
            </x-button>
        </div>
    </div>

    <div class="sm:w-1/3">
        <x-footer-title>
            Blijf op de hoogte
        </x-footer-title>
        <div class="flex flex-col justify-start space-y-3.5">
            <a class="block flex items-center space-x-2" href="http://youtube.com" rel="nofollow" target="_blank">
                <x-round-button>
                    @include('svg.youtube')
                </x-round-button>
                <span class="inline-block text-xs lg:text-sm font-sans font-light">
                    Youtube
                </span>
            </a>
            <a class="block flex items-center space-x-2" href="http://facebook.com" rel="nofollow" target="_blank">
                <x-round-button>
                    @include('svg.facebook')
                </x-round-button>
                <span class="inline-block text-xs lg:text-sm font-sans font-light">
                    Facebook
                </span>
            </a>
            <a class="block flex items-center space-x-2" href="http://instagram.com" rel="nofollow" target="_blank">
                <x-round-button>
                    @include('svg.instagram')
                </x-round-button>
                <span class="inline-block text-xs lg:text-sm font-sans font-light">
                    Instagram
                </span>
            </a>
        </div>
    </div>

    <div class="sm:w-1/3">
        <x-footer-title>
            Financiële gegevens
        </x-footer-title>
        <div class="space-y-4">
            <div>
                <span class="inline-block w-full text-primary text-xs lg:text-sm font-sans font-bold">
                    Bankrekening
                </span>
                <span class="inline-block w-full text-black text-xs/4 lg:text-sm/5.5 font-sans">
                    NL60 RABO 0112968570
                </span>
            </div>
            <div>
                <span class="inline-block w-full text-primary text-xs lg:text-sm font-sans font-bold">
                    SIN/Fiscaal nummer
                </span>
                <span class="inline-block w-full text-black text-xs/4 lg:text-sm/5.5 font-sans">
                    822582466
                </span>
            </div>  
            <div>
                <span class="inline-block w-full text-primary text-[0.6rem] lg:text-xs font-sans font-light">
                    Giften aan Moz Kids zijn fiscaal aftrekbaar.
                </span>
            </div>
        </div>
        <div class="mt-7.5">
            @include('svg.anbi')
        </div>
    </div>
</div>
<div class="flex flex-row justify-between items-center 
            text-black text-[0.6rem] font-sans font-light
            sm:pt-6.5 sm:border-t sm:border-secondary sm:mt-10">
    <div>
        <a href="#">
            Privacy- en cookieverklaring
        </a>
    </div>
    <div>
        <a href="https://fourdesign.nl" rel="nofollow" target="_blank">
            Design Fourdesign
        </a>
        <a href="https://made-foryou.nl" rel="nofollow" target="_blank" class="hidden sm:inline-block">
            & ontwikkeling Made
        </a>
        &copy; Mozkids {{ now()->format('Y')}}
    </div>
</div>
