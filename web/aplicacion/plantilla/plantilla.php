<?php

function paginaError($mensaje)
{
    header("HTTP/1.0 404 $mensaje");
    inicioCabecera("PRACTICA");
    finCabecera();
    inicioCuerpo("ERROR");

    echo "<br/>\n";
    echo $mensaje;
    echo "<br/>\n";
    echo "<br/>\n";
    echo "<br/>\n";
    echo "<a href='/index.php'>Ir a la pagina principal</a>\n";

    finCuerpo();
}

function inicioCabecera($titulo)
{
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title><?php echo $titulo; ?></title>
        <meta name="description" content="">
        <meta name="author" content="Administrador">

        <meta name="viewport" content="width=device-width; initial-scale=1.0">

        <link rel="shortcut icon" href="/favicon.ico">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="stylesheet" type="text/css" href="/estilos/base.css">
    <?php
}

function finCabecera()
{
    ?>
    </head>
<?php
}

function inicioCuerpo(string $cabecera, ?array $ubicacion = null)
{
    global $acceso;
?>

    <body>
        <div id="documento">
            <header>
                <a href="/index.php">
                    <img src="/imagenes/logo2.png" alt="Logo IES Pedro Espinosa" width="50" height="50" style="vertical-align: middle;">
                </a>
                <h1 id="titulo" style="display: inline-block; vertical-align: middle;"><?php echo $cabecera; ?></h1>
            </header>

            <div id="barraLogin"></div>

            <div id="barraMenu">
                <ul>
                    <li><a href="/index.php">Inicio</a></li>
                    <li><a href="/aplicacion/pruebas/index.php">Pruebas</a></li>
                    <li><a href="/aplicacion/practicas">Ejercicios</a></li>
                </ul>
            </div>

            <?php
            if ($ubicacion !== null) {
            ?>
                <div id="barraUbicacion">
                    <?php mostrarBarraUbicacion($ubicacion); ?>
                </div>
            <?php
            }
            ?>

            <div>
            <?php
        }

        function finCuerpo()
        {
            ?>
                <br />
                <br />
            </div>

            <footer>
                <hr width="90%" />
                <div>
                    &copy; Copyright by Jorge García Ortiz
                </div>
            </footer>
        </div>
    </body>

    </html>
<?php
        }

        function mostrarBarraUbicacion(array $ubicacion)
        {
            echo "<nav class='barraModdle'>";

            $total = count($ubicacion);
            $contador = 0;

            foreach ($ubicacion as $nombre => $url) {
                $contador++;

                if ($contador < $total) {
                    echo "<a href='{$url}'>{$nombre}</a> &raquo; ";
                } else {
                    echo "<span>{$nombre}</span>";
                }
            }

            echo "</nav>";
        }
