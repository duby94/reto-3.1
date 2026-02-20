<?php require("layout/header.php"); ?>

<h1>CLIENTES</h1>
<br />
<h2><?php echo (isset($opcion) && $opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVO'); ?></h2>

<?php
// Si no hay $cliente, creamos uno vacío para evitar notices
if (!isset($cliente)) {
    $cliente = new stdClass();
    $cliente->id = 0;
    $cliente->nombre = '';
    $cliente->apellidos = '';
    $cliente->email = '';
    $cliente->contrasena = '';
    $cliente->direccion = '';
    $cliente->cp = '';
    $cliente->poblacion = '';
    $cliente->provincia = '';
    $cliente->fecha_nacimiento = '';
}
?>

<form action="<?php echo 'index.php?c=clientes&m=' .
    (isset($opcion) && $opcion == 'EDITAR' ? 'modificar&id=' . $cliente->id : 'insertar'); ?>" method="POST">

    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" name="nombre" id="nombre"
        value="<?php echo htmlspecialchars($cliente->nombre); ?>" required />
    <br />

    <label for="apellidos" class="form-label">Apellidos</label>
    <input type="text" class="form-control" name="apellidos" id="apellidos"
        value="<?php echo htmlspecialchars($cliente->apellidos); ?>" required />
    <br />

    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" name="email" id="email"
        value="<?php echo htmlspecialchars($cliente->email); ?>" required />
    <br />

    <label for="contrasena" class="form-label">Contraseña</label>
    <input type="password" class="form-control" name="contrasena" id="contrasena" value="" <?php echo (isset($opcion) && $opcion == 'EDITAR' ? '' : 'required'); ?> />
    <small>Dejar vacío si no desea cambiar la contraseña</small>
    <br />

    <label for="direccion" class="form-label">Dirección</label>
    <input type="text" class="form-control" name="direccion" id="direccion"
        value="<?php echo htmlspecialchars($cliente->direccion); ?>" required />
    <br />

    <label for="cp" class="form-label">Código Postal</label>
    <input type="text" class="form-control" name="cp" id="cp" value="<?php echo htmlspecialchars($cliente->cp); ?>"
        required />
    <br />

    <label for="poblacion" class="form-label">Población</label>
    <input type="text" class="form-control" name="poblacion" id="poblacion"
        value="<?php echo htmlspecialchars($cliente->poblacion); ?>" required />
    <br />

    <label for="provincia" class="form-label">Provincia</label>
    <input type="text" class="form-control" name="provincia" id="provincia"
        value="<?php echo htmlspecialchars($cliente->provincia); ?>" required />
    <br />

    <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento"
        value="<?php echo htmlspecialchars($cliente->fecha_nacimiento); ?>" required />
    <br />

<!-- Modificacion examen -->
    <label for="formadepago" class="form-label">Forma de Pago</label>
    <select class="form-control" name="formadepago" id="formadepago" required>
        <option value="1" <?php echo (isset($cliente->formadepago) && $cliente->formadepago == 1 ? 'selected' : ''); ?>>
            Contado</option>
        <option value="2" <?php echo (isset($cliente->formadepago) && $cliente->formadepago == 2 ? 'selected' : ''); ?>>
            Recibo 30 días</option>
        <option value="3" <?php echo (isset($cliente->formadepago) && $cliente->formadepago == 3 ? 'selected' : ''); ?>>
            Recibo 30 y 60 días</option>
    </select>
    <br />

    <button type="submit" class="btn btn-primary">Aceptar</button>
    <a href="<?php echo URLSITE . '?c=clientes'; ?>">
        <button type="button" class="btn btn-outline-secondary float-end">Cancelar</button>
    </a>
</form>

<?php require("layout/footer.php"); ?>