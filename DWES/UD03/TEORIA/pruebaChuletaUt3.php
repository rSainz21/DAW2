<?php
declare(strict_types=1);

/* =====================================================================
   UT03 DWES - TODOS LOS EJEMPLOS EN UN SOLO FICHERO
   Cómo probarlo:
     1) Guárdalo como ut03.php en la carpeta de tu servidor (htdocs, www...)
        o abre una terminal en su carpeta y ejecuta:  php -S localhost:8000
     2) Abre en el navegador: http://localhost:8000/ut03.php
   Requiere PHP 8.1 o superior (enum, readonly, new en parámetros).
   Nota: como el fichero usa namespaces, todo el código va en bloques
   { } (los namespace con llaves no se pueden mezclar con código suelto).
   ===================================================================== */

// ---------- Namespace del apartado 10 ----------
namespace Proyecto\Prueba {
    class MiClase {
        public function hola(): string {
            return "Hola desde " . __NAMESPACE__ . "\\MiClase";
        }
    }
    function miFuncion(): string { return "miFuncion() del namespace " . __NAMESPACE__; }
}

// ---------- Todo lo demás en el espacio global ----------
namespace {

use Proyecto\Prueba\MiClase as Clase;   // import con alias

echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>UT03 pruebas</title>
<style>body{font-family:sans-serif;max-width:900px;margin:auto;padding:10px}
h2{background:#223;color:#fff;padding:6px;margin-top:30px}h3{color:#036}
pre{background:#eee;padding:6px}</style></head><body>';

function t(string $s): void { echo "<h2>$s</h2>"; }
function s(string $s): void { echo "<h3>$s</h3>"; }
function p(mixed $s): void { echo $s . "<br>"; }
function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

/* =============== 1. ESTRUCTURAS CONDICIONALES =============== */
t("1. Estructuras condicionales");

s("if / elseif / else");
$a = 1; $b = 3;
if ($a < $b)
    print "a es menor que b";
elseif ($a > $b)
    print "a es mayor que b";
else
    print "a es igual a b";
echo "<br>";

s("Operador ternario anidado");
$imprimir = ($a < $b) ? "a es menor que b" : (($a > $b) ? "a es mayor que b" : "a es igual a b");
p($imprimir);

s("switch (prueba a cambiar \$a a 0, 1 o 5)");
switch ($a) {
    case 0: p("a vale 0"); break;
    case 1: p("a vale 1"); break;
    default: p("a no vale 0 ni 1");
}

s("match (devuelve valor, comparación estricta ===)");
$valor = 2;
$resultado = match($valor) {
    1 => 'Uno',
    2 => 'Dos',
    default => 'Otro',
};
p("match($valor) = $resultado");
try {
    echo match(99) { 1 => 'x', 2 => 'y' };   // sin default y sin coincidencia
} catch (\UnhandledMatchError $e) {
    p("Sin default y sin coincidencia -> UnhandledMatchError: " . h($e->getMessage()));
}

/* =============== 2. BUCLES =============== */
t("2. Bucles");

s("while");
$a = 1;
while ($a < 8) $a += 3;
p("while: \$a vale $a (esperado 10)");

s("do...while");
$a = 1;
do { $a -= 3; } while ($a > 10);
p("do-while: \$a vale $a (esperado -2)");

s("for (5 y 8)");
for ($a = 5; $a < 10; $a += 3) {
    p($a);
}

s("foreach");
$nombres = ['Lucía', 'Victor', 'Efren', 'Cesar', 'Eloy', 'David'];
foreach ($nombres as $nombre) { print $nombre . "<br/>"; }
echo "<b>Con índice:</b><br>";
foreach ($nombres as $indice => $nombre) { print $indice . " " . $nombre . "<br/>"; }

/* =============== 3. FUNCIONES =============== */
t("3. Funciones");

s("Función con global (no recomendado)");
function precio_con_iva_global() {
    global $precio;
    $precio_iva = $precio * 1.21;
    print "el precio con IVA es " . $precio_iva;
}
$precio = 10;
precio_con_iva_global();
echo "<br>";

s("Función definida condicionalmente");
$iva = true;
if ($iva) {
    function precio_cond() { return "precio_cond() solo existe porque \$iva es true"; }
}
p(precio_cond());

s("Parámetros, return y valor por defecto");
function precio_con_iva(float|int $precio, float $iva = 0.21): float|int {
    return $precio * (1 + $iva);
}
p("10 con IVA por defecto: " . precio_con_iva(10));
p("10 con IVA del 0.04: " . precio_con_iva(10, 0.04));

s("Número indeterminado de parámetros (...)");
function concatenar(...$palabras) {
    $resultado = "";
    foreach ($palabras as $palabra) { $resultado .= $palabra . " "; }
    echo $resultado;
}
concatenar('curso', 'DAW2', 'módulo', 'DWES');
echo "<br>";

s("Paso por valor vs por referencia");
function sube_valor($x)      { $x = $x * 2; }
function sube_ref(&$x)       { $x = $x * 2; }
$n = 10;
sube_valor($n); p("Por valor: \$n sigue valiendo $n");
sube_ref($n);   p("Por referencia: \$n ahora vale $n");

s("func_num_args, func_get_arg, func_get_args");
function comprobarArgumentos() {
    $num = func_num_args();
    p("El número de argumentos es $num");
    for ($i = 0; $i < $num; $i++) { p("Argumento $i = " . func_get_arg($i)); }
    p("func_get_args() = " . json_encode(func_get_args()));
}
comprobarArgumentos(1, "Hola", "Adios");

s("Tipos de parámetros y strict_types (este fichero lo tiene activado)");
function sumaEnteros(int $e1, int $e2): int { return $e1 + $e2; }
p("sumaEnteros(2,5) = " . sumaEnteros(2, 5));
try {
    echo sumaEnteros(2, 5.6);
} catch (\TypeError $e) {
    p("<b>Con strict_types=1, sumaEnteros(2, 5.6) da TypeError:</b> " . h($e->getMessage()));
}
p("<i>Para ver el caso sin strict_types (trunca) crea otro fichero SIN la línea declare(strict_types=1); y llama a sumaEnteros(2,5.6): en PHP 8.1+ además sale un aviso 'Deprecated'.</i>");
function mediaEnteros(int $e1, int $e2): int|float { return ($e1 + $e2) / 2; }
p("mediaEnteros(2,5) = " . mediaEnteros(2, 5));

/* =============== 4. INCLUDE / REQUIRE =============== */
t("4. include / require");
$fichero = __DIR__ . '/ut03_externo.php';
file_put_contents($fichero, '<?php function desde_externo() { return "Hola desde ut03_externo.php"; }');
require_once $fichero;
require_once $fichero;   // la segunda vez NO se vuelve a cargar (si fuera require daría error: función ya declarada)
p(desde_externo());
p("include de un fichero que no existe:");
@include 'no_existe.php';
p("-> solo avisa (warning), el script continúa. Con require daría error fatal y se pararía.");
unlink($fichero);

/* =============== 5. CADENAS =============== */
t("5. Cadenas de caracteres");
$cadena = 'aeioui';
p("strpos('aeioui','i') = " . strpos($cadena, 'i'));
p("strrpos('aeioui','i') = " . strrpos($cadena, 'i'));
p("str_starts_with(...,'e') = " . (str_starts_with($cadena, 'e') ? "comienza" : "no comienza"));
p("str_ends_with(...,'i') = " . (str_ends_with($cadena, 'i') ? "finaliza" : "no finaliza"));
$cadena1 = 'aeiou';
p("strcmp('aeioui','aeiou') = " . strcmp($cadena, $cadena1));
p("substr(-4) = " . substr($cadena, -4));
p("substr(2) = " . substr($cadena, 2));
p("substr(-4,2) = " . substr($cadena, -4, 2));
p("substr(2,2) = " . substr($cadena, 2, 2));
p("str_replace('a','b') = " . str_replace('a', 'b', $cadena));
$cadena = 'hola Mundo';
p(strtolower($cadena) . " | " . strtoupper($cadena) . " | " . ucfirst($cadena) . " | " . ucwords($cadena));
p("strlen('aeiou') = " . strlen('aeiou') . " | mb_strlen('aeiou') = " . mb_strlen('aeiou'));
p("strlen('áeiou') = " . strlen('áeiou') . " (cuenta bytes) | mb_strlen('áeiou') = " . mb_strlen('áeiou'));

/* =============== 6. ARRAYS =============== */
t("6. Arrays");
$modulos1  = array(0 => "Programación", 1 => "Base de datos", 9 => "Desarrollo web en entorno servidor");
$modulos12 = array("Programación", "Base de datos", "Desarrollo web en entorno servidor");
$modulos2  = array("PR" => "Programación", "BD" => "Base de datos", "DWES" => "Desarrollo web en entorno servidor");
p($modulos1[9]); p($modulos12[2]); p($modulos2["DWES"]);

s("Array multidimensional");
$ciclos = array(
    "DAW" => array("PR" => "Programación", "BD" => "Base de datos", "DWES" => "Desarrollo web en entorno servidor"),
    "DAM" => array("PR" => "Programación", "BD" => "Base de datos", "AD" => "Acceso a datos")
);
p($ciclos["DAW"]["DWES"]);

s("Añadir con [] y string como array");
$nuevo = [];
$nuevo[] = "Programación"; $nuevo[] = "Base de datos"; $nuevo[] = "DWES";
echo "<pre>" . print_r($nuevo, true) . "</pre>";
$modulo = "Desarrollo web en entorno servidor";
p("\$modulo[3] = " . $modulo[3]);

s("foreach con clave => valor");
foreach ($modulos2 as $codigo => $modulo) {
    echo "El código del módulo " . $modulo . " es " . $codigo . "<br/>";
}

s("list, range, count, in_array, unset, isset");
list($x, $y, $z) = [1, 2, 3];
p("list: \$x=$x \$y=$y \$z=$z");
list(, $segundo) = [1, 2, 3];
p("list con hueco: \$segundo = $segundo");
$arr = range(10, 20);
p("range(10,20)[5] = " . $arr[5] . " | count = " . count($arr));
p("range('a','z')[5] = " . range("a", "z")[5]);
p("range(2,10,2) = " . implode(", ", range(2, 10, 2)));
p(in_array('Samuel', ['Samuel', 'Manuel']) ? "Samuel se encuentra" : "No se encuentra");
$tmp = ['a' => 1, 'b' => 2];
unset($tmp['a']);
p("tras unset: " . json_encode($tmp));
p("isset(\$tmp['b']) = " . var_export(isset($tmp['b']), true) . " | isset(\$tmp['zzz']) = " . var_export(isset($tmp['zzz']), true));

/* =============== 7. SUPERGLOBALES =============== */
t("7. Superglobales");
p("SERVER_NAME: " . h($_SERVER['SERVER_NAME'] ?? '-'));
p("REQUEST_METHOD: " . h($_SERVER['REQUEST_METHOD'] ?? '-'));
p("REQUEST_URI: " . h($_SERVER['REQUEST_URI'] ?? '-'));
p("HTTP_USER_AGENT: " . h($_SERVER['HTTP_USER_AGENT'] ?? '-'));
p("SCRIPT_NAME: " . h($_SERVER['SCRIPT_NAME'] ?? '-'));
p("SERVER_PORT: " . h($_SERVER['SERVER_PORT'] ?? '-'));
p("<i>\$_GET, \$_POST: ver apartado 12 (formularios). \$_SESSION y \$_COOKIE necesitan session_start()/setcookie() antes de cualquier salida HTML, así que pruébalos en un fichero aparte.</i>");

/* =============== 8. OBJETOS =============== */
t("8. Objetos");

s("Clase, constructor, promotion, get/set, static, const, magic, clone, destructor");

class BaseDatos {
    const DOMINIO = "localhost";
    const USUARIO = "dwes";
    const CLAVE = "1234";
    const BD = "tienda";
}
p("BaseDatos::USUARIO = " . BaseDatos::USUARIO);

class Producto {
    private static int $num_productos = 0;
    public function __construct(
        private string $codigo,
        public string $nombre = "",
        protected float $PVP = 0.0
    ) {
        self::$num_productos++;
    }
    public function getCodigo(): string { return $this->codigo; }
    public function setCodigo(string $nuevo): void { $this->codigo = $nuevo; }
    public function muestra(): string { return "<p>" . $this->codigo . " - " . $this->nombre . "</p>"; }
    public static function total(): int { return self::$num_productos; }
    public function __clone() { $this->codigo = $this->codigo . "-COPIA"; }
    public function __toString(): string { return "Producto[{$this->codigo}, {$this->nombre}]"; }
    public function __destruct() { echo "(destructor: se elimina {$this->codigo})<br>"; }
}

$p = new Producto("A1", "Samsung Galaxy", 599.0);
echo $p->muestra();
$p->setCodigo("A2");
p("getCodigo() = " . $p->getCodigo());
p("echo \$p usa __toString: " . $p);
p("Productos creados (static): " . Producto::total());

s("Operadores instanceof, ==, === y clone");
$a = $p;          // mismo objeto
$c = clone $p;    // copia (llama a __clone)
p("\$a === \$p (mismo objeto): " . var_export($a === $p, true));
p("\$c === \$p: " . var_export($c === $p, true));
p("\$c == \$p: " . var_export($c == $p, true) . " (el código se cambió en __clone)");
p("\$p instanceof Producto: " . var_export($p instanceof Producto, true));
p("get_class: " . get_class($p));
p("method_exists(Producto,'muestra'): " . var_export(method_exists('Producto', 'muestra'), true));
p("property_exists(Producto,'nombre'): " . var_export(property_exists('Producto', 'nombre'), true));
p("get_class_methods: " . implode(", ", get_class_methods('Producto')));
p("get_object_vars (desde fuera, solo públicos): " . json_encode(get_object_vars($p)));
class_alias('Producto', 'Articulo');
$art = new Articulo("Z9", "Creado con alias");
p("Objeto creado con class_alias: " . $art);
unset($art);   // fuerza __destruct
unset($c);

s("Métodos mágicos __get y __set");
class Dinamico {
    private array $atributos = [];
    public function __get($atributo) { return $this->atributos[$atributo] ?? null; }
    public function __set($atributo, $valor) { $this->atributos[$atributo] = $valor; }
}
$d = new Dinamico();
$d->color = "rojo";            // no existe -> llama a __set
p("\$d->color = " . $d->color); // -> __get

s("Creando instancia en el constructor + readonly");
class HolaMundo { public function saludar() { return "¡Hola mundo!"; } }
class Saludo {
    public function __construct(private readonly HolaMundo $holaMundo = new HolaMundo()) {}
    public function mostrarSaludo() { return $this->holaMundo->saludar(); }
}
p((new Saludo())->mostrarSaludo());

s("Herencia, abstract, final, parent::, interfaces");
interface iMuestra { public function muestra(): string; }

abstract class Persona implements iMuestra {
    public function __construct(protected string $nombre, protected string $apellidos) {}
    abstract public function muestra(): string;
    final public function nombreCompleto(): string { return "$this->nombre $this->apellidos"; }
}
class Alumno extends Persona {
    public function __construct(string $nombre, string $apellidos, private array $notas) {
        parent::__construct($nombre, $apellidos);
    }
    public function muestra(): string {
        return "<p>Alumno: {$this->nombreCompleto()} - notas: " . implode(", ", $this->notas) . "</p>";
    }
}
class Profesor extends Persona {
    public function __construct(string $nombre, string $apellidos, private int $horas) {
        parent::__construct($nombre, $apellidos);
    }
    public function muestra(): string {
        return "<p>Profesor: {$this->nombreCompleto()} - horas: {$this->horas}</p>";
    }
}
$al = new Alumno("Ana", "Pérez", [7, 8, 9]);
$pr = new Profesor("Luis", "Gómez", 18);
echo $al->muestra() . $pr->muestra();
p("\$al instanceof Persona: " . var_export($al instanceof Persona, true));
p("\$al instanceof Alumno: " . var_export($al instanceof Alumno, true));
p("\$al instanceof iMuestra: " . var_export($al instanceof iMuestra, true));
p("get_parent_class(\$al): " . get_parent_class($al));
p("is_subclass_of(\$al,'Persona'): " . var_export(is_subclass_of($al, 'Persona'), true));
// try { $x = new Persona("a", "b"); }   // clase abstracta
// catch (\Error $e) { p("<b>No se puede instanciar abstracta:</b> " . h($e->getMessage())); }

s("Interface Countable (de PHP) y varios interfaces");
class Carrito implements Countable {
    private array $items = [];
    public function addItem(string $item): void { $this->items[] = $item; }
    public function count(): int { return count($this->items); }
}
$miCarrito = new Carrito();
$miCarrito->addItem('Manzana'); $miCarrito->addItem('Banana'); $miCarrito->addItem('Naranja');
p("count(\$miCarrito) = " . count($miCarrito) . " | is_countable: " . var_export(is_countable($miCarrito), true));

interface Dibujable { public function dibujar(): string; }
interface Redimensionable { public function cambiarTamano(float $f): string; }
interface ElementoGrafico extends Dibujable, Redimensionable { public function obtenerPosicion(): string; }
class Circulo implements ElementoGrafico {
    public function dibujar(): string { return "Dibujo un círculo"; }
    public function cambiarTamano(float $f): string { return "Círculo x$f"; }
    public function obtenerPosicion(): string { return "Posición (0,0)"; }
}
$ci = new Circulo();
p($ci->dibujar() . " | " . $ci->cambiarTamano(2) . " | " . $ci->obtenerPosicion());
p("interface_exists('iMuestra'): " . var_export(interface_exists('iMuestra'), true));

s("Enumeraciones (PHP 8.1)");
enum Sede {
    case ESPAÑA; case PORTUGAL; case MARRUECOS;
    public function lugar(): string {
        return match($this) {
            self::ESPAÑA => 'Madrid',
            self::PORTUGAL => 'Lisboa',
            self::MARRUECOS => 'Rabat'
        };
    }
}
class Mundial {
    public function __construct(private Sede $sede) {}
    public function getSede(): Sede { return $this->sede; }
}
$mundial = new Mundial(Sede::ESPAÑA);
p("Sede: " . $mundial->getSede()->name . " -> capital " . $mundial->getSede()->lugar());
$sedeActual = Sede::ESPAÑA;
p("Sede::ESPAÑA === Sede::ESPAÑA: " . var_export($sedeActual === Sede::ESPAÑA, true));
p("Sede::ESPAÑA === Sede::PORTUGAL: " . var_export($sedeActual === Sede::PORTUGAL, true));
p("instanceof Sede: " . var_export($sedeActual instanceof Sede, true));

/* =============== 9. TRAITS =============== */
t("9. Traits");
trait Saludar { function decirHola() { return "hola"; } }
trait Despedir { function decirAdios() { return "adios"; } }
trait SaludoYDespedida { use Saludar, Despedir; }   // trait que usa otros traits
class Comunicacion { use SaludoYDespedida; }
$com = new Comunicacion();
p($com->decirHola() . ", que tal " . $com->decirAdios());

s("Orden de precedencia: clase > trait > clase padre");
trait Comunica {
    function decirHola() { return "Hola"; }
    function decirQueTal() { return "¿Qué tal? Soy un trait"; }
    function decirHolaYQuetal() { return $this->decirHola() . " " . $this->decirQueTal(); }
    function preguntarEstado() { return $this->decirHola() . " " . parent::decirQueTal(); }
    function decirBien() { return "Bien, desde el Trait Comunica"; }
}
class Estado {
    function decirQueTal() { return "¿Qué tal? Soy Estado"; }
    function decirBien() { return "Bien, desde la clase Estado"; }
}
class Comunicar extends Estado {
    use Comunica;
    function decirQueTal() { return "¿Qué tal? Soy Comunicar"; }
}
$cm = new Comunicar();
p($cm->decirHolaYQuetal());   // gana la clase
p($cm->preguntarEstado());    // parent:: apunta a Estado
p($cm->decirBien());          // gana el trait sobre el padre

s("Conflictos: insteadof y as");
trait Juego  { function play() { echo "Jugando a un juego"; } }
trait Musica { function play() { echo "Escuchando música"; } }
// class Reproductor {
//     use Juego, Musica {
//         Musica::play insteadof Juego;
//         Juego::play as playDeJuego;
//     }
// }
$r = new Reproductor();
$r->play(); echo "<br>"; $r->playDeJuego(); echo "<br>";
p("Reflection getTraitNames: " . implode(", ", (new ReflectionClass('Reproductor'))->getTraitNames()));

/* =============== 10. NAMESPACES =============== */
t("10. Namespaces");
$obj = new \Proyecto\Prueba\MiClase();       // ruta completa
p($obj->hola());
$obj2 = new Clase();                         // alias definido arriba con "use ... as Clase"
p("Con alias: " . $obj2->hola());
p(\Proyecto\Prueba\miFuncion());
p("__NAMESPACE__ en el espacio global es: '" . __NAMESPACE__ . "' (vacío)");

/* =============== 11. TIPOS DE DATOS =============== */
t("11. Funciones de tipos de datos");
foreach ([1, 1.5, "hola", true, [1], null, new stdClass] as $v) {
    p("gettype = " . gettype($v) . " | is_numeric: " . var_export(is_numeric($v), true) . " | is_scalar: " . var_export(is_scalar($v), true));
}

/* =============== 12. FORMULARIOS =============== */
t("12. Formularios GET y POST");

s("Formulario GET");
?>
<form action="" method="get">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" placeholder="Ej: Ana" required><br>
    <label for="apellido">Apellidos:</label>
    <input type="text" id="apellido" name="apellidos"><br>
    <input type="submit" name="enviar" value="Enviar GET">
</form>
<?php
if (isset($_GET['enviar'])) {
    echo "<pre>print_r(\$_GET):\n" . h(print_r($_GET, true)) . "</pre>";
    p("Hola " . h($_GET['nombre'] ?? '') . " " . h($_GET['apellidos'] ?? ''));
}
$usuario = $_GET['usuario'] ?? 'invitado';   // operador ??
p("Operador ??: \$_GET['usuario'] ?? 'invitado' = " . h($usuario) . " <i>(prueba a añadir ?usuario=Roberto a la URL)</i>");

s("Formulario POST (con select, textarea, checkbox, date, email)");
?>
<form action="" method="post">
    <input type="text" name="nombre" placeholder="Nombre"><br>
    <input type="email" name="email" placeholder="email"><br>
    <input type="date" name="fecha"><br>
    <select name="motivo">
        <option value="">-- Elige --</option>
        <option value="consulta">Consulta</option>
        <option value="queja">Queja</option>
    </select><br>
    <textarea name="mensaje" rows="3" placeholder="Escriba aquí..."></textarea><br>
    <label><input type="checkbox" name="acepto" value="si"> Acepto</label><br>
    <button type="submit" name="enviarpost">Enviar POST</button>
    <button type="reset">Limpiar</button>
</form>
<?php
if (isset($_POST['enviarpost'])) {
    echo "<pre>print_r(\$_POST):\n" . h(print_r($_POST, true)) . "</pre>";
    p("Acepto: " . (isset($_POST['acepto']) ? 'sí' : 'no (un checkbox sin marcar NO se envía)'));
}

/* =============== 13. XSS =============== */
t("13. XSS y htmlspecialchars");
$malo = "<script>alert('hackeado')</script> x' onclick='malicious()";
p("Texto malicioso original (escapado aquí solo para mostrarlo): <code>" . h($malo) . "</code>");
p("Resultado de h(): <code>" . h($malo) . "</code>");
p("Si lo imprimieras SIN h() el navegador ejecutaría el &lt;script&gt;.");

echo "<hr><p><b>Fin.</b> Al terminar el script se ejecutan los destructores pendientes:</p>";
echo '</body></html>';
}