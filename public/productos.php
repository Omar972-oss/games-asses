<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/repositorios/RepositorioProductos.php';
require_once __DIR__ . '/../src/utilidades/vistas.php';

$repositorio = new RepositorioProductos(__DIR__ . '/../datos.json/datos.json');
$productos = $repositorio->obtenerTodos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo — GameZone</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <header>
        <h1>GameZone</h1>
        <nav aria-label="Navegación principal">
            <a href="index.php">Inicio</a>
            <a href="productos.php">Catálogo</a>
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>

    <main>
        <nav class="migas" aria-label="Migas de pan">
            <a href="index.php">Inicio</a> &gt; <span>Catálogo</span>
        </nav>

        <h2>Catálogo de videojuegos</h2>

        <section class="tarjetas-productos">
            <?php foreach ($productos as $producto): ?>
                <?php mostrarTarjetaProducto($producto); ?>
            <?php endforeach; ?>
        </section>
    </main>

    <footer>
        <p>GameZone — Catálogo de videojuegos</p>
    </footer>
</body>
</html>