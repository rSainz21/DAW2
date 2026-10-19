function ej3(num){
    let resultado=[];
    for(let fila=0;fila<=num;++fila){
        let linea;
        for(let col=0;col<num;++col){
            if(fila===0||fila===num-1||col===0||col===num-1){
                linea+='*';
            }else{
                linea+=' ';
            }
        }
    }
}
    