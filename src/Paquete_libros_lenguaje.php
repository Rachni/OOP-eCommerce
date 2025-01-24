<?php
class Paquete_libros_lenguaje extends Paquete_libros
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addLanguageBook(Libro $book)
    {
        if ($book->getTematica() == 'Lenguaje') {
            $this->addProducto($book); //heredado de Paquete_libros
        }
    }
}
