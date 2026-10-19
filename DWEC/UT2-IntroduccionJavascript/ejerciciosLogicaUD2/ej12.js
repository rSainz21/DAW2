'use strict';
function acertarNumero() {
    const minimo = 1;
    const rango = 100;
    const maxIntentos = 5;
    const secreto = Math.floor(Math.random() * rango) + minimo;
    let intentos = 0;
    let acertado = false;

    do {
        const num = Number(prompt(`Intento ${intentos + 1} de ${maxIntentos}: número entre 1 y 100`));
        if (isNaN(num) || num < 1 || num > 100) {
            alert('Número no válido');
        } else {
            intentos++;
            acertado = num === secreto;
            if (!acertado) {
                alert(num < secreto ? 'El secreto es MAYOR' : 'El secreto es MENOR');
            }
        }
    } while (!acertado && intentos < maxIntentos);

    alert(acertado ? `¡Ganaste en ${intentos} intentos!` : `Perdiste, era ${secreto}`);
}

acertarNumero();