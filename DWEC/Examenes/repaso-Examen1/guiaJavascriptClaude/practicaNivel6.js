'use strict';
const $discos = (function () {
    let discos = [
        { titulo: 'filipense', artista: 'la pantera', anio: 2026 },
        { titulo: '1 semana increible', artista: 'la pantera', anio: 2024 },
        { titulo: 'yhlqmdlg', artista: 'badbunny', anio: 2018 }
    ];

    function buscar(titulo) {
        for (let i = 0; i < discos.length; i++) {          // ✔ for normal en vez de for...in
            if (discos[i].titulo === titulo) {
                return i;                                    // ✔ ya es número, no hace falta Number
            }
        }
        return -1;
    }

    function listar() {
        let texto = '';
        for (let disco of discos) {
            texto += `${disco.titulo} - ${disco.artista} - ${disco.anio}\n`;   // ✔ salto de línea
        }
        alert(texto === '' ? 'No hay discos' : texto);
    }

    function crear() {
        let titulo = prompt('Introduce el titulo:');
        if (!titulo) {                                       // ✔ vacío o cancelar
            alert('Tienes que introducir un titulo');
            return;
        }
        let artista = prompt('Introduce el artista:');
        if (!artista) {                                      // ✔
            alert('Tienes que introducir un artista');
            return;
        }
        let anio = Number(prompt('Introduce el año:'));
        if (isNaN(anio) || anio === 0) {                     // ✔ isNaN(anio), con paréntesis
            alert('Tienes que introducir un año válido');   // ✔ el mensaje decía "nombre"
            return;
        }
        discos.push({ titulo: titulo, artista: artista, anio: anio });
        alert('Disco añadido');
    }

    function borrar() {
        let posicion = buscar(prompt('Introduce el titulo que vas a borrar:'));
        if (posicion === -1) {
            alert('No existe ese disco');
            return;
        }
        let pregunta = prompt('¿Lo quieres borrar fijo? (s/n)');
        if (pregunta !== null && pregunta.toLowerCase() === 's') {   // ✔ toLowerCase()
            discos.splice(posicion, 1);                               // ✔ splice, no slice
            alert('Borrado');
        }
    }

    function menu() {
        let opcion;
        do {
            opcion = prompt('1.Listar\n2.Crear\n3.Borrar\n0.Terminar:');
            switch (opcion) {
                case '1':
                    listar();
                    break;
                case '2':
                    crear();
                    break;
                case '3':
                    borrar();
                    break;
                case '0':
                    alert('saliendo...');
                    break;
                default:
                    alert('eso no vale');
                    break;
            }
        } while (opcion !== '0');
    }

    return { menu };
})();

$discos.menu();