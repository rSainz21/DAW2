function cuadrado(lado){
    let figura="";

    for(let i=1;i<=lado;i++){
        for(let j=1;j<=lado;j++){
            if(i===1||i===lado||j===1||j===lado){
                figura+="*";
            }else{
                figura+=" ";
            }
        }
        figura+="\n";
    }
    return figura;
}
function pideLado(){
    let l=Number(prompt("Ingresae el lado del cuadrado: "));
    if(isNaN(l)||l<=0){
        return;
    }
    alert(cuadrado(l));
}
pideLado();