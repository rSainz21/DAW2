'use strict';

const alumnos = [
    {
        nombre: "Ana López",
        dni: "12345678A",
        curso: "2º Desarrollo Web",
        asignaturas: ["HTML", "CSS", "JavaScript", "React"],
        telefono: "600123456",
        email: "ana.lopez@example.com"
    },
    {
        nombre: "Carlos Martínez",
        dni: "23456789B",
        curso: "1º Administración de Sistemas",
        asignaturas: ["Linux", "Redes", "Hardware"],
        telefono: "650987654",
        email: "carlos.martinez@example.com"
    },
    {
        nombre: "Laura Sánchez",
        dni: "34567890C",
        curso: "3º Diseño Gráfico",
        asignaturas: ["Photoshop", "Illustrator", "UX Design"],
        telefono: "620111222",
        email: "laura.sanchez@example.com"
    },
    {
        nombre: "Mario Gómez",
        dni: "45678901D",
        curso: "1º Inteligencia Artificial",
        asignaturas: ["Python", "Machine Learning", "Data Science"],
        telefono: "670555444",
        email: "mario.gomez@example.com"
    }
];

let seleccionado = null;

let contenedor = document.createElement('div');
document.body.appendChild(contenedor);


function mostrarTabla() {

    contenedor.innerHTML = "";
    contenedor.classList.remove("contenedorFichas");
    seleccionado = null;

    // fila de la cabecera
    const titulos = ["Nombre", "Curso", "Teléfono", "Email"];
    const filaCabecera = document.createElement("div");
    filaCabecera.classList.add("filaCabecera");
    for (let i in titulos) {
        const celda = document.createElement("div");
        celda.classList.add("celda");
        celda.textContent = titulos[i];
        filaCabecera.appendChild(celda);
    }
    contenedor.appendChild(filaCabecera);

    // cada fila de alumno
    const columnas = ["nombre", "curso", "telefono", "email"];
    for (let i in alumnos) {
        const alumno = alumnos[i];
        const fila = document.createElement("div");
        fila.classList.add("fila");

        for (let c in columnas) {
            const celda = document.createElement("div");
            celda.classList.add("celda");
            celda.textContent = alumno[columnas[c]];
            fila.appendChild(celda);
        }

        

        // Click: solo una fila seleccionada
        fila.addEventListener("click", () => {
            if (seleccionado != null) {
                seleccionado.classList.remove("seleccionado");
            }
            fila.classList.add("seleccionado");
            seleccionado = fila;
        });

        contenedor.appendChild(fila);
    }
}

function mostrarFicha() {
    contenedor.innerHTML = "";
    contenedor.classList.add('contenedorFichas');
    seleccionado = null;

    for (let i in alumnos) {

        let alumno = alumnos[i];
        let ficha = document.createElement('div');
        ficha.classList.add('ficha');

        let nombre = document.createElement('div');
        nombre.textContent = alumno.nombre;
        ficha.appendChild(nombre);

        let dni = document.createElement('div');
        dni.textContent = 'DNI: ' + alumno.dni;
        ficha.appendChild(dni);

        let curso = document.createElement('div');
        curso.textContent = 'CURSO: ' + alumno.curso;
        ficha.appendChild(curso);

        let tituloAsignatura = document.createElement('div');
        tituloAsignatura.textContent = 'Asignaturas:';
        ficha.appendChild(tituloAsignatura);

        for (let a in alumno.asignaturas) {
            let asignatura = document.createElement('div');
            asignatura.textContent = '- ' + alumno.asignaturas[a];
            ficha.appendChild(asignatura);
        }

        let telefono = document.createElement('div');
        telefono.textContent = alumno.telefono;
        ficha.appendChild(telefono);

        let email = document.createElement('div');
        email.textContent = alumno.email;
        ficha.appendChild(email);

        
        ficha.addEventListener('click', () => {
            if (seleccionado != null) {
                seleccionado.classList.remove('seleccionado');
            }
            ficha.classList.add('seleccionado');
            seleccionado = ficha;
        });

        contenedor.appendChild(ficha);
    }
}

const botonTabla = document.getElementById("btnTabla");
const botonFicha = document.getElementById("btnFicha");

botonTabla.addEventListener("click", mostrarTabla);
botonFicha.addEventListener("click", mostrarFicha);

mostrarTabla();
