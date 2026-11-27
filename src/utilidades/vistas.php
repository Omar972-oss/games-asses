<?php

declare(strict_types=1);

require_once __DIR__ . '/../modelos/Producto.php';

function mostrarTarjetaProducto(Producto $producto, int $nivelEncabezado = 2): void
{
    $etiqueta = in_array($nivelEncabezado, [2, 3, 4], true) ? "h{$nivelEncabezado}" : 'h2';
    $id = (int) $producto->obtenerId();
    $nombre = htmlspecialchars($producto->obtenerNombre(), ENT_QUOTES, 'UTF-8');
    $categoria = htmlspecialchars($producto->obtenerCategoria()->obtenerNombre(), ENT_QUOTES, 'UTF-8');
    $plataforma = htmlspecialchars($producto->obtenerPlataforma(), ENT_QUOTES, 'UTF-8');
    $precio = htmlspecialchars($producto->obtenerPrecioFormateado(), ENT_QUOTES, 'UTF-8');
    $disponible = $producto->estaDisponible();
    ?>
    <article class="tarjeta-producto">
        <<?= $etiqueta ?>><?= $nombre ?></<?= $etiqueta ?>>
        <p><strong>Categoría:</strong> <?= $categoria ?></p>
        <p><strong>Plataforma:</strong> <?= $plataforma ?></p>
        <p><strong>Precio:</strong> <?= $precio ?></p>
        <p>
            <strong>Estado:</strong>
            <?= $disponible ? 'Disponible' : 'Agotado' ?>
        </p>
        <a href="producto-detalle.php?id=<?= $id ?>">Ver ficha</a>
    </article>
    <?php
}