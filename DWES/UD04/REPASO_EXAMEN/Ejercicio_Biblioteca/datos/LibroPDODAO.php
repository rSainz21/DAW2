<?php
require_once __DIR__ . "/LibroDAO.php";

class LibroDAOPDO implements LibroDAO{
    
    private PDO $conexion;

    public function __construct(PDO $conexion){
        $this->conexion=$conexion;
    }

    public function obtenerTodos(): array{
        
        $filas = $this->conexion
            ->query("SELECT * FROM libros")
            ->fetchAll(PDO::FETCH_ASSOC);

            $libros=[];

            foreach($filas as $fila){
                $libros[]=new Libro(
                    (int)$fila['id'],
                    $fila['titulo'],
                    (float)$fila['precio']
                );
            }
            return $libros;      
    }

    public function insertar(Libro $libro): void{
        
        $consulta = $this->conexion->prepare(
            "INSERT INTO libros(titulo, precio)
             VALUES (?, ?)"
        );

        $consulta->execute([
            $libro->titulo,
            $libro->precio
        ]);
    }

    public function actualizar(Libro $libro): void{
       
        $consulta = $this->conexion->prepare(
            "UPDATE libros
             SET titulo = ?, precio = ?
             WHERE id = ?"
        );

        $consulta->execute([
            $libro->titulo,
            $libro->precio,
            $libro->id
        ]);
    }

    public function borrar($id): void{

        $consulta=$this->conexion->prepare(
            "DELETE FROM libros WHERE id=?"
        );
        
        $consulta->execute([$id]);
    }

    public function reemplazar($tituloAntiguo, $tituloNuevo, $precio): void{
        
        $this->conexion->beginTransaction();

        try{

            $borrar=$this->conexion->prepare(
                "DELETE FROM libros WHERE titulo=?"
            );
            $borrar->execute([$tituloAntiguo]);

            if($borrar->rowCount()===0){
                throw new Exception ("No exiaste el producto que quieres reemplazar");
            }

            $insertar=$this->conexion->prepare(
                "INSERT INTO libros(titulo, precio)
                 VALUES (?, ?)"
            );
            $insertar->execute([$tituloNuevo, $precio]);

            $this->conexion->commit();
            
        }catch(Throwable $e){

            if($this->conexion->inTransaction()){
                $this->conexion->rollBack();
            }
            throw $e;
        }
    }
}

?>