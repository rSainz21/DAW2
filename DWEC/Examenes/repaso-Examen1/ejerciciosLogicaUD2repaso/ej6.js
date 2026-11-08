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

function rombo(d){
    let figura=[];
    let mitad=(d-1)/2;

    if(!Number.isInteger(d)||d<1||d%2===0){          // CAMBIO
        alert('Numero invalido, deber ser impar y mayor que 0.');
        return figura;                                // CAMBIO
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

let opcion;
let tamano;
do{
    opcion=Number(prompt('Elige una funcion geometrica:\n 1.-Cuadrado\n 2.-Triangulo\n 3.-Rombo\n 0.-Terminar')); // CAMBIO
    if(opcion===0){
        break;                                        // CAMBIO
    }
    tamano=Number(prompt('Introduce el tamaño de la figura:'));
    switch (opcion) {
        case 1:
            console.log(rectangulo(tamano));
            break;
        case 2:
            console.log(triangulo(tamano));
            break;
        case 3:
            console.log(rombo(tamano).join('\n'));    // CAMBIO
            break;
        default:
            alert('introduce un valor valido!!');
            break;
    }
}while(opcion!==0);

alert('fin del programa...');                         // CAMBIO (movido aquí)