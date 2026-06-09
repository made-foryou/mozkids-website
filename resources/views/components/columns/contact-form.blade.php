<div class="contact-form
            relative h-full
            bg-white/82 backdrop-blur-md
            rounded-2xl
            ring-1 ring-secondary-900/5
            shadow-[0_18px_44px_-22px_rgba(49,48,47,0.32)]
            px-6 py-7 md:px-8 md:py-9
            overflow-hidden">

    <span class="contact-form__glow
                 pointer-events-none absolute -top-24 -right-24
                 w-72 h-72
                 rounded-full
                 bg-primary-500/6 blur-3xl"
          aria-hidden="true"></span>

    <header class="contact-form__header relative mb-7"
            data-reveal="fade-up"
            style="--reveal-delay: 0ms">

        <span class="contact-form__eyebrow
                     inline-flex items-center gap-2
                     mb-3
                     text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.22em]
                     text-primary-500">
            <span class="inline-block w-1 h-1 rounded-full bg-primary-500 nav-pulse"
                  aria-hidden="true"></span>
            <span>Contact</span>
            <span class="ml-1 inline-block w-6 h-px
                         bg-gradient-to-r from-primary-500/40 to-transparent"
                  aria-hidden="true"></span>
        </span>

        <h2 class="contact-form__title
                   text-2xl md:text-3xl
                   text-secondary-900 font-semibold
                   tracking-[-0.018em] leading-[1.15] text-balance
                   mb-3">
            Stuur ons een bericht
        </h2>

        <p class="contact-form__intro
                  text-[13px] md:text-sm
                  text-secondary-900/70 leading-relaxed">
            Heb je een vraag of opmerking? Vul het formulier in en we nemen zo snel
            mogelijk contact met je op.
        </p>
    </header>

    <form data-made-form=""
          action="{{ route('api.contact-form') }}"
          method="POST"
          class="contact-form__form relative
                 flex flex-col gap-5"
          data-reveal="fade-up"
          style="--reveal-delay: 120ms">

        @csrf
        <x-honeypot />

        <div class="contact-form__field">
            <label for="name"
                   class="contact-form__label
                          block mb-1.5
                          text-[12px] md:text-[13px] font-medium
                          text-secondary-900">
                Naam
                <span class="contact-form__required text-primary-500" aria-hidden="true">*</span>
                <span class="sr-only">(verplicht)</span>
            </label>
            <input type="text"
                   name="name"
                   id="name"
                   required
                   autocomplete="name"
                   class="contact-form__input
                          block w-full
                          px-4 py-3 rounded-xl
                          bg-white
                          text-sm text-secondary-900
                          placeholder:text-secondary-900/35
                          ring-1 ring-secondary-900/12
                          transition-[box-shadow,background-color,ring-color] duration-200 ease-out
                          hover:ring-secondary-900/20
                          focus:outline-none focus:ring-2 focus:ring-primary-500/45
                          focus:bg-white
                          aria-[invalid=true]:ring-2 aria-[invalid=true]:ring-primary-500/60" />
            <p class="contact-form__error
                      hidden mt-1.5
                      text-[11px] font-medium text-primary-500"
               id="name-error"></p>
        </div>

        <div class="contact-form__field">
            <label for="email"
                   class="contact-form__label
                          block mb-1.5
                          text-[12px] md:text-[13px] font-medium
                          text-secondary-900">
                E-mailadres
                <span class="contact-form__required text-primary-500" aria-hidden="true">*</span>
                <span class="sr-only">(verplicht)</span>
            </label>
            <input type="email"
                   name="email"
                   id="email"
                   required
                   autocomplete="email"
                   class="contact-form__input
                          block w-full
                          px-4 py-3 rounded-xl
                          bg-white
                          text-sm text-secondary-900
                          placeholder:text-secondary-900/35
                          ring-1 ring-secondary-900/12
                          transition-[box-shadow,background-color,ring-color] duration-200 ease-out
                          hover:ring-secondary-900/20
                          focus:outline-none focus:ring-2 focus:ring-primary-500/45
                          focus:bg-white
                          aria-[invalid=true]:ring-2 aria-[invalid=true]:ring-primary-500/60" />
            <p class="contact-form__error
                      hidden mt-1.5
                      text-[11px] font-medium text-primary-500"
               id="email-error"></p>
        </div>

        <div class="contact-form__field-row
                    grid grid-cols-1 sm:grid-cols-2 gap-5">

            <div class="contact-form__field">
                <label for="phone"
                       class="contact-form__label
                              block mb-1.5
                              text-[12px] md:text-[13px] font-medium
                              text-secondary-900">
                    Telefoonnummer
                </label>
                <input type="tel"
                       name="phone"
                       id="phone"
                       autocomplete="tel"
                       class="contact-form__input
                              block w-full
                              px-4 py-3 rounded-xl
                              bg-white
                              text-sm text-secondary-900
                              placeholder:text-secondary-900/35
                              ring-1 ring-secondary-900/12
                              transition-[box-shadow,background-color,ring-color] duration-200 ease-out
                              hover:ring-secondary-900/20
                              focus:outline-none focus:ring-2 focus:ring-primary-500/45
                              focus:bg-white
                              aria-[invalid=true]:ring-2 aria-[invalid=true]:ring-primary-500/60" />
                <p class="contact-form__error
                          hidden mt-1.5
                          text-[11px] font-medium text-primary-500"
                   id="phone-error"></p>
            </div>

            <div class="contact-form__field">
                <label for="subject"
                       class="contact-form__label
                              block mb-1.5
                              text-[12px] md:text-[13px] font-medium
                              text-secondary-900">
                    Onderwerp
                </label>
                <input type="text"
                       name="subject"
                       id="subject"
                       class="contact-form__input
                              block w-full
                              px-4 py-3 rounded-xl
                              bg-white
                              text-sm text-secondary-900
                              placeholder:text-secondary-900/35
                              ring-1 ring-secondary-900/12
                              transition-[box-shadow,background-color,ring-color] duration-200 ease-out
                              hover:ring-secondary-900/20
                              focus:outline-none focus:ring-2 focus:ring-primary-500/45
                              focus:bg-white
                              aria-[invalid=true]:ring-2 aria-[invalid=true]:ring-primary-500/60" />
                <p class="contact-form__error
                          hidden mt-1.5
                          text-[11px] font-medium text-primary-500"
                   id="subject-error"></p>
            </div>
        </div>

        <div class="contact-form__field">
            <label for="message"
                   class="contact-form__label
                          block mb-1.5
                          text-[12px] md:text-[13px] font-medium
                          text-secondary-900">
                Bericht
                <span class="contact-form__required text-primary-500" aria-hidden="true">*</span>
                <span class="sr-only">(verplicht)</span>
            </label>
            <textarea name="message"
                      id="message"
                      rows="6"
                      required
                      class="contact-form__textarea
                             block w-full resize-y
                             px-4 py-3 rounded-xl
                             bg-white
                             text-sm text-secondary-900 leading-relaxed
                             placeholder:text-secondary-900/35
                             ring-1 ring-secondary-900/12
                             transition-[box-shadow,background-color,ring-color] duration-200 ease-out
                             hover:ring-secondary-900/20
                             focus:outline-none focus:ring-2 focus:ring-primary-500/45
                             focus:bg-white
                             aria-[invalid=true]:ring-2 aria-[invalid=true]:ring-primary-500/60"></textarea>
            <p class="contact-form__error
                      hidden mt-1.5
                      text-[11px] font-medium text-primary-500"
               id="message-error"></p>
        </div>

        <div class="contact-form__field contact-form__privacy
                    flex items-start gap-3
                    pt-1">

            <label for="privacy"
                   class="relative inline-flex items-center justify-center shrink-0
                          mt-0.5
                          cursor-pointer
                          group/check">
                <input id="privacy"
                       name="privacy"
                       type="checkbox"
                       required
                       aria-describedby="privacy-description"
                       class="peer sr-only" />

                <span class="contact-form__checkbox
                             inline-flex items-center justify-center
                             w-5 h-5 rounded-md
                             bg-white
                             ring-1 ring-secondary-900/15
                             transition-[background-color,box-shadow,ring-color] duration-200 ease-out
                             group-hover/check:ring-secondary-900/30
                             peer-checked:bg-primary-500 peer-checked:ring-primary-500
                             peer-focus-visible:ring-2 peer-focus-visible:ring-primary-500/60
                             peer-checked:[&_svg]:opacity-100 peer-checked:[&_svg]:scale-100">

                    <svg viewBox="0 0 14 14" fill="none"
                         class="w-3.5 h-3.5
                                opacity-0 scale-75
                                transition-[opacity,transform] duration-200 ease-out">
                        <path d="M3 7.5 6 10.5 11 4"
                              stroke="white"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round" />
                    </svg>
                </span>
            </label>

            <div class="text-[12px] md:text-[13px] leading-snug">
                <label for="privacy"
                       class="block font-medium text-secondary-900 cursor-pointer">
                    Privacyverklaring
                    <span class="text-primary-500" aria-hidden="true">*</span>
                    <span class="sr-only">(verplicht)</span>
                </label>
                <p id="privacy-description"
                   class="text-secondary-900/65 mt-0.5">
                    Ik ga akkoord met de privacyverklaring en verwerking van mijn persoonsgegevens.
                </p>
                <p class="contact-form__error
                          hidden mt-1
                          text-[11px] font-medium text-primary-500"
                   id="privacy-error"></p>
            </div>
        </div>

        <div class="contact-form__submit mt-3">
            <x-cta type="submit" class="w-full justify-center">
                Versturen
            </x-cta>
        </div>
    </form>
</div>
