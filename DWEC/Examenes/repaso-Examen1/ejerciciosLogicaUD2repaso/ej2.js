'use strict';

let entrada;
let numeros=[];
do {

    entrada=prompt('Introduce un numero: ');
    let numero=Number(entrada);
    if(entrada===null){
        break;
    }
    if(numero!==0){
        numeros.push(numero);
    }

} while (entrada.trim()!=='0');

if(numeros.length===0){
    alert('No se ha introducido ningun numero');
} else {
    let maximo=Math.max(...numeros);
    let minimo=Math.min(...numeros);
    let suma=0;
    for(let num of numeros){
        suma+=num;
    }
    let media=suma/numeros.length;
    let total=numeros.length;

    alert(
        `Máximo: ${maximo}\n` +
        `Mínimo: ${minimo}\n` +
        `Suma: ${suma}\n` +
        `Media: ${media.toFixed(2)}\n` +
        `Total introducidos: ${total}`
    );
}