'use strict';
function factorial(n){
    let resultado=1;
    let desarrollo='';
    for(let i=n;i>=1;i--){
        resultado*=i;
        desarrollo+=i;
        if(i>1){
            desarrollo+='x';
        }
    }
    if(n===0){
        desarrollo='0';
    }
    return desarrollo+'='+resultado;
}

let num=Number(prompt('Introduce el numero para calcular'));
alert(factorial(num));
let opcion;
do{
    opcion=Number(prompt('1.-Calcular otro factorial\n2.-Salir'));
    switch (opcion) {
        case 1:
            let f=Number(prompt('Introduce el numero para calcular'));
            alert(factorial(f));
            break;
        case 2:
            alert('Saliendo...')
            break
        default:
            alert('Introduce un valor valido')
            break;
    }

}while(opcion!==2);

