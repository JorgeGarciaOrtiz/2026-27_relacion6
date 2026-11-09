<?php

/**
 * Función que comprueba que un número entero está comprendido entre un número maximo y un 
 * minimo. Si no lo esta le asignamos el valor por defecto
 *
 * @param integer $var Número que validamos, si no es valido lo modificamos
 * @param integer $min Valor mínimo permitido
 * @param integer $max Valor máximo permitido
 * @param integer $defecto Valor que se asigna si el número no es válido
 * @return boolean True si el número es validado y false si no lo es
 */
function validaEntero(int &$var, int $min, int $max, int $defecto): bool
{
    // Devuelve mixed: el número entero o false
    $resultado = filter_var($var, FILTER_VALIDATE_INT, [
        "options" => [
            "min_range" => $min,
            "max_range" => $max,
        ]
    ]);

    if ($resultado === false) {
        // Si el número no es válido, asignamos el valor por defecto
        $var = $defecto;
        // Devolvemos false
        return false;
    } else {
        // Si el número si es válido, asignamos el valor correcto
        $var = $resultado;
        // Devolvemos true
        return true;
    }
}

/**
 * Función que comprueba que un número real está comprendido entre un número maximo y un 
 * minimo. Si no lo esta le asignamos el valor por defecto.
 *
 * @param float $var Número que validamos, si no es valido lo modificamos
 * @param float $min Valor mínimo permitido
 * @param float $max Valor máximo permitido
 * @param float $defecto Valor que se asigna si el número no es válido
 * @return boolean True si el número es validado y false si no lo es
 */
function validaReal(float &$var, float $min, float $max, float $defecto): bool
{
    // Devuelve mixed: el número real o false
    $resultado = filter_var($var, FILTER_VALIDATE_FLOAT, [
        "options" => [
            "min_range" => $min,
            "max_range" => $max,
        ]
    ]);

    if ($resultado === false) {
        // Si el número no es válido, asignamos el valor por defecto
        $var = $defecto;
        // Devolvemos false
        return false;
    } else {
        // Si el número si es válido, asignamos el valor correcto
        $var = $resultado;
        // Devolvemos true
        return true;
    }
}

/**
 * Función que comprueba que una fecha tiene el formato dd/mm/aaaa y que existe.
 * Si es correcta, la deja con 2 cifras en el día y el mes.
 * Si no lo es, le asignamos el valor por defecto.
 *
 * @param string $var Fecha que validamos, se modifica si hay que sanearla o no es válida
 * @param string $defecto Fecha que se asigna si la fecha no es válida
 * @return boolean True si la fecha es válida y false si no lo es
 */
function validaFecha(string &$var, string $defecto): bool
{
    // Creo la expresión regular: dd/mm/aaaa o d/m/aaaa
    $expresionRegular = '#^[0-9]{1,2}[/][0-9]{1,2}[/][0-9]{4}$#';

    // Devuelve mixed: la fecha (string) o false
    $resultado = filter_var($var, FILTER_VALIDATE_REGEXP, [
        "options" => [
            "regexp" => $expresionRegular,
        ]
    ]);

    // Si la fecha coincide con la expresión regular:
    if ($resultado !== false) {

        // Dividimos la fecha en 3 partes: día, mes y año
        $partesFecha = explode("/", $var);

        // Comprobamos que la fecha existe
        if (checkdate($partesFecha[1], $partesFecha[0], $partesFecha[2])) { // mes, día, año

            // En el caso de que si, la saneamos
            $especifica = mktime(0, 0, 0, $partesFecha[1], $partesFecha[0], $partesFecha[2]); // hora, minuto, segundo, mes, día, año
            // La fecha inicial sera esta nueva fecha
            $var = date('d/m/Y', $especifica);

            // Devolvemos true
            return true;
        }
    }

    // Si la fecha no es válida, asignamos el valor por defecto
    $var = $defecto;
    // Devolvemos false
    return false;
}

/**
 * Función que comprueba que una hora tiene el formato hh:mm:ss y que sus valores son correctos.
 * Si es correcta, la deja con 2 cifras en la hora, los minutos y los segundos.
 * Si no lo es, le asignamos el valor por defecto.
 *
 * @param string $var Hora que validamos, se modifica si hay que sanearla o no es válida
 * @param string $defecto Hora que se asigna si la hora no es válida
 * @return boolean True si la hora es válida y false si no lo es
 */
function validaHora(string &$var, string $defecto): bool
{
    // Creo la expresión regular: hh:mm:ss o h:m:ss
    $expresionRegular = '#^[0-9]{1,2}[:][0-9]{1,2}[:][0-9]{1,2}$#';

    // Devuelve mixed: la hora (string) o false
    $resultado = filter_var($var, FILTER_VALIDATE_REGEXP, [
        "options" => [
            "regexp" => $expresionRegular,
        ]
    ]);

    // Si la hora coincide con la expresión regular:
    if ($resultado !== false) {

        // Dividimos la hora en 3 partes: hora, min y segundos
        $partesHora = explode(":", $var);

        // Comprobamos que la hora existe
        if (($partesHora[0] < 24) && ($partesHora[1] < 60) && ($partesHora[2] < 60)) {

            // En el caso de que si, la saneamos
            $especifica = mktime($partesHora[0], $partesHora[1], $partesHora[2], 0, 0, 0); // mktime: hora, minuto, segundo, mes, día, año
            // La hora inicial sera esta nueva hora
            $var = date('H:i:s', $especifica);

            // Devolvemos true
            return true;
        }
    }

    // Si la hora no es válida, asignamos el valor por defecto
    $var = $defecto;
    // Devolvemos false
    return false;
}

/**
 * Función que comprueba que un email tiene el formato aaaaa@bbbb.ccc.
 * Si es correcto, lo deja saneado.
 * Si no lo es, le asignamos el valor por defecto.
 *
 * @param string $var Email que validamos, se modifica si hay que sanearlo o no es válido
 * @param string $defecto Email que se asigna si el email no es válido
 * @return boolean True si el email es válido y false si no lo es
 */
function validaEmail(string &$var, string $defecto): bool
{
    // Saneamos el email
    $var = filter_var($var, FILTER_SANITIZE_EMAIL);

    // Devuelve mixed: el email o false
    $resultado = filter_var($var, FILTER_VALIDATE_EMAIL);

    if ($resultado === false) {
        // Si el email no es válido, asignamos el valor por defecto
        $var = $defecto;
        // Devolvemos false
        return false;
    } else {
        // Si el email es válido, asignamos el valor correcto
        $var = $resultado;
        // Devolvemos true
        return true;
    }
}

/**
 * Función que comprueba que una cadena no supera la longitud máxima.
 * Si la supera, le asignamos el valor por defecto.
 *
 * @param string $var Cadena que validamos, si no es válida la modificamos
 * @param integer $longitud Longitud máxima permitida
 * @param string $defecto Valor que se asigna si la cadena no es válida
 * @return boolean True si la cadena es válida y false si no lo es
 */
function validaCadena(string &$var, int $longitud, string $defecto): bool
{
    // Creo la expresión regular
    $expresionRegular = '#^.{0,' . $longitud . '}$#us';
    // u: Trata correctamente caracteres como "ñ" o "á"
    // s: Hace que el "." también incluya los saltos de línea

    // Devuelve mixed: la cadena (string) o false
    $resultado = filter_var($var, FILTER_VALIDATE_REGEXP, [
        "options" => [
            "regexp" => $expresionRegular,
        ]
    ]);

    // Si la cadena coincide con la expresión regular:
    if ($resultado !== false) {
        // Si la longitud es válida, asignamos el valor correcto
        $var = $resultado;
        // Devolvemos true
        return true;
    }

    // Si la cadena no es válida, asignamos el valor por defecto
    $var = $defecto;
    // Devolvemos false
    return false;
}

/**
 * Función que comprueba que una cadena cumple una expresión regular.
 * Si no la cumple, le asignamos el valor por defecto.
 *
 * @param string $var Cadena que validamos, si no es válida la modificamos
 * @param string $expresion Expresión regular que debe cumplir
 * @param string $defecto Valor que se asigna si la cadena no es válida
 * @return boolean True si la cadena es válida y false si no lo es
 */
function validaExpresion(string &$var, string $expresion, string $defecto): bool
{
    // Devuelve mixed: la cadena (string) o false
    $resultado = filter_var($var, FILTER_VALIDATE_REGEXP, [
        "options" => [
            "regexp" => $expresion,
        ]
    ]);

    // Si la cadena coincide con la expresión regular:
    if ($resultado !== false) {
        // Asignamos el valor correcto
        $var = $resultado;
        // Devolvemos true
        return true;
    }

    // Si la cadena no es válida, asignamos el valor por defecto
    $var = $defecto;
    // Devolvemos false
    return false;
}

/**
 * Función que comprueba que un valor coincide con uno de los elementos
 * o con una de las claves de un array.
 *
 * @param mixed $var Valor que validamos
 * @param array $posibles Array con los valores o claves permitidos
 * @param integer $tipo 1 para comparar con los elementos y 2 para comparar con las claves
 * @return boolean True si el valor es válido y false si no lo es
 */
function validaRango(mixed $var, array $posibles, int $tipo = 1): bool
{
    // Si comparamos con los elementos del array:
    if ($tipo === 1) {
        
        // Recorremos los elementos
        foreach ($posibles as $valor) {

            // Si el valor coincide con el elemento:
            if ($var === $valor) {
                // Devolvemos true
                return true;
            }
        }

        // Si comparamos con las claves del array:
    } else if ($tipo === 2) {

        // Recorremos las claves
        foreach ($posibles as $clave => $valor) {

            // Si el valor coincide con la clave:
            if ($var === $clave) {
                  // Devolvemos true
                return true;
            }
        }
    }

    // Si no hay ninguna coincidencia, devolvemos false
    return false;
}