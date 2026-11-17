'use strict';

const $depurador = (function () {


    class NodoInspector {
        #nodoActual = null;


        constructor(nodoInicial) {
            this.#actualizarNodo(nodoInicial);
        }

        get esRaiz() {
            return this.#nodoActual === document.querySelector('html');
        }

        get esPrimerHijo() {
            return this.#nodoActual.previousElementSibling === null;
        }

        get esUltimoHijo() {
            return this.#nodoActual.nextElementSibling === null;
        }

        get tieneHijos() {
            return this.#nodoActual.firstElementChild !== null;
        }

        #actualizarNodo(nuevoSeleccionado) {
            if (this.#nodoActual !== null) {
                this.#nodoActual.classList.toggle('resaltado');
            }
            this.#nodoActual = nuevoSeleccionado;
            this.#nodoActual.classList.toggle('resaltado');
        }


        irPadre() {
            if (!this.esRaiz) {
                this.#actualizarNodo(this.#nodoActual.parentNode);
            }
        }

        irPrimerHijo() {
            if (this.tieneHijos) {
                this.#actualizarNodo(this.#nodoActual.firstElementChild);
            }
        }

        irUltimoHijo() {
            if (this.tieneHijos) {
                this.#actualizarNodo(this.#nodoActual.lastElementChild);
            }
        }

        irAnteriorHermano() {
            if (!this.esPrimerHijo) {
                this.#actualizarNodo(this.#nodoActual.previousElementSibling);
            }
        }

        irSiguienteHermano() {
            if (!this.esUltimoHijo) {
                this.#actualizarNodo(this.#nodoActual.nextElementSibling);
            }
        }

        obtenerInfo() {
            let texto = this.#nodoActual.textContent.trim();
            let clases = this.#nodoActual.className.replace('resaltado', '').trim();

            return {
                etiqueta: this.#nodoActual.tagName,
                texto: texto || '',
                clases: clases || ''
            };

        }
    }

    let inspector=null;
    let panel=null;
    let estilo=null;
    let btnRaiz=null;
    let btnPadre=null;
    let btnPrimerHijo=null;
    let btnUltimoHijo=null;
    let btnAnterior=null;
    let btnSiguiente=null;
    
    function activarDepuracion(){
        if(panel!==null){
            return;
        }
        estilo=document.createElement('style');
        estilo.textContent=`.resaltado { outline: 3px solid rgba(225,0,128,1);
                            background-color: rgba(225,0,128,0.2); }`;
        
    }

    function desactivarDepuracion(){

    }

    return{

    };

})();

document.getElementById('activar').addEventListener('click',function(){
    $depurador.activarDepuracion();
})

document.getElementById('desactivar').addEventListener('click',function(){
    $depurador.desactivarDepuracion();
})