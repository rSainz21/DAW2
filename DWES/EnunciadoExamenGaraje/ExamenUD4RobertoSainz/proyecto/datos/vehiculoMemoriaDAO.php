<?php

// -------------------------------------------- TODO: require/s necesario/s

class VehiculoMemoriaDAO // -----------------------TODO: implement/s necesario/s
{
    private array $vehiculos = [];

    /** Último id asignado (simula el AUTO_INCREMENT de la BD) */
    private int $ultimoId = 0;

    // -------------------------------------------- TODO: firma del método para obtener todos los vehículos
    {
        return array_values($this->vehiculos);
    }

    // ------------------------------------------- TODO: firma del método para obtener un vehículo por id
    {

        foreach ($this->vehiculos as $vehiculo) {

            if ($vehiculo->id == $id) {
                return $vehiculo;
            }

        }

        return null;
    }

    // ----------------------------------------- TODO: firma del método para insertar un vehículo
    {

        // Si no trae id (0), se le asigna el siguiente, como haría la BD
        if ($vehiculo->id <= 0) {
            $vehiculo->id = $this->ultimoId + 1;
        }

        $this->ultimoId = max($this->ultimoId, $vehiculo->id);

        $this->vehiculos[] = $vehiculo;
    }

    // ----------------------------------------- TODO: firma del método para actualizar un vehículo
    {

        foreach ($this->vehiculos as $i => $p) {

            if ($p->id == $vehiculo->id) {

                $this->vehiculos[$i] = $vehiculo;
                return;
            }

        }
    }

    // ----------------------------------------- TODO: firma del método para borrar un vehículo 
    {

        $this->vehiculos = array_filter(
            $this->vehiculos,
            fn($p) => $p->id != $id
        );
    }

   /**
     * Reemplazo "transaccional" en memoria (Simulado):     
     * */
    // --------------------------------------- TODO: firma del método para reemplazar un vehículo por nombre
    {

        // COMENZAR TRANSACCIÓN SIMULADA: copia del estado (clonamos los objetos para que una
        // modificación posterior no altere la copia de seguridad)
        $copiaVehiculos = array_map(
            fn($p) => clone $p,
            $this->vehiculos
        );
        $copiaUltimoId = $this->ultimoId;

        try {

            // 1) Eliminar el vehículo antiguo
            $antes = count($this->vehiculos);

            $this->vehiculos = array_filter(
                $this->vehiculos,
                fn($p) => $p->nombre !== $nombreAntiguo
            );

            if (count($this->vehiculos) === $antes) {

                throw new RuntimeException(
                    "No existe ningún vehículo con nombre '"
                    . $nombreAntiguo
                    . "'"
                );
            }

            // 2) Insertar el vehículo nuevo
            $this->insertar($nuevo);

            // CONFIRMACIÓN DE TRANSACCIÓN: no hay que hacer nada, el estado ya es el definitivo

        } catch (Throwable $e) {

            // RECHAZO DE TRANSACCIÓN: se restaura el estado anterior
            $this->vehiculos = $copiaVehiculos;
            $this->ultimoId = $copiaUltimoId;

            throw $e;
        }
    }
}