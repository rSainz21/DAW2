'use strict';
function contadorCaracteres(texto){
    let contador=[];
    let textoValidado=texto.trim().toLowerCase();
    for(let letra of textoValidado){
        contador[letra]=(contador[letra]||0)+1
    }
    return contador;
}

let continuar;
do{
    let texto=prompt('introduce el texto');
    if(texto===null||texto===''){
        alert('texto vacio');
    }else{
        let resultado=contadorCaracteres(texto);
        console.log(resultado);
        for(let clave in resultado){
            console.log('"'+clave+'"->'+resultado[clave]);
        }
    }
    continuar=confirm('¿Quieres probar con otro texto?');

}while(continuar);