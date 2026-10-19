'use sctrict';
function tablaMultiplicar(numero) {
  let resultado = "Tabla del " + numero + ":\n";
  for (let i = 1; i <= 10; i++) {
    resultado = resultado + numero + " x " + i + " = " + (numero * i) + "\n";
  }
  return resultado;
}

function ejercicio7a() {
  let n = Number(prompt("Número para mostrar su tabla:"));
  if (isNaN(n)) { alert("Número no válido"); return; }
  alert(tablaMultiplicar(n));
}

function ejercicio7b() {
  let n1 = Number(prompt("Primer número (0-10):"));
  let n2 = Number(prompt("Segundo número (0-10):"));

  let n1Valido = (!isNaN(n1) && n1 >= 0 && n1 <= 10);
  let n2Valido = (!isNaN(n2) && n2 >= 0 && n2 <= 10);

  if (!n1Valido || !n2Valido) {
    alert("Ambos números deben estar entre 0 y 10");
    return;
  }

  let menor = n1;
  let mayor = n2;
  if (n2 < n1) {
    menor = n2;
    mayor = n1;
  }

  let salida = "";
  for (let i = menor; i <= mayor; i++) {
    salida = salida + tablaMultiplicar(i) + "\n";
  }
  alert(salida);
}
