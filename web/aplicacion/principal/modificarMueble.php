<?php

// Incluimos la cabecera y la plantilla de la aplicación
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(RUTABASE . "/aplicacion/datos/muebles.php");

// ==========================================================
// CONTROLADOR
// ==========================================================

// Indica si se muestra el resumen (solo cuando se envía el formulario sin errores)
$mostrarResumen = false;

// Objeto del mueble que vamos a modificar (null hasta que lo encontremos)
$mueble = null;

// Inicializamos el índice con 0
// Para saber que mueble del array estamos usando en el momento
$indice = 0;

// Si el mueble ha llegado desde el formulario:
if (isset($_POST["mueble"])) { // name del select

    // Asigno el valor del formulario a la variable del indice, convertido a entero
    $indice = (int) $_POST["mueble"];

    // Guardamos el mueble seleccionado
    $mueble = $muebles[$indice];
}

// Aqui dentro van todos las propiedades
$propiedades = [];

// Recorro las propiedades del mueble
for ($i = 0; $i < count($mueble->damePropiedadesAdicionales()); $i++) {
    // Guardo la propiedad 
    $propiedad = $mueble->damePropiedadesAdicionales()[$i];
    // Creo el metodo que nos da el valor de la propiedad
    $metodo = "get" . $propiedad;
    // Guardo la clave y el valor de la propiedad 
    $propiedades[$propiedad] = $mueble->$metodo();
}

// Creamos un array con los datos del mueble
$datos = [
    "nombre" => $mueble->getNombre(),
    "fabricante" => $mueble->getFabricante(),
    "pais" => $mueble->getPais(),
    "año" => $mueble->getAnio(),
    "fechaInicio" => $mueble->getFechaIniVenta(),
    "fechaFin" => $mueble->getFechaFinVenta(),
    "precio" => $mueble->getPrecio(),
    "caracteristicas" => $mueble->getCaracteristicas(),
    "propiedades"  => $propiedades,
];

// Creamos un array con los errores
$errores = [];

if (isset($_POST["guardar"])) { // name del botón

    // ------------------------------------------------------
    // Nombre
    // ------------------------------------------------------

    // Inicializamos el nombre con el valor inicial del array de datos
    $nombre = $datos["nombre"];

    // Si el nombre ha llegado desde el formulario:
    if (isset($_POST["nombre"])) {

        // Asigno el valor del formulario a la variable para el nombre
        $nombre = $_POST["nombre"];

        // Le quito los espacios de los extremos
        $nombre = trim($nombre);

        // Pongo el nombre en mayúscula
        $nombre = mb_strtoupper($nombre);
    }

    // Si esta vacio dara error
    if ($nombre === "") {
        $errores["nombre"][] = "El nombre esta vacio";
    }

    // Si ocupa más de 40 caracteres dara error
    if (mb_strlen($nombre, 'UTF-8') > 40) {
        $errores["nombre"][] = "El nombre no puede ocupar más de 40 caracteres";
    }

    // Guardamos el nombre para mostrarlo en el formulario
    $datos["nombre"] = $nombre;

    // ------------------------------------------------------
    // Pais
    // ------------------------------------------------------

    // Inicializamos el pais con el valor inicial del array de datos
    $pais = $datos["pais"];

    // Si el pais ha llegado desde el formulario:
    if (isset($_POST["pais"])) {

        // Asigno el valor del formulario a la variable para el pais
        $pais = $_POST["pais"];

        // Le quito los espacios de los extremos
        $pais = trim($pais);
    }

    // Si ocupa más de 20 caracteres dara error
    if (mb_strlen($pais, 'UTF-8') > 20) {
        $errores["pais"][] = "El pais no puede ocupar más de 20 caracteres";
    }

    // Guardamos el pais para mostrarlo en el formulario
    $datos["pais"] = $pais;

    // ------------------------------------------------------
    // Precio
    // ------------------------------------------------------

    // Inicializamos el precio con el valor inicial del array de datos
    $precio = $datos["precio"];

    // Si el precio ha llegado desde el formulario:
    if (isset($_POST["precio"]) && is_numeric($_POST["precio"])) {

        // Asigno el valor del formulario a la variable para el precio
        $precio = (float) $_POST["precio"];
    }

    // Si vale menos de 30 dará error
    if ($precio < 30) {
        $errores["precio"][] = "El precio no puede ser menor de 30";
    }

    // Guardamos el precio para mostrarlo en el formulario
    $datos["precio"] = $precio;

    // ------------------------------------------------------

    // Si no hay ningún error:
    if (!$errores) {

        // Actualizamos el mueble con los datos nuevos
        $mueble->setNombre($datos["nombre"]);

        // Mostramos el resumen en lugar del formulario
        $mostrarResumen = true;
    }
}

// ==========================================================
// PLANTILLA
// ==========================================================

// Cabecera de la página
inicioCabecera("TIENDA");
cabecera();
finCabecera();

// Cuerpo de la página
inicioCuerpo("Tienda");
cuerpo($datos, $errores, $indice, $mostrarResumen);
finCuerpo();

// ==========================================================
// VISTA
// ==========================================================

function cabecera() {}

/**
 * Muestra el cuerpo de la página: el resumen si los datos son correctos
 * o el formulario con los datos y los errores en caso contrario.
 *
 * @param array $datos Datos del mueble que se muestran
 * @param array $errores Errores encontrados al validar
 * @param integer $indice Posición en el array del mueble que se modifica
 * @param boolean $mostrarResumen True si hay que mostrar el resumen
 * @return void
 */
function cuerpo(array $datos, array $errores, int $indice, bool $mostrarResumen)
{
    // Si los datos son correctos, mostramos el resumen
    if ($mostrarResumen) {
        resumen($datos);
    } else {
        // Si no, mostramos el formulario con los datos y los errores
        formulario($datos, $errores, $indice);
    }
}

/**
 * Muestra los errores, si los hay, y el formulario con los datos del mueble.
 *
 * @param array $datos Datos que se muestran en los campos del formulario
 * @param array $errores Errores encontrados al validar
 * @param integer $indice Posición del mueble, se envía en un campo oculto
 * @return void
 */
function formulario(array $datos, array $errores, int $indice)
{
    // Si hay errores, los mostramos todos (campo => mensaje)
    if ($errores) {
        echo "<div class='error'>";
        foreach ($errores as $clave => $valor) {
            foreach ($valor as $error)
                echo "$clave => $error<br>" . PHP_EOL;
        }
        echo "</div>";
    }
?>
    <form action="" method="post">

        <!-- Información oculta -->
        <input type="hidden" name="mueble" value="<?php echo $indice; ?>">

        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" maxlength="40"
            value="<?php echo $datos["nombre"]; ?>">

        <br><label for="fabricante">Fabricante: </label>
        <input type="text" name="fabricante" id="fabricante" maxlength="30"
            value="<?php echo $datos["fabricante"]; ?>">

        <br><label for="pais">Pais: </label>
        <input type="text" name="pais" id="pais" maxlength="20"
            value="<?php echo $datos["pais"]; ?>">

        <br><label for="año">Año: </label>
        <input type="text" name="año" id="año"
            value="<?php echo $datos["año"]; ?>">

        <br><label for="fechaInicio">Fecha de inicio: </label>
        <input type="text" name="fechaInicio" id="fechaInicio"
            value="<?php echo $datos["fechaInicio"]; ?>">

        <br><label for="fechaFin">Fecha de fin: </label>
        <input type="text" name="fechaFin" id="fechaFin"
            value="<?php echo $datos["fechaFin"]; ?>">

        <br><label for="precio">Precio: </label>
        <input type="text" name="precio" id="precio"
            value="<?php echo $datos["precio"]; ?>">

        <br><label for="caracteristicas">Caracteristicas: </label>
        <?php
        foreach ($datos["caracteristicas"] as $caracteristica => $valor) {
        ?>
            <br><label for="<?php echo $caracteristica ?>"> <?php echo $caracteristica . ": " ?> </label>
            <input type="text" name="<?php echo $caracteristica ?>" id="<?php echo $caracteristica ?>"
                value="<?php echo $valor ?>">
        <?php
        }
        ?>

        <br><label for="propiedades">Propiedades adicionales: </label>
        <?php
        foreach ($datos["propiedades"] as $propiedad => $valor) {
        ?>
            <br><label for="<?php echo $propiedad ?>"> <?php echo $propiedad . ": " ?> </label>
            <input type="text" name="<?php echo $propiedad ?>" id="<?php echo $propiedad ?>"
                value="<?php echo $valor ?>">
        <?php
        }
        ?>

        <br><br><input type="submit" name="guardar" value="Guardar cambios">

        <?php echo "<br><br><a href='index.php'>⬅ Atras</a>"; ?>
    </form>
<?php
}

/**
 * Muestra un resumen con los datos del mueble una vez modificado,
 * cuando todos los datos introducidos son correctos.
 *
 * @param array $datos Datos validados del formulario
 * @return void
 */
function resumen(array $datos)
{
    // Mostramos todos los datos introducidos
    echo "<h3>Resumen del formulario</h3>";

    echo "Nombre: " . $datos["nombre"] . "<br>";
    echo "Fabricante: " . $datos["fabricante"] . "<br>";
    echo "Pais: " . $datos["pais"] . "<br>";
    echo "Año: " . $datos["año"] . "<br>";
    echo "Fecha de inicio de venta: " . $datos["fechaInicio"] . "<br>";
    echo "Fecha de fin de venta: " . $datos["fechaFin"] . "<br>";
    echo "Precio: " . $datos["precio"] . "<br>";

    echo "<br>Caracteristicas:<br>";
    foreach ($datos["caracteristicas"] as $caracteristica => $valor) {
        echo $caracteristica . ": " .
            (($valor === true || $valor === false) ? ($valor ? "Si" : "No") : $valor);
        echo "<br>";
    }

    echo "<br>Propiedades adicionales: <br>";
    foreach ($datos["propiedades"] as $propiedad => $valor) {
        echo $propiedad . ": " . $valor;
        echo "<br>";
    }

    echo "<br><a href='index.php'>⬅ Atras</a>";
}
