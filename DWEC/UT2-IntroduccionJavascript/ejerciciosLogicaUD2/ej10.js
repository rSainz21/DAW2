'use strict';
function contarCaracteres(texto){
    const contador={};
    for(let i=0;i<texto.length;i++){
        let caracter=texto.charAt(i);
        contador[caracter]=(contador[caracter]||0)+1;
    }
    return contador;
}

function mostrarContador(contador) {
    const entradas = Object.entries(contador);

    if (entradas.length === 0) {
        console.log('   (cadena vacía, no hay caracteres)');
        return;
    }

    for (const [caracter, apariciones] of entradas) {
        // JSON.stringify muestra el espacio como " " y no se pierde a la vista
        console.log(`   ${JSON.stringify(caracter)} -> ${apariciones}`);
    }
}

// ---------- Código auxiliar para probar la aplicación ----------
console.log('--- Prueba 1: palabra con repetidos ---');
mostrarContador(contarCaracteres('banana'));

console.log('--- Prueba 2: frase con espacios y mayúsculas ---');
mostrarContador(contarCaracteres('Hola Mundo'));

console.log('--- Prueba 3: cadena vacía ---');
mostrarContador(contarCaracteres(''));

console.log('--- Prueba 4: parámetro no válido ---');
try {
    contarCaracteres(123);
} catch (error) {
    console.log(`   Error capturado: ${error.message}`);
}

function contarLetras(cadena){
    
}