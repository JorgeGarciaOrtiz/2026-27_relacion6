<?php

abstract class MuebleBase
{
    // ------------------------------------------------
    // Constantes
    // ------------------------------------------------

    const MAXIMO_MUEBLES = 100;

    // ------------------------------------------------
    // Variables de instancia
    // ------------------------------------------------

    private static int $_mueblesCreados;

    // ------------------------------------------------
    // Propiedades
    // ------------------------------------------------

    private string $_nombre;
    private string $_fabricante;
    private string $_pais;
    private int $_anio;
    private string $_fechaIniVenta;
    private string $_fechaFinVenta;
    private float $_precio;

    // ------------------------------------------------
    // Constructor
    // ------------------------------------------------

    // ------------------------------------------------
    // Métodos de la clase
    // ------------------------------------------------

    // ------------------------------------------------
    // Métodos get
    // ------------------------------------------------

    public function getNombre(): string
    {
        return $this->_nombre;
    }

    public function getFabricante(): string
    {
        return $this->_fabricante;
    }

    public function getPais(): string
    {
        return $this->_pais;
    }

    public function getAnio(): int
    {
        return $this->_anio;
    }

    public function getFechaIniVenta(): string
    {
        return $this->_fechaIniVenta;
    }

    public function getFechaFinVenta(): string
    {
        return $this->_fechaFinVenta;
    }

    public function getPrecio(): float
    {
        return $this->_precio;
    }

    // ------------------------------------------------
    // Métodos set
    // ------------------------------------------------

    public function setNombre(string $nombre): bool
    {
        if ((validaCadena($nombre, 40, "")) && (mb_strlen($nombre, 'UTF-8') > 0)) {
            $this->_nombre = mb_strtoupper($nombre);
            return true;
        } else {
            return false;
        }
    }

    // ------------------------------------------------
    // Métodos mágicos
    // ------------------------------------------------
}
