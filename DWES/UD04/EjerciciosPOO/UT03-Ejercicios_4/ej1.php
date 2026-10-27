<?php

class Circulo{
    private $radio = 0;

    public function __construct($radio = 0){
        $this->setRadio($radio);
    }

    public function getRadio(){
        return $this->radio;
    }

    public function setRadio($nuevoRadio){
        $nuevoRadio = (float)$nuevoRadio;
        if ($nuevoRadio < 0){
            $nuevoRadio = 0;
        }
        $this->radio = $nuevoRadio;
    }

    public function __get($name){
        if ($name === 'radio'){
            return $this->getRadio();
        }
        return null;
    }

    public function __set($name, $valor){
        if ($name === 'radio'){
            $this->setRadio($valor);
        }
    }
}

?>
