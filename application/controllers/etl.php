<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Etl extends CI_Controller  {
    
    protected $dwhcon;
    protected $errorcon;
    protected $acsempleados;
    protected $srvempleados;

    public function __construct () {
        parent::__construct();
        $this->load->model('Misc');
        $server = 'localhost';
        $dwh = array("Database"=>"DwH");
        $error = array("Database"=>"Error");
        $this->dwhcon = sqlsrv_connect($server,$dwh);
        $this->errorcon = sqlsrv_connect($server,$error);
        if ($dwh) {
            echo "Conexión de la base de datos establecida";
        }else {
            echo "Conexión de la base de datos no establecida";
            die(print_r(sqlsrv_errors(),true));
        }
        
        $this->acsempleados = json_decode(file_get_contents("http://localhost/ETLC/index.php/access/acsEmpleados?table=acsempleados"));
        $this->srvempleados = json_decode(file_get_contents("http://localhost/ETLC/index.php/sqlserver/srvEmpleados?table=srvempleados"));

    }
    

    public function Empleados () {        
        $errores = 0;
        foreach($this->acsempleados as $ae):
            //Datos necesarios
            $aid    = intval($ae->id_Empleado); 
            $an     = $this->Misc->delete_numbers($ae->Nombre);
            $aap    = $this->Misc->delete_numbers($ae->Apellido_Paterno);
            $aam    = $this->Misc->delete_numbers($ae->Apellido_Materno);
            $arfc   = $ae->RFC;
            //Formacion de nombre completo
            $anc    = strtoupper( $an." ".$aap." ".$aam);
            echo $aid.' '.$anc.'</br>';
            if (count($this->srvempleados) > 0){
                foreach ($this->srvempleados as $se):
                    //Datos necesarios
                    $sid    = $se->id_Empleado; 
                    $sn     = $se->Nombre;
                    $sap    = $se->Apellido_P;
                    $sam    = $se->Apellido_M;
                    $srfc   = $se->RFC;
                    //Formacion de nombre completo
                    $snc    = strtoupper( $sn." ".$sap." ".$sam);
                    //Validadcion nombre ya ingresado
                    if ($aid != $sid && $anc == $snc){
                        $terror = "Error 1: Nombre de usuario duplicado";
                        $query = "INSERT INTO Empleados VALUES ($aid, '$sn', '$aap', '$aam', '$arfc', '$terror', 'No')";
                        sqlsrv_query($this->errorcon,$query);
                        $errores++;
                    }
                    if ($aid != $sid && $arfc == $srfc){
                        $terror = "Error 2: RFC de usuarios duplicado";
                        $query = "INSERT INTO Empleados VALUES ($aid, '$sn', '$aap', '$aam', '$arfc', '$terror', 'No')";
                        sqlsrv_query($this->errorcon,$query);
                        $errores++;
                    }
                endforeach;
            }
            if (strlen($arfc) > 13 || strlen($arfc) < 13 ){
                $terror = "Error 3: RFC de tamaño incorrecto";
                $query = "INSERT INTO Empleados VALUES ($aid, '$an', '$aap', '$aam', '$arfc', '$terror', 'No')";
                sqlsrv_query($this->errorcon,$query);
                $errores++;
            }
            if ($errores == 0){
                $query = "INSERT INTO Empleados VALUES ($aid, '$an', '$aap', '$aam', '$arfc')";
                sqlsrv_query($this->dwhcon,$query);
                $errores++;
            }else{
                $errores = 0;
            }
        endforeach;
    }
    
}