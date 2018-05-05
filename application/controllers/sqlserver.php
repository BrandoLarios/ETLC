<?php
class Sqlserver extends CI_Controller {

    protected $dwhcon;

    public function __construct () {
        parent :: __construct();
        $server = 'localhost';
        $dwh = array("Database"=>"DwH");
        $this->dwhcon = sqlsrv_connect($server,$dwh);
        if ($dwh) {

        }else {
            echo "Conexión de la base de datos no establecida";
            die(print_r(sqlsrv_errors(),true));
        }
    }

    public function peticion ($query) {
        $ptt = sqlsrv_query ($this->dwhcon,$query);
        $tabla = array();
        $i=0;
        while ($row = sqlsrv_fetch_array ($ptt)) {
            $tabla [$i] = $row;
            $i++;
        }
        return $tabla;
    }

    public function srvEmpleados () {
        $query = "SELECT * from Empleados";
        $srvempleados = $this->peticion($query);
        echo json_encode ($srvempleados);
    }
    public function insertE () {
        
    }
    
}