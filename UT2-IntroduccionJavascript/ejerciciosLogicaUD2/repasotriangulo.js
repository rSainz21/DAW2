function triangulo(n){
    let figura="";
    for(let i=1;i<=n;i++){
        for(let espacios=1;espacios<=n-i;espacios++){
            figura+=" ";
        }
        for(let asteriscos=1;asteriscos<=2*i-1;asteriscos++){
            figura+="*";
        }
        figura+="\n";
    }
    return figura;
}

function pideAltura(){
    let altura=Number(prompt("Introduce la altura del triangulo: "));
    if(isNaN(altura)||altura<=0){
        return;
    }
    alert(triangulo(altura));
}

pideAltura();