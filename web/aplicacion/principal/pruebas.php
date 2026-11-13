<?php

// Incluimos la cabecera y la plantilla de la aplicación
include_once(dirname(__FILE__) . "/../../cabecera.php");

// Ruta de navegación de la página
$ubicacion = [
    "Inicio" => "/index.php",
    "Pruebas" => "./pruebas.php"
];

// ==========================================================
// CONTROLADOR
// ==========================================================

// Array donde guardo todos los resultados de las pruebas
$resultados = [];

// ----------------------------------------------------------
// Mueble Base
// ----------------------------------------------------------

// Creo un mueble reciclado
$muebleBase = new MuebleReciclado("mesa");

// Paso un nombre correcto
$resultados["nombreCorrecto"] = $muebleBase->setNombre("mesa grande");
// Paso un nombre incorrecto
$resultados["nombreIncorrecto"] = $muebleBase->setNombre("");

// Paso un fabricante (siempre es correcto)
$resultados["fabricanteCorrecto"] = $muebleBase->setFabricante("Ikea");

// Paso un país correcto
$resultados["paisCorrecto"] = $muebleBase->setPais("FRANCIA");
// Paso un país incorrecto
$resultados["paisIncorrecto"] = $muebleBase->setPais("UN PAIS CON MAS DE VEINTE LETRAS");

// Paso un año correcto
$resultados["anioCorrecto"] = $muebleBase->setAnio(2022);
// Paso un año incorrecto
$resultados["anioIncorrecto"] = $muebleBase->setAnio(2010);

// Paso una fecha de inicio correcta
$resultados["fechaIniCorrecta"] = $muebleBase->setFechaIniVenta("15/06/2023");
// Paso una fecha de inicio incorrecta (anterior al año de fabricación)
$resultados["fechaIniIncorrecta"] = $muebleBase->setFechaIniVenta("01/01/2021");

// Paso una fecha de fin correcta
$resultados["fechaFinCorrecta"] = $muebleBase->setFechaFinVenta("31/12/2030");
// Paso una fecha de fin incorrecta (anterior a la de inicio)
$resultados["fechaFinIncorrecta"] = $muebleBase->setFechaFinVenta("01/01/2023");

// Paso un precio correcto
$resultados["precioCorrecto"] = $muebleBase->setPrecio(50);
// Paso un precio incorrecto
$resultados["precioIncorrecto"] = $muebleBase->setPrecio(10);

// Devuelvo todos los valores
$resultados["nombre"] = $muebleBase->getNombre();
$resultados["fabricante"] = $muebleBase->getFabricante();
$resultados["pais"] = $muebleBase->getPais();
$resultados["anio"] = $muebleBase->getAnio();
$resultados["fechaIni"] = $muebleBase->getFechaIniVenta();
$resultados["fechaFin"] = $muebleBase->getFechaFinVenta();
$resultados["precio"] = $muebleBase->getPrecio();

// Añado características y las devuelvo como objeto
$muebleBase->anadirCaracteristicas("saliente", true, "precio", 300);
$resultados["caracteristicasMueble"] = $muebleBase->getCaracteristicas();

// Compruebo si se pueden crear más muebles y cuántos quedan
$resultados["quedan"] = 0;
$resultados["puedeCrear"] = MuebleBase::puedeCrear($resultados["quedan"]);

// Creo un mueble con valores incorrectos para ver los valores por defecto
$resultados["muebleDefecto"] = new MuebleReciclado(
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
$resultados["error3"] = "";
$resultados["error4"] = "";

try {
    // Intento crear un mueble sin nombre para provocar el error
    $muebleSinNombre = new MuebleReciclado("");
} catch (Exception $e) {
    $resultados["error3"] = $e->getMessage();
}

try {
    // Intento crear una propiedad nueva para provocar el error
    $muebleBase->color = "rojo";
} catch (Exception $e) {
    $resultados["error4"] = $e->getMessage();
}

// Variables donde guardo los mensajes de error
$resultados["error5"] = "";
$resultados["error6"] = "";

try {
    // __get: intento leer una propiedad que no existe para provocar el error
    $colorMueble = $muebleBase->color;
} catch (Exception $e) {
    $resultados["error5"] = $e->getMessage();
}

// __isset: compruebo si existe una propiedad (siempre devuelve false)
$resultados["existeNombre"] = isset($muebleBase->nombre);

try {
    // __unset: intento borrar una propiedad para provocar el error
    unset($muebleBase->nombre);
} catch (Exception $e) {
    $resultados["error6"] = $e->getMessage();
}

// ----------------------------------------------------------
// Mueble Reciclado
// ----------------------------------------------------------

// Creo un mueble reciclado
$resultados["muebleReciclado"] = new MuebleReciclado("silla");

// Añado características por parejas
$resultados["muebleReciclado"]->anadirCaracteristicas("color", "rojo", "patas", 4);

// Pruebo con un número impar (el último se descarta)
$resultados["muebleReciclado"]->anadirCaracteristicas("material", "madera", "sobra");

// Pasamos un porcentaje de reciclado correcto
$resultados["porcentajeCorrecto"] = $resultados["muebleReciclado"]->setPorcentajeReciclado(50);
// Pasamos un porcentaje de reciclado incorrecto
$resultados["porcentajeIncorrecto"] = $resultados["muebleReciclado"]->setPorcentajeReciclado(5000);

// Devolvemos el porcentaje de reciclado
$resultados["porcentaje"] = $resultados["muebleReciclado"]->getPorcentajeReciclado();

// Pasamos todas las propiedades adicionales
$resultados["adicionalesReciclado"] = implode(", ", $resultados["muebleReciclado"]->damePropiedadesAdicionales());

// ----------------------------------------------------------
// Mueble Tradicional
// ----------------------------------------------------------

// Creo un mueble tradicional
$resultados["muebleTradicional"] = new MuebleTradicional("armario");

// Añado características por parejas
$resultados["muebleTradicional"]->anadirCaracteristicas("color", "rojo", "patas", 4);

// Pruebo con un número impar (el último se descarta)
$resultados["muebleTradicional"]->anadirCaracteristicas("material", "madera", "sobra");

// Pasamos un peso correcto
$resultados["pesoCorrecto"] = $resultados["muebleTradicional"]->setPeso(15);
// Pasamos un peso incorrecto
$resultados["pesoIncorrecto"] = $resultados["muebleTradicional"]->setPeso(5555);
// Pasamos una serie (todas son correctas)
$resultados["serieCorrecta"] = $resultados["muebleTradicional"]->setSerie("S05");

// Devolvemos peso
$resultados["peso"] = $resultados["muebleTradicional"]->getPeso();
// Devolvemos la serie
$resultados["serie"] = $resultados["muebleTradicional"]->getSerie();

// Pasamos todas las propiedades adicionales
$resultados["adicionalesTradicional"] = implode(", ", $resultados["muebleTradicional"]->damePropiedadesAdicionales());

// Creo un mueble tradicional con valores incorrectos para ver los valores por defecto
$resultados["muebleTradicionalDefecto"] = new MuebleTradicional(
    "mesita",
    "Ikea",
    "UN PAIS CON MAS DE VEINTE LETRAS",
    2015,
    "01/01/2010",
    "01/01/2000",
    5,
    5000,
    "S07"
);

// ----------------------------------------------------------
// Caracteristicas
// ----------------------------------------------------------

// Creo un nuevo objeto 
$resultados["caracteristicas"] = new Caracteristicas();

// Añado varias caracteristicas al objeto
$resultados["caracteristicas"]->color = "rojo";
$resultados["caracteristicas"]->material = "madera";
$resultados["caracteristicas"]->patas = 4;
$resultados["caracteristicas"]->ULTIMA = "ULTIMA";
// Modifico una caracteristicas despues de crear la ultima
$resultados["caracteristicas"]->color = "azul";

// Guardo el objeto como cadena antes de borrar nada
$resultados["caracteristicasCadena"] = (string) $resultados["caracteristicas"];

// Variables donde guardo los mensajes de error
$resultados["error1"] = "";
$resultados["error2"] = "";

try {
    // Añado otra caracteristica para provocar el error
    $resultados["caracteristicas"]->garantia = "2 años"; // Error no se pueden crear más caracteristicas
} catch (Exception $e) {
    $resultados["error1"] = $e->getMessage();
}

// __get: leo una caracteristica que si existe
$resultados["material"] = $resultados["caracteristicas"]->material;

try {
    // __get: leo una caracteristica que no existe para provocar el error
    $pesoCaracteristica = $resultados["caracteristicas"]->peso; // No existe la propiedad: peso
} catch (Exception $e) {
    $resultados["error2"] = $e->getMessage();
}

// __isset: compruebo si las propiedades existen (la segunda es inventada)
$resultados["existeMaterial"] = isset($resultados["caracteristicas"]->material); // true
$resultados["existePeso"] = isset($resultados["caracteristicas"]->peso); // false

// __unset: elimino una caracteristica y compruebo que ya no esta
unset($resultados["caracteristicas"]->material);
$resultados["existeMaterialTrasBorrar"] = isset($resultados["caracteristicas"]->material); // false

// ----------------------------------------------------------
// Máximo de muebles
// ----------------------------------------------------------

// Variable donde guardo el mensaje de error
$resultados["error7"] = "";

try {
    // Creo muebles hasta superar el máximo para provocar el error
    while (true) {
        new MuebleReciclado("relleno");
    }
} catch (Exception $e) {
    $resultados["error7"] = $e->getMessage();
}

// Compruebo otra vez si se pueden crear más muebles
$resultados["quedanFinal"] = 0;
$resultados["puedeCrearFinal"] = MuebleBase::puedeCrear($resultados["quedanFinal"]);

// ==========================================================
// PLANTILLA
// ==========================================================

// Cabecera de la página
inicioCabecera("TIENDA");
cabecera();
finCabecera();

// Cuerpo de la página
inicioCuerpo("Tienda", $ubicacion);
cuerpo($resultados);
finCuerpo();

// ==========================================================
// VISTA
// ==========================================================

function cabecera() {}

/**
 * Muestra el resultado de todas las pruebas de las clases MuebleBase, MuebleReciclado,
 * MuebleTradicional y Caracteristicas, separado por secciones.
 *
 * @param array $resultados Resultados de todas las pruebas
 * @return void
 */
function cuerpo(array $resultados)
{
    // ----------------------------------------------------------
    // Mueble Base
    // ----------------------------------------------------------

    echo "<h2>Mueble Base</h2>";

    // Muestro si los valores que le he asignado son correctos
    echo "Nombre correcto -> " . ($resultados["nombreCorrecto"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Nombre incorrecto -> " . ($resultados["nombreIncorrecto"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Fabricante correcto -> " . ($resultados["fabricanteCorrecto"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo "País correcto -> " . ($resultados["paisCorrecto"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo "País incorrecto -> " . ($resultados["paisIncorrecto"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Año correcto -> " . ($resultados["anioCorrecto"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Año incorrecto -> " . ($resultados["anioIncorrecto"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Fecha inicio correcta -> " . ($resultados["fechaIniCorrecta"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Fecha inicio incorrecta -> " . ($resultados["fechaIniIncorrecta"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Fecha fin correcta -> " . ($resultados["fechaFinCorrecta"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Fecha fin incorrecta -> " . ($resultados["fechaFinIncorrecta"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Precio correcto -> " . ($resultados["precioCorrecto"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Precio incorrecto -> " . ($resultados["precioIncorrecto"] ? "true" : "false") . "<br><br>" . PHP_EOL;

    // Muestro los valores guardados
    echo "Nombre: " . $resultados["nombre"] . "<br>" . PHP_EOL;
    echo "Fabricante: " . $resultados["fabricante"] . "<br>" . PHP_EOL;
    echo "País: " . $resultados["pais"] . "<br>" . PHP_EOL;
    echo "Año: " . $resultados["anio"] . "<br>" . PHP_EOL;
    echo "Fecha inicio: " . $resultados["fechaIni"] . "<br>" . PHP_EOL;
    echo "Fecha fin: " . $resultados["fechaFin"] . "<br>" . PHP_EOL;
    echo "Precio: " . $resultados["precio"] . "<br><br>" . PHP_EOL;

    // Muestro las características del mueble
    echo "Características: " . $resultados["caracteristicasMueble"] . "<br><br>" . PHP_EOL;

    // Muestro si se pueden crear más muebles
    echo "Puede crear -> " . ($resultados["puedeCrear"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Quedan: " . $resultados["quedan"] . "<br><br>" . PHP_EOL;

    // Muestro el mueble creado con valores incorrectos
    echo $resultados["muebleDefecto"] . "<br><br>" . PHP_EOL;

    // Muestro los errores
    echo $resultados["error3"] . "<br>" . PHP_EOL;
    echo $resultados["error4"] . "<br>" . PHP_EOL;

    // Muestro los métodos mágicos
    echo $resultados["error5"] . "<br>" . PHP_EOL;
    echo "Existe nombre -> " . ($resultados["existeNombre"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo $resultados["error6"] . "<br>" . PHP_EOL;

    // ----------------------------------------------------------
    // Mueble Reciclado
    // ----------------------------------------------------------

    echo "<h2>Mueble Reciclado</h2>";

    // Veo el mueble por dentro
    var_dump($resultados["muebleReciclado"]);

    // Muestro el porcentaje
    echo "Porcentaje de reciclado: " . $resultados["porcentaje"] . "%<br><br>" . PHP_EOL;

    // Muestro si el valor que le he asignado es correcto
    echo "Porcentaje correcto -> " . ($resultados["porcentajeCorrecto"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Porcentaje incorrecto -> " . ($resultados["porcentajeIncorrecto"] ? "true" : "false") . "<br><br>" . PHP_EOL;

    // Muestro el toString del mueble
    echo $resultados["muebleReciclado"] . "<br><br>" . PHP_EOL;

    // Muestro las propiedades adicionales
    echo "Adicionales: " . $resultados["adicionalesReciclado"];

    // ----------------------------------------------------------
    // Mueble Tradicional
    // ----------------------------------------------------------

    echo "<h2>Mueble Tradicional</h2>";

    // Veo el mueble por dentro
    var_dump($resultados["muebleTradicional"]);

    // Muestro el peso y la serie
    echo "Peso: " . $resultados["peso"] . "<br>" . PHP_EOL;
    echo "Serie: " . $resultados["serie"] . "<br><br>" . PHP_EOL;

    // Muestro si los valores que le he asignado son correctos
    echo "Peso correcto -> " . ($resultados["pesoCorrecto"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Peso incorrecto -> " . ($resultados["pesoIncorrecto"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Serie correcta -> " . ($resultados["serieCorrecta"] ? "true" : "false") . "<br><br>" . PHP_EOL;

    // Muestro el toString del mueble
    echo $resultados["muebleTradicional"] . "<br><br>" . PHP_EOL;

    // Muestro las propiedades adicionales
    echo "Adicionales: " . $resultados["adicionalesTradicional"];

    // Muestro el mueble tradicional creado con valores incorrectos
    echo "<br><br>" . $resultados["muebleTradicionalDefecto"] . "<br>" . PHP_EOL;

    // ----------------------------------------------------------
    // Caracteristicas
    // ----------------------------------------------------------

    echo "<h2>Caracteristicas</h2>";

    // Muestro el toString antes de borrar ninguna caracteristica
    echo $resultados["caracteristicasCadena"] . "<br><br>" . PHP_EOL;

    // Muestro el error al crear una caracteristica despues de ULTIMA
    echo $resultados["error1"] . "<br><br>" . PHP_EOL;

    // __get
    echo "Material: " . $resultados["material"] . "<br>" . PHP_EOL;
    echo $resultados["error2"] . "<br><br>" . PHP_EOL;

    // __isset
    echo "Existe material -> " . ($resultados["existeMaterial"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Existe peso -> " . ($resultados["existePeso"] ? "true" : "false") . "<br><br>" . PHP_EOL;

    // __unset
    echo "Existe material tras borrar -> " . ($resultados["existeMaterialTrasBorrar"] ? "true" : "false") . "<br>" . PHP_EOL;

    // Muestro el objeto por dentro sin material
    var_dump($resultados["caracteristicas"]);

    // Muestro el orden a la inversa ejecutando el iterator
    foreach ($resultados["caracteristicas"] as $clave => $v) {
        echo $clave . ":" . $v . ";";
    }

    // ----------------------------------------------------------
    // Máximo de muebles
    // ----------------------------------------------------------

    echo "<h2>Máximo de muebles</h2>";

    // Muestro el error al superar el máximo
    echo $resultados["error7"] . "<br>" . PHP_EOL;

    // Muestro que ya no se pueden crear más
    echo "Puede crear -> " . ($resultados["puedeCrearFinal"] ? "true" : "false") . "<br>" . PHP_EOL;
    echo "Quedan: " . $resultados["quedanFinal"] . "<br>" . PHP_EOL;
}