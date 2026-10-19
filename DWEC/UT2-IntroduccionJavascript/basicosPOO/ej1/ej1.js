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

class PersonaFactory{
    static crear(nombre,fechaNacimiento,hobbies){
        const nacimiento=new Date(fechaNacimiento);
        const listaHobbies=hobbies.split(',');
        return new Persona(nombre,nacimiento,listaHobbies);
    }
}

do{
    alert('Bienvenido al programa de creación de personas');
    let nombre=prompt('Ingrese su nombre');
    let fechaNacimiento=prompt('Ingrese su fecha de nacimiento (YYYY-MM-DD)');
    let hobbies=prompt('Ingrese sus hobbies separados por coma');
    const persona=PersonaFactory.crear(nombre,fechaNacimiento,hobbies);
    alert(persona.saludar());
    alert(`Edad: ${persona.getEdad()}`);
    let opcion=prompt('Desea crear otra persona? (0 para salir, 1 para continuar)');
}while(opcion!=0);


let nom=prompt('Ingrese su nombre');
let fecha=prompt('Ingrese su fecha de nacimiento (YYYY-MM-DD)');
let hobbies=prompt('Ingrese sus hobbies separados por coma');
const persona=new Persona(nom,new Date(fecha),hobbies.split(','));
alert(persona.saludar());
alert(`Edad: ${persona.getEdad()}`);

