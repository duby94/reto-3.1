<?php require("layout/header.php"); ?>

<h1>Línea de Factura</h1>
<h2><?php echo (isset($opcion) && $opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVA'); ?></h2>

<?php
if (!isset($linea)) {
    $linea = new stdClass();
    $linea->id = 0;
    $linea->factura_id = '';
    $linea->referencia = '';
    $linea->descripcion = '';
    $linea->cantidad = '';
    $linea->precio = '';
    $linea->iva = '';
}
?>

<form action="<?php echo 'index.php?c=lineas&m=' . 
             (isset($opcion) && $opcion == 'EDITAR' ? 'modificar&id=' . $linea->id : 'insertar'); ?>" 
      method="POST">

    <label for="factura_id" class="form-label">Factura ID</label>
    <input type="number" class="form-control" name="factura_id" id="factura_id"
           value="<?php echo $linea->factura_id; ?>" required>
    <br>

    <label for="referencia" class="form-label">Referencia</label>
    <input type="number" class="form-control" name="referencia" id="referencia"
           value="<?php echo $linea->referencia; ?>" required>
    <br>

    <label for="descripcion" class="form-label">Descripción</label>
    <input type="text" class="form-control" name="descripcion" id="descripcion"
           value="<?php echo $linea->descripcion; ?>" required>
    <br>

    <label for="cantidad" class="form-label">Cantidad</label>
    <input type="number" step="0.001" class="form-control" name="cantidad" id="cantidad"
           value="<?php echo $linea->cantidad; ?>" required>
    <br>

    <label for="precio" class="form-label">Precio</label>
    <input type="number" step="0.01" class="form-control" name="precio" id="precio"
           value="<?php echo $linea->precio; ?>" required>
    <br>

    <label for="iva" class="form-label">IVA (%)</label>
    <input type="number" step="0.01" class="form-control" name="iva" id="iva"
           value="<?php echo $linea->iva; ?>" required>
    <br>

    <button type="submit" class="btn btn-primary">Aceptar</button>
    <a href="<?php echo URLSITE . '?c=lineas'; ?>" class="btn btn-outline-secondary">Cancelar</a>

</form>

<?php require("layout/footer.php"); ?>
