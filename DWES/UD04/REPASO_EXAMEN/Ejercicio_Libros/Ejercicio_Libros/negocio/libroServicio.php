<?php
require_once __DIR__ . "/../entidades/Libro.php";

class libroServicio{
    private PDO $pdo;

    public function __construct(){
        
        $ruta=__DIR__ . "/../libros.db";
        $dbNueva=!file_exists($ruta);

        $this->pdo=new PDO("sqlite:" . $ruta);
        $this->pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );

        if($dbNueva){
            $this->pdo->exec(
                "CREATE TABLE libros(
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                titulo TEXT NOT NULL,
                precio REAL NOT NULL)"
            );

            $this->pdo->exec(
                "INSERT INTO libros(titulo, precio)
                VALUES ('poesia',9.50),('teatro', 14.75)"
            );
        }

    }

    public function obtenerLibros():array{
        $filas=$this->pdo->query("SELECT * FROM libros")->fetchAll(PDO::FETCH_ASSOC);
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

    public function altaLibro(Libro $libro):void{
        $consulta=$this->pdo->prepare(
            "INSERT INTO libros(titulo,precio)
            VALUES (?, ?)"
        );

        $consulta->execute([$libro->titulo, $libro->precio]);
    }

    public function actualizarLibro(Libro $libro):void{
        $consulta=$this->pdo->prepare(
            "UPDATE libros SET titulo=?, precio=? WHERE id=?"
        );

        $consulta->execute([$libro->titulo, $libro->precio, $libro->id]);
    }

    public function borrarLibro(int $id):void{
        $consulta=$this->pdo->prepare(
            "DELETE FROM libros WHERE id=?"
        );

        $consulta->execute([$id]);
    }

    public function reemplazarLibro(
        string $tituloAntiguo, 
        string $tituloNuevo,
        float $precio):void{

        $this->pdo->beginTransaction();

        try{
            $borrado=$this->pdo->prepare(
                "DELETE FROM libros WHERE titulo=?"
            );
            $borrado->execute([$tituloAntiguo]);

            if($borrado->rowCount()===0){
                throw new Exception("No existe ese libro");
            }

            $insertado=$this->pdo->prepare(
                "INSERT INTO libros (titulo,precio)
                VALUES (?,?)"
            );
            $insertado->execute([$tituloNuevo,$precio]);

            $this->pdo->commit();

        }catch(Throwable $e){

            if($this->pdo->inTransaction()){
                $this->pdo->rollBack();
            }
            throw $e;
        }
    }
}


?>