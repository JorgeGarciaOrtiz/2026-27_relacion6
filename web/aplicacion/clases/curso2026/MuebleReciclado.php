<?php

/**
 * Clase que representa un mueble reciclado. No se pueden crear subclases de ella
 */
final class MuebleReciclado extends MuebleBase
{
    // ------------------------------------------------
    // Propiedad
    // ------------------------------------------------

    // Porcentaje de material reciclado (entre 0 y 100)
    private int $_porcentajeReciclado = 10;

    // ------------------------------------------------
    // Constructor
    // ------------------------------------------------

    /**
     * Constructor que recibe las propiedades del mueble y el porcentaje de reciclado 
     * con sus valores por defecto, menos el nombre que es obligatorio indicarlo.
     *
     * @param string $nombre Nombre del mueble (obligatorio)
     * @param string $fabricante Fabricante del mueble
     * @param string $pais País de fabricación
     * @param integer $anio Año de inicio de fabricación
     * @param string $fechaIniVenta Fecha en la que se empieza a vender
     * @param string $fechaFinVenta Fecha en la que dejará de venderse
     * @param float $precio Precio del mueble
     * @param integer $porcentajeReciclado Porcentaje de reciclado
     */
    public function __construct(
        string $nombre,
        string $fabricante = "FaMu:",
        string $pais = "ESPAÑA",
        int $anio = 2020,
        string $fechaIniVenta = "01/01/2020",
        string $fechaFinVenta = "31/12/2040",
        float $precio = 30,
        int $porcentajeReciclado = 10,
    ) {
        // Llamamos al constructor del padre para asignar las propiedades base
        parent::__construct($nombre, $fabricante, $pais, $anio, $fechaIniVenta, $fechaFinVenta, $precio);

        // Si el porcentaje no es válido asignamos el valor por defecto
        if (!$this->setPorcentajeReciclado($porcentajeReciclado)) {
            $this->setPorcentajeReciclado(10);
        }
    }

    // ------------------------------------------------
    // Método get
    // ------------------------------------------------

    /**
     * Devuelve el porcentaje de reciclado
     *
     * @return integer Porcentaje de reciclado
     */
    public function getPorcentajeReciclado(): int
    {
        return $this->_porcentajeReciclado;
    }

    // ------------------------------------------------
    // Método set
    // ------------------------------------------------

    /**
     * Guarda el porcentaje de reciclado si está entre 0 y 100
     *
     * @param integer $porcentajeReciclado Porcentaje de reciclado
     * @return boolean True si se ha guardado y false si no
     */
    public function setPorcentajeReciclado(int $porcentajeReciclado): bool
    {
        // Si el valor está entre 0 y 100
        if (validaEntero($porcentajeReciclado, 0, 100, 10)) {
            // Guardo el porcentaje
            $this->_porcentajeReciclado = $porcentajeReciclado;
            return true;
        } else {
            return false;
        }
    }

    // ------------------------------------------------
    // Método toString
    // ------------------------------------------------

    /**
     * Método que devuelve la información del mueble añadiendo el porcentaje de reciclado.
     *
     * @return string Cadena con los datos del mueble
     */
    public function __toString(): string
    {
        return parent::__toString() .
            ", con un porcentaje de reciclado del " .  $this->_porcentajeReciclado;
    }

    // ------------------------------------------------
    // Método
    // ------------------------------------------------

    /**
     * Método que devuelve un array con el nombre de las propiedades adicionales
     *
     * @return array Nombres de las propiedades adicionales
     */
    public function damePropiedadesAdicionales(): array
    {
        return ["PorcentajeReciclado"];
    }
}
