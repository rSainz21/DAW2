'use strict';

/**
 * Devuelve el tipo de un valor.
 * typeof devuelve 'object' para null y para arrays, así que los distinguimos.
 */
function obtenerTipo(valor) {
    if (valor === null) {
        return 'null';
    }
    if (Array.isArray(valor)) {
        return 'array';
    }
    return typeof valor;
}

/**
 * Agrupa un número variable de parámetros por tipo.
 * Devuelve un objeto: { tipo: [ { posicion, valor }, ... ] }
 */
function agrupar(...parametros) {
    const grupos = {};

    for (let posicion = 0; posicion < parametros.length; posicion++) {
        const valor = parametros[posicion];
        const tipo = obtenerTipo(valor);

        // Si es la primera vez que aparece el tipo, creamos su colección
        if (!(tipo in grupos)) {
            grupos[tipo] = [];
        }

        // Guardamos el valor junto a su posición original
        grupos[tipo].push({ posicion: posicion, valor: valor });
    }

    return grupos;
}

/**
 * Muestra por consola cada tipo y sus elementos con la posición original.
 */
function mostrarGrupos(grupos) {
    for (const [tipo, elementos] of Object.entries(grupos)) {
        console.log(`Tipo: ${tipo}`);
        for (const elemento of elementos) {
            console.log(`   Posición ${elemento.posicion} -> ${String(elemento.valor)}`);
        }
    }
}

// ---------- Código auxiliar para probar la aplicación ----------
console.log('--- Prueba 1: mezcla de tipos ---');
mostrarGrupos(agrupar(1, 'hola', true, 25, 'adiós', null, [1, 2], { a: 1 }, undefined, 3.14));

console.log('--- Prueba 2: un solo tipo ---');
mostrarGrupos(agrupar('a', 'b', 'c'));

console.log('--- Prueba 3: sin parámetros ---');
mostrarGrupos(agrupar()); // No muestra nada