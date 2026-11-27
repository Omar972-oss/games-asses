<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/repositorios/RepositorioProductos.php';
require_once __DIR__ . '/../src/utilidades/vistas.php';

$repositorio = new RepositorioProductos(__DIR__ . '/../datos.json/datos.json');
$idSolicitado = filter_var($_GET['id'] ?? '', FILTER_VALIDATE_INT);

$producto = null;
$productoEncontrado = false;

if ($idSolicitado !== false && $idSolicitado > 0) {
    try {
        $producto = $repositorio->buscarPorId((int) $idSolicitado);
        $productoEncontrado = true;
    } catch (OutOfBoundsException $error) {
        $productoEncontrado = false;
        http_response_code(404);
    }
} else {
    http_response_code(404);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $productoEncontrado && $producto !== null ? htmlspecialchars($producto->obtenerNombre(), ENT_QUOTES, 'UTF-8') . ' — GameZone' : 'No encontrado — GameZone' ?></title>
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
            <a href="index.php">Inicio</a> &gt;
            <a href="productos.php">Catálogo</a> &gt;
            <span><?= $productoEncontrado && $producto !== null ? htmlspecialchars($producto->obtenerNombre(), ENT_QUOTES, 'UTF-8') : 'No encontrado' ?></span>
        </nav>

        <?php if ($productoEncontrado && $producto !== null): ?>
            <article class="ficha-producto">
                <h2><?= htmlspecialchars($producto->obtenerNombre(), ENT_QUOTES, 'UTF-8') ?></h2>
                <p><strong>Desarrolladora:</strong> <?= htmlspecialchars($producto->obtenerDesarrolladora(), ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Categoría:</strong> <?= htmlspecialchars($producto->obtenerCategoria()->obtenerNombre(), ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Plataforma:</strong> <?= htmlspecialchars($producto->obtenerPlataforma(), ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Precio:</strong> <?= htmlspecialchars($producto->obtenerPrecioFormateado(), ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Disponibilidad:</strong> <?= $producto->estaDisponible() ? 'Disponible' : 'Agotado' ?></p>
                <p><strong>Descripción:</strong></p>
                <p><?= htmlspecialchars($producto->obtenerDescripcion(), ENT_QUOTES, 'UTF-8') ?></p>
                <a href="productos.php">Volver al catálogo</a>
            </article>
        <?php else: ?>
            <section class="mensaje-error">
                <h2>Videojuego no encontrado</h2>
                <p>No existe ningún videojuego con el identificador solicitado.</p>
                <a href="productos.php">Volver al catálogo</a>
            </section>
        <?php endif; ?>
    </main>

    <footer>
        <p>GameZone — Ficha de videojuego</p>
    </footer>
</body>
</html>