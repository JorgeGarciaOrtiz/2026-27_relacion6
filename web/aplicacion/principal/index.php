<?php

// Incluimos la cabecera y la plantilla de la aplicación
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(RUTABASE . "/aplicacion/datos/muebles.php");

// ==========================================================
// CONTROLADOR
// ==========================================================

// Mueble elegido por el usuario, null si no hay ninguno
$muebleSeleccionado = null;

// Inicializamos el índice con 0
// Para saber que mueble del array estamos usando en el momento
$indice = 0;

// Si se ha enviado el formulario:
if ($_POST) {

    // Si el mueble ha llegado desde el formulario:
    if (isset($_POST["mueble"])) {

        // Asigno el valor del formulario a la variable del indice, convertido a entero
        $indice = (int) $_POST["mueble"];

        // Si se ha pulsado el botón Mostrar mueble
        if (isset($_POST["selectMostrar"])) {

            // Guardamos el mueble seleccionado
            $muebleSeleccionado = $muebles[$indice];
        }
    }

    // Si se ha pulsado el botón Modificar mueble
    if (isset($_POST["selectModificar"])) {

        // Redirijo a la página de modificar pasando el índice por la URL
        header("Location: modificarMueble.php?mueble=$indice");

        // Paro la ejecución
        exit;
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
cuerpo($muebleSeleccionado, $indice, $muebles);
finCuerpo();

// ==========================================================
// VISTA
// ==========================================================

function cabecera() {}

/**
 * Muestra el cuerpo de la página principal de la tienda: la tabla con los muebles,
 * el formulario para elegir uno y, si hay uno seleccionado, todos sus datos.
 *
 * @param MuebleBase|null $muebleSeleccionado Mueble elegido por el usuario (null si no hay ninguno)
 * @param integer $indice Posición en el array del mueble elegido (0 si no hay ninguno)
 * @return void
 */
function cuerpo($muebleSeleccionado, int $indice, array $muebles)
{
?>
    <!-- Tabla con los muebles -->
    <table class="tabla">
        <!-- Cada columna -->
        <tr>
            <th>Índice</th>
            <th>Tipo</th>
            <th>Nombre</th>
            <th>Año</th>
            <th>Precio</th>
        </tr>

        <!-- Recorro los datos que necesito de cada mueble -->
        <?php for ($i = 1; $i < count($muebles) + 1; $i++) { ?>
            <!-- Cada fila -->
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo get_class($muebles[$i]) ?></td>
                <td><?php echo $muebles[$i]->getNombre() ?></td>
                <td><?php echo $muebles[$i]->getAnio() ?></td>
                <td><?php echo $muebles[$i]->getPrecio() ?></td>
            </tr>
        <?php } ?>
    </table>

    <!-- Formulario con los dos botones y el select -->
    <br>
    <form action="" method="post">

        <fieldset>
            <legend>Selecciona un mueble</legend>

            <!-- Botones -->
            <input type="submit" name="selectMostrar" value="Mostrar mueble">
            <input type="submit" name="selectModificar" value="Modificar mueble"
                formtarget="_blank">

            <br><select name="mueble">
                <!-- Recorro los datos que necesito de cada mueble -->
                <?php for ($i = 1; $i < count($muebles) + 1; $i++) { ?>
                    <option value="<?php echo $i ?>" <?php if ($indice == $i) { ?> selected <?php } ?>>
                        <?php echo $muebles[$i]->getNombre() . " - " .  $muebles[$i]->getPrecio() . "€" ?>
                    </option>
                <?php } ?>
            </select>
        </fieldset>
    </form>

    <!-- Solo muestro los datos si hay un mueble seleccionado -->
    <?php if ($muebleSeleccionado) { ?>

        <p>
            <!-- Muestro todas las propiedades linea por linea -->
            <?php echo "Nombre: " .  $muebleSeleccionado->getNombre() ?>
            <?php echo "<br>Fabricante: " .  $muebleSeleccionado->getFabricante() ?>
            <?php echo "<br>Pais: " .  $muebleSeleccionado->getPais() ?>
            <?php echo "<br>Año: " .  $muebleSeleccionado->getAnio() ?>
            <?php echo "<br>Fecha de inicio de venta: " .  $muebleSeleccionado->getFechaIniVenta() ?>
            <?php echo "<br>Fecha de fin de venta: " .  $muebleSeleccionado->getFechaFinVenta() ?>
            <?php echo "<br>Precio: " .  $muebleSeleccionado->getPrecio() ?>

            <?php echo "<br>Caracteristicas: " ?>
            <!-- Recorro cada caracteristica del mueble -->
            <?php
            foreach ($muebleSeleccionado->getCaracteristicas() as $caracteristica => $valor) {
                echo "<br> - " . $caracteristica  . ": " .
                    (($valor === true || $valor === false) ? ($valor ? "Si" : "No") : $valor);
            }
            ?>

            <?php echo "<br>Propiedades adicionales: " ?>
            <!-- Recorro cada propiedad del mueble -->
            <?php for ($i = 0; $i < count($muebleSeleccionado->damePropiedadesAdicionales()); $i++) {

                // Guardo la propiedad 
                $propiedad = $muebleSeleccionado->damePropiedadesAdicionales()[$i];

                // Creo el metodo que nos da la el valor de la propiedad
                $metodo = "get" . $propiedad;

                // Muestro la propiedad con su valor
                echo "<br>" . "- " .  $propiedad . ": " . $muebleSeleccionado->$metodo();
            }
            ?>
        </p>
    <?php } ?>
<?php
}
