<?php
require_once(__DIR__ . '/../config.php');

class BD
{
    private $con = null;
    private $error = '';

    function __construct()
    {
        $this->error = '';

        try {
            $this->con = new PDO('mysql:host=' . SERVIDOR .
                                ';dbname=' . BASEDATOS .
                                ';charset=utf8mb4',
                                USUARIO,
                                CONTRASENA,
                                [PDO::ATTR_EMULATE_PREPARES => false]);

            if ($this->con) {
                $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->con->exec('SET NAMES utf8mb4');
            }
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    function __destruct()
    {
        $this->con = null;
    }

    protected function _consultar($query, $params = [])
    {
        $this->error = '';
        $filas = null;

        try {
            $stmt = $this->con->prepare($query);
            $stmt->execute($params);

            if ($stmt->rowCount() > 0) {
                $filas = [];
                while ($registro = $stmt->fetchObject()) {
                    $filas[] = $registro;
                }
            }
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }

        return $filas;
    }

    protected function _ejecutar($query, $params = [])
    {
        $this->error = '';
        $filas = 0;

        try {
            $stmt = $this->con->prepare($query);
            $stmt->execute($params);
            $filas = $stmt->rowCount();
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }

        return $filas;
    }

    protected function _ultimoId()
    {
        return $this->con->lastInsertId();
    }

    public function GetError()
    {
        return $this->error;
    }

    public function Error()
    {
        return ($this->error != '');
    }
}
