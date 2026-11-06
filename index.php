<?php

declare(strict_types=1);

require_once __DIR__ . '/app/config/Database.php';

$controladores = [
    'paquete' => 'PaqueteController',
];

$nombreControlador = strtolower((string) ($_GET['c'] ?? 'paquete'));
$accion = strtolower((string) ($_GET['a'] ?? 'index'));

if (!isset($controladores[$nombreControlador])) {
    http_response_code(404);
    exit('Controlador no encontrado.');
}

$archivoControlador = __DIR__ . '/app/controllers/' . $controladores[$nombreControlador] . '.php';

if (!is_file($archivoControlador)) {
    http_response_code(500);
    exit('El controlador solicitado no está disponible.');
}

require_once $archivoControlador;

$claseControlador = $controladores[$nombreControlador];
$metodosPermitidos = ['index', 'detalle'];

if (!in_array($accion, $metodosPermitidos, true) || !method_exists($claseControlador, $accion)) {
    http_response_code(404);
    exit('Acción no encontrada.');
}

$controlador = new $claseControlador();
$controlador->{$accion}();
