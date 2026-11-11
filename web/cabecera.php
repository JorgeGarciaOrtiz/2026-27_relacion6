<?php

define("RUTABASE", dirname(__FILE__));
define("MODO_TRABAJO", "desarrollo");

if (MODO_TRABAJO == "produccion")
    error_reporting(0);
else
    error_reporting(E_ALL);

spl_autoload_register(function ($clase) {
    $ruta = RUTABASE . "/scripts/clases/";
    $ruta2 = RUTABASE . "/aplicacion/clases/curso2026/";
    $fichero = $ruta . "$clase.php";
    $fichero2 = $ruta2 . "$clase.php";

    if (file_exists($fichero)) {
        require_once($fichero);
    } else if (file_exists($fichero2)) {
        require_once($fichero2);
    } else {
        throw new Exception("La clase $clase no se ha encontrado.");
    }
});

include(RUTABASE . "/aplicacion/plantilla/plantilla.php");
include(RUTABASE . "/scripts/librerias/validacion.php");
include(RUTABASE . "/aplicacion/datos/muebles.php");
