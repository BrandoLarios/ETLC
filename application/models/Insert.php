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

    public function insertEmp ($query) {
        sqlsrv_query ($this->dwhcon,$query);
    }
}