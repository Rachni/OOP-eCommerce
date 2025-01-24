<?php
abstract class Paquete_libros
{
    protected $productos = []; // array de objetos libro
    protected $cantidad;
    protected $importe;

    // Constructor
    public function __construct()
    {
        $this->productos = [];
        $this->cantidad = $this->calcularCantidad();
        $this->importe = $this->calcularImporte();
    }

    // Getters
    public function getProductos()
    {
        return $this->productos;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getImporte()
    {
        return $this->importe;
    }

    // Métodos de cálculo
    protected function calcularCantidad()
    {
        $total = 0;
        foreach ($this->productos as $item) {
            $total += $item['cantidad']; // Sumar la cantidad de cada libro
        }
        return $total;
    }

    protected function calcularImporte()
    {
        $total = 0;
        foreach ($this->productos as $item) {
            $total += $item['producto']->getPrecio() * $item['cantidad']; 
        }
        return $total;
    }

    // Agregar un producto
    public function addProducto($producto)
    {
        // Verificar si el libro ya está en el paquete
        foreach ($this->productos as &$item) {
            if ($item['producto']->getNombre() == $producto->getNombre()) {
                // Si ya existe el producto, se incrementa la cantidad
                $item['cantidad']++;
                $this->cantidad = $this->calcularCantidad();
                $this->importe = $this->calcularImporte();
                return;
            }
        }

        // Si no está en el paquete, añadirlo con cantidad 1
        $this->productos[] = [
            'producto' => $producto,
            'cantidad' => 1
        ];

        // Actualizar la cantidad total y el precio
        $this->cantidad = $this->calcularCantidad();
        $this->importe = $this->calcularImporte();
    }
}
