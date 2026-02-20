<?php require("layout/header.php"); ?>

<h1>Recibo</h1>
<br/>
<h2><?php echo (isset($opcion) && $opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVO'); ?></h2>

<?php
if (!isset($recibo)) {
    $recibo = new stdClass();
    $recibo->recibo_id = 0;
    $recibo->factura_id = '';
    $recibo->fecha = '';
    $recibo->importe = '';
}
?>

<form action="<?php echo 'index.php?c=recibos&m=' . 
             (isset($opcion) && $opcion == 'EDITAR' ? 'modificar&id=' . $recibo->recibo_id : 'insertar'); ?>" 
      method="POST">

  <label for="factura_id" class="form-label">Factura ID</label>
  <input type="number" class="form-control" name="factura_id" id="factura_id"
         value="<?php echo isset($recibo->factura_id) ? $recibo->factura_id : ''; ?>" required/>
  <br/>

  <label for="fecha" class="form-label">Fecha de cobro</label>
  <input type="date" class="form-control" name="fecha" id="fecha"
         value="<?php echo isset($recibo->fecha) ? $recibo->fecha : ''; ?>" required/>
  <br/>

  <label for="importe" class="form-label">Importe</label>
  <input type="number" step="0.01" class="form-control" name="importe" id="importe"
         value="<?php echo isset($recibo->importe) ? $recibo->importe : ''; ?>" required/>
  <br/>

  <button type="submit" class="btn btn-primary">Aceptar</button>
  <a href="<?php echo URLSITE . '?c=recibos'; ?>">
      <button type="button" class="btn btn-outline-secondary float-end">Cancelar</button>
  </a>
</form>

<?php require("layout/footer.php"); ?>
