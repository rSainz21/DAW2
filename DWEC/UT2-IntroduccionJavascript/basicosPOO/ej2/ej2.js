'use strict';

const animales={
    animal: 'jajaja',
    perro: ' hace guau guau',
    gato: 'hace miau miau'
};

function queTipoEs(tipo){
    for(let i in animales){
        if(i===tipo){
            return true;
        }
    }
    return false;
}


function Animal(tipo,nombre){
    this.tipo=queTipoEs(tipo)?tipo:'animal';
    this.nombre=nombre;
}

Animal.prototype.comer = function () {
    return `${this.nombre} está comiendo`;
};

Animal.prototype.dormir=function(){
    return `${this.nombre} esta durmiendo`;
};

Animal.prototype.hacerRuido=function () {
    return `${this.nombre} ${animales[this.tipo]}`;
};

const animal = new Animal('animal', 'Bicho');
const perro = new Animal('perro', 'Toby');
const gato = new Animal('gato', 'Misi');
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