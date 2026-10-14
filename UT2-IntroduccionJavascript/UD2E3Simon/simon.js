const simon = (function () {

    // nombres de colores
    const COLORES = ["verde", "rojo", "azul", "amarillo"];


    const juego = {
        estado: "parado",
        secuencia: [],
        posicion: 0,
        mejorRacha: 0
    };


    function colorAleatorio() {
        let posicion = Math.floor(Math.random() * COLORES.length);
        juego.secuencia.push(COLORES[posicion]);
    }


    function iniciar() {
        juego.estado = "jugando";
        juego.secuencia = [];
        juego.posicion = 0;
        colorAleatorio();
    }


    function obtenerSecuencia() {
        return juego.secuencia.slice(0);
    }


    function obtenerEstado() {
        return juego.estado;
    }


    function ponerColor(color) {
        if (color !== juego.secuencia[juego.posicion]) {
            juego.estado = 'parado';
            return 'fallo';
        }

        juego.posicion++;

        if (juego.posicion === juego.secuencia.length) {
            if (juego.secuencia.length > juego.mejorRacha) {
                juego.mejorRacha = juego.secuencia.length;
            }
            colorAleatorio();
            juego.posicion = 0;
            return 'ronda';
        }

        return 'acierto';
    }

    function obtenerMejorRacha() {
        return juego.mejorRacha;
    }

    function obtenerPosicion() {
        return juego.posicion;
    }

    return {
        obtenerSecuencia: obtenerSecuencia,
        ponerColor: ponerColor,
        obtenerMejorRacha: obtenerMejorRacha,
        obtenerPosicion: obtenerPosicion,
        iniciar: iniciar,
        obtenerEstado: obtenerEstado
    };
})();


// ===================== INTERFAZ =====================

const colores = {
    verde: "boton verde",
    rojo: "boton rojo",
    azul: "boton azul",
    amarillo: "boton amarillo"
};


const ENCENDIDO = " encendido";


function obtenerDiv(nombre) {
    return document.querySelector("." + nombre);
}


function apagarTodos() {
    for (let nombre in colores) {
        obtenerDiv(nombre).className = colores[nombre];
    }
}

function encender(nombre) {
    obtenerDiv(nombre).className = colores[nombre] + ENCENDIDO;
}


window.addEventListener("load", function () {
    apagarTodos();
    
});