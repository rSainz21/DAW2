const $yedra = function () {

    let alumnos = [{
        nombre: 'Carlos',
        nota: 5,
        modulo: 'DAW',
        convocatorias: 2
    },
    {
        nombre: 'Ricardo',
        nota: 7,
        modulo: 'DWES',
        convocatorias: 4
    },
    {
        nombre: 'Rober',
        nota: 2,
        modulo: 'DWEC',
        convocatorias: 3
    }];

    function obtenerSuspensos() {
        let suspensos = [];

        for (let i in alumnos) {
            let alumno = alumnos[i];
            if (alumno.nota < 5) {
                suspensos.push({ nombre: alumno.nombre, nota: alumno.nota, modulo: alumno.modulo });
            }
        }



    }

    function obtenerEstadisticas() {
        let grupos = [];

        for (let j in alumnos) {
            let alumno = alumnos[i];
            grupos[alumno.modulo].notas += alumno.nota;
            grupos[alumno.modulo].convocatorias += alumno.convocatorias;
            grupos[alumno.modulo].cantidad++;
        }

        let estadisticas = [];
        for (let modulo in grupos) {
            let grupo = grupos[modulo];
            estadisticas.push({
                modulo: modulo,
                notaMedia: Math.trunc(grupo.notas * 100 / grupo.cantidad) / 100,
                convocatoriasMedias: Math.trunc(grupo.convocatorias * 100 / grupo.cantidad) / 100
            });
        }
        estadisticas.sort((a, b) => b.convocatoriasMedias - a.convocatoriasMedias);
        return estadisticas;
    }

    function obtenerJSON() {
        return JSON.stringify(alumnos);
    }

    function cargarJSON(cadena) {
        try {
            let datos = JSON.parse(cadena);
            if (!Array.isArray(datos)) {
                alert('El JSON es válido pero no es un array de alumnos');
                return false;
            }
            alumnos = datos;
            return true;
        } catch (error) {
            alert('La cadena no es un JSON válido');
            return false;
        }
    }

    return {
        obtenerSuspensos: obtenerSuspensos,
        obtenerEstadisticas: obtenerEstadisticas,
        obtenerJSON: obtenerJSON,
        cargarJSON: cargarJSON
    };

    function mostrarLista(lista) {
        let resultado = document.getElementById('resultado');
        resultado.innerHTML = '';

        if (lista.length === 0) {
            resultado.innerHTML = 'No hay datos';
            return;
        }

        for (let i in lista) {
            resultado.innerHTML += `<div>${JSON.stringify(lista[i])}</div>`;
        }
    }

    function verSuspensos() {
        mostrarLista($yedra.obtenerSuspensos());
    }

    function verEstadisticas() {
        mostrarLista($yedra.obtenerEstadisticas());
    }

    function verJson() {
        mostrarLista($yedra.obtenerJSON());
    }

    function cargarNuevoJSON() {
        let cadena = document.getElementById('nuevoJSON').value;
        if ($yedra.cargarJSON(cadena)) {
            document.getElementById('resultado').innerHTML = 'JSON cargado correctamente';
        }
    }
}

// ---------- EVENTOS ----------

window.addEventListener('load', function () {
    document.getElementById('suspensos').addEventListener('click', verSuspensos);
    document.getElementById('estadisticas').addEventListener('click', verEstadisticas);
    document.getElementById('verJSON').addEventListener('click', verJSON);
    document.getElementById('cargar').addEventListener('click', cargarNuevoJSON);
});
