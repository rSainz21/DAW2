'use strict';

const $depurador = (function () {


    class NodoInspector {
        #nodoActual = null;


        constructor(nodoInicial) {
            this.#actualizarNodo(nodoInicial);
        }

        get esRaiz() {
            return this.#nodoActual === document.querySelector('body');
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

    let inspector = null;
    let panel = null;
    let estilo = null;
    let areaInfo = null;
    let btnPadre = null;
    let btnPrimerHijo = null;
    let btnUltimoHijo = null;
    let btnAnterior = null;
    let btnSiguiente = null;

    function activarDepuracion() {
        if (panel !== null) {
            return;
        }
        estilo = document.createElement('style');
        estilo.textContent = `.resaltado { outline: 3px solid rgba(225,0,128,1);
                            background-color: rgba(225,0,128,0.2); }`;
        document.querySelector('head').appendChild(estilo);

        panel = document.createElement('div');
        btnPadre = document.createElement('input');
        btnPadre.setAttribute('type', 'button');
        btnPadre.setAttribute('value', 'Padre');
        btnPadre.addEventListener('click', function () {
            inspector.irPadre();
        });
        panel.appendChild(btnPadre);

        btnPrimerHijo = document.createElement('input');
        btnPrimerHijo.setAttribute('type', 'button');
        btnPrimerHijo.setAttribute('value', 'Primer hijo');
        btnPrimerHijo.addEventListener('click', function () {
            inspector.irPrimerHijo();
        });
        panel.appendChild(btnPrimerHijo);

        btnUltimoHijo = document.createElement('input');
        btnUltimoHijo.setAttribute('type', 'button');
        btnUltimoHijo.setAttribute('value', 'Ultimo hijo');
        btnUltimoHijo.addEventListener('click', function () {
            inspector.irUltimoHijo();
        });
        panel.appendChild(btnUltimoHijo);


        btnAnterior = document.createElement('input');
        btnAnterior.setAttribute('type', 'button');
        btnAnterior.setAttribute('value', 'Anterior');
        btnAnterior.addEventListener('click', function () {
            inspector.irAnteriorHermano();
        });
        panel.appendChild(btnAnterior);

        btnSiguiente = document.createElement('input');
        btnSiguiente.setAttribute('type', 'button');
        btnSiguiente.setAttribute('value', 'Siguiente');
        btnSiguiente.addEventListener('click', function () {
            inspector.irSiguienteHermano();
        });
        panel.appendChild(btnSiguiente);

        areaInfo = document.createElement('div');
        panel.appendChild(areaInfo);
        document.body.appendChild(panel);
        inspector = new NodoInspector(document.body);
    }

    function refrescarPanel() {
        btnPadre.disabled = inspector.esRaiz;
        btnPrimerHijo.disabled = !inspector.tieneHijos;
        btnUltimoHijo.disabled = !inspector.tieneHijos;
        btnAnterior.disabled = inspector.esPrimerHijo;
        btnSiguiente.disabled = inspector.esUltimoHijo;

        areaInfo.textContent = '';
        const info = inspector.obtenerInfo();
        for (let i in info) {
            let linea = document.createElement('div');
            linea.textContent = `${i}:${info[i]}`;
            areaInfo.info.appendChild(linea);
        }
    }

    function desactivarDepuracion() {
        if (panel !== null) {
            return;
        }
        let resaltado = document.querySelector('.resaltado');
        if (resaltado !== null) {
            resaltado.classList.toggle('resaltado');
        }
        panel.remove();
        estilo.remove();
        inspector = null;
        estilo = null;
        panel = null;
        areaInfo = null;

    }

    return {
        activarDepuracion: activarDepuracion,
        desactivarDepuracion: desactivarDepuracion
    };

})();

document.getElementById('activar').addEventListener('click', function () {
    $depurador.activarDepuracion();
});1

document.getElementById('desactivar').addEventListener('click', function () {
    $depurador.desactivarDepuracion();
});