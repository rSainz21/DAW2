<?php
// index.php → Orquestador (recibe la petición y encadena las tres capas)

// Los errores se registran en el log, nunca se muestran al usuario
ini_set('display_errors', '0');
ini_set('log_errors', '1');

// Filtro anti-doble invocación rápida (común en PHP Server / Live Preview)
$lock = sys_get_temp_dir() . '/inventario_lab.req_lock';
if (file_exists($lock) && time() - filemtime($lock) < 1) {
    exit; // Ignora la segunda petición si se recibe a menos de 1 seg
}
touch($lock);

require_once __DIR__ . "/persistencia/material_repositorio.php"; // 1) datos
require_once __DIR__ . "/logica/inventario.php";                  // 2) lógica
require_once __DIR__ . "/presentacion/vista.php";                 // 3) presentación
?>
