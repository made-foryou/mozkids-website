<div class="info-card info-card--accent group relative
            h-full flex flex-col
            overflow-hidden
            bg-primary-500 text-white
            rounded-2xl
            shadow-[0_24px_50px_-24px_rgba(228,35,19,0.55)]
            px-7 py-7 lg:px-8 lg:py-8
            transition-[transform,box-shadow] duration-500 ease-out
            hover:-translate-y-1
            hover:shadow-[0_32px_64px_-26px_rgba(228,35,19,0.7)]">

    <span class="info-card__glow
                 pointer-events-none absolute -top-24 -right-16
                 w-64 h-64
                 rounded-full
                 bg-white/12 blur-3xl"
          aria-hidden="true"></span>

    <span class="info-card__eyebrow
                 relative
                 inline-flex items-center gap-2
                 mb-7
                 text-[10px] md:text-[11px] font-semibold uppercase tracking-[0.22em]
                 text-white">
        <span class="inline-block w-1 h-1 rounded-full bg-white nav-pulse"
              aria-hidden="true"></span>
        <span>Nieuwsbrief</span>
        <span class="ml-1 inline-block w-6 h-px
                     bg-gradient-to-r from-white/50 to-transparent"
              aria-hidden="true"></span>
    </span>

    <div class="info-card__intro relative
                flex-1
                border-t border-white/15 pt-6
                pb-6 mb-6
                border-b border-white/15">
        <span class="block mb-3
                     text-lg md:text-xl
                     font-semibold tracking-[-0.01em] leading-snug">
            Blijf op de hoogte.
        </span>
        <p class="text-[13px] md:text-sm
                  text-white/85 leading-relaxed">
            Vul je gegevens in en wij houden je op de hoogte van het laatste nieuws en de
            ontwikkelingen bij Stichting Moz Kids.
        </p>
    </div>

    <div class="relative">
        <form class="made-mailchimp-form flex flex-col gap-3"
              action="{{ route('api.subscribe-to-newsletter') }}"
              method="POST">

            <input name="firstname"
                   type="text"
                   placeholder="Voornaam"
                   required
                   class="newsletter-input
                          w-full px-4 py-3 rounded-xl
                          bg-white/12 backdrop-blur-sm
                          text-white placeholder:text-white/55
                          ring-1 ring-white/15
                          transition-[background-color,box-shadow] duration-200
                          focus:bg-white/18 focus:outline-none focus:ring-2 focus:ring-white/40" />

            <input name="lastname"
                   type="text"
                   placeholder="Achternaam"
                   required
                   class="newsletter-input
                          w-full px-4 py-3 rounded-xl
                          bg-white/12 backdrop-blur-sm
                          text-white placeholder:text-white/55
                          ring-1 ring-white/15
                          transition-[background-color,box-shadow] duration-200
                          focus:bg-white/18 focus:outline-none focus:ring-2 focus:ring-white/40" />

            <input name="email"
                   type="email"
                   placeholder="E-mailadres"
                   required
                   class="newsletter-input
                          w-full px-4 py-3 rounded-xl
                          bg-white/12 backdrop-blur-sm
                          text-white placeholder:text-white/55
                          ring-1 ring-white/15
                          transition-[background-color,box-shadow] duration-200
                          focus:bg-white/18 focus:outline-none focus:ring-2 focus:ring-white/40" />

            <button type="submit"
                    class="newsletter-submit group/btn relative
                           mt-3
                           inline-flex items-center justify-center gap-2.5
                           px-5 py-3 rounded-full
                           bg-white text-primary-500
                           text-[12px] font-semibold tracking-[0.08em] uppercase
                           overflow-hidden
                           transition-[transform,box-shadow] duration-300 ease-out
                           hover:-translate-y-0.5
                           hover:shadow-[0_14px_30px_-8px_rgba(0,0,0,0.35)]
                           focus-visible:outline-2 focus-visible:outline-offset-2
                           focus-visible:outline-white">
                <span class="absolute inset-0
                             bg-gradient-to-r from-transparent via-primary-500/15 to-transparent
                             -translate-x-full
                             transition-transform duration-700 ease-out
                             group-hover/btn:translate-x-full"></span>
                <span class="relative">Aanmelden</span>
                <span class="relative inline-flex
                             transition-transform duration-300 ease-out
                             group-hover/btn:translate-x-1"
                      aria-hidden="true">
                    @include('svg.arrow-right')
                </span>
            </button>
        </form>

        <div class="made-mailchimp-success opacity-0 pointer-events-none absolute transition-opacity ease-in-out duration-450 py-4">
            <h3 class="text-white font-semibold mb-2">Aanmelding verstuurd</h3>
            <p class="text-white/85 text-sm leading-relaxed">
                Bedankt voor je aanmelding. Je ontvangt een bevestigingsmail waarin je je
                aanmelding kunt bevestigen. Zodra je dat hebt gedaan, houden we je op de
                hoogte van het laatste nieuws en ontwikkelingen rondom Moz Kids.
            </p>
            <p class="text-white/85 text-sm mt-4">
                Een vriendelijke groet,<br />
                Het Moz Kids Team
            </p>
        </div>
    </div>
</div>
