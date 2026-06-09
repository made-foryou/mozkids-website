<span {{ $attributes->merge(['class' => 'footer-title
                                     inline-flex items-center gap-2
                                     mb-6
                                     text-[10px] md:text-[11px]
                                     font-semibold uppercase tracking-[0.22em]
                                     text-primary-500']) }}>
    <span class="inline-block w-1 h-1 rounded-full bg-primary-500 nav-pulse"
          aria-hidden="true"></span>
    <span>{{ $slot }}</span>
    <span class="ml-1 inline-block w-6 h-px
                 bg-gradient-to-r from-primary-500/40 to-transparent"
          aria-hidden="true"></span>
</span>
