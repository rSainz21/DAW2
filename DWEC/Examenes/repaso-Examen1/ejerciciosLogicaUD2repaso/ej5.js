'use strict';
//si es un numero par no funciona
function rombo(d){
    let figura=[];
    let mitad=(d-1)/2;

    if(d===0||d===null||d%2==0){
        alert('Numero invalido, deber ser impar y mayor que 0.');
        return;
    }

    for(let fila=0;fila<d;fila++){
        let distancia=Math.abs(mitad-fila);
        let linea='';
        for(let espacio=0;espacio<distancia;espacio++){
            linea+=' ';
        }
        for(let asterisco=0;asterisco<d-distancia*2;asterisco++){
            linea+='*';
        }
        figura.push(linea);
    }
    return figura;
}

console.log(rombo(5));