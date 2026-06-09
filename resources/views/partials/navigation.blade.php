@php
    $currentUrl = rtrim(request()->url(), '/');
@endphp

<div class="nav-shell flex flex-row justify-between items-center w-full gap-6 xl:gap-10">

    <a
        href="{{ url('/') }}"
        class="nav-logo group relative block
               transition-transform ease-out duration-300
               hover:-rotate-1
               focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-primary-500
               focus-visible:rounded-sm"
        aria-label="Naar de homepagina van Moz Kids"
    >
        <span class="absolute -inset-3 rounded-2xl bg-primary-500/0 group-hover:bg-primary-500/5
                     transition-colors duration-300 -z-10"></span>
        @include('svg.logo')
    </a>

    <nav class="hidden xl:block" aria-label="Hoofdnavigatie">
        <ul class="nav-list flex flex-row items-center gap-1">

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
                @endphp

                <li class="nav-item relative"
                    style="--nav-delay: {{ $loop->index * 60 }}ms"
                    @if ($hasChildren) data-has-children @endif
                >
                    <a
                        href="{{ $itemUrl }}"
                        title="{{ $item->linkable->meta->title }}"
                        @if ($isActive) aria-current="page" @endif
                        @if ($hasChildren) aria-haspopup="true" aria-expanded="false" @endif
                        class="nav-link group relative inline-flex items-center gap-2
                               px-4 py-3 rounded-full
                               text-[13px] uppercase tracking-[0.14em] font-semibold
                               text-secondary-900/85
                               transition-colors duration-300 ease-out
                               hover:text-primary-500
                               focus-visible:outline-2 focus-visible:outline-offset-2
                               focus-visible:outline-primary-500
                               {{ $isActive ? 'is-active text-primary-500' : '' }}"
                    >
                        <span class="nav-link__bg absolute inset-0 rounded-full
                                     bg-primary-500/0 scale-90 opacity-0
                                     transition-all duration-300 ease-out
                                     group-hover:bg-primary-500/8 group-hover:scale-100 group-hover:opacity-100"></span>

                        <span class="nav-link__label relative z-10">{{ $item->linkName }}</span>

                        @if ($hasChildren)
                            <span class="nav-link__chevron relative z-10 inline-flex
                                         transition-transform duration-300 ease-out"
                                  aria-hidden="true">
                                <svg viewBox="0 0 12 12" class="w-2 h-2 fill-none stroke-current"
                                     stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 4.5 6 7.5 9 4.5" />
                                </svg>
                            </span>
                        @endif

                        <span class="nav-link__underline absolute left-4 right-4 bottom-1.5
                                     h-px origin-left scale-x-0
                                     bg-current
                                     transition-transform duration-300 ease-out
                                     group-hover:scale-x-100"></span>

                        @if ($isActive)
                            <span class="nav-link__dot absolute left-1/2 -bottom-1 -translate-x-1/2
                                         w-1 h-1 rounded-full bg-primary-500
                                         nav-pulse"
                                  aria-hidden="true"></span>
                        @endif
                    </a>

                    @if ($hasChildren)
                        <div class="submenu absolute left-1/2 top-full pt-4
                                    min-w-[260px]
                                    opacity-0 pointer-events-none
                                    transition-[opacity,translate] duration-300 ease-out
                                    z-40"
                             role="region"
                             aria-label="Submenu van {{ $item->linkName }}">

                            <div class="submenu__panel relative
                                        rounded-2xl
                                        bg-secondary-500/92 backdrop-blur-xl
                                        ring-1 ring-secondary-900/8
                                        shadow-[0_24px_60px_-24px_rgba(49,48,47,0.35)]
                                        p-2">

                                <span class="submenu__tail absolute left-1/2 -top-1.5 -translate-x-1/2
                                             w-3 h-3 rotate-45
                                             bg-secondary-500/92
                                             ring-1 ring-secondary-900/8
                                             rounded-[3px]"
                                      aria-hidden="true"></span>

                                <p class="submenu__eyebrow
                                          px-3 pt-1.5 pb-1
                                          text-[9px] font-semibold uppercase tracking-[0.22em]
                                          text-secondary-800/60">
                                    {{ $item->linkName }}
                                </p>

                                <ul class="relative flex flex-col gap-px" role="menu">
                                    @foreach ($item->children as $child)
                                        @php
                                            $childUrl = rtrim(Cms::url($child->linkable), '/');
                                            $isChildActive = $childUrl === $currentUrl
                                                || ($childUrl !== rtrim(url('/'), '/') && str_starts_with($currentUrl, $childUrl . '/'));
                                        @endphp

                                        <li role="none"
                                            class="submenu-item"
                                            style="--submenu-delay: {{ 80 + ($loop->index * 50) }}ms">
                                            <a
                                                href="{{ $childUrl }}"
                                                role="menuitem"
                                                @if ($isChildActive) aria-current="page" @endif
                                                class="submenu-link group/sub relative
                                                       flex items-center gap-3
                                                       px-3 py-2.5 rounded-xl
                                                       text-[13px] font-medium tracking-[0.01em]
                                                       text-secondary-900/85
                                                       transition-colors duration-200 ease-out
                                                       hover:bg-primary-500/8 hover:text-primary-500
                                                       focus-visible:outline-2 focus-visible:outline-offset-1
                                                       focus-visible:outline-primary-500
                                                       {{ $isChildActive ? 'is-active text-primary-500 bg-primary-500/6' : '' }}"
                                            >
                                                <span class="submenu-link__marker
                                                             inline-flex items-center justify-center
                                                             w-1 h-1 rounded-full bg-primary-500/30
                                                             transition-all duration-300 ease-out
                                                             group-hover/sub:bg-primary-500 group-hover/sub:w-1.5 group-hover/sub:h-1.5
                                                             {{ $isChildActive ? '!bg-primary-500 !w-1.5 !h-1.5' : '' }}"
                                                      aria-hidden="true"></span>

                                                <span class="flex-1">{{ $child->linkName }}</span>

                                                <span class="submenu-link__arrow inline-flex items-center
                                                             text-primary-500/55
                                                             -translate-x-1 opacity-0
                                                             transition-all duration-300 ease-out
                                                             group-hover/sub:translate-x-0 group-hover/sub:opacity-100"
                                                      aria-hidden="true">
                                                    @include('svg.arrow-right')
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </li>
            @endforeach

        </ul>
    </nav>

    <div class="hidden xl:block">
        @if (!empty($donationPage))
            <a
                href="{{ Cms::url($donationPage) }}"
                class="donate-cta group relative inline-flex items-center gap-2.5
                       pl-5 pr-6 py-3 rounded-full
                       bg-primary-500 text-white
                       text-[12px] font-semibold tracking-[0.08em] uppercase
                       overflow-hidden
                       transition-[transform,box-shadow] duration-300 ease-out
                       hover:-translate-y-0.5
                       hover:shadow-[0_12px_28px_-8px_rgba(228,35,19,0.55)]
                       focus-visible:outline-2 focus-visible:outline-offset-2
                       focus-visible:outline-primary-500"
            >
                <span class="donate-cta__sheen absolute inset-0
                             bg-gradient-to-r from-transparent via-white/25 to-transparent
                             -translate-x-full
                             transition-transform duration-700 ease-out
                             group-hover:translate-x-full"></span>

                <span class="donate-cta__heart relative flex items-center justify-center
                             w-4 h-4 text-white"
                      aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="currentColor"
                         class="w-4 h-4 donate-cta__beat">
                        <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                    </svg>
                </span>

                <span class="relative">Doneer direct</span>

                <span class="donate-cta__arrow relative inline-flex translate-x-0
                             transition-transform duration-300 ease-out
                             group-hover:translate-x-1"
                      aria-hidden="true">
                    @include('svg.arrow-right')
                </span>
            </a>
        @endif
    </div>


    <div class="block xl:hidden">
        <button
            type="button"
            class="burger group relative
                   inline-flex items-center justify-center
                   w-11 h-11 rounded-full
                   text-secondary-900
                   transition-colors duration-300
                   hover:bg-primary-500/8
                   focus-visible:outline-2 focus-visible:outline-offset-2
                   focus-visible:outline-primary-500"
            data-made-sidebar-opener
            aria-label="Open menu"
        >
            <span class="burger__bars relative block w-5 h-4" aria-hidden="true">
                <span class="burger__bar burger__bar--1 absolute left-0 right-0 top-0
                             h-[2px] rounded-full bg-current
                             transition-all duration-300 ease-out
                             group-hover:w-3.5"></span>
                <span class="burger__bar burger__bar--2 absolute left-0 right-0 top-1/2 -translate-y-1/2
                             h-[2px] rounded-full bg-current
                             transition-all duration-300 ease-out
                             group-hover:w-5"></span>
                <span class="burger__bar burger__bar--3 absolute left-0 right-0 bottom-0
                             h-[2px] rounded-full bg-current
                             transition-all duration-300 ease-out
                             group-hover:w-2.5"></span>
            </span>
        </button>
    </div>
</div>
