# Ejercicio: Gestión de libros con PHP y PDO (nivel «solución mínima»)

Mismo esqueleto que `SolucionMinimaConClases` del examen RA4, con otro dominio
y otros nombres. Tú escribes **index.php, la entidad y el servicio**. La **vista
te la damos hecha** (`presentacion/vista.php`), igual que en el examen.

## 1. Estructura de carpetas

```
ejercicio_libros/
├── index.php                  ← lo escribes tú
├── libros.db                  ← se crea sola al arrancar por primera vez
├── entidades/
│   └── Libro.php              ← lo escribes tú
├── negocio/
│   └── libroService.php       ← lo escribes tú
├── presentacion/
│   └── vista.php              ← APORTADA (no la toques)
└── ver.php                    ← APORTADA (opcional: muestra la tabla en la terminal)
```

## 2. Qué tienes que hacer

**2.1 Entidad `Libro`** (`entidades/Libro.php`)
- Propiedades públicas con tipo: `id` (int), `titulo` (string), `precio` (float).
- Constructor que recibe y asigna las tres.

**2.2 Servicio `LibroService`** (`negocio/libroService.php`)
- Se conecta con **PDO a SQLite** (`libros.db`, en la carpeta raíz del proyecto).
- Los errores de PDO deben lanzar **excepciones**.
- Si la base de datos **no existía**, crea la tabla `libros(id, titulo, precio)`
  (id autoincremental) y carga **2 libros iniciales** (ver apartado 4).
- Métodos (todos con consultas **preparadas** cuando hay datos externos):
  - `obtenerLibros(): array` → devuelve objetos `Libro`.
  - `altaLibro(Libro $libro): void`
  - `actualizarLibro(Libro $libro): void`
  - `borrarLibro(int $id): void`
  - `reemplazarLibro(string $tituloAntiguo, string $tituloNuevo, float $precio): void`
    → **una transacción**: borra el libro antiguo (por título) y inserta el nuevo.
    Si el antiguo no existe, o falla cualquier cosa, **rollback** y se relanza
    la excepción.

**2.3 `index.php`**
- Un bloque por botón, detectado por el `name` del botón: `insertar`, `actualizar`,
  `borrar`, `transaccion`. Cada acción termina **redirigiendo** a `index.php`.
- El botón de la transacción tiene los **valores fijados en el código**:
  sustituye el libro **«Poesía»** por **«Poesía Completa»** de **21 €**.
- La **precondición** (debe existir un libro llamado exactamente «Poesía») debe
  figurar en un **comentario** del código del `index.php` (y ya sale en la vista).
- Si la transacción falla, **la aplicación no se puede romper**: se recarga la
  lista igualmente.
- Al final: leer los libros y cargar la vista.

## 3. Reglas

- Usa solo lo que aparece en tus apuntes y en la solución mínima del examen.
- Sigue el estilo de la solución mínima (nombres, separación en carpetas).
- Los nombres de los botones y campos de la vista son: `insertar`, `actualizar`,
  `borrar`, `transaccion`, `id`, `titulo`, `precio`. Tu `index.php` tiene que
  usar **exactamente esos**. Mira la vista para ver cómo se usan `$libros` y
  las propiedades de cada libro.

## 4. Datos iniciales  *[dato de ejemplo inventado]*

| id | titulo | precio |
|---|---|---|
| 1 | Poesía | 9,50 |
| 2 | Teatro | 14,00 |

## 5. Cómo comprobar que lo has hecho bien

Arranca el servidor desde la carpeta del proyecto (`php -S localhost:8000`) y abre
`http://localhost:8000/index.php`.

1. Primera carga: se crea `libros.db` y salen **Poesía** y **Teatro**.
2. Insertar «Novela» a 11 €: aparece en la lista.
3. Cambiar «Teatro» por «Teatro Clásico» a 16 € y pulsar *Actualizar*: se guarda.
4. Pulsar *Borrar* en «Novela»: desaparece.
5. Pulsar *Ejecutar transacción*: «Poesía» se convierte en **«Poesía Completa»** a 21 €.
6. Pulsar *Ejecutar transacción* **otra vez**: la página **no se rompe** y no cambia nada (rollback).
7. Recargar la página varias veces: **no se duplican** libros.
8. `php ver.php` en la terminal muestra el estado real de la base de datos.

## 6. Pistas: en qué orden hacerlo

1. Entidad `Libro`.
2. Constructor del servicio (conexión + crear tabla y datos si la BD es nueva).
3. `obtenerLibros()` + el final del `index.php` (leer + cargar la vista). Ya debes ver la tabla.
4. `altaLibro()` + bloque `insertar`.
5. `actualizarLibro()` y `borrarLibro()` + sus bloques.
6. `reemplazarLibro()` (la transacción) + bloque `transaccion` con su `try/catch` y su comentario.

## 7. Errores en los que ya caíste haciendo el de productos

- `new PDO("sqlite:" . $ruta)`: con **punto**, no con coma.
- Cerrar el paréntesis del `CREATE TABLE`.
- Los `name` de los botones tienen que coincidir con los de la vista, o no pasa nada.
- El `require` de la vista va **al final** del `index.php`.
- Si cambias la tabla o los datos iniciales, **borra `libros.db`** para que se vuelva a crear.
- La extensión `pdo_sqlite` tiene que estar activada en tu `php.ini`.

Cuando termines (o te atasques), compara con la carpeta `Solucion_Libros`.
