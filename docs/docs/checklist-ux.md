# Checklist UX - GameZone

Tareas que revisé (en escritorio y celular):
1. Entrar desde `index.php` al catálogo (`productos.php`) y ver en qué sección estoy.
2. Abrir la ficha de un juego (`producto-detalle.php`) y regresar al catálogo usando las migas de pan o el botón de regreso.
3. Ir a `contacto.php` y llenar el formulario validando los mensajes de ayuda y error.

| # | Heurística | Dónde pasa | Sev. | Qué mejorar | Prioridad |
|---|---|---|---|---|---|
| 1 | H4 Consistencia y estándares | `productos.php` y `producto-detalle.php` apuntaban a rutas distintas de `datos.json` | 4 | Unificar la ruta `__DIR__ . "/../datos.json/datos.json"` y mantener `estilos.css` en todas las vistas | Sí |
| 2 | H1 Visibilidad del estado | En el menú de todas las páginas no se distinguía la sección activa | 3 | Agregar `aria-label="Principal"`, `aria-current="page"` y subrayado en CSS | Sí |
| 3 | H5 Prevención de errores y H10 Ayuda | En `contacto.php` faltaban límites de caracteres y textos de guía/error por campo | 3 | Agrupar en `.campo`, agregar `minlength`/`maxlength`, `.ayuda-campo` y `.error-campo` con `:user-invalid` | Sí |
| 4 | H3 Control y libertad | En `producto-detalle.php` solo se regresaba con el botón inferior o el menú | 3 | Agregar ruta de migas de pan (`nav.migas`) con `Inicio / Catálogo / Juego` | Sí |
| 5 | Accesibilidad: contraste y hover | En `estilos.css` faltaba reforzar el estado hover en enlaces de navegación | 3 | Definir `--color-acento` y agregar subrayado con `text-underline-offset` en `nav a:hover` | Sí |
| 6 | H2 Lenguaje del usuario | Cuidar acentos y etiquetas claras en español en todas las vistas | 2 | Revisar ortografía y textos descriptivos en cada página | No |
| 7 | Estructura del documento | Declarar `<!DOCTYPE html>`, `lang="es"`, `charset="UTF-8"` y `viewport` en todas las vistas | 2 | Confirmar estructura base completa en todos los `.php` | No |