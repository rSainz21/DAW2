'use strict';
import datos from './datos.js';
import Libro from './libro.js';

class Autor{
    autorId;
    nombre;
    nacionalidad;
    biografia;
    libros;
    constructor(autorId = 0, nombre = '', nacionalidad = '', biografia = '', libros = []) {
        this.autorId=autorId;
        this.nombre=nombre;
        this.nacionalidad=nacionalidad;
        this.biografia=biografia;
        this.libros=[];
        for (let titulo of libros) {
            this.libros.push(titulo);
        }
    }

    get autorId() {
        return this.autorId;
    }
 
    get nombre() {
        return this.nombre;
    }
 
    set nombre(valor) {
        this.nombre = valor;
    }
 
    get nacionalidad() {
        return this.nacionalidad;
    }
 
    set nacionalidad(valor) {
        this.nacionalidad = valor;
    }
 
    get biografia() {
        return this.biografia;
    }
 
    set biografia(valor) {
        this.biografia = valor;
    }

    get libros() {
        return this.libros;
    }

    generarHTMLCreacion(){
        return `
        <form data-componente="autor-creacion" name="autor-creacion">
            <h2>Nuevo autor</h2>
            <div>
                <label for="nombre">Nombre:</label>
                <input type type="text" id="nombre" name="nombre" required>
            </div>
            <div>
                <label for="nacionalidad">Nacionalidad:</label>
                <input type="text" id="nacionalidad" name="nacionalidad">
            </div>
            <div>
                <label for="biografia">Biografia:</label>
                <input type type="text" id="biografia" name="biografia" required>
            </div>
            <div>
                <button type="submit">Crear</button>
            </div>
        </form>`
    }

    generarHTMLPropiedades() {
        let filas = '';
        for (const titulo of this.libros) {
            filas += `
            <div class="tabla-fila" data-titulo="${titulo}">
                <div>${titulo}</div>
                <div>
                    <input type="button" value="Eliminar" data-accion="eliminarlibro">
                </div>
            </div>`;
        }
        if (filas === '') {
            filas = '<div class="tabla-fila"><div>Este autor no tiene libros publicados</div></div>';
        }
 
        return `
        <div data-componente="autor-propiedades" data-id="${this.autorId}">
            
            <div>
                <label for="nombre">Nombre:</label>
                <input type type="text" id="nombre" name="nombre" value="${this.nombre}" required>
            </div>
            <div>
                <label for="nacionalidad">Nacionalidad:</label>
                <input type="text" id="nacionalidad" name="nacionalidad" value="${this.nacionalidad}" required>
            </div>
            <div>
                <label for="biografia">Biografia:</label>
                <input type type="text" id="biografia" name="biografia" value="${this.biografia}" required>
            </div>
            <h3>Libros publicados</div>
            <div class="listado-tabla">
                <div class="tabla-fila cabecera">
                    <div>Título</div><div>Acciones</div>
                </div>
                ${filas}
            </div>
            <div>
                <input type="button" value="Añadir libro" data-accion="anadirLibro">
                <input type="button" value="Borrar libro" data-accion="borrarLibro">
            </div>
        </div>`;
    }

}
export default Autor;