'use strict';

// function dibujaTriangulo(altura) {
//   let filas = [];
//   for (let i = 1; i <= altura; i++) {
//     filas[filas.length] = "*".repeat(i);
//   }
//   return filas;
// }

function dibujarTriangulo(altura){
    let resultado = [];
    for(let fila=0; fila<altura; fila++){
        let linea = "";
        let espacios = altura-fila-1;
        let asteriscos = fila+1+fila;
        for(let j=0; j<espacios; j++){
            linea += "-";
        }
        for(let k=0; k<asteriscos; k++){
            linea += "*";
        }
        resultado[fila] = linea;
    }
    return resultado;
}

console.log(dibujarTriangulo(5));