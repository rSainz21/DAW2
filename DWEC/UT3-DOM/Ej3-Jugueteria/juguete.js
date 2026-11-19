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

        let htmlPropiedades=document.createElement('form');
        htmlPropiedades.setAttribute('data-componente','propiedades');
        htmlPropiedades.setAttribute('name','jg-formulario');

        let id=document.createElement('input');
        txtNombre.setAttribute('type','hidden');
        txtNombre.setAttribute('id','jugueteid');
        txtNombre.setAttribute('value',this.#jugueteId);
        htmlPropiedades.appendChild(id);
        
        let divNombre=document.createElement('div');
        let lblNombre=document.createElement('label');
        lblNombre.textContent='Nombre';
        let txtNombre=document.createElement('input');
        txtNombre.setAttribute('type','text');
        txtNombre.setAttribute('id','nombre');
        txtNombre.setAttribute('value',this.#nombre);
        divNombre.appendChild(lblNombre);
        divNombre.appendChild(txtNombre);
        htmlPropiedades.appendChild(divNombre);

        let divMarca=document.createElement('div');
        let lblMarca=document.createElement('label');
        lblMarca.textContent='Marca';
        let txtMarca=document.createElement('input');
        txtMarca.setAttribute('type','text');
        txtMarca.setAttribute('id','marca');
        txtMarca.setAttribute('value',this.#marca);
        divMarca.appendChild(lblMarca);
        divMarca.appendChild(txtMarca);
        htmlPropiedades.appendChild(divMarca);

        let divPrecio=document.createElement('div');
        let lblPrecio=document.createElement('label');
        lblPrecio.textContent='Precio';
        let txtPrecio=document.createElement('input');
        txtPrecio.setAttribute('type','text');
        txtPrecio.setAttribute('id','precio');
        txtPrecio.setAttribute('value',this.#precio);
        divPrecio.appendChild(lblPrecio);
        divPrecio.appendChild(txtPrecio);
        htmlPropiedades.appendChild(divPrecio);

        let divBoton=document.createElement('div');
        let boton=document.createElement('input');
        boton.setAttribute('type','submit');
        boton.textContent='Guardar';
        divBoton.appendChild(boton);
        htmlPropiedades.appendChild(divBoton);

        return htmlPropiedades;


        /* return `
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
        </form>`; */
    }
}
