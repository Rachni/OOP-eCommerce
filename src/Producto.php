<?php

abstract class Producto
{
    private $nombre;
    private $precio;
    private $cantidad = 1;

    public function __construct($nombre, $precio)
    {
        $this->nombre = $nombre;
        $this->precio = $precio;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function getCantidad()
    {
        return $this->cantidad;
    }
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setCantidad($cantidad)
    {
        $this->cantidad = max(1, $cantidad); //min 1
    }
}
