<div 
    class="made-sidebar 
           relative z-50 hidden lg:hidden"
    role="dialog"
    arial-modal="true"
>

    <div 
        class="fixed inset-0 hidden
               bg-gray-900/80 opacity-0
               transition-opacity ease-linear duration-300" 
        aria-hidden="true"
        data-backdrop
    ></div>

    <div 
        class="fixed inset-0 flex"
    >

        <div 
            class="relative 
                   hidden flex-1
                   mr-16 w-full max-w-xs
                   transition ease-in-out duration-300 transform
                   -translate-x-full" 
            data-menu
        >

            <div 
                class="absolute top-0 left-full 
                       hidden justify-center
                       w-16 pt-5
                       opacity-0
                       ease-in-out duration-300" 
                data-close-button
            >

                <button 
                    type="button" 
                    class="-m-2.5 p-2.5" 
                    data-closer
                >
                    <span class="sr-only">Close sidebar</span>
                    <svg class="size-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>

            </div>

            <div 
                class="flex grow flex-col gap-y-6
                       overflow-y-auto
                       px-6 pb-4
                       bg-secondary"
            >
                {{ $slot }}
            </div>

        </div>

    </div>

</div>