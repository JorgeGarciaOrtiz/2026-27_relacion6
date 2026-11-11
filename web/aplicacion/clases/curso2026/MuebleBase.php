<?php

/**
 * Clase abstracta que representa un mueble de la tienda
 */
abstract class MuebleBase
{
    // ------------------------------------------------
    // Constante
    // ------------------------------------------------

    // Número máximo de muebles que se pueden crear
    const MAXIMO_MUEBLES = 100;

    // ------------------------------------------------
    // Variable de clase
    // ------------------------------------------------

    // Número de muebles creados hasta el momento
    private static int $_mueblesCreados = 0;

    // ------------------------------------------------
    // Propiedades
    // ------------------------------------------------

    // Nombre del mueble (obligatorio)
    private string $_nombre;

    // Fabricante del mueble
    private string $_fabricante = "FaMu:";

    // País de fabricación
    private string $_pais = "ESPAÑA";

    // Año de inicio de fabricación
    private int $_anio = 2020;

    // Fecha en la que se empieza a vender
    private string $_fechaIniVenta = "01/01/2020";

    // Fecha en la que dejará de venderse
    private string $_fechaFinVenta = "31/12/2040";

    // Precio del mueble
    private float $_precio = 30;

    // Caracteristicas del mueble
    private Caracteristicas $_caracteristicas;

    // ------------------------------------------------
    // Constructor
    // ------------------------------------------------

    /**
     * Constructor que recibe las propiedades con sus valores por defecto,
     * menos en el caso del nombre que es obligatorio indicarlo.
     * Si se ha superado el máximo de instancias creadas, lanza una excepción.
     *
     * @param string $nombre Nombre del mueble (obligatorio)
     * @param string $fabricante Fabricante del mueble
     * @param string $pais País de fabricación
     * @param integer $anio Año de inicio de fabricación
     * @param string $fechaIniVenta Fecha en la que se empieza a vender
     * @param string $fechaFinVenta Fecha en la que dejará de venderse
     * @param float $precio Precio del mueble
     */
    public function __construct(
        string $nombre,
        string $fabricante = "FaMu:",
        string $pais = "ESPAÑA",
        int $anio = 2020,
        string $fechaIniVenta = "01/01/2020",
        string $fechaFinVenta = "31/12/2040",
        float $precio = 30
    ) {
        // Si ya se ha llegado al máximo de muebles, se lanza una excepción
        if (self::MAXIMO_MUEBLES <= self::$_mueblesCreados) {
            throw new Exception("Número maximo de muebles alcanzado");
        }

        // Si el nombre no es válido, se lanza una excepción
        if (!$this->setNombre($nombre)) {
            throw new Exception("El nombre no es válido");
        }

        // Si el país no es válido, se asigna el valor por defecto
        if (!$this->setPais($pais)) {
            $this->setPais("ESPAÑA");
        }

        // Si el fabricante no es válido, se asigna el valor por defecto
        if (!$this->setFabricante($fabricante)) {
            $this->setFabricante("FaMu:");
        }

        // Si el año no es válido, se asigna el valor por defecto
        if (!$this->setAnio($anio)) {
            $this->setAnio(2020);
        }

        // Si la fecha de inicio no es válida, se asigna el 01/01 del año de fabricación
        if (!$this->setFechaIniVenta($fechaIniVenta)) {
            $this->setFechaIniVenta('01/01/' . $this->_anio);
        }

        // Si la fecha de fin no es válida, se asigna el valor por defecto
        if (!$this->setFechaFinVenta($fechaFinVenta)) {
            $this->setFechaFinVenta("31/12/2040");
        }

        // Si el precio no es válido, se asigna el valor por defecto
        if (!$this->setPrecio($precio)) {
            $this->setPrecio(30);
        }

        // Creo el objeto donde se guardarán las características
        $this->_caracteristicas = new Caracteristicas();

        // Sumo uno al contador de muebles creados
        self::$_mueblesCreados++;
    }

    // ------------------------------------------------
    // Métodos
    // ------------------------------------------------

    /**
     * Método que devuelve un array con el nombre de las propiedades adicionales a la clase base
     *
     * @return array
     */
    public function damePropiedadesAdicionales(): array
    {
        return [];
    }

    /**
     * Método de clase que indica si se pueden crear más instancias de la clase.
     *
     * @param integer $numero Número de muebles que aún se pueden crear de la clase
     * @return boolean True si se pueden crear más instancias y false en caso contrario
     */
    public static function puedeCrear(int &$numero): bool
    {
        // Si se ha llegado al máximo de muebles no se pueden crear más
        if (self::MAXIMO_MUEBLES <= self::$_mueblesCreados) {
            // El número de muebles que se pueden crear es de cero
            $numero = 0;
            return false;
        }

        // Calculo cuántos muebles se pueden crear todavía
        $numero = self::MAXIMO_MUEBLES - self::$_mueblesCreados;

        return true;
    }

    /**
     * Añade características al mueble recibiendo pares de nombre y valor.
     * Si el número de argumentos es impar, se descarta el último
     *
     * @param mixed ...$argumentos Pares de nombre de la característica y su valor
     * @return void
     */
    public function anadirCaracteristicas(mixed ...$argumentos): void
    {
        // Si el número de argumentos es impar, quito el último
        if (count($argumentos) % 2 !== 0) {
            array_pop($argumentos);
        }

        // Recorro los argumentos de 2 en 2 y añado cada característica
        for ($i = 0; $i < count($argumentos); $i += 2) {
            $this->_caracteristicas->{$argumentos[$i]} = $argumentos[$i + 1];
        }
    }

    // ------------------------------------------------
    // Método toString
    // ------------------------------------------------

    /**
     * Método que devuelve la información del mueble
     *
     * @return string Cadena con los datos del mueble
     */
    public function __toString(): string
    {
        return "MUEBLE de clase " . static::class .
            " con nombre " . $this->_nombre .
            ", fabricante " . $this->_fabricante .
            ", fabricado en " . $this->_pais .
            " a partir del año " . $this->_anio .
            ", vendido desde " . $this->_fechaIniVenta .
            " hasta " . $this->_fechaFinVenta .
            ", precio " . $this->_precio . 
            ", características: " . $this->_caracteristicas;
    }

    // ------------------------------------------------
    // Métodos get
    // ------------------------------------------------

    /**
     * Devuelve el nombre del mueble
     *
     * @return string Nombre del mueble
     */
    public function getNombre(): string
    {
        return $this->_nombre;
    }

    /**
     * Devuelve el fabricante del mueble
     *
     * @return string Fabricante del mueble
     */
    public function getFabricante(): string
    {
        return $this->_fabricante;
    }

    /**
     * Devuelve el país de fabricación
     *
     * @return string País de fabricación
     */
    public function getPais(): string
    {
        return $this->_pais;
    }

    /**
     * Devuelve el año de inicio de fabricación
     *
     * @return integer Año de inicio de fabricación
     */
    public function getAnio(): int
    {
        return $this->_anio;
    }

    /**
     * Devuelve la fecha en la que se empieza a vender
     *
     * @return string Fecha de inicio de venta
     */
    public function getFechaIniVenta(): string
    {
        return $this->_fechaIniVenta;
    }

    /**
     * Devuelve la fecha en la que dejará de venderse
     *
     * @return string Fecha de fin de venta
     */
    public function getFechaFinVenta(): string
    {
        return $this->_fechaFinVenta;
    }

    /**
     * Devuelve el precio del mueble
     *
     * @return float Precio del mueble
     */
    public function getPrecio(): float
    {
        return $this->_precio;
    }

    /**
     * Devuelve todas las caracteristicas
     *
     * @return Caracteristicas Objeto con las características del mueble
     */
    public function getCaracteristicas(): Caracteristicas
    {
        return $this->_caracteristicas;
    }

    // ------------------------------------------------
    // Métodos set
    // ------------------------------------------------

    /**
     * Guarda el nombre del mueble si no está vacío y no pasa de 40 caracteres, y lo pone en mayúsculas
     * 
     * @param string $nombre Nombre del mueble
     * @return boolean True si se ha guardado y false si no
     */
    public function setNombre(string $nombre): bool
    {
        // Si el nombre no pasa de 40 caracteres y no esta vacío:
        if ((validaCadena($nombre, 40, "")) && (mb_strlen($nombre, 'UTF-8') > 0)) {
            // Lo guardo en mayúsculas
            $this->_nombre = mb_strtoupper($nombre);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Guarda el fabricante, le añade "FaMu:" delante si no lo tiene y lo corta a 30 caracteres
     * 
     * @param string $fabricante Fabricante del mueble
     * @return boolean Siempre true
     */
    public function setFabricante(string $fabricante): bool
    {
        // Si está vacío ponemos solo "FaMu:"
        if ($fabricante === "") {
            $fabricante = "FaMu:";
        }

        // Si no empieza por "FaMu:" lo añadimos al principio
        if (!str_starts_with($fabricante, "FaMu:")) {
            $fabricante = "FaMu:" . $fabricante;
        }

        // Si pasa de 30 caracteres se corta la cadena
        if (mb_strlen($fabricante) > 30) {
            $fabricante = mb_substr($fabricante, 0, 30);
        }

        // Guardo el fabricante corregido
        $this->_fabricante = $fabricante;
        return true;
    }

    /**
     * Guarda el país si no pasa de 20 caracteres
     * 
     * @param string $pais País de fabricación
     * @return boolean True si se ha guardado y false si no
     */
    public function setPais(string $pais): bool
    {
        // Si el país no pasa de 20 caracteres:
        if (validaCadena($pais, 20, "ESPAÑA")) {
            // Guardo el país
            $this->_pais = $pais;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Guarda el año de inicio de fabricación si está entre 2020 y el año actual
     * 
     * @param integer $anio Año de inicio de fabricación
     * @return boolean True si se ha guardado y false si no
     */
    public function setAnio(int $anio): bool
    {
        // Si el año está entre 2020 y el año actual:
        if (validaEntero($anio, 2020, (int) date('Y'), 2020)) {
            // Guardo el año
            $this->_anio = $anio;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Guarda la fecha de inicio de venta si es una fecha válida y no es anterior al 01/01 del año de fabricación
     * 
     * @param string $fechaIniVenta Fecha de inicio de venta
     * @return boolean True si se ha guardado y false si no
     */
    public function setFechaIniVenta(string $fechaIniVenta): bool
    {
        // Si la fecha es valida:
        if (validaFecha($fechaIniVenta, "01/01/2020")) {

            // Paso las dos fechas a DateTime para poder compararlas
            $anioFabricacion = DateTime::createFromFormat('!d/m/Y', '01/01/' . $this->_anio);
            $fechaInicioVenta = DateTime::createFromFormat('!d/m/Y', $fechaIniVenta);

            // Si la fecha de venta no es anterior a la de fabricación:
            if ($anioFabricacion <= $fechaInicioVenta) {
                // Guardo la fecha de inicio de venta
                $this->_fechaIniVenta = $fechaIniVenta;
                return true;
            }
        }

        return false;
    }

    /**
     * Guarda la fecha de fin de venta si es una fecha válida y no es anterior a la fecha de inicio de venta
     * 
     * @param string $fechaFinVenta Fecha de fin de venta
     * @return boolean True si se ha guardado y false si no
     */
    public function setFechaFinVenta(string $fechaFinVenta): bool
    {
        // Si la fecha es valida:
        if (validaFecha($fechaFinVenta, "31/12/2040")) {

            // Paso las dos fechas a DateTime para poder compararlas
            $fechaInicialVenta = DateTime::createFromFormat('!d/m/Y', $this->_fechaIniVenta);
            $fechaFinalVenta = DateTime::createFromFormat('!d/m/Y', $fechaFinVenta);

            // Si la fecha de fin no es anterior a la de inicio:
            if ($fechaInicialVenta <= $fechaFinalVenta) {
                // Guardo la fecha de fin de venta
                $this->_fechaFinVenta = $fechaFinVenta;
                return true;
            }
        }

        return false;
    }

    /**
     * Guarda el precio del mueble si no es menor de 30
     * 
     * @param float $precio Precio del mueble
     * @return boolean True si se ha guardado y false si no
     */
    public function setPrecio(float $precio): bool
    {
        // Si el precio no es menor que 30:
        if ($precio >= 30) {
            // Guardo el precio
            $this->_precio = $precio;
            return true;
        } else {
            return false;
        }
    }

    // ------------------------------------------------
    // Métodos mágicos
    // ------------------------------------------------

    /**
     * Impide crear propiedades nuevas que no existen en la clase
     * 
     * @param string $nombre Nombre de la propiedad
     * @param mixed $valor Valor que se intenta asignar
     * @return void
     */
    public function __set(string $nombre, mixed $valor)
    {
        // Si intento crear una propiedad nueva, se lanza un error
        throw new Exception("No existe la propiedad " . $nombre);
    }

    /**
     * Impide leer propiedades que no existen o no son accesibles
     * 
     * @param string $nombre Nombre de la propiedad
     * @return mixed
     */
    public function __get(string $nombre)
    {
        // Si intento leer una propiedad que no existe, se lanza un error
        throw new Exception("No existe la propiedad " . $nombre);
    }

    /**
     * Indica que no existe ninguna propiedad dinámica
     * 
     * @param string $nombre Nombre de la propiedad
     * @return boolean Siempre false
     */
    public function __isset(string $nombre): bool
    {
        return false;
    }

    /**
     * Impide borrar propiedades que no existen o no son accesibles
     * 
     * @param string $nombre Nombre de la propiedad
     * @return void
     */
    public function __unset(string $nombre)
    {
        // Si intento borrar una propiedad que no existe, se lanza un error
        throw new Exception("No existe la propiedad " . $nombre);
    }
}
