<?php

class Producto{
    public int $id;
    public string $nombre;
    public float $precio;

    public function __construct(int $id, string $nombre, float $precio){
        $this->id=$id;
        $this->nombre=$nombre;
        $this->precio=$precio;
    }

    public function getId():int{
        return $this->id;
    }

    public function setId(int $id):void{
        $this->id=$id;
    }

}

?>