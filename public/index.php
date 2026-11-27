<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/repositorios/RepositorioProductos.php';
require_once __DIR__ . '/../src/utilidades/vistas.php';

$repositorio = new RepositorioProductos(__DIR__ . '/../datos.json/datos.json');
$destacados = array_slice($repositorio->obtenerTodos(), 0, 3);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameZone — Inicio</title>
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
        <section class="hero">
            <h2>Bienvenido a GameZone</h2>
            <p>Explora el catálogo de videojuegos, consulta plataformas, precios y disponibilidad.</p>
            <a href="productos.php">Ver catálogo</a>
        </section>

        <section class="destacados">
            <h2>Videojuegos destacados</h2>
            <section class="tarjetas-productos">
                <?php foreach ($destacados as $producto): ?>
                    <?php mostrarTarjetaProducto($producto, 3); ?>
                <?php endforeach; ?>
            </section>
        </section>
    </main>

    <footer>
        <p>GameZone — Inicio</p>
    </footer>
</body>
</html>