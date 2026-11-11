<?php

// Creo el primer mueble
$mueble1 = new MuebleReciclado(
    "sofa",
    "Ikea",
    "ITALIA",
    2022,
    "01/03/2022",
    "31/12/2030",
    450,
    80
);
$mueble1->anadirCaracteristicas("color", "gris", "plazas", 3);

// Creo el segundo mueble
$mueble2 = new MuebleTradicional(
    "armario",
    "Muebles Lopez",
    "ESPAÑA",
    2021,
    "15/02/2021",
    "31/12/2035",
    320,
    120,
    "S02"
);
$mueble2->anadirCaracteristicas("puertas", 4, "espejo", true);

// Creo el tercer mueble
$mueble3 = new MuebleReciclado(
    "mesa",
    "EcoMuebles",
    "PORTUGAL",
    2023,
    "10/05/2023",
    "31/12/2032",
    180,
    65
);
$mueble3->anadirCaracteristicas("forma", "redonda", "extensible", false);

// Creo el cuarto mueble
$mueble4 = new MuebleTradicional(
    "cama",
    "Descanso",
    "FRANCIA",
    2024,
    "01/09/2024",
    "31/12/2040",
    600,
    250,
    "S03"
);
$mueble4->anadirCaracteristicas("tamano", "150x190", "canape", true);

// Creo el quinto mueble
$mueble5 = new MuebleReciclado(
    "estanteria",
    "Ikea",
    "SUECIA",
    2025,
    "20/01/2025",
    "31/12/2038",
    95,
    100
);
$mueble5->anadirCaracteristicas("baldas", 5, "color", "blanco");

// Array indexado con todos los muebles
$muebles = [
    1 => $mueble1,
    2 => $mueble2,
    3 => $mueble3,
    4 => $mueble4,
    5 => $mueble5,
];
