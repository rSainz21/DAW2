'use strict';
import datos from './datos.js';

class Libro{
    libroId;
    titulo;
    ISBN;
    autorId;
    bibliotecaId;
    prestamos;
    estaDisponible;
    constructor(libroId = 0, titulo = '', ISBN = '', autorId = 0, bibliotecaId = 0, prestamos = []) {
        this.libroId = libroId;
        this.titulo = titulo;
        this.ISBN = ISBN;
        this.autorId = autorId;
        this.bibliotecaId = bibliotecaId;
        this.prestamos = [];
        for (let prestamo of prestamos) {
            this.prestamos.push({
                fechaPrestamo: prestamo.fechaPrestamo,
                fechaDevolucion: prestamo.fechaDevolucion
            });
        }
    }

    get libroId() {
        return this.libroId;
    }
 
    get titulo() {
        return this.titulo;
    }
 
    set titulo(valor) {
        this.titulo = valor;
    }
 
    get ISBN() {
        return this.ISBN;
    }
 
    set ISBN(valor) {
        this.ISBN = valor;
    }
 
    get autorId() {
        return this.autorId;
    }
 
    set autorId(valor) {
        this.autorId = valor;
    }
 
    get bibliotecaId() {
        return this.bibliotecaId;
    }
 
    set bibliotecaId(valor) {
        this.bibliotecaId = valor;
    }
 
    get prestamos() {
        return this.prestamos;
    }
 
    get estaDisponible() {
        for (let prestamo of this.prestamos) {
            if (prestamo.fechaDevolucion === null) {
                return false;
            }
        }
        return true;
    }

    generarHTMLCreacion(){
        return `
        <form data-componente="libro-creacion" name="libro-creacion">
            <div>
                <label for="titulo">Titulo:</label>
                <input type type="text" id="titulo" name="titulo" required>
            </div>
            <div>
                <label for="isbn">ISBN:</label>
                <input type="text" id="isbn" name="isbn" required>
            </div>
            <div>
                <label for="autorid">Id del autor:</label>
                <input type="hidden" id="autorid" value="${this.autorId}" required>
            <div>
            <div>
                <label for="bibliotecaid">Id de la biblioteca:</label>
                <input type="hidden" id="bibliotecaid" value="${this.bibliotecaId}" required>
            <div>
                <button type="submit">Crear</button>
            </div>
        </form>`
    }

    generarHTMLPropiedades(){

        //si el libro esta disponible mostrare un boton para prestarlo, y si esta prestado se mostrara uno para devolverlo
        let disponible='';
        let botonPrestamo='';
        if(this.estaDisponible){
            disponible='Si';
            botonPrestamo='<input type="button" value="Crear prestamo" data-accion="crear-prestamo">';
        }else{
            disponible='No';
            botonPrestamo='<input type="button" value="Devolver prestamo" data-accion="devolver-prestamo">';
        }

        return `
        <form data-componente="creacion" data-id="${this.libroId}">

            <div>
                <label for="titulo">Titulo:</label>
                <input type type="text" id="titulo" name="titulo" value="${this.titulo}" required>
            </div>
            <div>
                <label for="isbn">ISBN:</label>
                <input type="text" id="isbn" name="isbn" value="${this.ISBN}" required>
            </div>
            <input type type="hidden" id="autorid" name="autorid" required>
            <input type type="hidden" id="bibliotecaid" name="bibliotecaid" required>
            <div>
                <input type="button" value="Guardar" data-accion="btnGuardar">
            </div>
            <div>
                <input type="button" value="Borrar" data-accion="btnBorrar">
            </div>
            <div>
                <input type="button" value="Listar prestamos" data-accion="listar-prestamos">
                ${botonPrestamo}
            </div>

        </form>`
    }

    generarHTMLListadoPrestamos(ListaPrestamos){
        let filas="";
        for (let prestamo of ListaPrestamos){
            let devolucion=prestamo.fechaDevolucion===null?'Pendiente':prestamo.fechaDevolucion;
            filas+=`
            <div class="tabla-fila">
                <div>${prestamo.titulo}</div>
                <div>${prestamo.ISBN}</div>
                <div>${prestamo.fechaPrestamo}</div>
                <div>${devolucion}</div>
            </div>`;
        }
        if(filas===''){
            filas=`<div class="tabla-fila"> 
                        <div>Este libro no tiene prestamos</div>
                    </div>`
        }

        return `
        <div data-componente="libro-prestamos" data-id="${this.libroId}"> 
            <div class="tabla-listado">
                <div class="tabla-fila cabecera"> 
                    <div>Nombre</div><div>Marca</div><div>Precio</div> 
                </div>
                ${filas}
            </div>
            <div>
                <input type="button" value="Volver" data-accion="volver">
            </div>
        </div>`;
    }
}
export default Libro;
