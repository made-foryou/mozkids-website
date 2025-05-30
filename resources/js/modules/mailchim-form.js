export default class MailchimpForm {

    /** 
     * @param {HTMLFormElement} form 
     */
    constructor(form) {

        /**
         * @type {HTMLFormElement}
         * @private
         */
        this._form = form;

        /**
         * @type {HTMLButtonElement}
         * @private
         */
        this._submit = this._form.querySelector('button[type="submit"]');

        /**
         * @type {HTMLElement}
         * @private
         */
        this._success = document.querySelector('.made-mailchimp-success');

        /**
         * @type {boolean}
         * @private
         */
        this._loading = false;


        this._form.addEventListener('submit', this.onSubmit.bind(this));
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
            this.success();
        } else if (result.status === 302) {
            // @todo Respond that the user was already added to the list.
        } else if (result.status === 422) {
            const response = await result.json();
            this.processValidationErrors(response.errors);
        }

        this.stopLoading();

        return false;
    }

    startLoading() {
        const loadingIcon = '<div class="inline-block" role="status">'
            + '<svg aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-primary-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">'
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

    success() {
        this._form.classList.add('ease-in-out', 'duration-450', 'transition-opacity');
        this._form.classList.add('opacity-0');

        window.setTimeout(() => {
            this._form.classList.add('hidden', 'absolute');

            this._form.reset();

            this._success.classList.remove('absolute');
            this._success.classList.add('relative');

            this._success.classList.remove('opacity-0');
        }, 450);
    }

    processValidationErrors(errors) {
        const errorsFound = [];
        let element;

        for (const key of Object.keys(errors)) {
            element = this._form.querySelector(`[name="${key}"]`);

            if (element) {
                if (!element.classList.contains('border-red-500')) {
                    element.classList.add('border-red-500');
                }

                if (!element.classList.contains('border')) {
                    element.classList.add('border');
                }

                if (!element.hasAttribute('aria-invalid') || element.getAttribute('aria-invalid') !== 'true') {
                    element.setAttribute('aria-invalid', 'true');
                }

                errorsFound.push(key);
            }
        }

        const formKeys = new FormData(this._form).keys();

        for (const formKey of formKeys) {
            if (errorsFound.includes(formKey)) {
                continue;
            }

            element = this._form.querySelector(`[name="${formKey}"]`);

            if (element) {

                if (element.classList.contains('border-red-500')) {
                    element.classList.remove('border-red-500');
                }

                if (element.classList.contains('border')) {
                    element.classList.remove('border');
                }

                if (element.hasAttribute('aria-invalid') || element.getAttribute('aria-invalid') !== 'false') {
                    element.setAttribute('aria-invalid', 'false');
                }
            }
        }
    }


    static initialize() {
        const forms = document.querySelectorAll('form.made-mailchimp-form');

        if (forms.length === 0) {
            return;
        }

        forms.forEach((form) => {
            new MailchimpForm(form);
        });
    }

}