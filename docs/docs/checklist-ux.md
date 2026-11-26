# Hallazgos de Libreria-mars (`docs/checklist-ux.md`)

Tareas evaluadas: (a) encontrar un producto de la categoría Periféricos, (b) abrir su ficha y regresar al catálogo, (c) agregar un producto nuevo. Recorridas en escritorio y en 375 px. Los hallazgos con prioridad "Sí" son los que se corrigen en el video.

| # | Heurística | Dónde ocurre | Sev. | Mejora (como acción) | Prioridad |
|---|---|---|---|---|---|
| 1 | H4 Consistencia y estándares | `producto-detalle` y `agregar-producto` no cargan `estilos.css` | 4 | Vincula `estilos.css` en todas las vistas | Sí |
| 2 | H1 Visibilidad del estado | Menú de todas las vistas: no indica en cuál estás | 3 | Marca la página actual con `aria-current` y un subrayado | Sí |
| 3 | H5 Prevención de errores y H10 Ayuda | Formulario: precio y existencias sin `required`, sin límites y sin texto de ayuda | 3 | Agrega `required`, `min` y `max`, y una línea de ayuda bajo cada campo | Sí |
| 4 | H3 Control y libertad | `producto-detalle`: solo se regresa con el menú | 3 | Agrega una ruta de migas de pan | No |
| 5 | H10 Ayuda y documentación | `contacto`: dice "Contáctanos" pero no da ningún medio | 3 | Agrega un correo de contacto | No |
| 6 | Accesibilidad: contraste | Hover del menú 2.80, etiqueta de categoría 3.83, "Ver detalle" 4.11, botón "Agregar producto +" 4.11 | 3 | Oscurece `--color-acento` a `#1f6a8a` y quita el color de hover del menú | Sí |
| 7 | H4 Consistencia (CSS) | Botón "Agregar producto +" sin relleno: `vac(` y `--espacio-base` mal escritos | 2 | Corrige los nombres para que usen `--espaciado-base` | No |
| 8 | H2 Lenguaje del usuario | Menú "Catálgo"; "detallle"; `alt` "Detalle de foto" en todas las imágenes | 2 | Corrige la ortografía y describe cada foto en su `alt` | No |
| 9 | H4 Consistencia | Todas las vistas repiten el `h1` "Bienvenido a Tienda Tec" | 2 | Escribe un `h1` que nombre la vista | No |
| 10 | Estructura del documento | Sin `<!DOCTYPE html>`, `lang`, `meta charset` ni `meta viewport` | 2 | Agrega los cuatro en todas las vistas | No |
| 11 | H8 Diseño minimalista | Pie de página pegado al borde y `<section>` sin cerrar en el formulario | 1 | Agrega `padding` al pie y cierra la sección | No |
| 12 | H1 Visibilidad del estado | Formulario: al enviar no hay confirmación (`action="#"`) | 3 | Se resuelve con servidor en U3; anótalo como pendiente | No |


# Checklist de Usabilidad y Heurísticas de Nielsen — Proyecto Personal

## 1. Tareas Evaluadas (Escritorio y Móvil)
1. **Tarea 1:** Navegar desde la página principal (`index.php`) hacia el catálogo completo (`productos.php`) e identificar en qué sección se encuentra el usuario.
2. **Tarea 2:** Seleccionar un videojuego o artículo del catálogo para consultar su ficha (`producto-detalle.php`) y regresar al listado sin perder ubicación.
3. **Tarea 3:** Acceder a la vista de contacto (`contacto.php`), completar el formulario con validaciones básicas y enviar una consulta.

---

## 2. Registro de Hallazgos y Mejoras

| ID | Heurística / Criterio | Ubicación | Hallazgo Detectado | Severidad (0-4) | Prioridad | Acción de Mejora Aplicada |
| :--- | :--- | :--- | :--- | :---: | :---: | :--- |
| **H-01** | **H4: Consistencia y estándares** | `public/producto-detalle.php` | Verificar y asegurar la carga consistente de la hoja de estilos principal `assets/css/estilos.css` para evitar vistas sin formato al entrar desde el catálogo. | **4** | Alta | Enlazar `<link rel="stylesheet" href="assets/css/estilos.css">` dentro de `<head>` en todas las vistas. |
| **H-02** | **H1: Visibilidad del estado del sistema** | Menú `<nav>` en `index.php`, `productos.php`, `producto-detalle.php`, `contacto.php` | El menú superior no resalta visualmente en qué sección se encuentra el usuario (ni mantiene marcada la sección de catálogo al ver la ficha de un juego). | **3** | Alta | Agregar `aria-label="principal"` al `<nav>`, aplicar `aria-current="page"` en el enlace activo de cada vista y estilizar `nav a[aria-current="page"]` en `estilos.css`. |
| **H-03** | **Estándar HTML / Estructura base** | Todas las vistas `.php` | Falta declarar explícitamente `<!DOCTYPE html>`, idioma español (`lang="es"`), codificación `UTF-8` y configuración `viewport` para dispositivos móviles. | **2** | Media | Incorporar `<!DOCTYPE html>`, `<html lang="es">`, `<meta charset="UTF-8">` y `<meta name="viewport" content="width=device-width, initial-scale=1.0">` en el encabezado de cada vista. |
| **H-04** | **H5: Prevención de errores / H9: Recuperación de errores** | `public/contacto.php` | El formulario de contacto permite enviar campos vacíos o formatos de correo inválidos sin retroalimentación clara antes del envío. | **3** | Alta | Añadir atributos HTML5 (`required`, `type="email"`, `minlength`) y mensajes descriptivos en español para guiar al usuario al corregir datos. |
| **H-05** | **H3: Control y libertad del usuario** | `public/producto-detalle.php` | Al revisar la ficha detallada de un juego, el usuario necesita un enlace directo y visible para regresar al catálogo sin depender únicamente del botón "Atrás" del navegador. | **2** | Media | Incluir un botón/enlace claro de regreso a `productos.php` dentro del detalle del artículo. |
| **H-06** | **H2: Relación entre el sistema y el mundo real** | Menú y encabezados (`productos.php` / `index.php`) | Revisar acentos y etiquetas en español (por ejemplo, `Catálogo` en lugar de `Catalogo`) para mantener lenguaje natural y profesional. | **1** | Baja | Corregir acentuación y ortografía en los enlaces de navegación y títulos visibles. |

---

## 3. Fortalezas Identificadas
* **Diseño y jerarquía visual (`H8: Diseño estético y minimalista`):** Las tarjetas del catálogo muestran de forma limpia los datos clave del artículo sin saturar la pantalla en vista móvil.
* **Separación de datos (`datos.json`):** La información de los artículos está centralizada en formato JSON, facilitando su mantenimiento y consistencia entre el catálogo y el detalle.