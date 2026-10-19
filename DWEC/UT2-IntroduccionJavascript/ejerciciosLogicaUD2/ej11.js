'use strict';

function esPrimo(numero) {
    if (numero < 2) {
        return false;
    }
    for (let i = 2; i < numero; i++) {
        if (numero % i === 0) {
            return false; 
        }
    }
    return true;
}

function comprobarRango(minimo,maximo){
    
    let resultados=[];
    for(let i=minimo;i<=maximo;i++){
        let condiciones=[];
        if(i%3===0){
            condiciones.push('multiplo de 3');
        }
        if(i%5===0){
            condiciones.push('multiplo de 5');
        }
        if(esPrimo(i)){
            condiciones.push('es primo');
        }
    }
    return resultados;
}
console.log(comprobarRango(1,20))
