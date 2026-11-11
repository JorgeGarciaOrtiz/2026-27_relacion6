<?php

/**
 * Clase que representa las características adicionales de un mueble
 */
class Caracteristicas implements Iterator
{
    // ------------------------------------------------
    // Propiedades
    // ------------------------------------------------

    // Array donde se guardan las características creadas de forma dinámica
    private array $_caracteristicas = [];

    // Posición actual del recorrido
    private int $_posicion = 0;

    // ------------------------------------------------
    // Métodos mágicos
    // ------------------------------------------------

    /**
     * Crea o modifica una característica
     *
     * @param string $nombre Nombre de la característica
     * @param mixed $valor Valor de la característica
     * @return void
     */
    public function __set(string $nombre, mixed $valor): void
    {
        $error = false;
        $encontrado = false;

        // Recorro todas las caracteristicas
        foreach ($this->_caracteristicas as $clave => $v) {

            // Busco si hay algun elemento igual al que queremos modificar,
            // de esta forma podre asegurarme que aunque este la caracteristica
            // "ULTIMA" se modifique igualmente
            if ($clave === $nombre) {
                $encontrado = true;
            }

            // Si encontramos "ULTIMA" y no hay ningun elemento igual al que queremos 
            // modificar ponemos el error en true
            if ($clave === "ULTIMA" && $encontrado === false) {
                $error = true;
            }
        }

        // Si no esta la palabra ultima:
        if (!$error) {
            // Guardo la característica en el array
            $this->_caracteristicas[$nombre] = $valor;
        } else {
            // En el caso contrario lanzo un excepción
            throw new Exception("Error no se pueden crear más caracteristicas");
        }
    }

    /**
     * Devuelve el valor de una característica
     *
     * @param string $nombre Nombre de la característica
     * @return mixed Valor de la característica
     */
    public function __get(string $nombre): mixed
    {
        // Si la característica existe devuelvo su valor
        if (isset($this->_caracteristicas[$nombre])) {
            return $this->_caracteristicas[$nombre];
        } else {
            // Si no existe lanzo una excepción
            throw new Exception("No existe la propiedad " . $nombre);
        }
    }

    /**
     * Indica si existe una característica
     *
     * @param string $nombre Nombre de la característica
     * @return boolean True si existe y false si no
     */
    public function __isset(string $nombre): bool
    {
        // Si la característica existe devuelve true
        if (isset($this->_caracteristicas[$nombre])) {
            return true;
        }
        return false;
    }

    /**
     * Borra una característica
     *
     * @param string $nombre Nombre de la característica
     * @return void
     */
    public function __unset(string $nombre): void
    {
        // Borro la característica del array
        unset($this->_caracteristicas[$nombre]);
    }

    // ------------------------------------------------
    // Métodos que implementamos de Iterator
    // ------------------------------------------------

    /**
     * Pone el puntero al final
     *
     * @return void
     */
    public function rewind(): void
    {
        $this->_posicion = count($this->_caracteristicas) - 1;
    }

    /**
     * Indica si la posición actual es válida
     *
     * @return boolean True si hay elemento y false si no quedan más
     */
    public function valid(): bool
    {
        return $this->_posicion >= 0;
    }

    /**
     * Devuelve la clave del elemento actual
     *
     * @return mixed Clave actual
     */
    public function key(): mixed
    {
        // Saca todas las claves del array (con array_keys) y cojo la de la posición actual
        return array_keys($this->_caracteristicas)[$this->_posicion];
    }

    /**
     * Vuelvo al elemento anterior
     *
     * @return void
     */
    public function next(): void
    {
        $this->_posicion--;
    }

    /**
     * Devuelve el valor del elemento actual
     *
     * @return mixed Valor actual
     */
    public function current(): mixed
    {
        return $this->_caracteristicas[$this->key()];
    }

    // ------------------------------------------------
    // Método toString
    // ------------------------------------------------

    /**
     * Método que devuelve las características con la forma car1:valor1;car2:valor2;
     *
     * @return string Cadena con todas las características
     */
    public function __toString(): string
    {
        $cadena = "";

        foreach ($this->_caracteristicas as $clave => $v) {
            $cadena .= $clave . ":" . $v . ";";
        }

        return $cadena;
    }
}
