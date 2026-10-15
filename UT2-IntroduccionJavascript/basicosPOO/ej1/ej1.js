'use strict';

class Persona{
    constructor(nombre,nacimiento,hobbies){
        this.nombre=nombre,
        this.nacimiento=nacimiento,
        this.hobbies=hobbies
    }

    getEdad(){
        const hoy=new Date();
        let edad=hoy.getFullYear()-this.nacimiento.getFullYear();
        return edad;
    }

    saludar(){
        return `Hola, me llamo ${this.nombre} y me gusta ${this.hobbies.join(',')}`;
    }
}
const person
console.log()