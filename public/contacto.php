<?php

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = trim($_POST["nombre"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $asunto = trim($_POST["asunto"] ?? "");
    $mensajeUsuario = trim($_POST["mensaje"] ?? "");

    if (
        $nombre !== "" &&
        filter_var($correo, FILTER_VALIDATE_EMAIL) &&
        $asunto !== "" &&
        $mensajeUsuario !== ""
    ) {
        $mensaje = "Gracias, " . htmlspecialchars($nombre) .
                   ". Tu mensaje fue recibido en el formulario.";
    } else {
        $mensaje = "Por favor, completa correctamente todos los campos.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameZone - Contacto</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>

<body>

    <header>
        <h1>📩 Contacto GameZone</h1>
        <p>Estamos para ayudarte</p>
    </header>

    <nav aria-label="Principal">
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="productos.php">Catálogo</a></li>
            <li><a href="contacto.php" aria-current="page">Contacto</a></li>
        </ul>
    </nav>

    <main>

        <section>

            <h2>Contáctanos</h2>

            <p>
                ¿Tienes alguna pregunta sobre nuestros videojuegos?
                Envíanos un mensaje.
            </p>

            <?php if ($mensaje !== ""): ?>
                <div class="mensaje">
                    <?= $mensaje ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="contacto.php">

                <div class="campo">
                    <label for="nombre">Nombre</label>
                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        minlength="2"
                        maxlength="80"
                        aria-describedby="ayuda-nombre"
                        required
                    >
                    <p class="ayuda-campo" id="ayuda-nombre">Escribe tu nombre (mínimo 2 caracteres).</p>
                    <p class="error-campo" id="error-nombre">Ingresa un nombre válido de al menos 2 caracteres.</p>
                </div>

                <div class="campo">
                    <label for="correo">Correo electrónico</label>
                    <input
                        type="email"
                        id="correo"
                        name="correo"
                        maxlength="120"
                        aria-describedby="ayuda-correo"
                        required
                    >
                    <p class="ayuda-campo" id="ayuda-correo">Ejemplo: usuario@correo.com</p>
                    <p class="error-campo" id="error-correo">Escribe una dirección de correo válida.</p>
                </div>

                <div class="campo">
                    <label for="asunto">Asunto</label>
                    <input
                        type="text"
                        id="asunto"
                        name="asunto"
                        minlength="3"
                        maxlength="100"
                        aria-describedby="ayuda-asunto"
                        required
                    >
                    <p class="ayuda-campo" id="ayuda-asunto">Motivo de tu consulta (entre 3 y 100 caracteres).</p>
                    <p class="error-campo" id="error-asunto">Escribe un asunto de al menos 3 caracteres.</p>
                </div>

                <div class="campo">
                    <label for="mensaje">Mensaje</label>
                    <textarea
                        id="mensaje"
                        name="mensaje"
                        minlength="5"
                        maxlength="500"
                        aria-describedby="ayuda-mensaje"
                        required
                    ></textarea>
                    <p class="ayuda-campo" id="ayuda-mensaje">Detalla tu duda sobre algún videojuego (5 a 500 caracteres).</p>
                    <p class="error-campo" id="error-mensaje">Escribe un mensaje de al menos 5 caracteres.</p>
                </div>

                <button type="submit" class="boton-enviar">
                    Enviar mensaje
                </button>

            </form>

        </section>

    </main>

    <footer>
        <p>&copy; 2026 GameZone</p>
    </footer>

</body>
</html>