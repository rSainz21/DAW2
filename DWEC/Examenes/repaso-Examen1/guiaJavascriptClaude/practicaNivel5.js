'use strict';
function aleatorio(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + 1;
}

function adivinar() {
    let secreto = aleatorio(1, 100);
    let intentos = 0;
    let acertado = false;

    do {
        let numero = parseInt(prompt(`Introduce un numero del 1 al 100 (vas ${intentos} intentos de 5):`));
        if (isNaN(numero)) {
            alert('Introduce un numero!!!');
        } else {
            intentos++;
            if (numero === secreto) {
                acertado = true;
            } else if (numero < secreto) {
                alert('El numero secreto es mas alto');
            } else {
                alert('El numero es mas bajo');
            }
        }
    } while (!acertado && intentos <= 5);

    if (acertado) {
        alert('ganaste')
    } else {
        alert('perdiste pringao')
    }
}

function juego() {
    let opciones = ['piedra', 'papel', 'tijera'];
    let historial = [];
    let jugador;
    let ganador;
    for (let ronda = 1; ronda <= 5; ronda++) {
        do {
            jugador = prompt(`Ronda ${ronda}: piedra, papel o tijera`);
        } while (jugador !== 'piedra' && jugador !== 'papel' && jugador !== 'tijera');
        let maquina = opciones[aleatorio(0, 2)];
        if (jugador === maquina) {
            ganador = empate;
        } else if ((jugador === 'piedra' && maquina === 'tijera') ||
            (jugador === 'papel' && maquina === 'piedra') ||
            (jugador === 'tijera' && maquina === 'papel')) {
            ganador=jugador;
        }else{
            ganador=maquina;
        }
        historial.push({jugador: jugador, maquina: maquina, ganador: ganador});
        alert(`Maquina: ${maquina}. Gana ${ganador}`);
    }
    let texto='';
    for(let i in historial){
        texto+=`${Number(i)+l}`
    }
}