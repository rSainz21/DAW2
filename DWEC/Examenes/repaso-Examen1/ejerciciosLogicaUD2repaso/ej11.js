'use strict';

function esPrimo(n){
    if(n<2){
        return false;
    }
    for(let i=2;i*i<=n;i++){
        if(n%i===0){
            return false;
        }
    }
    return true;
}

function rango(n1,n2){
    let resultado=[]
    let mayor=n1;
    let menor=n2;
    if(n2>n1){
        mayor=n2;
        menor=n1;
    }
    for(let i=menor;i<=mayor;i++){
        let propiedades=[];
        if(i%3===0){
            propiedades.push('multiplo de 3');
        }
        if(i%5===0){
            propiedades.push('multiplo de 5');
        }
        if(esPrimo(i)){
            propiedades.push('es primo');
        }
        if(propiedades.length>0){    // solo si cumple alguna condición
            resultado.push(i+': '+propiedades.join(', '));
        }
    }
    return resultado;
}

let continuar;
do {
    let n1=Number(prompt('Inicio del rango:'));
    let n2=Number(prompt('Final del rango'));
    if(!Number.isInteger(n1)||!Number.isInteger(n2)){
        alert('Numerp invalido');
    }else{
        let lista=rango(n1,n2);
        if(lista.length===0){
            alert('No hay numeros validos');
        }else{
            console.log(lista.join('\n'));
        }
    }
    continuar=confirm('¿Quieres hacerte otro rango?');
} while (continuar);