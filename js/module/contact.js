import { FormValidator } from '../classes/FormValidator.js';
window.onload = () => {
    let formHTML = document.getElementById('formcontact');
    let validator = {
        'subject': (value) => String(value).length > 0,
        'body': (value) => String(value).length > 0
    }
    let errors = {
        'subject': 'Subject must not be empty',
        'body': 'Body must not be empty'
    }
    let Form = new FormValidator(formHTML, validator, errors);
    Form.setupListener({showErrors: true});
}