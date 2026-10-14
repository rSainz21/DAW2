'use strict';
/*15-Crea un programa de gestión de personal.
La entidad “trabajador” tiene las propiedades: “código”, “nombre”, “categoría”, 
“contratación”.
Donde:
• Propiedad “código” tiene el formato “E01”, “E02” y es un valor único identificativo del 
trabajador. Se asigna automáticamente al crear el trabajador y no puede modificarse.
• Propiedad “nombre” es el nombre del trabajador.
• Propiedad “categoría” puede tomar los valores, 1, 2, 3 y representa el salario base a 
percibir. Donde 1-1100€, 2-1400€, 3-1900€
• Propiedad “contratación” indica el año de contratación, necesario para calcular la 
antigüedad.
• El importe de la nomina se calcula en base a la categoría más un 4% por cada año de 
antigüedad.
Se pide:
Almacenar en un array los datos de mis trabajadores.
• Listar trabajadores.
• Crear trabajador.
• Borrar trabajador, solicitando el código y confirmación.
• Modificar trabajador, solicitando el código y ofreciendo como valor por defecto el 
valor actual.
• Calcular nóminas. Listado ordenado por categorías de nominas con un resumen del
importe total de las nóminas de cada categoría, así como el resumen final del importe 
total de todas las nóminas de la empresa.
Consideraciones:
• Puede/debes tener datos cacheados.
• Implementa un menú para interactuar con la aplicación. Incluye la opción de terminar.
• Añade validaciones.
• Estructura y comenta el código.*/

let trabajadores=[];
let contadorCodigos=0;

function nuevoTrabajador(nombre,categoria,contratacion){
    contadorCodigos++;
    let codigo=`E0${contadorCodigos}`;
    let trabajador={codigo: codigo, nombre: nombre, categoria: categoria, contratacion: contratacion};
    trabajadores.push(trabajador);
    return trabajador;
}

nuevoTrabajador('Ana Ruiz', 1, 2015);
nuevoTrabajador('Luis Pérez', 2, 2019);
nuevoTrabajador('Marta Gil', 3, 2010);
nuevoTrabajador('Pedro Sanz', 2, 2022);
nuevoTrabajador('Lucía Díaz', 1, 2024);



