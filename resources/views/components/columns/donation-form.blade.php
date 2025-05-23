@if (!empty($bankLink))
<a
    href="{{ $bankLink }}"
    target="_blank"
    class="flex flex-col items-center justify-between gap-5 lg:flex-row
            relative w-full py-4 px-5 md:py-8 md:px-10
            bg-primary-500 rounded-lg
            group
            cursor-pointer
            transition duration-245 ease-in-out
            hover:bg-primary-700
            focus:scale-98
            focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-500"
>
    <span
        class="inline-block
                font-sans text-white text-lg tracking-wide
                md:text-xl lg:text-2xl">
        Doneer direct via internetbankieren
    </span>
    <div
        class="inline-flex items-center flex-shrink-0
               bg-white cursor-pointer rounded-full shadow-xs text-primary-500
               space-x-4 py-2 pl-6 pr-7 lg:py-3
               transition duration-245 ease-in-out
               group-hover:bg-primary-500 group-hover:text-white
               focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary-500"
    >
        <span
            class="block
                text-primary-500 text-xs lg:text-sm font-sans tracking-wide font-semibold
                group-hover:text-white"
        >
            Doneer direct
        </span>
        <x-svg.arrow-right class="size-5 text-primary-500 group-hover:text-white" />
    </div>
</a>
@endif

<div class="mt-5 w-full bg-white rounded-lg px-11 py-10">
    <span class="text-black text-xl md:text-2xl font-sans tracking-wide font-semibold">
        Ja, ik wil sponsoren
    </span>
    <form
      data-made-form=""
      class="flex flex-col divide-secondary-500 divide-y-1"
      action="{{ route('api.donate') }}"
      method="POST"
    >

      @csrf

      <div class="flex flex-col gap-8 py-8">
        <fieldset class="block">
            <legend class="text-sm/6 font-semibold text-gray-900">Sponsoren <span class="text-primary-400">*</span></legend>
            <p class="mt-1 text-sm/6 text-gray-600">Hoe zou je willen sponsoren?</p>
            <div class="mt-6 space-y-6 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
              <div class="flex items-center">
                <input
                  id="child"
                  required
                  name="type"
                  type="radio"
                  checked
                  value="child"
                  class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-primary-500 checked:bg-primary-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-500 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden"
                >
                <label for="child" class="ml-3 block text-sm/6 font-medium text-gray-900">Een kind</label>
              </div>
              <div class="flex items-center">
                <input
                  id="common"
                  value="common"
                  required
                  name="type"
                  type="radio"
                  class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-primary-500 checked:bg-primary-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-500 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden"
                >
                <label for="common" class="ml-3 block text-sm/6 font-medium text-gray-900">Algemeen</label>
              </div>
            </div>
          </fieldset>

          <div>
            <fieldset
              class="block"
              aria-label="Welk bedrag zou je willen sponsoren?"
              data-button-radio="amount"
            >
              <div class="text-sm/6 font-medium text-gray-900">Bedrag <span class="text-primary-400">*</span></div>
              <p class="mt-1 text-sm/6 text-gray-600">Welk bedrag zou je willen sponsoren?</p>

              <div class="mt-2 flex justify-start items-center flex-wrap gap-3">

                <label
                  class="flex cursor-pointer items-center justify-center
                        rounded-full px-3 py-3
                        text-sm font-semibold uppercase
                        focus:outline-hidden
                        ring-0 bg-primary-500 text-white
                        transition duration-200 ease-in-out
                        sm:flex-1"
                  for="20"
                >
                  <input type="radio" required checked name="amount" id="20" value="20" class="sr-only">
                  <span>€ 20,-</span>
                </label>

                <label
                  class="flex cursor-pointer items-center justify-center
                        rounded-full px-3 py-3
                        text-sm font-semibold uppercase
                        focus:outline-hidden
                        ring-1 ring-secondary-500 bg-secondary-200 text-gray-900
                        transition duration-200 ease-in-out
                        hover:bg-secondary-400
                        sm:flex-1"
                  for="40"
                >
                  <input type="radio" required name="amount" id="40" value="40" class="sr-only">
                  <span>€ 40,-</span>
                </label>

                <label
                  class="flex cursor-pointer items-center justify-center
                        rounded-full px-3 py-3
                        text-sm font-semibold uppercase
                        focus:outline-hidden
                        ring-1 ring-secondary-500 bg-secondary-200 text-gray-900
                        transition duration-200 ease-in-out
                        hover:bg-secondary-400
                        sm:flex-1"
                  for="60"
                >
                  <input type="radio" required name="amount" id="60" value="60" class="sr-only">
                  <span>€ 60,-</span>
                </label>

                <label
                  class="flex cursor-pointer items-center justify-center
                        rounded-full px-3 py-3
                        text-sm font-semibold
                        focus:outline-hidden
                        ring-1 ring-secondary-500 bg-secondary-200 text-gray-900
                        transition duration-200 ease-in-out
                        hover:bg-secondary-400
                        sm:flex-1"
                  for="other"
                >
                  <input type="radio" required name="amount" id="other" value="other" class="sr-only">
                  <span>Anders</span>
                </label>
              </div>
            </fieldset>

            <div data-button-radio-other class="relative max-h-0 h-24 transition scale-y-0 duration-200 ease-in-out origin-top opacity-0" aria-hidden="true">
              <label for="other-amount" class="block text-sm/6 font-medium text-gray-900">Anders</label>
              <div class="mt-2">
                <div class="flex items-center rounded-md bg-white px-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-primary-500">
                  <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6">€</div>
                  <input
                    type="text"
                    name="other-amount"
                    id="other-amount"
                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                    aria-describedby="other-amount-description"
                    disabled
                  >
                </div>
              </div>
              <p class="mt-2 text-sm text-gray-500" id="other-amount-description">Vul hier het gewenste bedrag in (9,95).</p>
              <p class="text-sm text-red-600 hidden" id="other-amount-error"></p>
            </div>
          </div>

          <fieldset class="block">
            <legend class="text-sm/6 font-semibold text-gray-900">Frequentie <span class="text-primary-400">*</span></legend>
            <p class="mt-1 text-sm/6 text-gray-600">Wat is de frequentie van jouw sponsoring?</p>
            <div class="mt-6 space-y-6 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                <div class="flex items-center">
                  <input
                    id="single"
                    required
                    name="frequency"
                    type="radio"
                    value="single"
                    checked
                    class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-primary-500 checked:bg-primary-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-500 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden"
                  >
                  <label for="single" class="ml-3 block text-sm/6 font-medium text-gray-900">Eenmalig</label>
                </div>
              <div class="flex items-center">
                <input
                  id="monthly"
                  value="monthly"
                  required
                  name="frequency"
                  type="radio"
                  class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-primary-500 checked:bg-primary-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-500 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden"
                >
                <label for="monthly" class="ml-3 block text-sm/6 font-medium text-gray-900">Maandelijks</label>
              </div>
              <div class="flex items-center">
                <input
                  id="yearly"
                  value="yearly"
                  required
                  name="frequency"
                  type="radio"
                  class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-primary-500 checked:bg-primary-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-500 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden"
                >
                <label for="yearly" class="ml-3 block text-sm/6 font-medium text-gray-900">Jaarlijks</label>
              </div>
            </div>
          </fieldset>
      </div>

      <div class="py-8 flex flex-col gap-8">
        <div>
          <span class="text-black text-xl md:text-2xl font-sans tracking-wide font-semibold">
            Uw gegevens
          </span>
          <p class="mt-2 text-xs text-gray-500">
            We gebruiken uw gegevens alleen voor identificatie en communicatie vanuit ons naar jou.
          </p>
        </div>

        <div>
          <label for="firstname" class="block text-sm/6 font-medium text-gray-900">
            Voornaam <span class="text-primary-400">*</span>
          </label>
          <div class="mt-2">
            <input
              type="text"
              name="firstname"
              id="firstname"
              required
              class="block w-full rounded-md px-3 py-1.5
                     bg-white
                     text-base text-gray-900
                     outline-1 -outline-offset-1 outline-gray-300
                     placeholder:text-gray-400
                     focus:outline-2 focus:-outline-offset-2 focus:outline-primary-500
                     sm:text-sm/6"
            >
          </div>
          <p class="text-sm text-gray-500" id="firstname-error"></p>
          <p class="text-sm text-red-600 hidden" id="firstname-error"></p>
        </div>

        <div>
          <label for="infix" class="block text-sm/6 font-medium text-gray-900">
            Tussenvoegsel(s)
          </label>
          <div class="mt-2">
            <input
              type="text"
              name="infix"
              id="infix"
              class="block w-full rounded-md px-3 py-1.5
                     bg-white
                     text-base text-gray-900
                     outline-1 -outline-offset-1 outline-gray-300
                     placeholder:text-gray-400
                     focus:outline-2 focus:-outline-offset-2 focus:outline-primary-500
                     sm:text-sm/6"
            >
          </div>
        </div>

        <div>
          <label for="surname" class="block text-sm/6 font-medium text-gray-900">
            Achternaam <span class="text-primary-400">*</span>
          </label>
          <div class="mt-2">
            <input
              type="text"
              name="surname"
              id="surname"
              required
              class="block w-full rounded-md px-3 py-1.5
                     bg-white
                     text-base text-gray-900
                     outline-1 -outline-offset-1 outline-gray-300
                     placeholder:text-gray-400
                     focus:outline-2 focus:-outline-offset-2 focus:outline-primary-500
                     sm:text-sm/6"
            >
          </div>
          <p class="text-sm text-red-600 hidden" id="surname-error"></p>
        </div>

        <div>
          <label for="email" class="block text-sm/6 font-medium text-gray-900">
            E-mailadres <span class="text-primary-400">*</span>
          </label>
          <div class="mt-2">
            <input
              type="email"
              name="email"
              id="email"
              required
              class="block w-full rounded-md px-3 py-1.5
                     bg-white
                     text-base text-gray-900
                     outline-1 -outline-offset-1 outline-gray-300
                     placeholder:text-gray-400
                     focus:outline-2 focus:-outline-offset-2 focus:outline-primary-500
                     sm:text-sm/6"
            >
          </div>
          <p class="text-sm text-red-600 hidden" id="email-error"></p>
        </div>

        <div>
          <label for="phone" class="block text-sm/6 font-medium text-gray-900">
            Telefoonnummer <span class="text-primary-400">*</span>
          </label>
          <div class="mt-2">
            <input
              type="phone"
              name="phone"
              id="phone"
              required
              class="block w-full rounded-md px-3 py-1.5
                     bg-white
                     text-base text-gray-900
                     outline-1 -outline-offset-1 outline-gray-300
                     placeholder:text-gray-400
                     focus:outline-2 focus:-outline-offset-2 focus:outline-primary-500
                     sm:text-sm/6"
            >
          </div>
          <p class="mt-2 text-sm text-gray-500" id="phone-description">Het telefoonnummer wordt alleen gebruikt voor belangrijke communicatie rondom de sponsoring.</p>
          <p class="text-sm text-red-600 hidden" id="phone-error"></p>
        </div>

        <div>
          <label for="comments" class="block text-sm/6 font-medium text-gray-900">
            Opmerking(en)
          </label>
          <div class="mt-2">
            <textarea
                name="comments"
                id="comments"
                rows="7"
                class="block w-full rounded-md px-3 py-1.5
                       bg-white
                       text-base text-gray-900
                       outline-1 -outline-offset-1 outline-gray-300
                       placeholder:text-gray-400
                       focus:outline-2 focus:-outline-offset-2 focus:outline-primary-500
                       sm:text-sm/6"
            ></textarea>
          </div>
          <p class="text-sm text-gray-500" id="comments-description"></p>
          <p class="text-sm text-red-600 hidden" id="comments-error"></p>
        </div>
      </div>
      <div class="py-8 flex flex-col gap-8" data-made-dependent="frequency" data-made-dependent-values="monthly,yearly">
        <div>
          <span class="text-black text-xl md:text-2xl font-sans tracking-wide font-semibold">
            Financiële gegevens
          </span>
          <p class="mt-2 text-xs text-gray-500">
            Deze gegevens zijn nodig om een automatische incasso en/of donatie aanvraag op
            te zetten en worden alleen op de mail gezet naar info@mozkids.nl zodat wij
            de donatie kunnen opzetten.
          </p>
        </div>
        <div>
          <label for="account-holder" class="block text-sm/6 font-medium text-gray-900">
            Naam rekeninghouder <span class="text-primary-400">*</span>
          </label>
          <div class="mt-2">
            <input
              type="text"
              name="account-holder"
              id="account-holder"
              required
              class="block w-full rounded-md px-3 py-1.5
                     bg-white
                     text-base text-gray-900
                     outline-1 -outline-offset-1 outline-gray-300
                     placeholder:text-gray-400
                     focus:outline-2 focus:-outline-offset-2 focus:outline-primary-500
                     sm:text-sm/6"
            >
          </div>
          <p class="mt-2 text-sm text-gray-500" id="account-holder-description">De naam van de rekeninghouder van de hieronder ingevulde bankrekening.</p>
          <p class="text-sm text-red-600 hidden" id="account-holder-error"></p>
        </div>
        <div>
          <label for="iban" class="block text-sm/6 font-medium text-gray-900">
            IBAN <span class="text-primary-400">*</span>
          </label>
          <div class="mt-2">
            <input
              type="text"
              name="iban"
              id="iban"
              required
              class="block w-full rounded-md px-3 py-1.5
                     bg-white
                     text-base text-gray-900
                     outline-1 -outline-offset-1 outline-gray-300
                     placeholder:text-gray-400
                     focus:outline-2 focus:-outline-offset-2 focus:outline-primary-500
                     sm:text-sm/6"
            >
          </div>
          <p class="mt-2 text-sm text-gray-500" id="iban-description">
            Het <a href="https://nl.wikipedia.org/wiki/International_Bank_Account_Number" target="_blank">IBAN</a> van waar de donatie van afgehaald kan worden.
          </p>
          <p class="text-sm text-red-600 hidden" id="iban-error"></p>
        </div>
      </div>
      <div class="py-8 flex flex-col gap-8">
        <div>
          <div class="flex gap-3">
            <div class="flex h-6 shrink-0 items-center">
              <div class="group grid size-4 grid-cols-1">
                <input
                  id="newsletter"
                  aria-describedby="newsletter-description"
                  name="newsletter"
                  type="checkbox"
                  class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-primary-500 checked:bg-primary-500 indeterminate:border-primary-500 indeterminate:bg-primary-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-500 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                >
                <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25" viewBox="0 0 14 14" fill="none">
                  <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
            </div>
            <div class="text-sm/6">
              <label for="newsletter" class="font-medium text-gray-900">Nieuwsbrief</label>
              <p id="newsletter-description" class="text-gray-500">Ja, ik wil de maandelijkse nieuwsbrief ontvangen van Moz Kids om op de hoogte te blijven van alles.</p>
            </div>
          </div>

          <div class="mt-8 flex gap-3">
            <div class="flex h-6 shrink-0 items-center">
              <div class="group grid size-4 grid-cols-1">
                <input
                  id="privacy"
                  aria-describedby="privacy-description"
                  name="privacy"
                  type="checkbox"
                  required
                  class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-primary-500 checked:bg-primary-500 indeterminate:border-primary-500 indeterminate:bg-primary-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-500 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                >
                <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25" viewBox="0 0 14 14" fill="none">
                  <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
              <p class="text-sm text-red-600 hidden" id="privacy-error"></p>
            </div>
            <div class="text-sm/6">
              <label for="privacy" class="font-medium text-gray-900">Privacy verklaring <span class="text-primary-400">*</span></label>
              <p id="privacy-description" class="text-gray-500">Ik ga akkoord met de privacy verklaring en verwerking van mijn persoonsgegevens.</p>
            </div>
          </div>

          <p class="mt-8 mb-4 text-xs text-black">
            Giften aan Moz kids zijn fiscaal aftrekbaar.
          </p>

          <x-button type="submit" color="primary">
            Doneren
          </x-button>
        </div>

    </form>
</div>
