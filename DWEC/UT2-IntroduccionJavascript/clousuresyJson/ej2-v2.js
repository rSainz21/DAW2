'use strict';
let alumnos = [{
    nombre: 'Carlos',
    nota: 5,
    modulo: 'DWES',
    convocatorias: 2
},
{
    nombre: 'Carlos',
    nota: 5,
    modulo: 'DWES',
    convocatorias: 2
},
{
    nombre: 'Carlos',
    nota: 5,
    modulo: 'DWES',
    convocatorias: 2
}];

function estadisticasPorModulo() {
    let modulos = [];
    let resultados = [];
    for (let alumno of alumnos) {
        if (!alumno.modulo in modulos) {
            modulos[alumno.modulo] = {
                total: 1,
                convocatorias: alumno.convocatorias,
                notas: alumno.nota
            };

        } else {
            modulos[alumno.modulo].total++,
            modulos[alumno.modulo].convocatorias += alumno.convocatorias,
            modulos[alumno.modulo].notas += alumno.notas
        }
    }
    for(let modulo in modulos){
        resultados.push({
            modulo: modulo,
            media: (Math.trunc(notas(total),2)),
            convocatoriaMedia: (Math.trunc(notas(convocatorias),2))
        })
    }
    return resultados;
}