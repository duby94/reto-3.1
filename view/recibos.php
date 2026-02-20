<?php require("layout/header.php"); ?>

<h1>Recibos</h1>
<br />

<table class="table table-striped table-hover">
    <thead>
        <tr class="text-center">
            <th>ID</th>
            <th>Factura ID</th>
            <th>Fecha</th>
            <th>Importe</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($recibos) && $recibos->filas):
            foreach ($recibos->filas as $fila):
                ?>
                <tr>
                    <td><?php echo $fila->recibo_id; ?></td>
                    <td><?php echo $fila->factura_id; ?></td>
                    <td><?php echo htmlspecialchars($fila->fecha); ?></td>
                    <td><?php echo $fila->importe; ?></td>
                    <td>
                        <a href="index.php?c=recibos&m=editar&id=<?php echo $fila->recibo_id; ?>"
                            class="btn btn-success btn-sm">Editar</a>
                        <a href="index.php?c=recibos&m=borrar&id=<?php echo $fila->recibo_id; ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Seguro que quieres borrar el recibo <?php echo $fila->recibo_id; ?>?');">
                            Borrar
                        </a>

                        <!-- Modificacion examen añadir boton imprimir -->
                        <a href="index.php?c=recibos&m=imprimir&id=<?php echo $fila->recibo_id; ?>"
                            class="btn btn-primary btn-sm" target="_blank">Imprimir</a>
                    </td>
                </tr>
                <?php
            endforeach;
        endif;
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5">
                <a href="index.php?c=recibos&m=nuevo" class="btn btn-primary">Nuevo Recibo</a>
            </td>
        </tr>
    </tfoot>
</table>

<?php require("layout/footer.php"); ?>