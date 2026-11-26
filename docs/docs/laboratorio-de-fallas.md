# Laboratorio de Fallas — GameZone (`games-asses`)

Este registro documenta las pruebas de robustez y manejo de errores aplicadas sobre `datos.json/datos.json`, `Producto` y `RepositorioProductos` para verificar que el sistema falle de forma controlada y explícita en lugar de mostrar datos corruptos o silenciosos.

---

## 1. JSON con sintaxis inválida (malformado)

* **Escenario de prueba:** Se introduce un error de sintaxis en `datos.json/datos.json` (por ejemplo, coma faltante entre objetos o llave sin cerrar) y se ejecuta `$repo->obtenerTodos()`.
* **Comportamiento esperado / obtenido:** `json_decode()` no devuelve un arreglo válido y `json_last_error() !== JSON_ERROR_NONE`, por lo que `RepositorioProductos::leerRegistros()` lanza una `RuntimeException` indicando que el archivo JSON no tiene un formato válido junto con `json_last_error_msg()`.
* **Prevención / mitigación:** Mantener la estructura JSON validada y envolver las llamadas al repositorio en bloques `try / catch` en las vistas o controladores para mostrar un mensaje claro al usuario sin exponer trazas técnicas en producción.

---

## 2. Archivo JSON inexistente o ilegible

* **Escenario de prueba:** Se instancia `new RepositorioProductos('/ruta/inexistente/datos.json')` o se renombra temporalmente el archivo de datos y se llama a `obtenerTodos()`.
* **Comportamiento esperado / obtenido:** `file_exists()` detecta la ausencia del archivo y `RepositorioProductos::leerRegistros()` lanza una `RuntimeException` especificando la ruta no encontrada.
* **Prevención / mitigación:** Centralizar la ruta por defecto en `RepositorioProductos::__construct()` apuntando a `__DIR__ . '/../../datos.json/datos.json'` y verificar permisos de lectura en el entorno.

---

## 3. Registro con campo obligatorio faltante

* **Escenario de prueba:** En `datos.json/datos.json` se elimina uno de los campos requeridos (`id`, `nombre`, `desarrolladora`, `genero`, `plataforma`, `precio`, `descripcion` o `stock`) en un videojuego y se ejecuta `obtenerTodos()`.
* **Comportamiento esperado / obtenido:** `Producto::desdeArreglo()` invoca `Producto::exigirCampos()`, detecta la clave ausente con `array_key_exists()` y lanza una `InvalidArgumentException` indicando qué campo falta.
* **Prevención / mitigación:** Respetar el esquema completo de 8 campos en todos los registros del catálogo antes de instanciar objetos `Producto`.

---

## 4. Búsqueda de un ID inexistente

* **Escenario de prueba:** Se llama a `$repo->buscarPorId(999)` (un identificador que no existe entre los 6 videojuegos cargados).
* **Comportamiento esperado / obtenido:** El método recorre todos los productos sin coincidencia y lanza una `OutOfBoundsException` con el mensaje `No existe ningún videojuego con el ID 999` en lugar de retornar `null`.
* **Prevención / mitigación:** En `producto-detalle.php`, capturar `Throwable` o `OutOfBoundsException` al consultar el ID recibido por `$_GET` para mostrar un aviso amigable de videojuego no encontrado o redirigir al catálogo.

---

## 5. Videojuego sin existencia (`stock: 0`)

* **Escenario de prueba:** Se evalúa el 6.º registro del catálogo (`Monster Hunter Rise: Sunbreak`, con `"stock": 0`) mediante `$producto->estaDisponible()`.
* **Comportamiento esperado / obtenido:** `estaDisponible()` retorna `false` (`$this->stock > 0`), permitiendo identificar el título como agotado sin romper la carga del catálogo.
* **Prevención / mitigación:** Reflejar el estado de disponibilidad (`Disponible` / `Agotado`) en las vistas de catálogo y detalle para evitar compras o acciones sobre stock cero.

---

## 6. Elemento del arreglo raíz que no es un arreglo/objeto

* **Escenario de prueba:** Si el JSON raíz contiene un valor primitivo dentro de la lista (por ejemplo, un número o cadena en lugar de un objeto con campos).
* **Comportamiento esperado / obtenido:** `RepositorioProductos::obtenerTodos()` valida `is_array($registro)` y lanza una `InvalidArgumentException` antes de pasarlo a `Producto::desdeArreglo()`.
* **Prevención / mitigación:** Asegurar que cada entrada del JSON sea un objeto con la estructura esperada del videojuego.