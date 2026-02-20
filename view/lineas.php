<?php require("layout/header.php"); ?>

<h1>Líneas de Factura</h1>
<br/>

<table class="table table-striped table-hover">
    <thead>
        <tr class="text-center">
            <th>ID</th>
            <th>Factura ID</th>
            <th>Referencia</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>IVA</th>
            <th>Importe</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($lineas) && $lineas->filas) :
            foreach ($lineas->filas as $fila) :
        ?>
        <tr>
            <td><?php echo $fila->id; ?></td>
            <td><?php echo $fila->factura_id; ?></td>
            <td><?php echo htmlspecialchars($fila->referencia); ?></td>
            <td><?php echo htmlspecialchars($fila->descripcion); ?></td>
            <td><?php echo $fila->cantidad; ?></td>
            <td><?php echo $fila->precio; ?></td>
            <td><?php echo $fila->iva; ?></td>
            <td><?php echo $fila->importe; ?></td>
            <td>
                <a href="index.php?c=lineas&m=editar&id=<?php echo $fila->id; ?>" class="btn btn-success btn-sm">Editar</a>
                <a href="index.php?c=lineas&m=borrar&id=<?php echo $fila->id; ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('¿Seguro que quieres borrar la línea <?php echo $fila->id; ?>?');">
                   Borrar
                </a>
            </td>
        </tr>
        <?php
            endforeach;
        endif;
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="9">
                <a href="index.php?c=lineas&m=nuevo" class="btn btn-primary">Nueva Línea</a>
            </td>
        </tr>
    </tfoot>
</table>

<?php require("layout/footer.php"); ?>
