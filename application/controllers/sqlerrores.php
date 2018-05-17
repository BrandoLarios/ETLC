<?php
class Errores extends CI_Controller {

    protected $errorcon;

    public function __construct () {
        parent :: __construct();
        $server = 'localhost';
        $error = array("Database"=>"Error");
        $this->errorcon = sqlsrv_connect($server,$error);
        if ($error) {

        }else {
            echo "Conexión de la base de datos no establecida";
            die(print_r(sqlsrv_errors(),true));
        }
    }

    public function peticion ($query) {
        $ptt = sqlsrv_query ($this->errorcon,$query);
        $tabla = array();
        $i=0;
        while ($row = sqlsrv_fetch_array ($ptt)) {
            $tabla [$i] = $row;
            $i++;
        }
        return $tabla;
    }
    
    public function Clientes () {
        $query = "SELECT * from Clientes";
        $errorclientes = $this->peticion($query);
        echo json_encode ($errorclientes);
    }
    
}