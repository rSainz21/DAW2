<?php

class Libro
{
    public int $id;
    public string $titulo;
    public float $precio;

    public function __construct(
        int $id,
        string $titulo,
        float $precio
    ) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->precio = $precio;
    }
}