<?php
try { 
    $conexion = new PDO( 
        'mysql:host=localhost;dbname=tienda;charset=utf8mb4', 
        'root', 
        'r00tMy$ql',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
    ); 
  
    echo 'Conexión realizada'; 
} catch (PDOException $e) { 
    echo 'No se ha podido conectar con la base de datos'; 
} 

$resultado=$conexion->query(

    'SELECT nombre, precio 
    FROM productos 
    WHERE unidades > 10 
    ORDER BY precio DESC' 
);

while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) { 
    echo $fila['nombre'] . ' - ' . $fila['precio'] . '<br>'; 
} 

// foreach($resultado as $producto){
//     echo '<br>' . 'Producto: ' . $producto['nombre'] . 'Precio: ' . $producto['precio'] . '<br>';
// }

// while($fila= $resultado->fetch(PDO::FETCH_ASSOC)){
//     echo $fila['nombre'] . ': ';
//     echo $fila['precio'] . ' euros <br>';
// }

$productos = $resultado->fetchAll(PDO::FETCH_ASSOC); 
  
foreach ($productos as $producto) { 
    echo $producto['nombre'] . '<br>'; 
} 

//Modificar datos INSERT UPDATE Y DELETE    !!!!!

$filas =$conexion->exec(
    'INSERT INTO productos (nombre,precio,unidades)
    VALUES ("Altavoces",32.90,8)'
);

echo 'Filas insertadas: ' . $filas;

$filas =$conexion->exec(
    'DELETE FROM productos
    WHERE id=3'
);

$filas=$conexion->exec(
    'UPDATE productos
    SET precio=29.90
    WHERE id=1'
);

// try { 
//     $consulta = $conexion->prepare( 
//         'SELECT * FROM productos WHERE id = :id' 
//     ); 
//     $consulta->execute([':id' => 1]); 
  
//     $producto = $consulta->fetch(PDO::FETCH_ASSOC); 
// } catch (PDOException $e) { 
//     error_log($e->getMessage()); 
//     echo 'No ha sido posible realizar la operación.'; 
// }

try { 
    $conexion->beginTransaction(); 
  
    $conexion->exec( 
        'UPDATE productos SET precio = precio - 100 WHERE id = 1' 
    ); 
  
    $conexion->exec( 
        'UPDATE productos SET precio = precio + 100 WHERE id = 2' 
    ); 
  
    $conexion->commit(); 
    echo 'Operación realizada'; 
} catch (PDOException $e) { 
    if ($conexion->inTransaction()) { 
        $conexion->rollBack(); 
    } 
  
    echo 'No se pudo completar la operación'; 
} 
?> 