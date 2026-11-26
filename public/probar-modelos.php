<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/modelos/Categoria.php';
require_once __DIR__ . '/../src/modelos/Producto.php';

$rpg = new Categoria('RPG');
$accion = new Categoria('Acción');

echo $rpg->obtenerNombre() . '<br>';
echo $accion->obtenerNombre() . '<br>';
echo '----------------------------------------<br>';

$juego = Producto::desdeArreglo([
    'id' => 1,
    'nombre' => 'Elden Ring',
    'categoria' => 'RPG',
    'precio' => 1299.00,
    'descripcion' => 'RPG de acción y fantasía oscura en mundo abierto.',
    'stock' => 15,
    'imagen' => 'https://placehold.co/200x150?text=Elden+Ring',
]);

echo $juego->obtenerNombre()
    . ' (' . $juego->obtenerCategoria()->obtenerNombre() . ')'
    . ' y cuesta ' . $juego->obtenerPrecioFormateado()
    . '<br>';

echo $juego->estaDisponible() ? 'Existe producto' : 'Agotado';