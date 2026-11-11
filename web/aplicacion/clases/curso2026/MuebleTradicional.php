<?php

/**
 * Clase que representa un mueble tradicional. No se pueden crear subclases de ella
 */
final class MuebleTradicional extends MuebleBase
{
    // ------------------------------------------------
    // Propiedades
    // ------------------------------------------------

    // Peso del mueble (entre 15 y 300)
    private float $_peso = 15;

    // Serie del mueble
    private string $_serie = "S01";

    // ------------------------------------------------
    // Constructor
    // ------------------------------------------------

    /**
     * Constructor que recibe las propiedades del mueble y el peso y la serie
     * con sus valores por defecto, menos el nombre que es obligatorio indicarlo.
     *
     * @param string $nombre Nombre del mueble (obligatorio)
     * @param string $fabricante Fabricante del mueble
     * @param string $pais País de fabricación
     * @param integer $anio Año de inicio de fabricación
     * @param string $fechaIniVenta Fecha en la que se empieza a vender
     * @param string $fechaFinVenta Fecha en la que dejará de venderse
     * @param float $precio Precio del mueble
     * @param float $peso Peso del mueble
     * @param string $serie Serie del mueble
     */
    public function __construct(
        string $nombre,
        string $fabricante = "FaMu:",
        string $pais = "ESPAÑA",
        int $anio = 2020,
        string $fechaIniVenta = "01/01/2020",
        string $fechaFinVenta = "31/12/2040",
        float $precio = 30,
        float $peso = 15,
        string $serie = "S01",
    ) {
        // Llamamos al constructor del padre para asignar las propiedades base
        parent::__construct($nombre, $fabricante, $pais, $anio, $fechaIniVenta, $fechaFinVenta, $precio);

        // Si el peso no es válido asignamos el valor por defecto
        if (!$this->setPeso($peso)) {
            $this->setPeso(15);
        }

        // Si la serie no es válida asignamos el valor por defecto
        if (!$this->setSerie($serie)) {
            $this->setSerie("S01");
        }
    }

    // ------------------------------------------------
    // Métodos get
    // ------------------------------------------------

    /**
     * Devuelve el peso del mueble
     *
     * @return float Peso del mueble
     */
    public function getPeso(): float
    {
        return $this->_peso;
    }

    /**
     * Devuelve la serie del mueble
     *
     * @return string Serie del mueble
     */
    public function getSerie(): string
    {
        return $this->_serie;
    }

    // ------------------------------------------------
    // Método set
    // ------------------------------------------------

    /**
     * Guarda el peso si está entre 15 y 300
     * @param float $peso Peso del mueble
     * @return boolean True si se ha guardado y false si no
     */
    public function setPeso(float $peso): bool
    {
        // Si el peso está entre 15 y 300:
        if (validaReal($peso, 15, 300, 15)) {
            // Guardo el peso
            $this->_peso = $peso;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Guarda la serie del mueble
     * @param string $serie Serie del mueble
     * @return boolean Siempre true
     */
    public function setSerie(string $serie): bool
    {
        // Guardo la serie
        $this->_serie = $serie;
        return true;
    }

    // ------------------------------------------------
    // Método toString
    // ------------------------------------------------

    /**
     * Método que devuelve la información del mueble añadiendo el peso y la serie
     *
     * @return string Cadena con los datos del mueble
     */
    public function __toString(): string
    {
        return parent::__toString() .
            ", peso de " .  $this->_peso .
            ", de la serie " .  $this->_serie;
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
        return ["Peso", "Serie"];
    }
}
