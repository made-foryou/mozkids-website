export default class DonationForm {

    /**
     * @param {HTMLFormElement} form
     */
    constructor(form) {

        /**
         * The Donation form element.
         * 
         * @type {HTMLFormElement}
         * @private
         */
        this._form = form;

        /**
         * Shows whether the donation form is loading.
         * 
         * @type {boolean}
         * @private
         */
        this._loading = false;

        /**
         * The submit button from the donation form.
         * 
         * @type {HTMLButtonElement}
         * @private
         */
        this._submit = this._form.querySelector('button[type="submit"]');

        this._form.addEventListener('submit', this.onSubmit.bind(this));

        this._form.querySelectorAll('input').forEach(input => {
            input.addEventListener('change', () => {
                this.resetError(input);
            });
        })
    }

    async onSubmit(event) {
        event.preventDefault();

        if (this._loading) {
            return;
        }

        this.startLoading();

        const result = await fetch(this._form.action, {
            method: this._form.method,
            body: new FormData(this._form),
            headers: {
                'Accept': 'application/json'
            }
        });

        if (result.status === 200) {
            const response = await result.json();

            if (response.redirect) {
                window.location.href = response.redirect;
            }
        } else {
            const response = await result.json();

            if (response.errors) {
                this.processErrors(response.errors);
            }
        }

        this.stopLoading();

        return false;
    }

    startLoading() {
        const loadingIcon = '<div class="inline-block" role="status">'
            + '<svg aria-hidden="true" class="w-5 h-5 text-white animate-spin dark:text-white fill-primary-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">'
            + '<path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>'
            + '<path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>'
            + '</svg>'
            + '<span class="sr-only">Loading...</span>'
            + '</div>';

        this._submit.innerHTML = this._submit.innerHTML + loadingIcon;

        this._loading = true;
    }

    stopLoading() {
        this._submit.querySelector('div[role="status"]').remove();

        this._loading = false;
    }

    processErrors(errors) {
        let counter = 0;
        for (const [key, value] of Object.entries(errors)) {
            const inputs = this._form.querySelectorAll(`[name="${key}"]`);

            if (inputs.length === 1) {
                // Normal input
                this.processInputError(inputs[0], value[0]);
            } else {
                // Radio inputs
            }

            if (counter === 0) {
                inputs[0].focus();
            }

            counter++;
        }
    }

    processInputError(input, error) {
        const descriptionElement = this._form.querySelector('#' + input.name + '-description');
        const errorElement = this._form.querySelector('#' + input.name + '-error');

        if (descriptionElement && !descriptionElement.classList.contains('hidden')) {
            descriptionElement.classList.add('hidden');
        }

        errorElement.classList.remove('hidden');

        if (input.name === 'other-amount') {
            input.parentNode.classList.add('mt-2', 'outline-primary-500', 'outline-2', 'outline-offset-2');
        } else {
            input.classList.add('mt-2', 'outline-primary-500', 'outline-2', 'outline-offset-2');
        }

        switch (error) {
            case 'validation.required':
            case 'validation.required_if':
                errorElement.innerText = 'Je bent dit veld vergeten in te vullen.';
                break;
            case 'email':
                errorElement.innerText = 'Dit is geen geldig e-mailadres.';
                break;
            case 'numeric':
                errorElement.innerText = 'Hier moet een numeriek getal ingevuld worden.';
                break;
            case 'string':
                errorElement.innerText = 'Dit is geen geldige tekst.';
                break;
            case 'validation.max.string':
                errorElement.innerText = 'Deze tekst is te lang. Maximaal kun je maar 255 karakters gebruiken.';
                break;
        }
    }

    resetError(input) {
        const descriptionElement = this._form.querySelector('#' + input.name + '-description');
        const errorElement = this._form.querySelector('#' + input.name + '-error');

        errorElement.classList.add('hidden');

        if (input.name === 'other-amount') {
            input.parentNode.classList.remove('mt-2', 'outline-primary-500', 'outline-2', 'outline-offset-2');
        } else {
            input.classList.remove('mt-2', 'outline-primary-500', 'outline-2', 'outline-offset-2');
        }

        if (descriptionElement && descriptionElement.classList.contains('hidden')) {
            descriptionElement.classList.remove('hidden');
        }
    }

}