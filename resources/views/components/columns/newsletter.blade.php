<div class="bg-transparent border border-white rounded-xl py-4 px-7 h-full">
    <span
        class="block
            mb-9 pb-3
            border-b border-white
            text-xs text-primary font-sans tracking-wide uppercase leading-8.5
            md:text-sm"
    >
        Nieuwsbrief
    </span>
    <div class="divide-y divide-secondary border-b border-secondary">
        <div class="pb-6">
            <span class="block text-base md:text-lg text-dark mb-3.5 font-sans tracking-wide">
                Wilt u op de hoogte blijven van onze laatste nieuws?
            </span>
            <span class="block text-xs md:text-sm text-dark leading-5.5 font-sans">
                Vul dan hieronder uw gegevens in en wij houden u op de hoogte van de laatste 
                nieuws en ontwikkelingen bij Stichting Moz Kids.
            </span>
        </div>
        <div>
            <form class="made-mailchimp-form" action="{{ route('api.subscribe-to-newsletter') }}" method="POST">

                <input name="firstname" type="text" placeholder="Voornaam" required  class="rounded-xl bg-white w-full px-5 py-4 text-base mb-4" />

                <input name="lastname" type="text" placeholder="Achternaam" required class="rounded-xl bg-white w-full px-5 py-4 text-base mb-4" />

                <input name="email" type="text" placeholder="E-mailadres" required class="rounded-xl bg-white w-full px-5 py-4 text-base mb-10" />

                <x-button type="submit">
                    Aanmelden
                </x-button>
            </form>
            <div class="made-mailchimp-success opacity-0 absolute transition-opacity ease-in-out duration-450 py-4">
                <h3 class="text-primary"><strong>Aanmelding verstuurd</strong></h3>
                <p class="mt-2">
                    Bedankt voor je aanmelding. Je ontvangt een bevestigingsmail waarin je je 
                    aanmelding kunt bevestigen. Zodra je dat hebt gedaan, wordt je op de 
                    hoogte gehouden van het laatste nieuws en ontwikkelingen rondom 
                    Moz Kids.
                </p>
                <p class="mt-4">
                    Een vriendelijke groet,
                    <br />
                    Het Moz Kids Team
                </p>
            </div>
        </div>
    </div>
</div>