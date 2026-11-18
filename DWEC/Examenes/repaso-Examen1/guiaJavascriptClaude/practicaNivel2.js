'use strict';

function cuadradoLleno(n){
    let figura=[];
    for(let fila=0;fila<n;fila++){
        let linea='';
        for(let col=0;col<n;col++){
            linea+='* ';
        }
        figura.push(linea);
    }
    return figura;
}
console.log(cuadradoLleno(4));

function cuadradoHueco(n){
    let figura=[];
    for(let fila=0;fila<n;fila++){
        let linea='';
        for(let col=0;col<n;col++){
            if(fila===0||fila===n-1||col===0||col===n-1){
                linea+='*';
            }else{
                linea+=' ';
            }
        }
        figura.push(linea);
    }
    return figura;
}
console.log(cuadradoHueco(4));

function triangulo(n){
    let figura=[];
    for(let fila=0;fila<n;fila++){
        let linea='';
        for(let espacios=0;espacios<(n-fila-1);espacios++){
            linea+=' ';
        }
        for(let asteriscos=0;asteriscos<(2*fila+1);asteriscos++){
            linea+='*'
        }
        figura.push(linea);
    }
    return figura;
}
console.log(triangulo(3));

function rombo(n){
    let figura=[];
    let medio=(n-1)/2;
    for(let fila=0;fila<n;fila++){
        let distancia=Math.abs(medio-fila);
        let linea='';
        for(let espacios=0;espacios<distancia;espacios++){
            linea+=' ';
        }
        for(let asteriscos=0;asteriscos<(n-(distancia*2));asteriscos++){
            linea+='*';
        }
        figura.push(linea);
    }
    return figura;
}
console.log(rombo(5));

