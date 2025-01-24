<?php
include_once('../src/handler.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OOP - Anabel Martínez Perdomo</title>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js" defer></script>
</head>

<body>
  <header>
    <h1>Libros didácticos</h1>
  </header>

  <main>
    <section id="productos">
      <h2>Productos Disponibles</h2>
      <div id="producto-lista">
        <?php foreach ($productos as $index => $producto): ?>
          <div class="producto">
            <div class="producto-info">
              <h3><?php echo $producto->getNombre(); ?></h3>
              <p>Precio: $<?php echo number_format($producto->getPrecio(), 2); ?></p>
            </div>
            <form action="index.php" method="POST">
              <input type="hidden" name="producto_id" value="<?php echo $index; ?>">
              <button type="submit" name="agregar">Agregar al Carrito</button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  </main>

  <div id="cart-modal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <section id="carrito">
        <h2>Carrito</h2>
        <div id="carrito-contenido">
          <?php if (empty($_SESSION['carrito']->getProductos())): ?>
            <p>El carrito está vacío.</p>
          <?php else: ?>
            <?php foreach ($_SESSION['carrito']->getProductos() as $item): ?>
              <div class="producto">
                <h4><?php echo $item->getNombre(); ?></h4>
                <p>Precio: $<?php echo number_format($item->getPrecio(), 2); ?></p>
                <p>Cantidad: <?php echo $item->getCantidad(); ?></p>
              </div>
            <?php endforeach; ?>
            <div>
              <h2>Total: €<?php echo number_format($total, 2, ',', '.'); ?></h2>
            </div>
            <br>
            <h2>Paquetes</h2>
            <!-- Mostrar Paquete de Libros de Lenguaje -->
            <?php if (!empty($_SESSION['paqueteLenguaje']->getProductos())): ?>
              <h3>Paquete de Libros de Lenguaje: <?php echo $_SESSION['paqueteLenguaje']->getCantidad(); ?> productos</h3>
              <?php foreach ($_SESSION['paqueteLenguaje']->getProductos() as $productoarray): ?>
                <div class="producto">
                  <h4><?php echo $productoarray['producto']->getNombre(); ?></h4>
                  <p>Precio: $<?php echo number_format($productoarray['producto']->getPrecio(), 2); ?></p>
                  <p>Cantidad: <?php echo $productoarray['cantidad']; ?></p>
                </div>
              <?php endforeach; ?>
              <h3 class="package-total">Total del Paquete: $<?php echo number_format($_SESSION['paqueteLenguaje']->getImporte(), 2); ?></h3>
            <?php endif; ?>
            <br>
            <!-- Mostrar Paquete de Libros de Matemáticas -->
            <?php if (!empty($_SESSION['paqueteMatematicas']->getProductos())): ?>
              <h3>Paquete de Libros de Matemáticas: <?php echo $_SESSION['paqueteMatematicas']->getCantidad(); ?> productos</h3>
              <?php foreach ($_SESSION['paqueteMatematicas']->getProductos() as $productoarray): ?>
                <div class="producto">
                  <h4><?php echo $productoarray['producto']->getNombre(); ?></h4>
                  <p>Precio: $<?php echo number_format($productoarray['producto']->getPrecio(), 2); ?></p>
                  <p>Cantidad: <?php echo $productoarray['cantidad']; ?></p>
                </div>
              <?php endforeach; ?>
              <h3 class="package-total">Total del Paquete: $<?php echo number_format($_SESSION['paqueteMatematicas']->getImporte(), 2); ?></h3>
            <?php endif; ?>

            <!-- Botón para Vaciar el Carrito -->
            <form action="index.php" method="POST">

              <button type="submit" name="vaciar">Vaciar Carrito</button>
            </form>

          <?php endif; ?>
        </div>
        <br>
        <button id="finalizar-compra">Finalizar Compra</button>
      </section>
    </div>
  </div>

  <button id="open-cart">Ver Carrito</button>
  <footer>
    <h2 style="color: white;">Anabel Martínez Perdomo </h2>
  </footer>
</body>

</html>