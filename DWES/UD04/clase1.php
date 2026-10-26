<?php

class Producr
{
    private $codigo;
    public $nombre;
    protected $PVP;
    public function muestra()
    {
        return "<p>" . $this->codigo . "</p>";
    }
    public function __construct()
    {
        $this->codigo = 1;
    }
}
