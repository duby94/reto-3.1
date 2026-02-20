<?php
require_once("bd.php");

class ClientesModelo extends BD
{
    public $id = 0;
    public $nombre = '';
    public $email = '';
    public $apellidos = '';
    public $contrasena = '';
    public $direccion = '';
    public $cp = '';
    public $poblacion = '';
    public $provincia = '';
    public $fecha_nacimiento = '';

    // modificacion del examen.
    public $formadepago = 1; // valor por defecto


    public $filas = null;

    public function Insertar()
    {
        $pass_hash = password_hash($this->contrasena, PASSWORD_DEFAULT);

        // modificacion del examen.
        $sql = "INSERT INTO clientes 
        (nombre, apellidos, email, contrasena, direccion, cp, poblacion, provincia, fecha_nacimiento, formadepago) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        return $this->_ejecutar($sql, [
            $this->nombre,
            $this->apellidos,
            $this->email,
            $pass_hash,
            $this->direccion,
            $this->cp,
            $this->poblacion,
            $this->provincia,
            $this->fecha_nacimiento,
            // modificacion del examen.
            $this->formadepago
        ]);
    }


    // modificacion del examen.
    public function Modificar()
    {
        $pass_hash = password_hash($this->contrasena, PASSWORD_DEFAULT);

        $sql = "UPDATE clientes SET
        nombre = ?, 
        apellidos = ?, 
        email = ?, 
        contrasena = ?, 
        direccion = ?, 
        cp = ?, 
        poblacion = ?, 
        provincia = ?, 
        fecha_nacimiento = ?,
        formadepago = ?
        WHERE id = ?";

        return $this->_ejecutar($sql, [
            $this->nombre,
            $this->apellidos,
            $this->email,
            $pass_hash,
            $this->direccion,
            $this->cp,
            $this->poblacion,
            $this->provincia,
            $this->fecha_nacimiento,
            // modificacion del examen.
            $this->formadepago,
            $this->id
        ]);
    }

    public function Borrar()
    {
        $sql = "DELETE FROM clientes WHERE id = ?";
        return $this->_ejecutar($sql, [$this->id]);
    }

    public function Seleccionar()
    {
        $sql = 'SELECT * FROM clientes';
        $params = [];

        if (!empty($this->id) && $this->id != 0) {
            $sql .= " WHERE id = ?";
            $params[] = $this->id;
        }

        $this->filas = $this->_consultar($sql, $params);

        if ($this->filas == null)
            return false;

        if (!empty($this->id) && $this->id != 0) {
            $this->nombre = $this->filas[0]->nombre;
            $this->apellidos = $this->filas[0]->apellidos;
            $this->email = $this->filas[0]->email;
            $this->contrasena = $this->filas[0]->contrasena;
            $this->direccion = $this->filas[0]->direccion;
            $this->cp = $this->filas[0]->cp;
            $this->poblacion = $this->filas[0]->poblacion;
            $this->provincia = $this->filas[0]->provincia;
            $this->fecha_nacimiento = $this->filas[0]->fecha_nacimiento;
        }

        return true;
    }

}
