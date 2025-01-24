<?php
include('../src/Producto.php');
include('../src/Libro.php');
include('../src/Paquete_libros.php');
include('../src/Paquete_libros_matematicas.php');
include('../src/Paquete_libros_lenguaje.php');
include('../src/Carrito.php');

// Iniciar la sesión
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar que el carrito exista en la sesión y si no, crearlo
if (!isset($_SESSION['carrito']) || !($_SESSION['carrito'] instanceof Carrito)) {
    $_SESSION['carrito'] = new Carrito();
}
// Este será el importe total del carrito
$total = $_SESSION['carrito']->getTotal();

// Si el paquete de matemáticas o lenguaje no existe en la sesión, se crea
if (!isset($_SESSION['paqueteMatematicas'])) {
    $_SESSION['paqueteMatematicas'] = new Paquete_libros_matematicas();
}
if (!isset($_SESSION['paqueteLenguaje'])) {
    $_SESSION['paqueteLenguaje'] = new Paquete_libros_lenguaje();
}

// PRODUCTOS
$productos = [
    new Libro("Álgebra Básica", 10.50, "Matemáticas"),
    new Libro("Geometría Avanzada", 15.75, "Matemáticas"),
    new Libro("Cálculo Diferencial", 20.00, "Matemáticas"),
    new Libro("Literatura Española", 12.00, "Lenguaje"),
    new Libro("Redacción y Escritura", 9.95, "Lenguaje"),
    new Libro("Historia del Arte", 18.50, "Lenguaje")
];

// Función para agregar al carrito y asignar a los paquetes correspondientes
if (isset($_POST['agregar']) && isset($_POST['producto_id'])) {
    $productoId = $_POST['producto_id'];

    // Verifica que el índice sea válido
    if (isset($productos[$productoId])) {
        $producto = $productos[$productoId];

        // Agregar al carrito usando la clase Carrito
        $_SESSION['carrito']->addProduct($producto);

        $total = $_SESSION['carrito']->getTotal();
        
        // Verificamos si es de Matemáticas o Lenguaje y lo agregamos al paquete correspondiente
        if ($producto->getTematica() == "Matemáticas") {
            $_SESSION['paqueteMatematicas']->addMathBook($producto);
        } elseif ($producto->getTematica() == "Lenguaje") {
            $_SESSION['paqueteLenguaje']->addLanguageBook($producto);
        }
    } else {
        echo "El producto seleccionado no es válido.";
    }
}

// Vaciar el carrito y los paquetes
if (isset($_POST['vaciar'])) {
    $_SESSION['carrito']->clearCart(); // Vaciar el carrito
    $_SESSION['paqueteMatematicas'] = new Paquete_libros_matematicas(); // Recrear el paquete de matemáticas
    $_SESSION['paqueteLenguaje'] = new Paquete_libros_lenguaje(); // Recrear el paquete de lenguaje
}
