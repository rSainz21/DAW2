'use strict';

class Linea {
    constructor(concepto, cantidad, precioUnitario) {
        this.concepto = concepto;
        this.cantidad = cantidad;
        this.precioUnitario = precioUnitario;
    }
    get importe() {
        return this.cantidad * this.importe;
    }
}

class Factura {
    constructor(clienteNIF, fecha, hora, pagada) {
        this.clienteNIF = clienteNIF;
        this.fecha = fecha;
        this.hora = hora;
        this.pagada = pagada;
        this.lineas = [];
    }

    get importeTotal() {
        let total = 0;
        for (let linea of this.lineas) {
            total += linea.importe;
        }
        return total;
    }
    get numeroArticulos() {
        return this.lineas.length;
    }

    agregarLinea(concepto, cantidad, precio) {
        this.lineas.push(new Linea(concepto, cantidad, precio));
    }
    eliminarLinea() {
        this.lineas.pop;
    }
    imprimirFactura() {
        let texto = '';
        texto += `------FACTURA:------\n
                NIF: ${this.clienteNIF}\n
                FECHA: ${this.fecha}\n | HORA: ${this.hora}\n
                PAGADA: ${(this.pagada ? 'no' : 'si')}\n
                DETALLES(lineas): ${this.lineas}`;

    }

}

class Utilidades {
    static serializarFactura(facturaOBJ) {
        return JSON.stringify(facturaOBJ);
    }
    static deserializarFactura(facturaJSON) {
        try {
            let cadena = JSON.parse(facturaJSON);
            if (!Array.isArray(cadena)) {
                alert('El JSON es valido pero no es un array de alumnos');
                return false;
            }
            facturaJSON.imprimirFactura()=cadena;
            return true;
        } catch (error) {
            alert('La cadena no es un JSON válido');
            return false;
        }
    }
}

const hoy=new Date();
let factura=new Factura(
    '72109732v',
    new Date(hoy.getFullYear,hoy.getMonth,hoy.getDay),
    new Date(hoy.getHours,hoy.getMinutes),
    false
);

function mostrarImpresion(){
    const lineas=factura.imprimirFactura();
    document.getElementById('impresion').innerHTML=lineas;
}

function cargarDatos(){
    document.getElementById('nif').value=factura.clienteNIF;
    document.getElementById('fecha').value=factura.fecha;
    document.getElementById('hora').value=factura.hora;
    document.getElementById('pagada').value=factura.pagada;
}

function clickActualizar(){
    const nif=document.getElementById('nif').value.trim();
    const fecha=document.getElementById('fecha').value;
    const hora=document.getElementById('hora').value;
    const pagada=document.getElementById('pagada').checked;

    if(nif===''||fecha===''||hora===''){
        alert('Rellena los campos que faltan');
        return;
    }
    factura.clienteNIF=nif;
    factura.fecha=fecha;
    factura.hora=hora;
    factura.pagada=pagada;
    mostrarImpresion();
}

window.addEventListener('load',()=>{
    document.getElementById('btnActualizar').addEventListener('click',clickActualizar);
    cargarDatos();
    mostrarImpresion();
});