<?php require("layout/header.php"); ?>

<h1>FACTURAS</h1>
<br />

<table class="table table-striped table-hover" id="tabla">
    <thead>
        <tr class="text-center">
            <th>Id</th>
            <th>Cliente</th>
            <th>Número</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($facturas) && $facturas->filas):
            foreach ($facturas->filas as $fila):
        ?>
        <tr>
            <td style="text-align: right; width: 5%;"><?php echo $fila->id; ?></td>
            <td><?php echo htmlspecialchars($fila->cliente_id); ?></td>
            <td><?php echo htmlspecialchars($fila->numero); ?></td>
            <td><?php echo htmlspecialchars($fila->fecha); ?></td>
            <td style="text-align: right; width: 50%;">
                <a href="index.php?c=facturas&m=editar&id=<?php echo $fila->id; ?>">
                    <button type="button" class="btn btn-success">Editar</button>
                </a>

                <a href="index.php?c=facturas&m=borrar&id=<?php echo $fila->id; ?>">
                    <button type="button" class="btn btn-danger borrar"
                        onclick="return confirm('¿Estás seguro de borrar la factura <?php echo $fila->id; ?>?');">
                        Borrar
                    </button>
                </a>

                <!-- Modificacion examen Botón Recibos por cada factura -->
                <a href="index.php?c=recibos&m=recibos&factura_id=<?php echo $fila->id; ?>">
                    <button type="button" class="btn btn-secondary">Recibos</button>
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
            <td colspan="5">
                <a href="index.php?c=facturas&m=nuevo">
                    <button type="button" class="btn btn-primary">Nueva Factura</button>
                </a>
            </td>
        </tr>
    </tfoot>
</table>

<?php require("layout/footer.php"); ?>
