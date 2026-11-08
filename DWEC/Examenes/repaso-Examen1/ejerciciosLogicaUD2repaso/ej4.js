'use strict';

function triangulo(h){
    let figura='';
    for(let fila=0;fila<h;fila++){
        let linea='';
        for(let espacios=0;espacios<(h-fila-1);espacios++){
            linea+=' ';
        }
        for(let asteriscos=0;asteriscos<(2*fila+1);asteriscos++){
            linea+='*';
        }
        figura+=linea+'\n';
    }
    return figura;
}
console.log(triangulo(5));
