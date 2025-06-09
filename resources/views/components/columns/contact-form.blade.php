<div class="bg-white rounded-xl py-8 px-7">
    <div>
        <span
            class="block
                mb-4
                text-xs text-primary-500 font-sans tracking-wide uppercase
                md:text-sm"
        >
            Contact
        </span>
        <div class="prose mb-8">
            <h2 class="mb-6">
                Contactformulier
            </h2>
            <p>
                Door middel van onderstaand formulier kunt u met al uw vragen en/of opmerkingen bij
                ons terecht.
            </p>
        </div>
    </div>
    <div>
        <form
            data-made-form=""
            action="{{ route('api.contact-form') }}"
            method="POST"
            class="flex flex-col gap-2"
        >

            @csrf

            <div>
                <label for="name" class="block text-sm/6 font-medium text-gray-900">
                    Naam <span class="text-primary-400">*</span>
                </label>
                <div class="mt-2">
                    <input
                    type="text"
                    name="name"
                    id="name"
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
                <p class="text-sm text-gray-500" id="name-description"></p>
                <p class="text-sm text-red-600 hidden" id="name-error"></p>
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
                <p class="text-sm text-gray-500" id="email-description"></p>
                <p class="text-sm text-red-600 hidden" id="email-error"></p>
            </div>

            <div>
                <label for="phone" class="block text-sm/6 font-medium text-gray-900">
                    Telefoonnummer
                </label>
                <div class="mt-2">
                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        class="block w-full rounded-md px-3 py-1.5
                                bg-white
                                text-base text-gray-900
                                outline-1 -outline-offset-1 outline-gray-300
                                placeholder:text-gray-400
                                focus:outline-2 focus:-outline-offset-2 focus:outline-primary-500
                                sm:text-sm/6"
                    >
                </div>
                <p class="text-sm text-gray-500" id="phone-description"></p>
                <p class="text-sm text-red-600 hidden" id="phone-error"></p>
            </div>

            <div>
                <label for="subject" class="block text-sm/6 font-medium text-gray-900">
                    Onderwerp
                </label>
                <div class="mt-2">
                    <input
                        type="text"
                        name="subject"
                        id="subject"
                        class="block w-full rounded-md px-3 py-1.5
                                bg-white
                                text-base text-gray-900
                                outline-1 -outline-offset-1 outline-gray-300
                                placeholder:text-gray-400
                                focus:outline-2 focus:-outline-offset-2 focus:outline-primary-500
                                sm:text-sm/6"
                    >
                </div>
                <p class="text-sm text-gray-500" id="subject-description"></p>
                <p class="text-sm text-red-600 hidden" id="subject-error"></p>
            </div>

            <div>
                <label for="message" class="block text-sm/6 font-medium text-gray-900">
                    Bericht <span class="text-primary-400">*</span>
                </label>
                <div class="mt-2">
                    <textarea
                        name="message"
                        id="message"
                        rows="7"
                        required
                        class="block w-full rounded-md px-3 py-1.5
                                bg-white
                                text-base text-gray-900
                                outline-1 -outline-offset-1 outline-gray-300
                                placeholder:text-gray-400
                                focus:outline-2 focus:-outline-offset-2 focus:outline-primary-500
                                sm:text-sm/6"
                    ></textarea>
                </div>
                <p class="text-sm text-gray-500" id="message-description"></p>
                <p class="text-sm text-red-600 hidden" id="message-error"></p>
            </div>

            <div class="flex gap-3">
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

            <div>
                <x-button type="submit" color="primary">
                    Versturen
                </x-button>
            </div>

        </form>
    </div>
</div>
