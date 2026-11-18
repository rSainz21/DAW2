'use strict';

function rectangulo(lado){
    let figura='';
    for(let fila=0;fila<lado;fila++){
        let linea='';
        for(let col=0;col<lado;col++){
            if(fila===0||fila===lado-1||col===0||col===lado-1){
                linea+='* '; 
            }else{
                linea+='  ';
            }
        }
        figura+=linea+'\n';
    }
    return figura;
}

console.log(rectangulo(5));