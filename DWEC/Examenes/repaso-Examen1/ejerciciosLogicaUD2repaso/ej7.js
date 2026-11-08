'use strict';
function multiplicar(){
    let n1=Number(prompt('Elige le primer numero:'));
    let n2=Number(prompt('Elige el segundo numero:'));

    let mayor=n1;
    let menor=n2;
    if(n2>n1){
        mayor=n2;
        menor=n1;
    }
    let resultado=[];

    for(let tabla=menor;tabla<=mayor;tabla++){
        let linea='';
        for(let multiplo=0;multiplo<=10;multiplo++){
            linea+= tabla+'x'+multiplo+'='+(tabla*multiplo+'\n');
        }
        resultado.push(linea);
    }
    return resultado;
}

console.log(multiplicar().join('\n'));