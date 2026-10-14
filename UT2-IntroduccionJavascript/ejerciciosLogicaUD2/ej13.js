'use strict';
function calcularAleatorio(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function juegoMates() {

    let operadores = ['+', '-', '*', '/'];
    let historial = [];
    let continuar;

    do {
        for (let i = 0; i < 4; i++) {
            let aleatorio1 = calcularAleatorio(1, 10);
            let aleatorio2 = calcularAleatorio(1, 10);
            let operador = [Math.floor(Math.random() * (operadores.length - 1))];

            let solucion = 0;
            switch (operador) {
                case '+':
                    solucion = aleatorio1 + aleatorio2;
                    break;
                case '-':
                    solucion = aleatorio1 - aleatorio2;
                    break;
                case '*':
                    solucion = aleatorio1 * aleatorio2;
                    break;
                case '/':
                    solucion = aleatorio1 / aleatorio2;
                    break;

                default: 'mira a ver'
                    break;
            }
            let respuesta;
            let acierto = false;
            do {
                respuesta = Number(prompt(`¿Cuanto es ${aleatorio1} ${operador} ${aleatorio2}?`));

            } while (isNaN(respuesta));

            if (respuesta == solucion) {
                acierto = true;
                alert('Correcto!!!');
            } else {
                alert(`Incorrecto, el resultado era ${solucion}`);
            }
            historial.push({
                pregunta: aleatorio1 + operador + aleatorio2,
                respuesta: respuesta,
                acierto: acierto
            })
        }

        let opcion = prompt('Quieres jugar otra vez?("s"|"n")');
        switch (opcion) {
            case 's':
                continuar = true;
                break;
            case 'n':
                continuar = false;
                break;
            default:
                alert('Opcion no valida se acabo el juego');
                continuar = false;
                break;
        }
    } while (continuar);

    let resumen = 'RESUMEN\n\n';
    let acertadas = 0;
    let falladas = 0;
    for (let i = 0; i < historial.length; i++) {
        const p = historial[i];
        resumen += `${i + 1}. ${p.pregunta} = ${p.respuesta} -> ${p.acierto ? 'Acierto' : 'Fallo'}\n`;
        if (p.acierto) {
            acertadas++;
        } else {
            falladas++;
        }
    }
    resumen += `\nAcertadas: ${acertadas}\nFalladas: ${falladas}`;
    alert(resumen);
}