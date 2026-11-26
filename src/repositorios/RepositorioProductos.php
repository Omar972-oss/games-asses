<?php

declare(strict_types=1);

require_once __DIR__ . '/../modelos/Producto.php';

class RepositorioProductos
{
    private string $rutaArchivo;

    public function __construct(?string $rutaArchivo = null)
    {
        $this->rutaArchivo = $rutaArchivo ?? __DIR__ . '/../../datos.json/datos.json';
    }

    /**
     * Lee el archivo JSON y devuelve los registros crudos como arreglos.
     *
     * @return array<int, array<string, mixed>>
     */
    private function leerRegistros(): array
    {
        if (!file_exists($this->rutaArchivo)) {
            throw new RuntimeException("No se encontró el archivo de datos: " . $this->rutaArchivo);
        }

        $contenido = file_get_contents($this->rutaArchivo);
        if ($contenido === false) {
            throw new RuntimeException("No se pudo leer el archivo de datos: " . $this->rutaArchivo);
        }

        $datos = json_decode($contenido, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($datos)) {
            throw new RuntimeException("El archivo JSON no tiene un formato válido: " . json_last_error_msg());
        }

        return $datos;
    }

    /**
     * Convierte todos los registros del JSON en objetos Producto.
     *
     * @return array<int, Producto>
     */
    public function obtenerTodos(): array
    {
        $registros = $this->leerRegistros();
        $productos = [];

        foreach ($registros as $registro) {
            if (!is_array($registro)) {
                throw new InvalidArgumentException("Cada elemento del catálogo debe ser un objeto o arreglo.");
            }
            $productos[] = Producto::desdeArreglo($registro);
        }

        return $productos;
    }

    /**
     * Busca un producto por su ID. Si no existe, lanza una excepción.
     */
    public function buscarPorId(int $id): Producto
    {
        foreach ($this->obtenerTodos() as $producto) {
            if ($producto->obtenerId() === $id) {
                return $producto;
            }
        }

        throw new OutOfBoundsException("No existe ningún videojuego con el ID " . $id);
    }
}