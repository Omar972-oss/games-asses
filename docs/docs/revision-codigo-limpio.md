# Revisión de Código Limpio — U3S07

| # | Principio | Qué encontré (archivo y método) | Qué cambié | Commit |
|---|---|---|---|---|
| 1 | Nombres (cap. 2) | Revisión de nombres y variables en vistas/utilidades | Reemplacé nombres ambiguos por nombres descriptivos en español (`$idSolicitado`, `$productoEncontrado`) | `<hash_commit_1>` |
| 2 | Funciones pequeñas (cap. 3) | `public/producto-detalle.php` al validar `$_GET['id']` | Extraje la validación del ID a `obtenerIdValidoDesdeGet()` para separar validación de búsqueda | `<hash_commit_2>` |
| 3 | Objetos (cap. 6) | Uso de `Producto` y `Categoria` en tarjetas y vistas | Consulté métodos del objeto (`obtenerPrecioFormateado()`, `estaDisponible()`) sin exponer propiedades públicas ni recalcular reglas en la vista | `<hash_commit_3>` |