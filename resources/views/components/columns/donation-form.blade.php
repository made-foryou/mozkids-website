@if (!empty($bankLink))
    <a href="{{ $bankLink }}"
       target="_blank"
       rel="noopener"
       class="donation-bank group/bank relative
              flex flex-col md:flex-row items-center justify-between gap-5
              w-full mb-6
              pl-5 pr-5 py-4 md:pl-6 md:pr-6 md:py-5
              border-b-0
              rounded-2xl
              bg-primary-500 text-white
              overflow-hidden
              shadow-[0_20px_44px_-22px_rgba(228,35,19,0.55)]
              transition-[transform,box-shadow] duration-500 ease-out
              hover:-translate-y-0.5
              hover:shadow-[0_28px_60px_-22px_rgba(228,35,19,0.7)]
              focus-visible:outline-2 focus-visible:outline-offset-4
              focus-visible:outline-primary-500"
       data-reveal="fade-up"
       style="--reveal-delay: 0ms">

        <span class="donation-bank__orb pointer-events-none absolute -top-20 -right-20
                     w-56 h-56 rounded-full bg-white/12 blur-3xl"
              aria-hidden="true"></span>

        <span class="donation-bank__sheen pointer-events-none absolute inset-0
                     bg-gradient-to-r from-transparent via-white/22 to-transparent
                     -translate-x-full
                     transition-transform duration-[1100ms] ease-out
                     group-hover/bank:translate-x-full"
              aria-hidden="true"></span>

        <span class="donation-bank__heart relative
                     inline-flex items-center justify-center
                     w-10 h-10 md:w-11 md:h-11 rounded-full
                     bg-white text-primary-500
                     shadow-[0_6px_16px_-6px_rgba(0,0,0,0.25)]
                     transition-transform duration-500 ease-out
                     group-hover/bank:scale-[1.06]"
              aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 donate-cta__beat">
                <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
            </svg>
        </span>

        <span class="donation-bank__copy relative
                     flex-1
                     text-center md:text-left
                     text-[15px] md:text-base lg:text-lg
                     font-semibold tracking-[-0.005em] leading-snug">
            Doneer direct via internetbankieren
        </span>

        <span class="donation-bank__arrow relative
                     inline-flex items-center justify-center
                     w-10 h-10 md:w-11 md:h-11 rounded-full
                     bg-white/10 ring-1 ring-white/30 text-white
                     transition-[transform,background-color,color] duration-300 ease-out
                     group-hover/bank:translate-x-1
                     group-hover/bank:bg-white
                     group-hover/bank:text-primary-500"
              aria-hidden="true">
            <x-svg.arrow-right class="w-4 h-4" />
        </span>
    </a>
@endif

<div class="donation-form
            relative
            bg-white/82 backdrop-blur-md
            rounded-2xl
            ring-1 ring-secondary-900/5
            shadow-[0_18px_44px_-22px_rgba(49,48,47,0.32)]
            px-6 py-7 md:px-9 md:py-10
            overflow-hidden"
     data-reveal="fade-up"
     style="--reveal-delay: 120ms">

    <span class="donation-form__glow
                 pointer-events-none absolute -top-32 -right-32
                 w-96 h-96 rounded-full
                 bg-primary-500/6 blur-3xl"
          aria-hidden="true"></span>

    <header class="donation-form__header relative mb-7">

        <span class="donation-form__eyebrow
                     inline-flex items-center gap-2
                     mb-3
                     text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.22em]
                     text-primary-500">
            <span class="inline-block w-1 h-1 rounded-full bg-primary-500 nav-pulse"
                  aria-hidden="true"></span>
            <span>Sponsoren</span>
            <span class="ml-1 inline-block w-6 h-px
                         bg-gradient-to-r from-primary-500/40 to-transparent"
                  aria-hidden="true"></span>
        </span>

        <h2 class="donation-form__title
                   text-2xl md:text-3xl
                   text-secondary-900 font-semibold
                   tracking-[-0.018em] leading-[1.15] text-balance">
            Ja, ik wil sponsoren
        </h2>
    </header>

    <form data-made-form=""
          action="{{ route('api.donate') }}"
          method="POST"
          class="donation-form__form relative
                 flex flex-col gap-9">

        @csrf

        {{-- ============================================================== --}}
        {{--  Sectie 01 — Sponsoring keuze                                  --}}
        {{-- ============================================================== --}}
        <section class="donation-section flex flex-col gap-6">

            <div class="donation-section__head">
                <span class="donation-section__eyebrow
                             inline-flex items-center gap-2
                             text-[10px] font-semibold uppercase tracking-[0.18em]
                             text-secondary-900/55">
                    <span class="tabular-nums text-primary-500">01</span>
                    <span class="opacity-40">/</span>
                    <span>Sponsoring</span>
                </span>
            </div>

            {{-- Sponsor type --}}
            <fieldset class="donation-field">
                <legend class="contact-form__label
                               block mb-1
                               text-[12px] md:text-[13px] font-medium
                               text-secondary-900">
                    Sponsoren
                    <span class="text-primary-500" aria-hidden="true">*</span>
                    <span class="sr-only">(verplicht)</span>
                </legend>
                <p class="text-[12px] text-secondary-900/60 mb-3">
                    Hoe zou je willen sponsoren?
                </p>

                <div class="donation-pills flex flex-wrap gap-2">
                    <label class="donation-pill cursor-pointer">
                        <input type="radio" name="type" id="child" value="child" required checked class="peer sr-only" />
                        <span class="donation-pill__face
                                     inline-flex items-center justify-center
                                     px-5 py-2.5 rounded-full
                                     text-[13px] font-semibold tracking-[0.02em]
                                     bg-white text-secondary-900
                                     ring-1 ring-secondary-900/12
                                     transition-[background-color,color,box-shadow,ring-color,transform] duration-300 ease-out
                                     hover:ring-secondary-900/25
                                     peer-checked:bg-primary-500 peer-checked:text-white peer-checked:ring-primary-500
                                     peer-checked:shadow-[0_10px_22px_-10px_rgba(228,35,19,0.55)]
                                     peer-focus-visible:ring-2 peer-focus-visible:ring-primary-500/50">
                            Een kind
                        </span>
                    </label>

                    <label class="donation-pill cursor-pointer">
                        <input type="radio" name="type" id="common" value="common" required class="peer sr-only" />
                        <span class="donation-pill__face
                                     inline-flex items-center justify-center
                                     px-5 py-2.5 rounded-full
                                     text-[13px] font-semibold tracking-[0.02em]
                                     bg-white text-secondary-900
                                     ring-1 ring-secondary-900/12
                                     transition-[background-color,color,box-shadow,ring-color,transform] duration-300 ease-out
                                     hover:ring-secondary-900/25
                                     peer-checked:bg-primary-500 peer-checked:text-white peer-checked:ring-primary-500
                                     peer-checked:shadow-[0_10px_22px_-10px_rgba(228,35,19,0.55)]
                                     peer-focus-visible:ring-2 peer-focus-visible:ring-primary-500/50">
                            Algemeen
                        </span>
                    </label>
                </div>
            </fieldset>

            {{-- Bedrag --}}
            <fieldset class="donation-field" data-button-radio="amount">
                <legend class="contact-form__label
                               block mb-1
                               text-[12px] md:text-[13px] font-medium
                               text-secondary-900">
                    Bedrag
                    <span class="text-primary-500" aria-hidden="true">*</span>
                    <span class="sr-only">(verplicht)</span>
                </legend>
                <p class="text-[12px] text-secondary-900/60 mb-3">
                    Welk bedrag zou je willen sponsoren?
                </p>

                <div class="donation-pills grid grid-cols-2 sm:grid-cols-4 gap-2">
                    @foreach (['20' => '€ 20,-', '40' => '€ 40,-', '60' => '€ 60,-', 'other' => 'Anders'] as $value => $label)
                        <label class="donation-pill cursor-pointer">
                            <input type="radio" name="amount" id="amount-{{ $value }}" value="{{ $value }}" required
                                   @if ($value === '20') checked @endif
                                   class="peer sr-only" />
                            <span class="donation-pill__face
                                         flex items-center justify-center
                                         w-full px-3 py-3 rounded-full
                                         text-[13px] font-semibold tracking-[0.02em] tabular-nums
                                         bg-white text-secondary-900
                                         ring-1 ring-secondary-900/12
                                         transition-[background-color,color,box-shadow,ring-color,transform] duration-300 ease-out
                                         hover:ring-secondary-900/25
                                         peer-checked:bg-primary-500 peer-checked:text-white peer-checked:ring-primary-500
                                         peer-checked:shadow-[0_10px_22px_-10px_rgba(228,35,19,0.55)]
                                         peer-focus-visible:ring-2 peer-focus-visible:ring-primary-500/50">
                                {{ $label }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </fieldset>

            {{-- Anders bedrag (toggled) --}}
            <div data-button-radio-other
                 class="donation-field
                        relative overflow-hidden
                        max-h-0 opacity-0 scale-y-0 origin-top
                        transition-[max-height,opacity,transform,margin] duration-300 ease-out"
                 aria-hidden="true">
                <label for="other-amount"
                       class="contact-form__label
                              block mb-1.5
                              text-[12px] md:text-[13px] font-medium
                              text-secondary-900">
                    Anders bedrag
                </label>
                <div class="flex items-center
                            bg-white rounded-xl
                            ring-1 ring-secondary-900/12
                            transition-[box-shadow,ring-color] duration-200
                            focus-within:ring-2 focus-within:ring-primary-500/45
                            px-4">
                    <span class="text-secondary-900/55 text-sm pr-2 tabular-nums">€</span>
                    <input type="text"
                           name="other-amount"
                           id="other-amount"
                           disabled
                           aria-describedby="other-amount-description"
                           class="block w-full py-3 bg-transparent
                                  text-sm text-secondary-900 tabular-nums
                                  placeholder:text-secondary-900/35
                                  focus:outline-none" />
                </div>
                <p class="mt-1.5 text-[11px] text-secondary-900/55" id="other-amount-description">
                    Vul het gewenste bedrag in, bijvoorbeeld <span class="tabular-nums">9,95</span>.
                </p>
                <p class="hidden mt-1 text-[11px] font-medium text-primary-500" id="other-amount-error"></p>
            </div>

            {{-- Frequentie --}}
            <fieldset class="donation-field">
                <legend class="contact-form__label
                               block mb-1
                               text-[12px] md:text-[13px] font-medium
                               text-secondary-900">
                    Frequentie
                    <span class="text-primary-500" aria-hidden="true">*</span>
                    <span class="sr-only">(verplicht)</span>
                </legend>
                <p class="text-[12px] text-secondary-900/60 mb-3">
                    Wat is de frequentie van je sponsoring?
                </p>

                <div class="donation-pills flex flex-wrap gap-2">
                    @foreach (['monthly' => 'Maandelijks', 'yearly' => 'Jaarlijks', 'single' => 'Eenmalig'] as $value => $label)
                        <label class="donation-pill cursor-pointer">
                            <input type="radio" name="frequency" id="freq-{{ $value }}" value="{{ $value }}" required
                                   @if ($value === 'monthly') checked @endif
                                   class="peer sr-only" />
                            <span class="donation-pill__face
                                         inline-flex items-center justify-center
                                         px-5 py-2.5 rounded-full
                                         text-[13px] font-semibold tracking-[0.02em]
                                         bg-white text-secondary-900
                                         ring-1 ring-secondary-900/12
                                         transition-[background-color,color,box-shadow,ring-color,transform] duration-300 ease-out
                                         hover:ring-secondary-900/25
                                         peer-checked:bg-primary-500 peer-checked:text-white peer-checked:ring-primary-500
                                         peer-checked:shadow-[0_10px_22px_-10px_rgba(228,35,19,0.55)]
                                         peer-focus-visible:ring-2 peer-focus-visible:ring-primary-500/50">
                                {{ $label }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </fieldset>
        </section>

        {{-- ============================================================== --}}
        {{--  Sectie 02 — Uw gegevens                                       --}}
        {{-- ============================================================== --}}
        <section class="donation-section flex flex-col gap-5
                        pt-8 border-t border-secondary-900/8">

            <div class="donation-section__head">
                <span class="donation-section__eyebrow
                             inline-flex items-center gap-2
                             mb-1.5
                             text-[10px] font-semibold uppercase tracking-[0.18em]
                             text-secondary-900/55">
                    <span class="tabular-nums text-primary-500">02</span>
                    <span class="opacity-40">/</span>
                    <span>Jouw gegevens</span>
                </span>
                <p class="text-[12px] text-secondary-900/60 leading-relaxed">
                    We gebruiken je gegevens alleen voor identificatie en communicatie rondom de sponsoring.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="donation-field">
                    <label for="firstname"
                           class="contact-form__label block mb-1.5
                                  text-[12px] md:text-[13px] font-medium text-secondary-900">
                        Voornaam
                        <span class="text-primary-500" aria-hidden="true">*</span>
                    </label>
                    <input type="text" name="firstname" id="firstname" required autocomplete="given-name"
                           class="contact-form__input block w-full
                                  px-4 py-3 rounded-xl
                                  bg-white text-sm text-secondary-900
                                  placeholder:text-secondary-900/35
                                  ring-1 ring-secondary-900/12
                                  transition-[box-shadow,ring-color] duration-200 ease-out
                                  hover:ring-secondary-900/20
                                  focus:outline-none focus:ring-2 focus:ring-primary-500/45
                                  aria-[invalid=true]:ring-2 aria-[invalid=true]:ring-primary-500/60" />
                    <p class="hidden mt-1.5 text-[11px] font-medium text-primary-500" id="firstname-error"></p>
                </div>

                <div class="donation-field">
                    <label for="infix"
                           class="contact-form__label block mb-1.5
                                  text-[12px] md:text-[13px] font-medium text-secondary-900">
                        Tussenvoegsel(s)
                    </label>
                    <input type="text" name="infix" id="infix" autocomplete="additional-name"
                           class="contact-form__input block w-full
                                  px-4 py-3 rounded-xl
                                  bg-white text-sm text-secondary-900
                                  placeholder:text-secondary-900/35
                                  ring-1 ring-secondary-900/12
                                  transition-[box-shadow,ring-color] duration-200 ease-out
                                  hover:ring-secondary-900/20
                                  focus:outline-none focus:ring-2 focus:ring-primary-500/45" />
                </div>
            </div>

            <div class="donation-field">
                <label for="surname"
                       class="contact-form__label block mb-1.5
                              text-[12px] md:text-[13px] font-medium text-secondary-900">
                    Achternaam
                    <span class="text-primary-500" aria-hidden="true">*</span>
                </label>
                <input type="text" name="surname" id="surname" required autocomplete="family-name"
                       class="contact-form__input block w-full
                              px-4 py-3 rounded-xl
                              bg-white text-sm text-secondary-900
                              placeholder:text-secondary-900/35
                              ring-1 ring-secondary-900/12
                              transition-[box-shadow,ring-color] duration-200 ease-out
                              hover:ring-secondary-900/20
                              focus:outline-none focus:ring-2 focus:ring-primary-500/45
                              aria-[invalid=true]:ring-2 aria-[invalid=true]:ring-primary-500/60" />
                <p class="hidden mt-1.5 text-[11px] font-medium text-primary-500" id="surname-error"></p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="donation-field">
                    <label for="email"
                           class="contact-form__label block mb-1.5
                                  text-[12px] md:text-[13px] font-medium text-secondary-900">
                        E-mailadres
                        <span class="text-primary-500" aria-hidden="true">*</span>
                    </label>
                    <input type="email" name="email" id="email" required autocomplete="email"
                           class="contact-form__input block w-full
                                  px-4 py-3 rounded-xl
                                  bg-white text-sm text-secondary-900
                                  placeholder:text-secondary-900/35
                                  ring-1 ring-secondary-900/12
                                  transition-[box-shadow,ring-color] duration-200 ease-out
                                  hover:ring-secondary-900/20
                                  focus:outline-none focus:ring-2 focus:ring-primary-500/45
                                  aria-[invalid=true]:ring-2 aria-[invalid=true]:ring-primary-500/60" />
                    <p class="hidden mt-1.5 text-[11px] font-medium text-primary-500" id="email-error"></p>
                </div>

                <div class="donation-field">
                    <label for="phone"
                           class="contact-form__label block mb-1.5
                                  text-[12px] md:text-[13px] font-medium text-secondary-900">
                        Telefoonnummer
                        <span class="text-primary-500" aria-hidden="true">*</span>
                    </label>
                    <input type="tel" name="phone" id="phone" required autocomplete="tel"
                           class="contact-form__input block w-full
                                  px-4 py-3 rounded-xl
                                  bg-white text-sm text-secondary-900
                                  placeholder:text-secondary-900/35
                                  ring-1 ring-secondary-900/12
                                  transition-[box-shadow,ring-color] duration-200 ease-out
                                  hover:ring-secondary-900/20
                                  focus:outline-none focus:ring-2 focus:ring-primary-500/45
                                  aria-[invalid=true]:ring-2 aria-[invalid=true]:ring-primary-500/60" />
                    <p class="mt-1.5 text-[11px] text-secondary-900/55" id="phone-description">
                        Wordt alleen gebruikt voor belangrijke communicatie rondom de sponsoring.
                    </p>
                    <p class="hidden mt-1 text-[11px] font-medium text-primary-500" id="phone-error"></p>
                </div>
            </div>

            <div class="donation-field">
                <label for="comments"
                       class="contact-form__label block mb-1.5
                              text-[12px] md:text-[13px] font-medium text-secondary-900">
                    Opmerking(en)
                </label>
                <textarea name="comments" id="comments" rows="5"
                          class="contact-form__textarea block w-full resize-y
                                 px-4 py-3 rounded-xl
                                 bg-white text-sm text-secondary-900 leading-relaxed
                                 placeholder:text-secondary-900/35
                                 ring-1 ring-secondary-900/12
                                 transition-[box-shadow,ring-color] duration-200 ease-out
                                 hover:ring-secondary-900/20
                                 focus:outline-none focus:ring-2 focus:ring-primary-500/45"></textarea>
                <p class="hidden mt-1.5 text-[11px] font-medium text-primary-500" id="comments-error"></p>
            </div>
        </section>

        {{-- ============================================================== --}}
        {{--  Sectie 03 — Financiële gegevens                               --}}
        {{-- ============================================================== --}}
        <section class="donation-section flex flex-col gap-5
                        pt-8 border-t border-secondary-900/8">

            <div class="donation-section__head">
                <span class="donation-section__eyebrow
                             inline-flex items-center gap-2
                             mb-1.5
                             text-[10px] font-semibold uppercase tracking-[0.18em]
                             text-secondary-900/55">
                    <span class="tabular-nums text-primary-500">03</span>
                    <span class="opacity-40">/</span>
                    <span>Financiële gegevens</span>
                </span>
                <p class="text-[12px] text-secondary-900/60 leading-relaxed">
                    Deze gegevens worden gebruikt om de incasso of donatie op te zetten en gaan alleen naar info@mozkids.nl.
                </p>
            </div>

            <div class="donation-field">
                <label for="account-holder"
                       class="contact-form__label block mb-1.5
                              text-[12px] md:text-[13px] font-medium text-secondary-900">
                    Naam rekeninghouder
                    <span class="text-primary-500" aria-hidden="true">*</span>
                </label>
                <input type="text" name="account-holder" id="account-holder" required autocomplete="name"
                       class="contact-form__input block w-full
                              px-4 py-3 rounded-xl
                              bg-white text-sm text-secondary-900
                              placeholder:text-secondary-900/35
                              ring-1 ring-secondary-900/12
                              transition-[box-shadow,ring-color] duration-200 ease-out
                              hover:ring-secondary-900/20
                              focus:outline-none focus:ring-2 focus:ring-primary-500/45
                              aria-[invalid=true]:ring-2 aria-[invalid=true]:ring-primary-500/60" />
                <p class="mt-1.5 text-[11px] text-secondary-900/55" id="account-holder-description">
                    De naam van de rekeninghouder van de onderstaande bankrekening.
                </p>
                <p class="hidden mt-1 text-[11px] font-medium text-primary-500" id="account-holder-error"></p>
            </div>

            <div class="donation-field">
                <label for="iban"
                       class="contact-form__label block mb-1.5
                              text-[12px] md:text-[13px] font-medium text-secondary-900">
                    IBAN
                    <span class="text-primary-500" aria-hidden="true">*</span>
                </label>
                <input type="text" name="iban" id="iban" required autocomplete="off"
                       inputmode="text"
                       class="contact-form__input block w-full
                              px-4 py-3 rounded-xl
                              bg-white text-sm text-secondary-900 tabular-nums tracking-wide
                              placeholder:text-secondary-900/35
                              ring-1 ring-secondary-900/12
                              transition-[box-shadow,ring-color] duration-200 ease-out
                              hover:ring-secondary-900/20
                              focus:outline-none focus:ring-2 focus:ring-primary-500/45
                              aria-[invalid=true]:ring-2 aria-[invalid=true]:ring-primary-500/60" />
                <p class="mt-1.5 text-[11px] text-secondary-900/55" id="iban-description">
                    Het <a href="https://nl.wikipedia.org/wiki/International_Bank_Account_Number"
                           target="_blank" rel="noopener"
                           class="text-primary-500 underline underline-offset-2 hover:text-primary-700">IBAN</a>
                    van waar de donatie afgehaald kan worden.
                </p>
                <p class="hidden mt-1 text-[11px] font-medium text-primary-500" id="iban-error"></p>
            </div>
        </section>

        {{-- ============================================================== --}}
        {{--  Sectie 04 — Akkoord & submit                                  --}}
        {{-- ============================================================== --}}
        <section class="donation-section flex flex-col gap-5
                        pt-8 border-t border-secondary-900/8">

            <div class="donation-section__head">
                <span class="donation-section__eyebrow
                             inline-flex items-center gap-2
                             text-[10px] font-semibold uppercase tracking-[0.18em]
                             text-secondary-900/55">
                    <span class="tabular-nums text-primary-500">04</span>
                    <span class="opacity-40">/</span>
                    <span>Akkoord</span>
                </span>
            </div>

            {{-- Newsletter checkbox --}}
            <div class="donation-checkbox flex items-start gap-3">
                <label for="newsletter"
                       class="relative inline-flex items-center justify-center shrink-0 mt-0.5
                              cursor-pointer group/check">
                    <input id="newsletter" name="newsletter" type="checkbox" class="peer sr-only" />
                    <span class="inline-flex items-center justify-center
                                 w-5 h-5 rounded-md
                                 bg-white ring-1 ring-secondary-900/15
                                 transition-[background-color,box-shadow,ring-color] duration-200 ease-out
                                 group-hover/check:ring-secondary-900/30
                                 peer-checked:bg-primary-500 peer-checked:ring-primary-500
                                 peer-focus-visible:ring-2 peer-focus-visible:ring-primary-500/60
                                 peer-checked:[&_svg]:opacity-100 peer-checked:[&_svg]:scale-100">
                        <svg viewBox="0 0 14 14" fill="none"
                             class="w-3.5 h-3.5 opacity-0 scale-75
                                    transition-[opacity,transform] duration-200 ease-out">
                            <path d="M3 7.5 6 10.5 11 4"
                                  stroke="white" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </label>

                <div class="text-[12px] md:text-[13px] leading-snug">
                    <label for="newsletter" class="block font-medium text-secondary-900 cursor-pointer">
                        Nieuwsbrief
                    </label>
                    <p id="newsletter-description" class="text-secondary-900/65 mt-0.5">
                        Ja, ik wil de maandelijkse nieuwsbrief van Moz Kids ontvangen om op de hoogte te blijven.
                    </p>
                </div>
            </div>

            {{-- Privacy checkbox --}}
            <div class="donation-checkbox flex items-start gap-3">
                <label for="privacy"
                       class="relative inline-flex items-center justify-center shrink-0 mt-0.5
                              cursor-pointer group/check">
                    <input id="privacy" name="privacy" type="checkbox" required
                           aria-describedby="privacy-description"
                           class="peer sr-only" />
                    <span class="inline-flex items-center justify-center
                                 w-5 h-5 rounded-md
                                 bg-white ring-1 ring-secondary-900/15
                                 transition-[background-color,box-shadow,ring-color] duration-200 ease-out
                                 group-hover/check:ring-secondary-900/30
                                 peer-checked:bg-primary-500 peer-checked:ring-primary-500
                                 peer-focus-visible:ring-2 peer-focus-visible:ring-primary-500/60
                                 peer-checked:[&_svg]:opacity-100 peer-checked:[&_svg]:scale-100">
                        <svg viewBox="0 0 14 14" fill="none"
                             class="w-3.5 h-3.5 opacity-0 scale-75
                                    transition-[opacity,transform] duration-200 ease-out">
                            <path d="M3 7.5 6 10.5 11 4"
                                  stroke="white" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </label>

                <div class="text-[12px] md:text-[13px] leading-snug">
                    <label for="privacy" class="block font-medium text-secondary-900 cursor-pointer">
                        Privacyverklaring
                        <span class="text-primary-500" aria-hidden="true">*</span>
                        <span class="sr-only">(verplicht)</span>
                    </label>
                    <p id="privacy-description" class="text-secondary-900/65 mt-0.5">
                        Ik ga akkoord met de privacyverklaring en verwerking van mijn persoonsgegevens.
                    </p>
                    <p class="hidden mt-1 text-[11px] font-medium text-primary-500" id="privacy-error"></p>
                </div>
            </div>

            <p class="text-[11px] text-primary-500 font-light italic">
                Giften aan Moz Kids zijn fiscaal aftrekbaar.
            </p>

            <div class="donation-form__submit mt-2">
                <x-cta type="submit" class="w-full justify-center">
                    Doneren
                </x-cta>
            </div>
        </section>
    </form>
</div>
