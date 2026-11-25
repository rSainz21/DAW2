// js/jugueteria.js
'use strict';
import Juguete from './juguete.js';
import datos from './datos.js';
class Jugueteria {
    // ===== PASO 1: propiedades y constructor =====
    #contenedor;
    #juguetes;
    #contador;
    constructor() {
        this.#juguetes = [];
        this.#contador = 0;
        for (let dato of datos) {
            this.#juguetes.push(new Juguete(dato.jugueteId, dato.nombre, dato.marca,
                dato.precio));
            if (dato.jugueteId > this.#contador) {
                this.#contador = dato.jugueteId;     // el siguiente id será el mayor + 1
            }
        }
    }
    // ===== PASO 2: métodos de datos (sin HTML) =====
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
        for (let i in this.#juguetes) {
            if (this.#juguetes[i].jugueteId === jugueteId) {
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
            if (this.#juguetes[i].jugueteId === jugueteId) {
                this.#juguetes.splice(i, 1);
                return;
            }
        }
    }
    // ===== PASO 3: métodos generarHTML (solo devuelven texto) =====
    generarHTMLNavegacion() {
        return `
        <div data-componente="navegacion">
            <input type="button" value="Inicio" data-accion="inicio">
            <input type="button" value="Listado" data-accion="listado">
        </div>`;
    }

    generarHTMLBuscador(filtro = '') {
        return `
        <div data-componente="buscador">
            <label>Buscar:</label>
            <input type="text" id="jg-filtro" value="${filtro}">
            <input type="button" value="Buscar" data-accion="buscar">
            </div>`;
    }

     generarHTMLListado(listaJuguetes) {
        let filas = '';
        for (let juguete of listaJuguetes) {
            filas += `
            <div data-id="${juguete.jugueteId}">
                <div>${juguete.nombre}</div>
                <div>${juguete.marca}</div>
                <div>${juguete.precio} €</div>
                <div>
                    <input type="button" value="Ver" data-accion="ver">
                    <input type="button" value="Borrar" data-accion="borrar">
                </div>
            </div>`;
        }
        return `
        <div data-componente="listado">
            <div>
                <div>Nombre</div><div>Marca</div><div>Precio</div><div>Acciones</div>
            </div>
            ${filas}
            <div>
                <input type="button" value="Nuevo" data-accion="nuevo">
            </div>
        </div>`;
    }
    // ===== PASO 4: arrancar y dibujar las vistas =====
    iniciarApp(selector) {
        this.#contenedor = document.querySelector(selector);
        if (!this.#contenedor) {
            alert(`No se ha encontrado el contenedor ${selector}`);
            return;
        }
        this.asignarEventos();
        this.navegarInicio();
    }
    navegarInicio(filtro = '') {
        this.#contenedor.innerHTML =
            this.generarHTMLNavegacion() +
            this.generarHTMLBuscador(filtro) +
            this.generarHTMLListado(this.obtenerJuguetes(filtro));
    }
    navegarListadoJuguetes() {
        this.#contenedor.innerHTML =
            this.generarHTMLNavegacion() +
            this.generarHTMLListado(this.obtenerJuguetes());
    }
    navegarPropiedades(juguete) {
        this.#contenedor.innerHTML =
            this.generarHTMLNavegacion() +
            juguete.generarHTMLPropiedades();
    }

    // ===== PASO 5: eventos (UN click en el contenedor para todo) =====
    asignarEventos() {
        this.#contenedor.addEventListener('click', (evento) => {
            let boton = evento.target.closest('[data-accion]');
            if (!boton) {
                return;
            }
            let fila = boton.closest('[data-id]');
            switch (boton.dataset.accion) {
                case 'inicio':
                    this.navegarInicio();
                    break;
                case 'listado':
                    this.navegarListadoJuguetes();
                    break;
                case 'buscar':
                    this.navegarInicio(this.#contenedor.querySelector('#jg-filtro').value);
                    break;
                case 'nuevo':
                    this.navegarPropiedades(new Juguete());
                    break;
                case 'ver':
                    this.navegarPropiedades(this.obtenerJuguete(Number(fila.dataset.id)));
                    break;
                case 'borrar':
                    if (prompt('¿Seguro que quieres borrarlo? (s/n)') === 's') {
                        this.borrarJuguete(Number(fila.dataset.id));
                    }
                    this.navegarListadoJuguetes();
                    break;
                case 'guardar': {
                    let nombre = this.#contenedor.querySelector('#jg-nombre').value.trim();
                    let marca = this.#contenedor.querySelector('#jg-marca').value.trim();
                    let precio = parseFloat(this.#contenedor.querySelector('#jg-precio').value);
                    if (nombre === '' || marca === '' || isNaN(precio) || precio < 0) {
                        alert('Datos no válidos');
                        return;
                    }
                    let jugueteId = Number(fila.dataset.id);
                    if (jugueteId === 0) {
                        this.crearJuguete({ nombre: nombre, marca: marca, precio: precio });
                    } else {
                        let juguete = this.obtenerJuguete(jugueteId);
                        juguete.nombre = nombre;          // setters
                        juguete.marca = marca;
                        juguete.precio = precio;
                    }
                    this.navegarListadoJuguetes();
                    break;
                }
            }
        });
    }
}
export default Jugueteria;
