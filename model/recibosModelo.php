<?php
require_once("model/bd.php");

class RecibosModelo extends BD
{
    public $recibo_id;
    public $factura_id;
    public $fecha;
    public $importe;

    public $filas;

    public function Seleccionar()
    {
        $sql = 'SELECT * FROM recibos';
        $params = [];

        if (!empty($this->recibo_id)) {
            $sql .= " WHERE recibo_id = ?";
            $params[] = $this->recibo_id;
        }
        if (!empty($this->factura_id)) {
            $sql .= empty($params) ? " WHERE factura_id = ?" : " AND factura_id = ?";
            $params[] = $this->factura_id;
        }

        $this->filas = $this->_consultar($sql, $params);

        if ($this->filas == null) return false;

        if (!empty($this->recibo_id)) {
            $fila = $this->filas[0];
            $this->factura_id = $fila->factura_id;
            $this->fecha      = $fila->fecha;
            $this->importe    = $fila->importe;
        }

        return true;
    }

    public function Insertar()
    {
        $sql = "INSERT INTO recibos (factura_id, fecha, importe) VALUES (?, ?, ?)";
        return $this->_ejecutar($sql, [
            $this->factura_id,
            $this->fecha,
            $this->importe
        ]);
    }

    public function Modificar()
    {
        $sql = "UPDATE recibos SET factura_id = ?, fecha = ?, importe = ? WHERE recibo_id = ?";
        return $this->_ejecutar($sql, [
            $this->factura_id,
            $this->fecha,
            $this->importe,
            $this->recibo_id
        ]);
    }

    public function Borrar()
    {
        $sql = "DELETE FROM recibos WHERE recibo_id = ?";
        return $this->_ejecutar($sql, [$this->recibo_id]);
    }
}
