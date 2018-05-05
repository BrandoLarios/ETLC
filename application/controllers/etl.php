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
        //Datos de access
        $acsempleados = json_decode(file_get_contents("http://localhost/ETLC/index.php/access/acsEmpleados?table=acsempleados"));
        //variables access
        foreach($acsempleados as $ae){
            //Datos necesarios
            $aid    = $ae->id_Empleado; 
            $an     = $ae->Nombre;
            $aap    = $ae->Apellido_Paterno;
            $aam    = $ae->Apellido_Materno;
            $arfc   = $ae->RFC;
            //Formacion de nombre completo
            $anc    = strtoupper( $an." ".$aap." ".$aam);
            //Datos de server
            $srvempleados = json_decode(file_get_contents("http://localhost/ETLC/index.php/sqlserver/srvEmpleados?table=srvempleados"));
            foreach ($srvempleados as $se){
                //Datos necesarios
                $sid    = $se->id_Empleado; 
                $sn     = $se->Nombre;
                $sap    = $se->Apellido_P;
                $sam    = $se->Apellido_M;
                $srfc   = $se->RFC;
                //Formacion de nombre completo
                $snc    = strtoupper( $sn." ".$sap." ".$sam);
                //Validadcion nombre ya ingresado
                if ($aid == $sid && $anc != $snc){
                    //Error duplicado de datos
                }else {
                    if (strlen($arfc) < 13 || strlen($arfc) > 13 ){
                        echo "Error de longitud en rfc";
                    }
                }
                
            }
            echo $aid.' '.$anc.'<br/>';
        }
    }



}