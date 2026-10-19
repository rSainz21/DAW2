// Ejercicio 14 - Gestión académica (versión sencilla)

const alumnos = [
    {
        nombre: 'Ana',
        asignaturas: [
            { modulo: 'DWEC', nota: 8 },
            { modulo: 'DIW', nota: 7.5 },
            { modulo: 'DWES', nota: 9 },
            { modulo: 'DAW', nota: 6 }
        ]
    },
    {
        nombre: 'Luis',
        asignaturas: [
            { modulo: 'DWEC', nota: 5 },
            { modulo: 'DIW', nota: 4 },
            { modulo: 'DWES', nota: 6 },
            { modulo: 'DAW', nota: 3 }
        ]
    },
    {
        nombre: 'Marta',
        asignaturas: [
            { modulo: 'DWEC', nota: 10 },
            { modulo: 'DIW', nota: 9 },
            { modulo: 'DWES', nota: 8.5 },
            { modulo: 'DAW', nota: 9.5 }
        ]
    },
    {
        nombre: 'Pablo',
        asignaturas: [
            { modulo: 'DWEC', nota: 3 },
            { modulo: 'DIW', nota: 6 },
            { modulo: 'DWES', nota: 4.5 },
            { modulo: 'DAW', nota: 7 }
        ]
    }
];

// Añade a cada alumno las propiedades "media" y "promociona"
function calcularExpedientes(alumnos) {
    for (let i = 0; i < alumnos.length; i++) {
        const alumno = alumnos[i];
        let suma = 0;
        let promociona = true;

        for (let j = 0; j < alumno.asignaturas.length; j++) {
            const asignatura = alumno.asignaturas[j];
            suma += asignatura.nota;
            if (asignatura.nota < 5) {
                promociona = false;
            }
        }

        alumno.media = suma / alumno.asignaturas.length;
        alumno.promociona = promociona;
    }
}

// Imprime "Índice-Nombre-Media" de los que promocionan
function listarPromocionan(alumnos) {
    console.log('ALUMNOS QUE PROMOCIONAN');
    for (let i = 0; i < alumnos.length; i++) {
        if (alumnos[i].promociona) {
            console.log(`${alumnos[i].nombre} - nº${i} - Nota:${alumnos[i].media}`);
        }
    }
}

// Imprime "Índice-Nombre-Pendientes:[pendiente1, pendiente2]" de los que no promocionan
function listarNoPromocionan(alumnos) {
    console.log('ALUMNOS QUE NO PROMOCIONAN');
    for (let i = 0; i < alumnos.length; i++) {
        const alumno = alumnos[i];
        if (!alumno.promociona) {
            let pendientes = '';
            for (let j = 0; j < alumno.asignaturas.length; j++) {
                if (alumno.asignaturas[j].nota < 5) {
                    if (pendientes !== '') {
                        pendientes += ', ';
                    }
                    pendientes += alumno.asignaturas[j].modulo;
                }
            }
            console.log(`${alumno.nombre} - nº${i} - Pendientes:[${pendientes}]`);
        }
    }
}

// ---------- Pruebas ----------
calcularExpedientes(alumnos);
console.log(alumnos);
listarPromocionan(alumnos);
listarNoPromocionan(alumnos);