@php
    $currentUrl = rtrim(request()->url(), '/');
    $delayCounter = 0;
@endphp

<x-sidebar>
    <div class="sidebar-header
                flex shrink-0 items-center justify-between
                pt-8 pb-10">
        <a href="{{ url('/') }}"
           class="sidebar-logo block
                  transition-transform duration-300 ease-out
                  hover:-rotate-1
                  focus-visible:outline-2 focus-visible:outline-offset-4
                  focus-visible:outline-primary-500 focus-visible:rounded-sm"
           aria-label="Naar de homepagina van Moz Kids">
            @include('svg.logo')
        </a>

        <button
            type="button"
            class="sidebar-close group relative
                   inline-flex items-center justify-center
                   w-11 h-11 rounded-full
                   text-secondary-900
                   transition-colors duration-300
                   hover:bg-primary-500/10
                   focus-visible:outline-2 focus-visible:outline-offset-2
                   focus-visible:outline-primary-500"
            data-made-sidebar-closer
            aria-label="Sluit menu"
        >
            <svg class="w-5 h-5
                        transition-transform duration-300 ease-out
                        group-hover:rotate-90"
                 fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"
                 aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <p class="sidebar-eyebrow
              text-[10px] font-semibold uppercase tracking-[0.2em]
              text-secondary-800/55
              mb-4">
        Menu
    </p>

    <nav class="sidebar-nav flex flex-1 flex-col" aria-label="Mobiele hoofdnavigatie">
        <ul role="list" class="sidebar-list flex flex-1 flex-col gap-1">

            @foreach ($items as $item)
                @php
                    $itemUrl = rtrim(Cms::url($item->linkable), '/');
                    $hasChildren = $item->children->isNotEmpty();
                    $childActive = $hasChildren && $item->children->contains(function ($child) use ($currentUrl) {
                        $url = rtrim(Cms::url($child->linkable), '/');
                        return $url === $currentUrl
                            || ($url !== rtrim(url('/'), '/') && str_starts_with($currentUrl, $url . '/'));
                    });
                    $isActive = $itemUrl === $currentUrl
                        || ($itemUrl !== rtrim(url('/'), '/') && str_starts_with($currentUrl, $itemUrl . '/'))
                        || $childActive;
                    $delayCounter++;
                @endphp

                <li class="sidebar-item"
                    style="--sidebar-delay: {{ 80 + ($delayCounter * 55) }}ms">
                    <a href="{{ $itemUrl }}"
                       @if ($isActive) aria-current="page" @endif
                       class="sidebar-link group relative
                              flex items-center gap-4
                              -mx-2 px-4 py-3 rounded-2xl
                              text-[20px] tracking-tight font-medium
                              text-secondary-900
                              transition-all duration-300 ease-out
                              hover:bg-primary-500/8 hover:text-primary-500
                              hover:translate-x-1
                              focus-visible:outline-2 focus-visible:outline-offset-2
                              focus-visible:outline-primary-500
                              {{ $isActive ? 'is-active text-primary-500' : '' }}">

                        <span class="sidebar-link__bullet inline-flex items-center justify-center
                                     w-2 h-2 rounded-full
                                     bg-primary-500/20 transition-all duration-300
                                     group-hover:bg-primary-500
                                     {{ $isActive ? '!bg-primary-500 nav-pulse' : '' }}"
                              aria-hidden="true"></span>

                        <span class="sidebar-link__label flex-1">{{ $item->linkName }}</span>

                        <span class="sidebar-link__arrow inline-flex items-center
                                     text-primary-500/50
                                     -translate-x-2 opacity-0
                                     transition-all duration-300 ease-out
                                     group-hover:translate-x-0 group-hover:opacity-100
                                     {{ $isActive ? '!opacity-100 !translate-x-0 !text-primary-500' : '' }}"
                              aria-hidden="true">
                            @include('svg.arrow-right')
                        </span>
                    </a>

                    @if ($hasChildren)
                        <ul role="list"
                            class="sidebar-sublist relative
                                   ml-4 mt-1 mb-2 pl-5
                                   flex flex-col gap-0.5">
                            <span class="absolute left-0 top-2 bottom-2 w-px
                                         bg-gradient-to-b from-secondary-900/15 via-secondary-900/10 to-transparent"
                                  aria-hidden="true"></span>

                            @foreach ($item->children as $child)
                                @php
                                    $childUrl = rtrim(Cms::url($child->linkable), '/');
                                    $isChildActive = $childUrl === $currentUrl
                                        || ($childUrl !== rtrim(url('/'), '/') && str_starts_with($currentUrl, $childUrl . '/'));
                                    $delayCounter++;
                                @endphp

                                <li class="sidebar-item sidebar-subitem relative"
                                    style="--sidebar-delay: {{ 80 + ($delayCounter * 55) }}ms">
                                    <span class="absolute -left-5 top-1/2 w-3 h-px
                                                 bg-secondary-900/12"
                                          aria-hidden="true"></span>

                                    <a href="{{ $childUrl }}"
                                       @if ($isChildActive) aria-current="page" @endif
                                       class="sidebar-sublink group relative
                                              flex items-center gap-3
                                              px-3 py-2 rounded-xl
                                              text-[15px] tracking-[0.005em] font-medium
                                              text-secondary-900/75
                                              transition-all duration-300 ease-out
                                              hover:bg-primary-500/8 hover:text-primary-500
                                              hover:translate-x-1
                                              focus-visible:outline-2 focus-visible:outline-offset-2
                                              focus-visible:outline-primary-500
                                              {{ $isChildActive ? 'is-active text-primary-500' : '' }}">

                                        <span class="sidebar-sublink__marker inline-flex
                                                     w-1 h-1 rounded-full
                                                     bg-primary-500/30
                                                     transition-all duration-300
                                                     group-hover:bg-primary-500 group-hover:w-1.5 group-hover:h-1.5
                                                     {{ $isChildActive ? '!bg-primary-500 !w-1.5 !h-1.5' : '' }}"
                                              aria-hidden="true"></span>

                                        <span class="flex-1">{{ $child->linkName }}</span>

                                        <span class="sidebar-sublink__arrow inline-flex items-center
                                                     text-primary-500/55
                                                     -translate-x-1 opacity-0
                                                     transition-all duration-300 ease-out
                                                     group-hover:translate-x-0 group-hover:opacity-100
                                                     {{ $isChildActive ? '!opacity-100 !translate-x-0' : '' }}"
                                              aria-hidden="true">
                                            @include('svg.arrow-right')
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach

        </ul>

        @if (!empty($donationPage))
            <div class="sidebar-footer mt-8 pt-8 border-t border-secondary-900/8"
                 style="--sidebar-delay: {{ 80 + (($delayCounter + 1) * 55) }}ms">
                <a
                    href="{{ Cms::url($donationPage) }}"
                    class="sidebar-cta group relative
                           inline-flex items-center justify-center gap-3
                           w-full px-6 py-4 rounded-full
                           bg-primary-500 text-white
                           text-[13px] font-semibold uppercase tracking-[0.08em]
                           overflow-hidden
                           transition-[transform,box-shadow] duration-300 ease-out
                           hover:-translate-y-0.5
                           hover:shadow-[0_14px_30px_-8px_rgba(228,35,19,0.55)]"
                >
                    <span class="absolute inset-0
                                 bg-gradient-to-r from-transparent via-white/25 to-transparent
                                 -translate-x-full
                                 transition-transform duration-700 ease-out
                                 group-hover:translate-x-full"></span>

                    <span class="relative flex items-center justify-center w-4 h-4">
                        <svg viewBox="0 0 24 24" fill="currentColor"
                             class="w-4 h-4 donate-cta__beat">
                            <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                        </svg>
                    </span>

                    <span class="relative">Doneer direct</span>
                </a>
            </div>
        @endif
    </nav>
</x-sidebar>
