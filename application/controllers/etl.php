<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Etl extends CI_Controller  {

    protected $dwhcon;

    public function __construct () {
        parent::__construct();
        $server = 'localhost';
        $dwh = array("Database"=>"DwH");
        $this->dwhcon = sqlsrv_connect($server,$dwh);
        if ($dwh) {

        }else {
            echo "Conexión de la base de datos no establecida";
            die(print_r(sqlsrv_errors(),true));
        }
    }

    public function Empleados () {
        $acsempleados = json_decode(file_get_contents("http://localhost/ETLC/index.php/access/acsEmpleados?table=acsempleados"));
        //$srvempleados = json_decode(file_get_contents("http://localhost/ETLC/index.php/sqlserver/srvEmpleados?table=srvempleados"));
        //var_dump($acsempleados);
        //var_dump($srvempleados);
        foreach($acsempleados as $ae){
            $ace = $ae->id_Empleado;
            $ane = strtoupper( $ae->Nombre." ".$ae->Apellido_Paterno." ".$ae->Apellido_Materno );

            $srvempleados = json_decode(file_get_contents("http://localhost/ETLC/index.php/sqlserver/srvEmpleados?table=srvempleados"));
            foreach ($srvempleados as $se){
                
                $sce = $se->id_Empleado;
                $sne = strtoupper( $se->Nombre." ".$se->Apellido_P." ".$se->Apellido_M );
                if ($ane == $sne && $ace != $sce){
                    //error cliente duplicado 
                }else {
                    $id = $ae->id_Empleado; 
                    $n = $ae->Nombre;
                    $ap = $ae->Apellido_Paterno;
                    $am = $ae->Apellido_Materno;
                    $rfc = $ae->RFC;
                    sqlsrv_query("INSERT INTO Empleados Values ()");
                } 
            }
            echo $ace.' '.$ane.'<br/>';
        }
    }



}