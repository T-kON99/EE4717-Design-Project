export class Validator {
    constructor(object = {}, object_validator = {}) {
        this.fields = {};
        for(const key in object) {
            this.fields[key] = object[key];
        }
        for(const key in object_validator) {
            this[`validate_${key}`] = object_validator[key];
        }
    }
    
    validateAll() {
        const obj = this;
        for (const key in obj.fields) {
            const value = obj.fields[key].value;
            if (!obj.fields.hasOwnProperty(key) || !obj.hasOwnProperty(`validate_${key}`)) continue;
            //  Loop over all properties of an object.
            //  key: the name of the object key
            if (value !== null) {
                console.log(`Validating ${key}`);
                if (!obj[`validate_${key}`](value)) {
                    return false;
                }
            }
        };
        return true;
    }
}