'use sctrict';
function dibujaFigura(generador, tamano) {
  alert(arrayATexto(generador(tamano)));
}

function ejercicio6() {
  let opcion;
  do {
    opcion = prompt(
      "Elige una figura:\n" +
      "1 - Cuadrado hueco\n" +
      "2 - Triángulo\n" +
      "3 - Rombo\n" +
      "0 - Terminar"
    );
    if (opcion === "0" || opcion === null) break;

    let tamano = Number(prompt("Tamaño de la figura:"));
    if (isNaN(tamano) || tamano <= 0) { alert("Tamaño no válido"); continue; }

    switch (opcion) {
      case "1": dibujaFigura(dibujaRectangulo, tamano); break;
      case "2": dibujaFigura(dibujaTriangulo, tamano); break;
      case "3": dibujaFigura(dibujaRombo, tamano); break;
      default:  alert("Opción no válida");
    }
  } while (opcion !== "0");
}