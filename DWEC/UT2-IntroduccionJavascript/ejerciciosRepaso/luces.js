// Enunciado

// Hay 3 bombillas: roja, verde y azul. Empiezan apagadas, en gris.

// Al hacer click en una bombilla, cambia: si está apagada se enciende con su color, y si está encendida se apaga.
// Un texto dice cuántas hay encendidas, por ejemplo “Encendidas: 2 de 3”.
// Un botón Apagar todas las apaga.
// Reglas, las mismas que en el Simon
// La lógica va en una función autoinvocada luces.
// Guarda en un objeto JSON si cada bombilla está encendida.
// No toca la pantalla.
// Expone 4 métodos: cambiar(nombre), estaEncendida(nombre), contarEncendidas() y apagarTodas().
// La interfaz va aparte.
// Una función pintar() pone en pantalla lo que diga luces.
// Una función que maneja el click en una bombilla.
// Una función para el botón.
// Los clicks se asocian en el load.
// HTML: las bombillas son divs sin id y con dos clases (bombilla roja). Solo hay un button.
// Para recorrer el objeto, usa for...in.

const colores = {
    roja: 'bombilla roja',
    verde: 'bombilla verde',
    azul: 'bombilla azul'
};

function obtenerDiv(nombre) {
    return document.querySelector('.' + nombre)
}

function encenderDiv(nombre){
    obtenerDiv(nombre).className = colores[nombre] + ' encendida' ;
}

function apagarDiv(nombre){
    obtenerDiv(nombre).className=colores[nombre] ;
}

let luces={
    roja: false,
    verde: false,
    azul: false
};

function cambiar(nombre){
    if(!nombre){
        nombre=true;
    }
}

function estaEncendida(){
    return l
}

window.addEventListener("load", function () {
    encenderDiv('verde');
});
