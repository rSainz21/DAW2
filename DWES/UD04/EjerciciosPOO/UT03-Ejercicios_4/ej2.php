<?php
class Coche{
    private $matricula;
    private $velocidad;

    public function __construct($matricula, $velocidad){
        $this->matricula = $matricula;
        $this->velocidad = $velocidad;
        $this->limitaVelocidad();
    }

    // La velocidad nunca puede ser menor de 0 ni mayor de 120
    private function limitaVelocidad(){
        if ($this->velocidad < 0){
            $this->velocidad = 0;
        }
        if ($this->velocidad > 120){
            $this->velocidad = 120;
        }
    }

    public function acelera($cantidad){
        $this->velocidad += $cantidad;
        $this->limitaVelocidad();
    }

    public function frena($cantidad){
        $this->velocidad -= $cantidad;
        $this->limitaVelocidad();
    }

    public function muestra(){
        return "<p>Matrícula: " . $this->matricula . " - Velocidad: " . $this->velocidad . " km/h</p>";
    }
}
?>