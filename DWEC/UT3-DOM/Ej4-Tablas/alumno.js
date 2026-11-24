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

let seleccionado=null;

let contenedor= document.createElement('div');
document.body.appendChild(contenedor);

let cabecera= document.createElement('div');
document.body.appendChild(cabecera);


function mostrarTabla(){
    contenedor.innerHTML='';
    seleccionado=null;

    let titulos= ['Nombre', 'Curso', 'Telefono', 'Email'];
    let filaCabecera=document.createElement('div');
    for(let i in titulos){
        let celda=document.createElement('div');
        celda.textContent=titulos[i];
        filaCabecera.appendChild(celda);
    }
    contenedor.appendChild(filaCabecera);

    let columnas= ['nombre', 'curso', 'telefono', 'email'];
    for(let i in alumnos){
        let alumno=alumnos[i];
        let fila=document.createElement('div');
        for(let c in columnas){
            let celda=document.createElement('div');
            celda.textContent=alumno[columnas[c]];
            fila.appendChild(celda);
        }
    }        

}

mostrarTabla();

