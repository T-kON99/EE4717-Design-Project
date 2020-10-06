import { Validator } from './Validator.js';

window.onload = () => {
    let formHTML = document.getElementById('formcontact');
    let form = {
        'subject': formHTML.getElementById('subject'),
        'body': formHTML.getElementById('email'),
    };
    let validator = new Validator(form, {
        'subject': (value) => String(value).length > 0,
        'body': (value) => String(value).length > 0
    });
    // for(const field in form) {
    //     form[field].onchange = (event) => {
    //         let error = document.getElementById(`${field}-error`);
    //         let error_message = '';
    //         if(!validator[`validate_${field}`](event.target.value)) {
    //             error.classList.toggle('blink');
    //             setTimeout(() => {
    //                 error.classList.toggle('blink');
    //             }, 2000);
    //             switch(field) {
    //                 case 'name':
    //                     error_message = 'Name must only contain alphabetic and space characters!';
    //                     break;
    //                 case 'email':
    //                     error_message = 'Email must follow given format!';
    //                     break;
    //                 case 'startdate':
    //                     error_message = 'Start date can\'t be today or past dates!';
    //                     break;
    //                 case 'experience':
    //                     error_message = 'Experience can\'t be empty!';
    //                     break;
    //             }
    //         } else {
    //             // Remove if it's validated.
    //             if(error.classList.contains('blink')) {
    //                 error.classList.remove('blink');
    //             }
    //         }
    //         error.innerHTML = error_message;        
    //     };
    // }
    // formHTML.onsubmit = (event) => {
    //     if(!validator.validateAll()) {
    //         event.preventDefault();
    //         alert('Please fix the error!');
    //         for(const field in form) {
    //             var event = new Event('change');
    //             form[field].dispatchEvent(event);
    //         }
    //         return false;
    //     }
    //     return true;
    // }
    console.log(validator.validateAll());
}