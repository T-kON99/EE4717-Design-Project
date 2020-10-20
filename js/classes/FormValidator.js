import { Validator } from './Validator.js';

export class FormValidator {
    constructor(formElement, formValidator = {}, errorMessage = {}) {
        this.form = formElement;
        this.inputs = formElement.querySelectorAll('input,textarea');
        this.formChildren = {};
        this.errors = errorMessage;
        for(const input of this.inputs) {
            if (input?.type && input?.type !== 'submit' && input?.type !== 'reset') {
                this.formChildren[input.name] = input;
            }
        }
        this.validator = new Validator(this.formChildren, formValidator);
    }

    setupListener({showErrors = false}) {
        let form = this.formChildren;
        for(const field in form) {
            form[field].onchange = (event) => {
                let error_message = '';
                if (showErrors) {
                    let error = document.getElementById(`${field}-error`);
                    if(!this.validator[`validate_${field}`](event.target.value)) {
                        error.classList.toggle('blink');
                        setTimeout(() => {
                            error.classList.toggle('blink');
                        }, 2000);
                        error_message = this.errors[field];
                    } else {
                        // Remove if it's validated.
                        if(error.classList.contains('blink')) {
                            error.classList.remove('blink');
                        }
                    }
                    error.innerHTML = error_message;       
                } 
            };
        }
        this.form.onsubmit = (event) => {
            if(!this.validator.validateAll()) {
                event.preventDefault();
                alert('Please fix the error!');
                for(const field in form) {
                    var event = new Event('change');
                    form[field].dispatchEvent(event);
                }
                return false;
            }
            return true;
        }
    }
}