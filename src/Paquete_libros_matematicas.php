<?php
class Paquete_libros_matematicas extends Paquete_libros
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addMathBook(Libro $book)
    {
        if ($book->getTematica() == 'Matemáticas') {
            
            $this->addProducto($book); //heredado de Paquete_libros
        }
    }
}
