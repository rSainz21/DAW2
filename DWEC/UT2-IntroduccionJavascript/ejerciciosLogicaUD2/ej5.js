'use sctrict';
function dibujaRombo(diagonal) {
  let filas = [];
  let mitad = Math.floor(diagonal / 2);

  // Mitad de ariba
  for (let i = 0; i <= mitad; i++) {
    let espacios = " ".repeat(mitad - i);
    let asteriscos = "*".repeat(2 * i + 1);
    filas.push(espacios + asteriscos);
  }

  // Mitad de abajo
  for (let i = mitad - 1; i >= 0; i--) {
    let espacios = " ".repeat(mitad - i);
    let asteriscos = "*".repeat(2 * i + 1);
    filas.push(espacios + asteriscos);
  }

  return filas;
}

function ejercicio5() {
  let diagonal = Number(prompt("Diagonal del rombo (mejor si es impar):"));
  if (isNaN(diagonal) || diagonal <= 0) { alert("Introduce un número positivo"); return; }
  alert(dibujaRombo(diagonal).join("\n"));
}