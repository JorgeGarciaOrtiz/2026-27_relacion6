<?php

// Incluimos la cabecera y la plantilla de la aplicación
include_once(dirname(__FILE__) . "/../../cabecera.php");

// ==========================================================
// CONTROLADOR
// ==========================================================

// ----------------------------------------------------------
// Mueble Base
// ----------------------------------------------------------

// Creo un mueble reciclado
$muebleBase = new MuebleReciclado("mesa");

// Paso un nombre correcto
$nombreCorrecto = $muebleBase->setNombre("mesa grande");
// Paso un nombre incorrecto
$nombreIncorrecto = $muebleBase->setNombre("");

// Paso un fabricante (siempre es correcto)
$fabricanteCorrecto = $muebleBase->setFabricante("Ikea");

// Paso un país correcto
$paisCorrecto = $muebleBase->setPais("FRANCIA");
// Paso un país incorrecto
$paisIncorrecto = $muebleBase->setPais("UN PAIS CON MAS DE VEINTE LETRAS");

// Paso un año correcto
$anioCorrecto = $muebleBase->setAnio(2022);
// Paso un año incorrecto
$anioIncorrecto = $muebleBase->setAnio(2010);

// Paso una fecha de inicio correcta
$fechaIniCorrecta = $muebleBase->setFechaIniVenta("15/06/2023");
// Paso una fecha de inicio incorrecta (anterior al año de fabricación)
$fechaIniIncorrecta = $muebleBase->setFechaIniVenta("01/01/2021");

// Paso una fecha de fin correcta
$fechaFinCorrecta = $muebleBase->setFechaFinVenta("31/12/2030");
// Paso una fecha de fin incorrecta (anterior a la de inicio)
$fechaFinIncorrecta = $muebleBase->setFechaFinVenta("01/01/2023");

// Paso un precio correcto
$precioCorrecto = $muebleBase->setPrecio(50);
// Paso un precio incorrecto
$precioIncorrecto = $muebleBase->setPrecio(10);

// Devuelvo todos los valores
$nombre = $muebleBase->getNombre();
$fabricante = $muebleBase->getFabricante();
$pais = $muebleBase->getPais();
$anio = $muebleBase->getAnio();
$fechaIni = $muebleBase->getFechaIniVenta();
$fechaFin = $muebleBase->getFechaFinVenta();
$precio = $muebleBase->getPrecio();

// Añado características y las devuelvo como objeto
$muebleBase->anadirCaracteristicas("saliente", true, "precio", 300);
$caracteristicasMueble = $muebleBase->getCaracteristicas();

// Compruebo si se pueden crear más muebles y cuántos quedan
$quedan = 0;
$puedeCrear = MuebleBase::puedeCrear($quedan);

// Creo un mueble con valores incorrectos para ver los valores por defecto
$muebleDefecto = new MuebleReciclado(
    "sofa",
    "Ikea",
    "UN PAIS CON MAS DE VEINTE LETRAS",
    2015,
    "01/01/2010",
    "01/01/2000",
    5,
    500
);

// Variables donde guardo los mensajes de error
$error3 = "";
$error4 = "";

try {
    // Intento crear un mueble sin nombre para provocar el error
    $muebleSinNombre = new MuebleReciclado("");
} catch (Exception $e) {
    $error3 = $e->getMessage();
}

try {
    // Intento crear una propiedad nueva para provocar el error
    $muebleBase->color = "rojo";
} catch (Exception $e) {
    $error4 = $e->getMessage();
}

// ----------------------------------------------------------
// Mueble Reciclado
// ----------------------------------------------------------

// Creo un mueble reciclado
$muebleReciclado = new MuebleReciclado("silla");

// Añado características por parejas
$muebleReciclado->anadirCaracteristicas("color", "rojo", "patas", 4);

// Pruebo con un número impar (el último se descarta)
$muebleReciclado->anadirCaracteristicas("material", "madera", "sobra");

// Pasamos un porcentaje de reciclado correcto
$porcentajeCorrecto = $muebleReciclado->setPorcentajeReciclado(50);
// Pasamos un porcentaje de reciclado incorrecto
$porcentajeIncorrecto = $muebleReciclado->setPorcentajeReciclado(5000);

// Devolvemos el porcentaje de reciclado
$porcentaje = $muebleReciclado->getPorcentajeReciclado();

// Pasamos todas las propiedades adicionales
$adicionalesReciclado = implode(", ", $muebleReciclado->damePropiedadesAdicionales());

// ----------------------------------------------------------
// Mueble Tradicional
// ----------------------------------------------------------

// Creo un mueble tradicional
$muebleTradicional = new MuebleTradicional("armario");

// Añado características por parejas
$muebleTradicional->anadirCaracteristicas("color", "rojo", "patas", 4);

// Pruebo con un número impar (el último se descarta)
$muebleTradicional->anadirCaracteristicas("material", "madera", "sobra");

// Pasamos un peso correcto
$pesoCorrecto = $muebleTradicional->setPeso(15);
// Pasamos un peso incorrecto
$pesoIncorrecto = $muebleTradicional->setPeso(5555);
// Pasamos una serie (todas son correctas)
$serieCorrecta = $muebleTradicional->setSerie("S05");

// Devolvemos peso
$peso = $muebleTradicional->getPeso();
// Devolvemos la serie
$serie = $muebleTradicional->getSerie();

// Pasamos todas las propiedades adicionales
$adicionalesTradicional = implode(", ", $muebleTradicional->damePropiedadesAdicionales());

// ----------------------------------------------------------
// Caracteristicas
// ----------------------------------------------------------

// Creo un nuevo objeto 
$caracteristicas = new Caracteristicas();

// Añado varias caracteristicas al objeto
$caracteristicas->color = "rojo";
$caracteristicas->material = "madera";
$caracteristicas->patas = 4;
$caracteristicas->ULTIMA = "ULTIMA";
// Modifico una caracteristicas despues de crear la ultima
$caracteristicas->color = "azul";

// Guardo el objeto como cadena antes de borrar nada
$caracteristicasCadena = (string) $caracteristicas;

// Variables donde guardo los mensajes de error
$error1 = "";
$error2 = "";

try {
    // Añado otra caracteristica para provocar el error
    $caracteristicas->garantia = "2 años"; // Error no se pueden crear más caracteristicas
} catch (Exception $e) {
    $error1 = $e->getMessage();
}

// __get: leo una caracteristica que si existe
$material = $caracteristicas->material;

try {
    // __get: leo una caracteristica que no existe para provocar el error
    $pesoCaracteristica = $caracteristicas->peso; // No existe la propiedad: peso
} catch (Exception $e) {
    $error2 = $e->getMessage();
}

// __isset: compruebo si las propiedades existen (la segunda es inventada)
$existeMaterial = isset($caracteristicas->material); // true
$existePeso = isset($caracteristicas->peso); // false

// __unset: elimino una caracteristica y compruebo que ya no esta
unset($caracteristicas->material);
$existeMaterialTrasBorrar = isset($caracteristicas->material); // false

// ==========================================================
// PLANTILLA
// ==========================================================

// Cabecera de la página
inicioCabecera("TIENDA");
cabecera();
finCabecera();

// Cuerpo de la página
inicioCuerpo("Tienda");
cuerpo(
    $nombreCorrecto,
    $nombreIncorrecto,
    $fabricanteCorrecto,
    $paisCorrecto,
    $paisIncorrecto,
    $anioCorrecto,
    $anioIncorrecto,
    $fechaIniCorrecta,
    $fechaIniIncorrecta,
    $fechaFinCorrecta,
    $fechaFinIncorrecta,
    $precioCorrecto,
    $precioIncorrecto,
    $nombre,
    $fabricante,
    $pais,
    $anio,
    $fechaIni,
    $fechaFin,
    $precio,
    $caracteristicasMueble,
    $puedeCrear,
    $quedan,
    $muebleDefecto,
    $error3,
    $error4,
    $muebleReciclado,
    $porcentaje,
    $porcentajeCorrecto,
    $porcentajeIncorrecto,
    $adicionalesReciclado,
    $muebleTradicional,
    $peso,
    $serie,
    $pesoCorrecto,
    $pesoIncorrecto,
    $serieCorrecta,
    $adicionalesTradicional,
    $caracteristicas,
    $caracteristicasCadena,
    $material,
    $error1,
    $error2,
    $existeMaterial,
    $existePeso,
    $existeMaterialTrasBorrar
);
finCuerpo();

// ==========================================================
// VISTA
// ==========================================================

function cabecera() {}

function cuerpo(
    bool $nombreCorrecto,
    bool $nombreIncorrecto,
    bool $fabricanteCorrecto,
    bool $paisCorrecto,
    bool $paisIncorrecto,
    bool $anioCorrecto,
    bool $anioIncorrecto,
    bool $fechaIniCorrecta,
    bool $fechaIniIncorrecta,
    bool $fechaFinCorrecta,
    bool $fechaFinIncorrecta,
    bool $precioCorrecto,
    bool $precioIncorrecto,
    string $nombre,
    string $fabricante,
    string $pais,
    int $anio,
    string $fechaIni,
    string $fechaFin,
    float $precio,
    Caracteristicas $caracteristicasMueble,
    bool $puedeCrear,
    int $quedan,
    MuebleReciclado $muebleDefecto,
    string $error3,
    string $error4,
    MuebleReciclado $muebleReciclado,
    int $porcentaje,
    bool $porcentajeCorrecto,
    bool $porcentajeIncorrecto,
    string $adicionalesReciclado,
    MuebleTradicional $muebleTradicional,
    float $peso,
    string $serie,
    bool $pesoCorrecto,
    bool $pesoIncorrecto,
    bool $serieCorrecta,
    string $adicionalesTradicional,
    Caracteristicas $caracteristicas,
    string $caracteristicasCadena,
    string $material,
    string $error1,
    string $error2,
    bool $existeMaterial,
    bool $existePeso,
    bool $existeMaterialTrasBorrar
) {
    // ----------------------------------------------------------
    // Mueble Base
    // ----------------------------------------------------------

    echo "<h2>Mueble Base</h2>";

    // Muestro si los valores que le he asignado son correctos
    echo "Nombre correcto -> " . ($nombreCorrecto ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Nombre incorrecto -> " . ($nombreIncorrecto ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Fabricante correcto -> " . ($fabricanteCorrecto ? "true" : "false") . "<br>" . PHP_EOL;
    echo "País correcto -> " . ($paisCorrecto ? "true" : "false") . "<br>" . PHP_EOL;
    echo "País incorrecto -> " . ($paisIncorrecto ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Año correcto -> " . ($anioCorrecto ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Año incorrecto -> " . ($anioIncorrecto ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Fecha inicio correcta -> " . ($fechaIniCorrecta ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Fecha inicio incorrecta -> " . ($fechaIniIncorrecta ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Fecha fin correcta -> " . ($fechaFinCorrecta ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Fecha fin incorrecta -> " . ($fechaFinIncorrecta ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Precio correcto -> " . ($precioCorrecto ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Precio incorrecto -> " . ($precioIncorrecto ? "true" : "false") . "<br><br>" . PHP_EOL;

    // Muestro los valores guardados
    echo "Nombre: " . $nombre . "<br>" . PHP_EOL;
    echo "Fabricante: " . $fabricante . "<br>" . PHP_EOL;
    echo "País: " . $pais . "<br>" . PHP_EOL;
    echo "Año: " . $anio . "<br>" . PHP_EOL;
    echo "Fecha inicio: " . $fechaIni . "<br>" . PHP_EOL;
    echo "Fecha fin: " . $fechaFin . "<br>" . PHP_EOL;
    echo "Precio: " . $precio . "<br><br>" . PHP_EOL;

    // Muestro las características del mueble
    echo "Características: " . $caracteristicasMueble . "<br><br>" . PHP_EOL;

    // Muestro si se pueden crear más muebles
    echo "Puede crear -> " . ($puedeCrear ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Quedan: " . $quedan . "<br><br>" . PHP_EOL;

    // Muestro el mueble creado con valores incorrectos
    echo $muebleDefecto . "<br><br>" . PHP_EOL;

    // Muestro los errores
    echo $error3 . "<br>" . PHP_EOL;
    echo $error4 . "<br>" . PHP_EOL;

    // ----------------------------------------------------------
    // Mueble Reciclado
    // ----------------------------------------------------------

    echo "<h2>Mueble Reciclado</h2>";

    // Veo el mueble por dentro
    var_dump($muebleReciclado);

    // Muestro el porcentaje
    echo "Porcentaje de reciclado: " . $porcentaje . "%<br><br>" . PHP_EOL;

    // Muestro si el valor que le he asignado es correcto
    echo "Porcentaje correcto -> " . ($porcentajeCorrecto ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Porcentaje incorrecto -> " . ($porcentajeIncorrecto ? "true" : "false") . "<br><br>" . PHP_EOL;

    // Muestro el toString del mueble
    echo $muebleReciclado . "<br><br>" . PHP_EOL;

    // Muestro las propiedades adicionales
    echo "Adicionales: " . $adicionalesReciclado;

    // ----------------------------------------------------------
    // Mueble Tradicional
    // ----------------------------------------------------------

    echo "<h2>Mueble Tradicional</h2>";

    // Veo el mueble por dentro
    var_dump($muebleTradicional);

    // Muestro el peso y la serie
    echo "Peso: " . $peso . "<br>" . PHP_EOL;
    echo "Serie: " . $serie . "<br><br>" . PHP_EOL;

    // Muestro si los valores que le he asignado son correctos
    echo "Peso correcto -> " . ($pesoCorrecto ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Peso incorrecto -> " . ($pesoIncorrecto ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Serie correcta -> " . ($serieCorrecta ? "true" : "false") . "<br><br>" . PHP_EOL;

    // Muestro el toString del mueble
    echo $muebleTradicional . "<br><br>" . PHP_EOL;

    // Muestro las propiedades adicionales
    echo "Adicionales: " . $adicionalesTradicional;

    // ----------------------------------------------------------
    // Caracteristicas
    // ----------------------------------------------------------

    echo "<h2>Caracteristicas</h2>";

    // Muestro el toString antes de borrar ninguna caracteristica
    echo $caracteristicasCadena . "<br><br>" . PHP_EOL;

    // Muestro el error al crear una caracteristica despues de ULTIMA
    echo $error1 . "<br><br>" . PHP_EOL;

    // __get
    echo "Material: " . $material . "<br>" . PHP_EOL;
    echo $error2 . "<br><br>" . PHP_EOL;

    // __isset
    echo "Existe material -> " . ($existeMaterial ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Existe peso -> " . ($existePeso ? "true" : "false") . "<br><br>" . PHP_EOL;

    // __unset
    echo "Existe material tras borrar -> " . ($existeMaterialTrasBorrar ? "true" : "false") . "<br>" . PHP_EOL;

    // Muestro el objeto por dentro (ya sin material)
    var_dump($caracteristicas);

    // Muestro el orden a la inversa ejecutando el iterator
    foreach ($caracteristicas as $clave => $v) {
        echo $clave . ":" . $v . ";";
    }
}
