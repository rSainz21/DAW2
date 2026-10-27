'use strict';
import Juguete from './juguete.js';
import datos from './datos.js';

export default class Jugueteria {
    #contenedor;
    #juguetes;
    #contador;

    constructor() {
        this.#juguetes = [];
        this.#contador = 0;
        for (let dato of datos) {
            this.#juguetes.push(new Juguete(dato.jugueteId, dato.nombre, dato.marca, dato.precio));
            if (dato.jugueteId > this.#contador) {
                this.#contador = dato.jugueteId;
            }
        }
    }

    iniciarApp(selector) {
        this.#contenedor = document.querySelector(selector);
        if (!this.#contenedor) {
            alert(`No se ha encontrado el contenedor ${selector}`);
            return;
        }
        this.#asignarEventos();
        this.navegarInicio();
    }

    obtenerJuguetes(filtro) {
        if (!filtro) {
            return this.#juguetes;
        }
        let resultado = [];
        for (let juguete of this.#juguetes) {
            if (juguete.nombre.toLowerCase().includes(filtro.toLowerCase())) {
                resultado.push(juguete);
            }
        }
        return resultado;
    }

    obtenerJuguete(jugueteId) {
        for (let juguete of this.#juguetes) {
            if (jugueteId === juguete.jugueteId) {
                return juguete;
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
        for (let juguete of this.#juguetes) {
            if (jugueteId === juguete.jugueteId) {
                this.#juguetes.splice(this.#juguetes.indexOf(juguete), 1);
                return;
            }
        }
    }

    navegarInicio(filtro = '') {
        this.#contenedor.innerHTML =
            this.generarHTMLNavegacion() + this.generarHTMLBuscador() + this.generarHTMLListado(this.obtenerJuguetes(filtro));
        this.#contenedor.querySelector('#jg-buscador-filtro').value = filtro;
    }

    navegarListadoJuguetes() {
        this.#contenedor.innerHTML = this.generarHTMLNavegacion() + this.generarHTMLListado(this.obtenerJuguetes());
    }

    navegarPropiedades(juguete) {
        this.#contenedor.innerHTML = this.generarHTMLNavegacion() + juguete.generarHTMLPropiedades();
    }

    #asignarEventos() {
        this.#contenedor.addEventListener('click', (evento) => {
            let fila = evento.target.closest('[data-id]');

            switch (evento.target.dataset.destino) {
                case 'inicio':
                    this.navegarInicio();
                    break;
                case 'listadojuguetes':
                    this.navegarListadoJuguetes();
                    break;
            }

            switch (evento.target.dataset.accion) {
                case 'nuevo':
                    this.navegarPropiedades(new Juguete());
                    break;
                case 'ver':
                    this.navegarPropiedades(this.obtenerJuguete(Number(fila.dataset.id)));
                    break;
                case 'borrar':
                    this.borrarJuguete(Number(fila.dataset.id));
                    this.navegarListadoJuguetes();
                    break;
            }
        });

        this.#contenedor.addEventListener('submit', (evento) => {
            evento.preventDefault();

            switch (evento.target.dataset.componente) {
                case 'buscador':
                    this.navegarInicio(this.#contenedor.querySelector('#jg-buscador-filtro').value);
                    break;
                case 'propiedades':
                    this.#guardarJuguete();
                    break;
            }
        });
    }

    #guardarJuguete() {
        let jugueteId = Number(this.#contenedor.querySelector('#jugueteid').value);
        let nuevo = {
            nombre: this.#contenedor.querySelector('#nombre').value,
            marca: this.#contenedor.querySelector('#marca').value,
            precio: Number(this.#contenedor.querySelector('#precio').value)
        };

        if (jugueteId === 0) {
            this.crearJuguete(nuevo);
        } else {
            let juguete = this.obtenerJuguete(jugueteId);
            juguete.nombre = nuevo.nombre;
            juguete.marca = nuevo.marca;
            juguete.precio = nuevo.precio;
        }
        this.navegarListadoJuguetes();
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
        </form>`;
    }

    generarHTMLListado(listaJuguetes) {
        let filas = "";
        for (let juguete of listaJuguetes) {
            filas += `
            <div class="jg-tabla-fila" data-id="${juguete.jugueteId}">
                <div>${juguete.nombre}</div>
                <div>${juguete.marca}</div>
                <div>${juguete.precio}€</div>
                <div>
                    <input type="button" value="Ver" data-accion="ver">
                    <input type="button" value="Borrar" data-accion="borrar">
                </div>
            </div>`;
        }
        return `
        <div data-componente="listado" class="jg-tabla"> 
            <div class="jg-tabla-fila jg-cabecera"> 
                <div>Nombre</div>
                <div>Marca</div>
                <div>Precio</div> 
                <div>Acciones</div>
            </div> 
            ${filas}
            <div>
                <input type="button" value="Nuevo" data-accion="nuevo">
            </div>
        </div>`;
    }
}