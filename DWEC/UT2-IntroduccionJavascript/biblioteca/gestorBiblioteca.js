'use strict';
import Libro from './libro.js';
import Autor from './autor.js';
import Biblioteca from './biblioteca.js';
import datos from './datos.js';

const $biblio= (function(){

    let libros=[];
    let autores=[];
    let bibliotecas=[];
    let contadorLibros=0;
    let contadorAutores=0;
    let contadorBibliotecas=0;
    let contenedor; 

    function cargarDatos(){

        for(let dato of datos.autores){
            autores.push(new Autor(dato.autorId,dato.nombre,dato.nacionalidad,dato.biografia,dato.libros));
            if(dato.autorId>contadorAutores){
                contadorAutores=dato.autorId;
            }
        }

        for(let dato of datos.libros){
            libros.push(new Libro(dato.libroId,dato.titulo,dato.ISBN,dato.autorId,dato.bibliotecaId,dato.prestamos));
            if(dato.libroId>contadorLibros){
                contadorLibros=dato.libroId;
            }
        }

        for(let dato of datos.bibliotecas){
            bibliotecas.push(new Biblioteca(dato.bibliotecaId,dato.nombre,dato.ubicacion));
            if(dato.bibliotecaId>contadorBibliotecas){
                contadorBibliotecas=dato.bibliotecaId;
            }
        }
    }

    cargarDatos();

    function buscarLibro(libroId){
        for(let libro of libros){
            if(libroId===libro.libroId){
                return libro;
            }
        }
    }

    function buscarAutor(autorId){
        for(let autor of autores){
            if(autorId===autor.autorId){
                return autor;
            }
        }

    }

    function buscarBiblioteca(bibliotecaId){
        for(let biblio of bibliotecas){
            if(bibliotecaId===biblio.bibliotecaId){
                return biblio;
            }
        }
    }

    function buscarLibrosPorTitulo(parametro){
        let resultado=[];
        for(let libro of libros){
            if(libro.titulo.toLowerCase().includes(parametro.toLowerCase())){
                resultado.push(libro);
            }
        }
        return resultado;
    }

    function buscarLibrosPorAutor(parametro){
        let resultado=[];
        for(let autor of autores){
            if(autor.nombre.toLowerCase().includes(parametro.toLowerCase())){

            }
        }
        return resultado;

    }

    function crearLibro(libro){
        contadorLibros++;
        let nuevo=new Libro(contadorLibros,libro.titulo,libro.ISBN,libro.autorId,libro.bibliotecaId);
        libros.push(nuevo);

        let autor=buscarAutor(libro.autorId);
        if(autor){
            autor.libros.push(libro.titulo);
        }
        return nuevo;
    }

    function crearAutor(autor){
        contadorAutores++;
        let nuevo=new Autor(contadorAutores,autor.nombre,autor.nacionalidad,autor.biografia);
        autores.push(nuevo);
        return nuevo;
    }

    function crearBiblioteca(biblio){
        contadorBibliotecas++;
        let nuevo=new Biblioteca(contadorBibliotecas,biblio.nombre,biblio.ubicacion);
        bibliotecas.push(nuevo);
        return nuevo;
    }

    function borrarLibro(libroId){
        let libro=buscarLibro(libroId);
        if(!libro){
            return;
        }

        let autor=buscarAutor(libro.autorId);
        if(autor){
            autor.libros.slice(autor.libros.indexOf(libro.titulo),1)
        }
        libros.splice(libros.indexOf(libro),1);
    }

    function borrarAutor(autorId){
        let autor=buscarAutor(autorId);
        if(!autor){
            return;
        }
        autores.splice(autores.indexOf(autor),1);
    }

    function borrarBiblioteca(bibliotecaId){
        let biblio=buscarBiblioteca(bibliotecaId);
        if(!biblio){
            return;
        }
        bibliotecas.splice(bibliotecas.indexOf(biblio),1);
    }

    function fechaHoy(){
        let hoy=new Date();
        let anio=hoy.getFullYear();
        let mes=hoy.getMonth()+1;
        let dia=hoy.getDate();
        
        if(mes<10){
            mes='0'+mes;
        }
        if(dia<10){
            dia='0'+dia;
        }

        return anio+'-'+mes+'-'+dia;
    }

    function crearPrestamo(libro){
        if(!libro.estaDisponible){
            return false;
        }
        libros.prestamos.push({fechaPrestamo: fechaHoy(), fechaDevolucion: null});
        return true;
    }

    function devolverPrestamo(libro){
        for(let prestamo of libro.prestamos){
            if(prestamo.fechaDevolucion===null){
                fechaDevolucion=fechaHoy();
                return true
            }
        }
        return false;
    }

    function generarHTMLListadoLibros(){
        let filas='';
        for(let libro of libros){
            let autor=buscarAutor(libro.autorId);
            let biblioteca=buscarBiblioteca(libro.bibliotecaId);
            let nombreAutor=autor?autor.nombre:'sin autor'
        }
    }

    return{
        buscarLibro,
        buscarAutor,
        buscarBiblioteca,
        crearLibro,
        crearAutor,
        crearBiblioteca,
        borrarLibro,
        borrarAutor,
        borrarBiblioteca,
        crearPrestamo,
        devolverPrestamo
    };

    function generarHTMLListadoLibros() {
        let filas = '';
        for (const libro of libros) {
            const autor = buscarAutor(libro.autorId);
            const biblioteca = buscarBiblioteca(libro.bibliotecaId);
            const nombreAutor = autor ? autor.nombre : 'Sin autor';
            const nombreBiblioteca = biblioteca ? biblioteca.nombre : 'Sin biblioteca';
            const disponible = libro.estaDisponible ? 'Sí' : 'No';
            filas += `
            <div class="tabla-fila" data-id="${libro.libroId}">
                <div>${libro.titulo}</div>
                <div>${nombreAutor}</div>
                <div>${nombreBiblioteca}</div>
                <div>${disponible}</div>
                <div>
                    <input type="button" value="Ver" data-accion="ver">
                    <input type="button" value="Editar" data-accion="editar">
                    <input type="button" value="Borrar" data-accion="borrar">
                </div>
            </div>`;
        }
 
        return `
        <div data-componente="listado-libros">
            <h2>Libros</h2>
            <div class="listado-tabla">
                <div class="tabla-fila cabecera">
                    <div>Título</div><div>Autor</div><div>Biblioteca</div><div>Disponible</div><div>Acciones</div>
                </div>
                ${filas}
            </div>
            <div>
                <input type="button" value="Crear libro" data-accion="crear">
            </div>
        </div>`;
    }









})();

export default $biblio;