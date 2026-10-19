'use strict';

function ejercicio2() {
  const numeros = [];
  let entrada;

  do {
    entrada = prompt("Introduce un número (0 para terminar):");
    const numero = Number(entrada);

    if (entrada === null) break;           // el usuario canceló
    if (isNaN(numero)) {
      alert("Eso no es un número válido, inténtalo de nuevo");
      continue;
    }
    if (numero !== 0) numeros.push(numero);
  } while (Number(entrada) !== 0);

  if (numeros.length === 0) {
    alert("No se introdujo ningún número");
    return;
  }

  const maximo = Math.max(...numeros);
  const minimo = Math.min(...numeros);
  const suma = numeros.reduce((acumulado, n) => acumulado + n, 0);
  const media = suma / numeros.length;

  alert(
    `Máximo: ${maximo}\n` +
    `Mínimo: ${minimo}\n` +
    `Suma: ${suma}\n` +
    `Media: ${media.toFixed(2)}\n` +
    `Total introducidos: ${numeros.length}`
  );
}