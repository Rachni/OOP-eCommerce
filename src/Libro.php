<?php
class Libro extends Producto
{
    private $tematica;

    public function __construct($nombre, $precio, $tematica)
    {
        parent::__construct($nombre, $precio);
        $this->setTematica($tematica);
    }

    public function getTematica()
    {
        return $this->tematica;
    }

    public function setTematica($tematica)
    {
        if ($tematica == "Matemáticas" || $tematica == "Lenguaje") {
            $this->tematica = $tematica;
        } else {
            throw new Exception("La temática no es válida");
        }
    }
}
