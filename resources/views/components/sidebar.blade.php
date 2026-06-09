<div
    class="made-sidebar
           relative z-50 hidden xl:hidden"
    role="dialog"
    aria-modal="true"
>

    <div
        class="fixed inset-0 hidden
               bg-secondary-900/55 opacity-0
               backdrop-blur-md
               transition-opacity ease-out duration-500"
        aria-hidden="true"
        data-backdrop
        data-made-sidebar-closer
    ></div>

    <div class="fixed inset-0 flex">

        <div
            class="relative
                   hidden flex-1
                   ml-auto w-full max-w-md
                   transition-transform ease-[cubic-bezier(0.22,1,0.36,1)] duration-500
                   translate-x-full"
            data-menu
        >

            <div
                class="absolute top-6 -left-16
                       hidden justify-center
                       opacity-0
                       transition-opacity ease-out duration-500"
                data-close-button
            ></div>

            <div
                class="sidebar-panel relative
                       flex grow flex-col gap-y-2
                       overflow-y-auto overflow-x-hidden
                       px-8 pb-10
                       bg-secondary-500
                       shadow-[-30px_0_60px_-20px_rgba(49,48,47,0.25)]"
            >
                <div class="pointer-events-none absolute -top-32 -right-32 w-72 h-72
                            rounded-full bg-primary-500/8 blur-3xl"
                     aria-hidden="true"></div>
                <div class="pointer-events-none absolute -bottom-40 -left-20 w-72 h-72
                            rounded-full bg-primary-500/5 blur-3xl"
                     aria-hidden="true"></div>

                <div class="relative">
                    {{ $slot }}
                </div>
            </div>

        </div>

    </div>

</div>
