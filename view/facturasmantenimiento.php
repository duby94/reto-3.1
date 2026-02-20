<?php require("layout/header.php"); ?>

<h1>FACTURA</h1>
<br/>
<h2><?php echo (isset($opcion) && $opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVA'); ?></h2>

<?php
if (!isset($factura)) {
    $factura = new stdClass();
    $factura->id = 0;
    $factura->cliente_id = '';
    $factura->numero = '';
    $factura->fecha = '';
}
?>

<form action="<?php echo 'index.php?c=facturas&m=' .
             (isset($opcion) && $opcion == 'EDITAR' ? 'modificar&id=' . $factura->id : 'insertar'); ?>"
      method="POST">

  <label for="cliente_id" class="form-label">Cliente</label>
  <input type="number" class="form-control" name="cliente_id" id="cliente_id"
         value="<?php echo isset($factura->cliente_id) ? $factura->cliente_id : ''; ?>" required/>
  <br/>

  <label for="numero" class="form-label">Número de factura</label>
  <input type="number" class="form-control" name="numero" id="numero"
         value="<?php echo isset($factura->numero) ? $factura->numero : ''; ?>" required/>
  <br/>

  <label for="fecha" class="form-label">Fecha</label>
  <input type="datetime-local" class="form-control" name="fecha" id="fecha"
         value="<?php echo isset($factura->fecha) ? date('Y-m-d\TH:i', strtotime($factura->fecha)) : ''; ?>" required/>
  <br/>

  <button type="submit" class="btn btn-primary">Aceptar</button>
  <a href="<?php echo URLSITE . '?c=facturas'; ?>">
      <button type="button" class="btn btn-outline-secondary float-end">Cancelar</button>
  </a>
</form>

<?php require("layout/footer.php"); ?>
