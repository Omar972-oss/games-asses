<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/repositorios/RepositorioProductos.php';

$repo = new RepositorioProductos();
$juegos = $repo->obtenerTodos();

echo 'Total de juegos cargados: ' . count($juegos) . '<br>';

foreach ($juegos as $juego) {
    $estado = $juego->estaDisponible() ? 'Disponible' : 'Agotado';
    echo $juego->obtenerId() . ' - ' . $juego->obtenerNombre()
        . ' (' . $juego->obtenerPrecioFormateado() . ') [' . $estado . ']<br>';
}

echo '----------------------------------------<br>';

$uno = $repo->buscarPorId(1);
echo 'Buscado ID 1: ' . $uno->obtenerNombre() . '<br>';

try {
    $repo->buscarPorId(999);
} catch (Throwable $e) {
    echo 'Excepción esperada al buscar ID 999: ' . $e->getMessage();
}