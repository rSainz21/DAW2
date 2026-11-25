'use strict';
class Juguete {
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
    // Formulario con los datos del juguete. data-id = 0 significa juguete nuevo
    generarHTMLPropiedades() {
        return `
        <div data-componente="propiedades" data-id="${this.#jugueteId}">
            <div>
                <label>Nombre:</label>
                <input type="text" id="jg-nombre" value="${this.#nombre}">
            </div>
            <div>
                <label>Marca:</label>
                <input type="text" id="jg-marca" value="${this.#marca}">
            </div>
            <div>
                <label>Precio:</label>
                <input type="number" id="jg-precio" value="${this.#precio}">
            </div>
            <div>
                <input type="button" value="Guardar" data-accion="guardar">
            </div>
        </div>`;
    }
}
export default Juguete;
