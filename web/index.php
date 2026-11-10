<?php

// Incluimos la cabecera y la plantilla de la aplicación
include_once(dirname(__FILE__) . "/cabecera.php");

// ==========================================================
// CONTROLADOR
// ==========================================================

// ==========================================================
// PLANTILLA
// ==========================================================

// Cabecera de la página
inicioCabecera("TIENDA");
cabecera();
finCabecera();

// Cuerpo de la página
inicioCuerpo("Tienda");
cuerpo();
finCuerpo();

// ==========================================================
// VISTA
// ==========================================================

function cabecera() {}

function cuerpo()
{
?>
    <a href="./index.php">Inicio</a>
    <br>
    <a href="">Tienda</a>
<?php
}
