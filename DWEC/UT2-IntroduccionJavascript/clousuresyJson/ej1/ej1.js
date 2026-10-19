function jugarDados(numLados) {

    function tirarDado() {
        return Math.floor(Math.random() * numLados) + 1;
    }

    return function () {
        let dadoJugador = tirarDado();
        let dadoMaquina = tirarDado();
        return [dadoJugador, dadoMaquina];
    }
}


let partida={
    tirarDados:null,
    tiradasTotales: 0,
    tiradasHechas: 0,
    victoriasJugador: 0,
    victoriasMaquina: 0
}

function mostrarVictoriasTotales(){
    document.getElementById('victoriasTotales').innerHTML=
    `Jugador: ${partida.victoriasJugador} victorias - Maquina: ${partida.victoriasMaquina} victorias`;
}

function comenzarPartida(){
    let lados = parseInt(document.getElementById('lados').value);
    let tiradas = parseInt(document.getElementById('tiradas').value);

    if (isNaN(lados) || lados < 2 || isNaN(tiradas) || tiradas < 1) {
        alert('Introduce un número de lados (mínimo 2) y un número de tiradas (mínimo 1)');
        return;
    }

    partida.tirarDados(lados);
    partida.tiradasTotales=tiradas;
    partida.tiradasHechas=0;
    partida.victoriasJugador=0;
    partida.victoriasMaquina=0;

    document.getElementById('resultados').innerHTML='ninguno todavia';
    mostrarVictoriasTotales();
}

function tirar(){
    if(partida.tirarDados===null){
        alert('primero dale a comenzar la partida');
        return;
    }
    if(partida.tiradasHechas===partida.tiradasTotales){
        alert('Se acabo la partida0');
        return;
    }

    let resultado=partida.tirarDados();
    let jugador=resultado[0];
    let maquina=resultado[1];
    partida.tiradasHechas++;

    if(jugador>maquina){
        victoriasJugador++;
        alert(`Jugador ${jugador} victorias | Maquina ${maquna} victorias ---> Gana Jugador`);
    }else if(jugador<maquina){
        victoriasMaquina++;
        alert(`Jugador ${jugador} victorias | Maquina ${maquna} victorias ---> Gana Maquina`);
    }
}

