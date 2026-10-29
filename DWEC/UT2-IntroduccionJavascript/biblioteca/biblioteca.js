'use strict';
import datos from './datos.js';
import Libro from './libro.js';
import Autor from './autor.js';

class Biblioteca {
    bibliotecaId;
    nombre;
    ubicacion;
    libros; 
 
    constructor(bibliotecaId = 0, nombre = '', ubicacion = '') {
        this.bibliotecaId = bibliotecaId;
        this.nombre = nombre;
        this.ubicacion = ubicacion;
        this.libros = [];
    }
 
    get bibliotecaId() {
        return this.bibliotecaId;
    }
 
    get nombre() {
        return this.nombre;
    }
 
    set nombre(valor) {
        this.nombre = valor;
    }
 
    get ubicacion() {
        return this.ubicacion;
    }
 
    set ubicacion(valor) {
        this.ubicacion = valor;
    }
 
    get libros() {
        return this.libros;
    }
 
    set libros(valor) {
        this.libros = valor;
    }

    generarHTMLCreacion() {
        return `
        <form data-componente="biblioteca-creacion" name="biblioteca-creacion>
        <h2>Nueva biblioteca</h2>

            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" required>
            </div>
            <div>
                <label for="ubicacion">Ubicación:</label>
                <input type="text" id="ubicacion" required>
            </div>
            <div>
                <button type="submit">Guardar</button>
            </div>
        </form>`;
    }
}

export default Biblioteca;