'use strict';
import Juguete from './juguete.js';
import datos from './datos.js';

export default class Jugueteria {
    #contenedor;
    #juguetes;
    #contador;
    constructor(contenedor, juguetes, contador) {
        this.#contenedor = contenedor;
        this.#juguetes = [];
        this.#contador = 0;
    }

    iniciarApp(selector) {
        this.#contenedor = document.querySelector(selector);
        if (!this.#contenedor) {
            alert(`No se ha encontrado el contenedor ${selector}`);
            return;
        }
    }

    obtenerJuguetes(filtro) {
        if (!filtro) {
            return this.#juguetes;
        }
        let resultado = [];
        for (let i in this.#juguetes) {
            let juguete = this.#juguetes[i];
            if (juguete.nombre === filtro) {
                resultado.push(juguete);
            }
        }
        return resultado;
    }

    obtenerJuguete(jugueteId) {
        for (let i in this.#juguetes) {
            if (jugueteId === this.#juguetes[i].jugueteId) {
                return this.#juguetes[i];
            }
        }
    }

    crearJuguete(nuevo) {
        this.#contador++;
        let juguete = new Juguete(this.#contador, nuevo.nombre, nuevo.marca, nuevo.precio);
        this.#juguetes.push(juguete);
        return juguete;
    }

    borrarJuguete(jugueteId) {
        for (let i in this.#juguetes) {
            if (jugueteId === this.#juguetes[i].jugueteId) {
                this.#juguetes.splice(i, 1);
                return;
            }
        }
    }

    generarHTMLNavegacion() {
        return `
        <nav data-componente="navegacion" class="jg-navegacion"> 
            <ul> 
                <li><a href="#" data-destino="inicio">Inicio</a></li> 
                <li><a href="#" data-destino="listadojuguetes">Listado</a></li> 
            </ul> 
        </nav>`;
    }

    generarHTMLBuscador() {
        return `
        <form data-componente="buscador" name="jg-buscador">
            <input type="text" id="jg-buscador-filtro" placeholder="Buscar por nombre..." />
            <button type="submit">Buscar</button>
        </form>`
    }

    generarHTMLListado(listaJuguetes) {
        let filas = "";
        for (let i of listaJuguetes) {
            let juguete = listaJuguetes[i];
            filas += `
            <div class="jg-tabla-fila" data-id=${juguete.jugueteId}>
                <div>${juguete.nombre}</div>
                <div>${juguete.marca}<div>
                <div>${juguete.precio}€
            <div>
                <input type="button" value="Ver" data-accion="ver">
                <input type="button" value="Borrar" data-accion="borrar">
            </div>`;
        }
        return `
        <div data-componente="listado" class="jg-tabla"> 
            <div class="jg-tabla-fila jg-cabecera"> 
                <div>Nombre</div>
                <div>Marca</div>
                <div>Precio</div> 
        </div> 
3 
            ${filas}
            <div>
                <input type="button" value="Nuevo" data-accion="nuevo">
            </div>
        </div>`;
    }
}
