<?php require("layout/header.php"); ?>

<h1>CLIENTES</h1>
<br/>

<table class="table table-striped table-hover" id="tabla">
<thead>
<tr class="text-center">
    <th>Id</th>
    <th>Nombre</th>
    <th>Email</th>
    <th></th>
</tr>
</thead>
<tbody>
<?php
// comentario para reto 3.1
if (isset($clientes) && $clientes->filas) :
    foreach ($clientes->filas as $fila) :
?>
<tr>
    <td style="text-align: right; width: 5%;"><?php echo $fila->id; ?></td>
    <td><?php echo htmlspecialchars($fila->nombre); ?></td>
    <td><?php echo htmlspecialchars($fila->email); ?></td>
    <td style="text-align: right; width: 50%;">
        <a href="index.php?c=clientes&m=editar&id=<?php echo $fila->id; ?>">
            <button type="button" class="btn btn-success">Editar</button></a>
        <a href="index.php?c=clientes&m=borrar&id=<?php echo $fila->id; ?>" >
            <button type="button" class="btn btn-danger borrar"
            onclick="return confirm('¿Estás seguro de borrar el registro <?php echo $fila->id; ?>?');">Borrar</button></a>
    </td>
</tr>
<?php
    endforeach;
endif;
?>
</tbody>
<tfoot>
<tr>
    <td colspan="4">
        <a href="index.php?c=clientes&m=nuevo">
        <button type="button" class="btn btn-primary">Nuevo</button>
        </a>
    </td>
</tr>
</tfoot>
</table>

<?php require("layout/footer.php"); ?>
