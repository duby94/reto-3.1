<?php
require_once("model/bd.php");

class FacturasModelo extends BD
{
    // CAMBIO 4
    public $id;
    public $cliente_id;
    public $numero;
    public $fecha;

    public $filas;
    protected $error;

    public function Seleccionar()
    {
        $sql = 'SELECT * FROM facturas';
        $params = [];

        if (!empty($this->id) && $this->id != 0) {
            $sql .= " WHERE id = ?";
            $params[] = $this->id;
        }

        $this->filas = $this->_consultar($sql, $params);

        if ($this->filas == null) return false;

        if (!empty($this->id) && $this->id != 0) {
            $this->cliente_id = $this->filas[0]->cliente_id;
            $this->numero     = $this->filas[0]->numero;
            $this->fecha      = $this->filas[0]->fecha;
        }

        return true;
    }

    public function Insertar()
    {
        $sql = "INSERT INTO facturas (cliente_id, numero, fecha) VALUES (?, ?, ?)";
        return $this->_ejecutar($sql, [$this->cliente_id, $this->numero, $this->fecha]);
    }

    public function Modificar()
    {
        $sql = "UPDATE facturas SET cliente_id = ?, numero = ?, fecha = ? WHERE id = ?";
        return $this->_ejecutar($sql, [$this->cliente_id, $this->numero, $this->fecha, $this->id]);
    }

    public function Borrar()
    {
        $sql = "DELETE FROM facturas WHERE id = ?";
        return $this->_ejecutar($sql, [$this->id]);
    }
}
