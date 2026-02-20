<?php
require_once("model/bd.php");

class LineasModelo extends BD
{
    public $id;
    public $factura_id;
    public $referencia;
    public $descripcion;
    public $cantidad;
    public $precio;
    public $iva;
    public $importe;

    public $filas;

    public function Seleccionar()
    {
        $sql = 'SELECT * FROM lineas_factura';
        $params = [];

        if (!empty($this->id) && $this->id != 0) {
            $sql .= " WHERE id = ?";
            $params[] = $this->id;
        }
        if (!empty($this->factura_id)) {
            $sql .= empty($params) ? " WHERE factura_id = ?" : " AND factura_id = ?";
            $params[] = $this->factura_id;
        }

        $this->filas = $this->_consultar($sql, $params);

        if ($this->filas == null) return false;

        if (!empty($this->id) && $this->id != 0) {
            $fila = $this->filas[0];
            $this->factura_id = $fila->factura_id;
            $this->referencia  = $fila->referencia;
            $this->descripcion = $fila->descripcion;
            $this->cantidad    = $fila->cantidad;
            $this->precio      = $fila->precio;
            $this->iva         = $fila->iva;
            $this->importe     = $fila->importe;
        }

        return true;
    }

    public function Insertar()
    {
        $sql = "INSERT INTO lineas_factura (factura_id, referencia, descripcion, cantidad, precio, iva) 
                VALUES (?, ?, ?, ?, ?, ?)";
        return $this->_ejecutar($sql, [
            $this->factura_id,
            $this->referencia,
            $this->descripcion,
            $this->cantidad,
            $this->precio,
            $this->iva
        ]);
    }

    public function Modificar()
    {
        $sql = "UPDATE lineas_factura 
                SET factura_id = ?, referencia = ?, descripcion = ?, cantidad = ?, precio = ?, iva = ?
                WHERE id = ?";
        return $this->_ejecutar($sql, [
            $this->factura_id,
            $this->referencia,
            $this->descripcion,
            $this->cantidad,
            $this->precio,
            $this->iva,
            $this->id
        ]);
    }

    public function Borrar()
    {
        $sql = "DELETE FROM lineas_factura WHERE id = ?";
        return $this->_ejecutar($sql, [$this->id]);
    }
}
