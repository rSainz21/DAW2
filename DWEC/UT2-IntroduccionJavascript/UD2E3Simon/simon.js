const simon = (function () {
 
    //nombres de los colores
    const COLORES = ["verde", "rojo", "azul", "amarillo"];
 
    
    const juego = {
        estado: "parado",   
        secuencia: [],      
        posicion: 0,        
        mejorRacha: 0       
    };
 
    //color aleatorio
    function agregarColor() {
        let numero = Math.floor(Math.random() * COLORES.length);
        juego.secuencia.push(COLORES[numero]);   //añade el color a la ronda
    }
 
    function iniciar() {
        juego.estado = "jugando";   
        juego.secuencia = [];       
        juego.posicion = 0;         
        agregarColor();            
    }
 
    function ponerColor(color) {
        if (color !== juego.secuencia[juego.posicion]) {
            juego.estado = "parado";        // comprueaba si fallo se pone la partida en paradp
            return "fallo";
        }
 
        juego.posicion++;
 
        
        if (juego.posicion === juego.secuencia.length) {
            if (juego.secuencia.length > juego.mejorRacha) {
                juego.mejorRacha = juego.secuencia.length;     //si es la secuencia mas larga se convierte en mejorracha 
            }
            agregarColor();                 // se suma un color masa a la siguinete ronda
            juego.posicion = 0;             // y se vuelve a comprobar desde el principio
            return "ronda";
        }
 
        return "acierto";
    }
 
    // Devuelve copia dela secuencia
    function obtenerSecuencia() {
        return juego.secuencia.slice(0);
    }
 
    // devuelve la mejor racha
    function obtenerMejorRacha() {
        return juego.mejorRacha;
    }
 
    // Devuelve la posición que toca comprobar (= aciertos de la ronda actual)
    function obtenerPosicion() {
        return juego.posicion;
    }
 
    // Devuelve si la partida esta parada o jugando
    function obtenerEstado() {
        return juego.estado;
    }
 
    // Lo único que se ve desde fuera: los 6 métodos que pide el enunciado
    return {
        obtenerSecuencia: obtenerSecuencia,
        ponerColor: ponerColor,
        obtenerMejorRacha: obtenerMejorRacha,
        obtenerPosicion: obtenerPosicion,
        iniciar: iniciar,
        obtenerEstado: obtenerEstado
    };
})();
 
 

//  interfaz
 
// colores para los divs 
const colores = {
    verde: "boton verde",
    rojo: "boton rojo",
    azul: "boton azul",
    amarillo: "boton amarillo"
};
 
// Clase extra para encender un div (en simon.css: .verde.encendido...)
// Lleva un espacio delante para poder pegarla a las otras clases
const ENCENDIDO = " encendido";
 
// true mientras se está enseñando la secuencia: así se ignoran los clicks
let mostrando = false;
 
// Guarda el temporizador que apaga el color pulsado (para poder cancelarlo)
let temporizadorPulsado;
 
 
// ---------- Funciones para encender y apagar ----------
 
// Devuelve el div de un color buscándolo por su clase (los divs no tienen id)
function obtenerDiv(nombre) {
    return document.querySelector("." + nombre);
}
 
// Apaga todos los colores: cada div vuelve a sus clases normales ("boton verde")
function apagarTodos() {
    for (let nombre in colores) {
        obtenerDiv(nombre).className = colores[nombre];
    }
}
 
// Enciende un color: sus clases normales + "encendido" ("boton verde encendido")
function encender(nombre) {
    obtenerDiv(nombre).className = colores[nombre] + ENCENDIDO;
}
 
 
// ---------- Funciones de información ----------
 
// Lee un campo de milisegundos. Si está vacío o no es válido, usa el valor por defecto
function leerTiempo(id, porDefecto) {
    let tiempo = parseInt(document.getElementById(id).value);
    if (isNaN(tiempo) || tiempo <= 0) {
        return porDefecto;
    }
    return tiempo;
}
 
// Escribe un texto en el mensaje de la partida
function ponerMensaje(texto) {
    document.getElementById("mensaje").innerHTML = texto;
}
 
// Escribe la mejor racha y los aciertos ("2 de 5") pidiéndoselos a simon
function actualizarInfo() {
    document.getElementById("mejorRacha").innerHTML = simon.obtenerMejorRacha();
    document.getElementById("aciertos").innerHTML =
        simon.obtenerPosicion() + " de " + simon.obtenerSecuencia().length;
}
 
 
// ---------- Presentar la secuencia ----------
 
// Enseña la secuencia de simon color a color:
// apagar todo -> esperar -> encender -> esperar -> siguiente color
function mostrarSecuencia() {
    let secuencia = simon.obtenerSecuencia();                 // colores a enseñar
    let tiempoLuz = leerTiempo("tiempoLuz", 600);             // ms encendido
    let tiempoEspera = leerTiempo("tiempoEspera", 300);       // ms apagado entre colores
    let i = 0;                                                // color que toca enseñar
 
    mostrando = true;                                         // desde ya se ignoran los clicks
    ponerMensaje("Mira la secuencia...");
 
    // Cada llamada a paso() enseña UN color y programa la siguiente llamada
    function paso() {
        apagarTodos();                                        // 1. apagar todas las luces
 
        // Último valor: ya se han enseñado todos los colores
        if (i === secuencia.length) {
            mostrando = false;                                // ya se puede pulsar
            ponerMensaje("Tu turno");
            return;                                           // no se programa nada más
        }
 
        setTimeout(function () {                              // 2. esperar tiempo entre encendidos
            encender(secuencia[i]);                           // 3. iluminar la luz actual
            i++;                                              //    y pasar al siguiente valor
            setTimeout(paso, tiempoLuz);                      // 4. esperar tiempo de iluminación
        }, tiempoEspera);
    }
 
    paso();                                                   // arranca la primera vuelta
}
 
 
// ---------- Arrancar el juego ----------
 
// Se ejecuta al pulsar "Comenzar"
function comenzar() {
    // Si ya hay una partida en marcha, no hace nada
    if (simon.obtenerEstado() === "jugando") {
        return;
    }
    simon.iniciar();          // partida nueva en simon (secuencia de 1 color)
    actualizarInfo();         // "0 de 1"
    mostrarSecuencia();       // enseña la secuencia
}
 
 
// ---------- Pulsar un color ----------
 
// Se ejecuta al hacer click en un color. Recibe su nombre ("verde"...)
function pulsarColor(nombre) {
    // Si el juego está parado o se está enseñando la secuencia, no hace nada
    if (simon.obtenerEstado() === "parado" || mostrando) {
        return;
    }
 
    let resultado = simon.ponerColor(nombre);     // simon comprueba el color
 
    // Ilumina el color pulsado un momento
    clearTimeout(temporizadorPulsado);            // cancela el apagado de un click anterior
    apagarTodos();
    encender(nombre);
    temporizadorPulsado = setTimeout(apagarTodos, 300);
 
    actualizarInfo();                             // racha y aciertos al día
 
    if (resultado === "fallo") {
        ponerMensaje("¡Has perdido! Pulsa Comenzar para jugar otra vez");
    } else if (resultado === "ronda") {
        // simon ya tiene la secuencia nueva (1 color más). Enseño "N de N" de la que se acaba de completar
        let completada = simon.obtenerSecuencia().length - 1;
        document.getElementById("aciertos").innerHTML = completada + " de " + completada;
        ponerMensaje("¡Bien! Siguiente ronda");
        mostrando = true;                         // bloquea clicks durante la pausa
        setTimeout(function () {
            actualizarInfo();                     // "0 de N+1"
            mostrarSecuencia();                   // enseña la secuencia nueva
        }, 1000);
    }
}
 
 
// ---------- Evento load: se asocian los clicks ----------
window.addEventListener("load", function () {
    apagarTodos();
 
    // Botón Comenzar
    document.getElementById("btnComenzar").addEventListener("click", comenzar);
 
    // Un click por cada color. Cada función recuerda su "nombre"
    for (let nombre in colores) {
        obtenerDiv(nombre).addEventListener("click", function () {
            pulsarColor(nombre);
        });
    }
});