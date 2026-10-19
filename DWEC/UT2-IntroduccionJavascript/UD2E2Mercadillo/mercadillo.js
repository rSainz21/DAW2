'use strict';

const $negocio = (function () {

    let inventario = {
        "lampara": { cantidad: 5, precio: 12, categoria: "hogar" },
        "camiseta": { cantidad: 10, precio: 10, categoria: "ropa" },
        "silla": { cantidad: 7, precio: 20, categoria: "hogar" }
    };

    function agregarProducto(nombre, cantidad, precio, categoria) {
        for (let k in inventario) {
            if (k === nombre) {
                alert("el objeto ya existe en inventario")
            } else {
                inventario[nombre] = {
                    cantidad: cantidad,
                    precio: precio,
                    categoria: categoria
                };
            }
        }
    }

    function eliminarProducto(nombre) {
        for (let j in inventario) {
            if (j === nombre) {
                delete inventario[j];
            } else {
                alert("el producto no existe")
            }
        }
    }

    function buscarProducto(nombre) {
        for (let j in inventario) {
            if (j === nombre) {
                return {
                    nombre: j,
                    cantidad: inventario[j].cantidad,
                    precio: inventario[j].precio,
                    categoria: inventario[j].categoria
                };
            }
        }
        alert("el producto no existe");
    }

    function actualizarInventario(nombre, cantidad) {
        for (let j in inventario) {
            if (j === nombre) {
                let stockActualizado = inventario[j].cantidad + cantidad;
                if (stockActualizado < 0) {
                    alert("no hay suficiente stcok")
                    return;
                }
                inventario[j].cantidad = stockActualizado;
                if (stockActualizado === 0) {
                    alert("el stock se a quedado a 0, reponerlo");
                }
                return;
            }
        }
        alert("el producto no existe");
    }

    function listar() {
        let lista = [];
        for (let i in inventario) {
            lista.push({
                nombre: i,
                cantidad: inventario[nombre].cantidad,
                precio: inventario[nombre].precio,
                categoria: inventario[nombre].categoria
            });
        }
        return lista;
    }

    function ordenarProductosPorPrecio() {
        return listar().toSorted((a, b) => a.precio - b.precio);
    }

    function imprimirInventario() {
        let informe = [];
        for (let i in inventario) {
            informe.push({
                nombre: i,
                categoria: inventario[i].categoria,
                cantidad: inventario[i].cantidad,
                precio: inventario[i].precio,
                total: inventario[i].cantidad * inventario[i].precio
            });
        }
        return informe;
    }

    function filtrarProductosPorCategoria(categoria) {
        let listaFiltrada = [];
        for (let i in inventario) {
            if (i === categoria) {
                listaFiltrada.push({
                    nombre: inventario[i].nombre,
                    cantidad: inventario[i].cantidad,
                    precio: inventario[i].precio
                })
            }
        }
        return listaFiltrada;
    }

    function buscarProducto(nombre) {
        for (let j in inventario) {
            if (j === nombre) {
                return {
                    nombre: j,
                    cantidad: inventario[j].cantidad,
                    precio: inventario[j].precio,
                    categoria: inventario[j].categoria
                };
            }
        }
        alert("el producto no existe");
    }

    return {
        agregarProducto: agregarProducto,
        eliminarProducto: eliminarProducto,
        buscarProducto: buscarProducto,
        actualizarInventario: actualizarInventario,
        ordenarProductosPorPrecio: ordenarProductosPorPrecio,
        imprimirInventario: imprimirInventario,
        filtrarProductosPorCategoria: filtrarProductosPorCategoria
    };

})();

window.addEventListener("load", function () {

// --------esto es para mostrar los datos todavia no terminio los botones------------------------
    const inputNombre = document.getElementById("nombre");
    const inputCantidad = document.getElementById("cantidad");
    const inputPrecio = document.getElementById("precio");
    const inputCategoria = document.getElementById("categoria");
    const zonaResultado = document.getElementById("resultado");

    function mostrarHTML(lista) {
        if (lista.length === 0) {                     
        zonaResultado.innerHTML = '<div class="fila"><div>No hay productos</div></div>';
        return;
    }
        let html = "";
        for (let producto of lista) {
            html += '<div class="fila">';
        html += "<div>" + producto.nombre + "</div>";
        html += "<div>" + producto.categoria + "</div>";  
        html += "<div>" + producto.cantidad + "</div>";
        html += "<div>" + producto.precio + "</div>";
        html += "<div>" + producto.total + "</div>";       
        html += "</div>"; 
        }
        zonaResultado.innerHTML=html;
    }

// ----------------------------esto es para hacer ya los botones-------------------------------
    
    function clickAgregar(){
        const nombre = inputNombre.value.trim().toLowerCase();
        const cantidad=inputCantidad.value.
    }

});
