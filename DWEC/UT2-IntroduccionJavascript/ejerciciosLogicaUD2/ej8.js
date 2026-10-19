
function factorial(num){
    if(num<0) return "Ese numero no vale";
    if(num===0) return "El 0 no vale tampoco";

    let resultado=1; 
    let desarrollo="";

    for(let i=num;i>=1;i--){
        resultado=resultado*i;
        if(i===1){
            desarrollo=desarrollo+i;
        }else{
            desarrollo=desarrollo+i+"x";
        }
    }
    return desarrollo + "=" + resultado;
}
console.log(factorial(4));