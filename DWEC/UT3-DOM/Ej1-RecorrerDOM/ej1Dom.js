'use strict';
const dom = (function () {

    function obtenerEstructuraJSON(nodo) {
        if (nodo == undefined) {
            nodo = document.body;
        }

        let nodoJSON = {
            etiqueta: nodo.tagName.toLowerCase(),
            texto: '',
            tieneId: nodo.getAttribute('id') != null,
            lstClass: [],
            lstData: {},
            lstHijos: []
        };

        let texto = nodo.textContent;
        for (let i = 0; i < nodo.children.length; i++) {
            texto = texto.replace(nodo.children[i].textContent, '');
        }
        nodoJSON.texto = texto.trim();

        for (let i = 0; i < nodo.classList.length; i++) {
            nodoJSON.lstClass.push(nodo.classList[i]);
        }

        for (let clave in nodo.dataset) {
            nodoJSON.lstData[clave] = nodo.dataset[clave];
        }
            
        for (let i = 0; i < nodo.children.length; i++) {
            nodoJSON.lstHijos.push(obtenerEstructuraJSON(nodo.children[i]));
        }

        return nodoJSON;
    }

    function imprimirEstructura(selector) {
        let nodo = document.querySelector(selector);


        if (nodo == null) {
            alert('no hay ningun nodo en ' + selector);
            return '';
        }

        let camino = [];
        while (nodo != document) {
            camino.push(nodo);
            nodo = nodo.parentNode;
        }

        let cadena = "";
        for (let i = camino.length - 1; i >= 0; i--) {
            let actual = camino[i];

            let id = actual.getAttribute("id");
            if (id == null) {
                id = "noid";
            }

            let clases = actual.className;
            if (clases == "") {
                clases = "noclass";
            }

            let texto = actual.textContent;
            for (let j = 0; j < actual.children.length; j++) {
                texto = texto.replace(actual.children[j].textContent, "");
            }
            texto = texto.trim();

            cadena += actual.tagName.toLowerCase() + "-" + id + "-" + clases + "-" + texto + "\n";
        }

        console.log(cadena);
        return cadena;
    }

    return {
        obtenerEstructuraJSON: obtenerEstructuraJSON,
        imprimirEstructura: imprimirEstructura
    };

})();

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('btnJSON').addEventListener('click', () => {
        console.log(dom.obtenerEstructuraJSON());
    });

    document.getElementById('btnImprimir').addEventListener('click', () => {
        dom.imprimirEstructura(document.getElementById('selector').value);
    });
});