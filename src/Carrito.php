<?php

class Carrito
{

    private $productos = [];
    private $total;


    public function __construct()
    {
        $this->productos = $_SESSION['cart'] ?? [];
        $this->calcularTotal();
    }


    public function getProductos()
    {
        foreach ($this->productos as $producto) {
            if (!$producto instanceof Producto) {
                throw new UnexpectedValueException('Los productos en el carrito deben ser instancias de la clase Producto.');
            }
        }

        return $this->productos;
    }



    public function getTotal()
    {
        return $this->total;
    }


    public function addProduct($product)
    {
        if (!$product instanceof Producto) {
            throw new InvalidArgumentException('El producto debe ser una instancia de la clase Producto.');
        }
    
        // Asegúrate de que el producto tenga una cantidad válida
        if ($product->getCantidad() <= 0) {
            throw new InvalidArgumentException('La cantidad del producto debe ser mayor a 0.');
        }
    
        // Busca si el producto ya existe en el carrito
        foreach ($this->productos as $existingProduct) {
            if ($existingProduct->getNombre() === $product->getNombre()) {
                // Suma la cantidad del producto existente
                $newCantidad = $existingProduct->getCantidad() + $product->getCantidad();
    
                // Verifica que la nueva cantidad sea válida
                if ($newCantidad <= 0) {
                    throw new InvalidArgumentException('La cantidad total del producto no puede ser menor o igual a 0.');
                }
    
                $existingProduct->setCantidad($newCantidad);
    
                // Actualiza la sesión y el total
                $_SESSION['cart'] = $this->productos;
                $this->calcularTotal();
                return;
            }
        }
    
        // Si no existe, añade el producto al carrito
        $this->productos[] = $product;
        $_SESSION['cart'] = $this->productos;
        $this->calcularTotal();
    }


    public function removeProduct($index)
    {
        if (isset($this->productos[$index])) {
            unset($this->productos[$index]);
            $this->productos = array_values($this->productos); // Reindex the array
            $_SESSION['cart'] = $this->productos;
            $this->calcularTotal();
        } else {
            throw new OutOfBoundsException("Product at index {$index} does not exist.");
        }
    }


    public function clearCart()
    {
        $this->productos = [];
        $_SESSION['cart'] = $this->productos;
        $this->calcularTotal();
    }


    private function calcularTotal()
    {
        $this->total = 0;
    
        foreach ($this->productos as $product) {
            // Valida que los valores sean correctos antes de sumar
            $cantidad = $product->getCantidad();
            $precio = $product->getPrecio();
    
            if ($cantidad <= 0 || $precio < 0) {
                throw new UnexpectedValueException('Cantidad o precio del producto inválido al calcular el total.');
            }
    
            $this->total += $precio * $cantidad;
        }
    }
}    
