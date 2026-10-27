'use strict';

export default class Juguete {
    #jugueteId;
    #nombre;
    #marca;
    #precio;

    constructor(jugueteId = 0, nombre = '', marca = '', precio = 0) {
        this.#jugueteId = jugueteId;
        this.#nombre = nombre;
        this.#marca = marca;
        this.#precio = precio;
    }

    get jugueteId() {
        return this.#jugueteId;
    }

    get nombre() {
        return this.#nombre;
    }

    set nombre(valor) {
        this.#nombre = valor;
    }

    get marca() {
        return this.#marca;
    }

    set marca(valor) {
        this.#marca = valor;
    }

    get precio() {
        return this.#precio;
    }

    set precio(valor) {
        this.#precio = valor;
    }

    generarHTMLPropiedades() {
        return `
        <form data-componente="propiedades" name="jg-formulario">
            <input type="hidden" id="jugueteid" name="jugueteid" value="${this.#jugueteId}">
            <div>
                <label for="nombre">Nombre del juguete:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ej. Camión de bomberos" value="${this.#nombre}" required>
            </div>
            <div>
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" placeholder="Ej. Hot Wheels" value="${this.#marca}" required>
            </div>
            <div>
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Ej. 19.99" step="0.01" value="${this.#precio}" required>
            </div>
            <div>
                <button type="submit">Guardar</button>
            </div>
        </form>`;
    }
}
