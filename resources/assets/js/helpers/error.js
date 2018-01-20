export default class Errors{
    constructor(){
        this.errors = {}
    }

    get(field){
        if(this.errors[field]){
            return this.errors[field][0];
        }
    }

    any(){
        return Object.keys(this.errors).length > 0;
    }

    record(error){
        this.errors = error;
    }

    clear(field){
        delete this.errors[field];
    }
}