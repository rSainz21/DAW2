'use strict';

// ======================= LÓGICA: $cesar =======================
const $cesar = (function () {
    const ALFABETO = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZ';   // 27 letras

    // Mueve cada letra "clave" posiciones a la DERECHA
    function cifrarTexto(textoPlano, clave) {
        let resultado = '';
        for (let i = 0; i < textoPlano.length; i++) {
            let letra = textoPlano[i];
            // 1. buscar la posición de la letra en el alfabeto
            let posicion = -1;
            for (let j = 0; j < ALFABETO.length; j++) {
                if (ALFABETO[j] === letra) {
                    posicion = j;
                }
            }
            // 2. si no es una letra (espacio, número, signo) se queda igual
            if (posicion === -1) {
                resultado += letra;
            } else {
                // 3. sumar la clave y dar la vuelta al final del alfabeto
                let nueva = (posicion + clave) % ALFABETO.length;
                resultado += ALFABETO[nueva];
            }
        }
        return resultado;
    }

    // Mueve cada letra "clave" posiciones a la IZQUIERDA
    function descifrarTexto(textoCifrado, clave) {
        let resultado = '';
        for (let i = 0; i < textoCifrado.length; i++) {
            let letra = textoCifrado[i];
            let posicion = -1;
            for (let j = 0; j < ALFABETO.length; j++) {
                if (ALFABETO[j] === letra) {
                    posicion = j;
                }
            }
            if (posicion === -1) {
                resultado += letra;
            } else {
                // restar la clave; si queda negativo, dar la vuelta por el final
                let nueva = (posicion - clave) % ALFABETO.length;
                if (nueva < 0) {
                    nueva += ALFABETO.length;
                }
                resultado += ALFABETO[nueva];
            }
        }
        return resultado;
    }

    return { cifrarTexto, descifrarTexto };
})();

// ======================= INTERFAZ =======================

function clickCifrar() {
    let clave = parseInt(document.getElementById('clave').value);
    if (isNaN(clave) || clave < 0) {
        alert('La clave tiene que ser un número de 0 o más');
        return;
    }
    let plano = document.getElementById('plano').value.toUpperCase();
    document.getElementById('cifrado').value = $cesar.cifrarTexto(plano, clave);
}

function clickDescifrar() {
    let clave = parseInt(document.getElementById('clave').value);
    if (isNaN(clave) || clave < 0) {
        alert('La clave tiene que ser un número de 0 o más');
        return;
    }
    let cifrado = document.getElementById('cifrado').value.toUpperCase();
    document.getElementById('plano').value = $cesar.descifrarTexto(cifrado, clave);
}

window.addEventListener('load', function () {
    document.getElementById('btnCifrar').addEventListener('click', clickCifrar);
    document.getElementById('btnDescifrar').addEventListener('click', clickDescifrar);
});