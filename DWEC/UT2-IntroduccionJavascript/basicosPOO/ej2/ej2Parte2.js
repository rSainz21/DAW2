'use strict';

class Animal {
    constructor(nombre) {
        this.nombre = nombre;
        this.tipo=this.tipo;
    }
 
    comer() {
        return `${this.nombre} está comiendo`;
    }

    dormir(){
        return `${this.nombre} está durmiendo`;
    }

    hacerRuido(){
        return `${this.nombre} hace ruido`;
    }
}

class Perro extends Animal {
    constructor(nombre){
        super(nombre);
        this.tipo= 'perro';
    }

    hacerRuido(){
        return `${this.nombre} hace guau guau`;
    }
}

class Gato extends Animal {
    constructor(nombre){
        super(nombre);
        this.tipo='gato';
    }

    hacerRuido(){
        return `${this.nombre} hace miau miau`;
    }
}


const animal = new Animal('animal', 'Bicho');
const perro = new Perro('perro', 'Toby');
const gato = new Gato('gato', 'Misi');
const raro = new Animal('dragon', 'Smaug'); 

console.log(animal.comer());
console.log(animal.dormir());
console.log(animal.hacerRuido());
 
console.log(perro.comer());   
console.log(perro.dormir());  
console.log(perro.hacerRuido()); 
 
console.log(gato.comer());
console.log(gato.dormir());
console.log(gato.hacerRuido()); 
console.log(raro.hacerRuido());