# Práctica 1 · Unidad 5 — Accesibilidad. Aula Abierta

**Diseño de Interfaces Web · DAW · Curso 2026/2027**
**Alumno:** Roberto Sainz Arjona

---

## EJERCICIO 1

### 1. Prueba inicial con Tab y Shift+Tab

En la página original **no se ve en qué enlace o campo estoy**. La última regla de `estilos.css` elimina el contorno de foco a todos los elementos interactivos:

```css
a:focus, button:focus, input:focus, textarea:focus { outline: none; }
```

Al pulsar Tab el foco avanza (Cursos → Inscripción → "Haz clic aquí" → correo → consulta → botón), pero no hay ninguna señal visual, así que un usuario de teclado se pierde.

### 2. Prueba inicial con zoom al 200 %

El contenido **no se adapta bien**:

- Las tarjetas tienen `grid-template-columns: 360px 360px`. Con zoom al 200 % no caben y aparece **barra de desplazamiento horizontal**.
- La imagen decorativa (círculos) queda encima del título y del texto del hero y dificulta la lectura.

### 3 y 4. Problemas encontrados y corrección

| Categoría | Problema en el original | Corrección aplicada |
|---|---|---|
| **a. Idioma y título** | `<html>` sin `lang`; `<title>Página</title>` no describe nada. | `<html lang="es">` y `<title>Aula Abierta · Talleres gratuitos de diseño web</title>`. |
| **b. Estructura semántica y encabezados** | Todo son `div` (cabecera, menú, pie). No hay `h1`: empieza por `h2` y salta a `h3` y `h4`. | `header`, `nav` (con lista `ul`), `main`, `section`, `footer`. Jerarquía correcta: `h1` (hero) → `h2` (Próximos talleres, Solicita información) → `h3` (cada tarjeta). Añadido enlace "Saltar al contenido principal". |
| **c. Alternativas textuales** | La imagen decorativa tenía un `alt` descriptivo ("Tres círculos…"), que solo mete ruido al lector de pantalla. La imagen del proceso (informativa) no tenía `alt`. | Decorativa: `alt=""`. Informativa: `alt="Proceso para crear una web en tres pasos: 1. Planificar, 2. Maquetar y 3. Revisar."` |
| **d. Enlaces descriptivos** | "Haz clic aquí" no dice a dónde lleva (fuera de contexto, en una lista de enlaces, no se entiende). | "Solicita información sobre los talleres". Los enlaces del menú ahora van subrayados para que no dependan solo del color. |
| **e. Etiquetas del formulario** | Los nombres de los campos eran `<p>`, no `<label>`. El lector de pantalla no los asocia al campo y al hacer clic en el texto no se activa el campo. El placeholder hacía de etiqueta y desaparece al escribir. | `<label for="correo">` y `<label for="consulta">`. Se indica "(obligatorio)" en el texto. Añadido `autocomplete="email"`. |
| **f. Estados que no dependan del color** | El estado de plazas era solo un círculo verde o rojo vacío: sin texto, invisible para lectores de pantalla y para personas con daltonismo. | Texto + icono + color: "✔ Plazas disponibles" y "✖ Completo". El icono lleva `aria-hidden="true"` porque el texto ya lo dice. |
| **g. Contraste y foco visible** | Texto de introducción `#b6bdc6` sobre blanco = **1,89:1** (mínimo 4,5:1). Borde de los campos `#8d9ba6` = 2,85:1 (mínimo 3:1). Foco eliminado con `outline: none`. | Introducción `#4f5d6b` = **6,75:1**. Borde de campos `#5f6f7c` = 4,77:1. Botones `#0f5f87` con texto blanco = 6,98:1. Estados: verde `#0f6b34` (6,62:1) y rojo `#b3202c` (6,65:1). Foco con `outline: 3px solid` oscuro, y amarillo `#ffd166` en la cabecera oscura (7,78:1). |
| **h. Tarjetas en pantallas estrechas** | Columnas fijas de 360px. | `grid-template-columns: 1fr 1fr` y, con `@media (max-width: 700px)`, una sola columna. En móvil se oculta la decoración y se reduce el `h1`. La cabecera y el menú usan `flex-wrap`. |

### 5. Repetición de las pruebas

- **Teclado:** el primer Tab muestra "Saltar al contenido principal". Después el foco recorre Cursos → Inscripción → botón del hero → correo → consulta → Enviar, en orden lógico y siempre con un contorno bien visible (amarillo en la cabecera oscura, azul oscuro en el resto).
- **Zoom 200 %:** las tarjetas pasan a una columna, la decoración desaparece y no hay scroll horizontal. Todo el texto se lee sin superposiciones. (El texto dentro de la imagen del proceso se hace pequeño, pero su información está también en el `alt`.)

### 6. Texto de ayuda asociado con `aria-describedby`

```html
<label for="correo">Correo electrónico (obligatorio)</label>
<p class="ayuda" id="ayuda-correo">Te responderemos a esta dirección. Ejemplo: nombre@correo.com</p>
<input type="email" id="correo" name="correo" autocomplete="email"
       aria-describedby="ayuda-correo" required>
```

Cuando el campo recibe el foco, el lector de pantalla lee primero la etiqueta ("Correo electrónico, obligatorio") y después la descripción ("Te responderemos a esta dirección…"). El ejemplo ya no está en un `placeholder`, porque este desaparece al escribir y suele tener poco contraste.

### 7. ¿Por qué no usar ARIA para sustituir `<label>`?

- **Primera regla de ARIA:** si existe un elemento HTML nativo que ya hace la función, hay que usarlo. `<label>` ya da nombre accesible al campo; ARIA es solo un parche para cuando HTML no llega.
- **ARIA solo afecta a las tecnologías de apoyo.** `aria-label` es invisible: las personas que ven la pantalla se quedan sin saber qué poner en el campo (también usuarios con discapacidad cognitiva o personas mayores).
- **`<label>` aporta funcionalidad que ARIA no da:** al hacer clic en el texto se activa el campo, lo que agranda la zona de clic (muy útil en móvil y con problemas motores, y en casillas de verificación).
- **Robustez:** `<label>` funciona en todos los navegadores y lectores de pantalla. `aria-label` a veces no lo traducen los traductores automáticos ni lo usa el software de control por voz.
- **Mantenimiento:** con `aria-label` el texto visible y el accesible pueden acabar siendo distintos (incumple WCAG 2.5.3 "Etiqueta en el nombre").

---

## EJERCICIO 2 — Análisis de la portada de Wikipedia en español

> Nota: la portada cambia a diario. Las imágenes citadas son las del 16/11/2026; comprueba el `alt` exacto con F12 el día que lo entregues.

### 1. Navegación por teclado

Sí se puede usar entera con Tab y Shift+Tab. El primer Tab muestra un enlace de salto ("Saltar al contenido" / "Saltar a: navegación, búsqueda") que permite ir directo al contenido. Después se llega al botón del menú principal, al logotipo, al **buscador** ("Buscar en Wikipedia") y a los enlaces de cuenta. Luego se recorren los enlaces de las secciones de la portada. El elemento con foco **sí se identifica visualmente**: aparece un contorno o anillo azul alrededor del enlace o del campo de búsqueda.

### 2. Estructura y encabezados

La página tiene un único `h1` (el título de la página, "Wikipedia:Portada"). Las secciones de la portada se organizan como bloques con encabezados `h2`: "Bienvenidos a Wikipedia", "Participación y comunidad", "Búsquedas y consultas", "En curso", "Fallecimientos", "Conmemoraciones y fiestas", "Imágenes y multimedia" y "Ediciones de Wikipedia en otros idiomas". Si una sección tiene subapartados, usan `h3`. No hay saltos de nivel, así que un lector de pantalla puede usar los encabezados para saltar entre secciones. También hay regiones semánticas (`header`, `nav`, `main`, `footer`).

### 3. Imágenes y alternativas textuales

- **Imagen 1:** soldados revolucionarios ante la Puerta de Brandenburgo (1918), en el artículo destacado sobre la Revolución de noviembre.
- **Imagen 2:** Salar de Talar, cerca de San Pedro de Atacama.

En las miniaturas de la portada, el `alt` suele estar vacío o repetir el nombre del archivo, y la información real va en el **pie de foto** que está justo al lado. El lector de pantalla lee ese pie, así que la imagen no pierde información. Aun así, un `alt` que describa la foto sería mejor que el nombre del archivo. Logotipos como el globo de Wikipedia sí tienen un `alt` correcto ("Wikipedia").

### 4. Zoom al 200 %

Se puede seguir leyendo y navegando. El diseño es adaptable: los menús laterales se recogen en un botón (menú hamburguesa), las columnas de la portada se colocan una debajo de otra y el texto se reajusta. No aparece scroll horizontal en el texto principal ni se superponen elementos. Lo único es que hay que hacer más scroll vertical.

### 5. Contraste y legibilidad

En general el contraste es bueno: texto negro sobre blanco y enlaces azules sobre blanco. Las combinaciones más débiles son:

- Los **enlaces ya visitados** (morado) dentro de cajas con fondo de color claro: se distinguen peor del texto normal.
- El **texto pequeño gris** de los pies de foto y del pie de página: es más difícil de leer, sobre todo con poca luz o en el móvil.
- Los **enlaces no van subrayados** en el texto, solo se distinguen por el color azul, lo que puede ser un problema para personas con daltonismo.

### 6. Buenas prácticas y principios WCAG

1. **Foco visible y enlace "Saltar al contenido"** → **Operable**: toda la web se usa solo con teclado y se sabe dónde está el foco.
2. **Pies de foto y textos alternativos en las imágenes** → **Perceptible**: la información de las imágenes llega también en forma de texto.

Otras que se pueden añadir: el `lang="es"` y la navegación coherente en todas las páginas (**Comprensible**), y el HTML semántico con encabezados y landmarks (**Robusto**: funciona bien con lectores de pantalla y otras tecnologías de apoyo).
