'use strict';
function estadisticas(){
    let maximo;
    let minimo;
    let suma=0;
    let total=0;
    let numero;
    do{
        numero=parseFloat(prompt('Introduce un numero (0 para terminar)'));
        if(isNaN(numero)){
            alert('Eso no es un numero')
        }else if(numero!==0){
            if(total===0||numero>maximo){
                maximo=numero;
            }
            if(total==0||numero<minimo){
                minimo=numero;
            }
            suma+=numero;
            total++;
        }
    }while(numero!==0);

    if(total===0){
        alert('No has introducido ningun numero');
    }else{
        alert(`Maximo: ${maximo}, Minimo: ${minimo}, Suma: ${suma}, Total: ${total}`);
    }
}
// estadisticas();

function notas(){
    let aprobados=0;
    let suspensos=0;
    let suma=0;
    let media=0;
    let total=0;
    let nota;
    do{
        nota=parseFloat(prompt('Introduce una nota: (-1 para terminar)'));
        if(isNaN(nota)||nota<-1){
            alert('Introduce un numero valido');
        }else if(nota!==-1){
            if(nota>=5){
                aprobados++;
            }else{
                suspensos++;
            }
            ++total;
            suma+=nota;
            media=suma/total;
        }
    }while(nota!==-1);

    if(total===0){
        alert('No has introducido ninguna nota');
    }else{
        alert(`Aprobados: ${aprobados}, Suspensos: ${suspensos}, Media: ${media}`);
    }
}
// notas();
