<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Etl extends CI_Controller  {
    
    protected $dwhcon;
    protected $errorcon;
    protected $acsempleados;protected $acsclientes;protected $acsmascotas; 
    protected $srvempleados;protected $srvclientes;protected $srvmascotas;

    public function __construct () {
        parent::__construct();
        $this->load->model('Misc');
        $server = 'localhost';
        $dwh = array("Database"=>"DwH");
        $error = array("Database"=>"Error");
        $this->dwhcon = sqlsrv_connect($server,$dwh);
        $this->errorcon = sqlsrv_connect($server,$error);
        if ($dwh) {
            echo "Conexión de la base de datos establecida".'</br>';
        }else {
            echo "Conexión de la base de datos no establecida".'</br>';
            die(print_r(sqlsrv_errors(),true));
        }
        
        $this->acsempleados = json_decode(file_get_contents("http://localhost/ETLC/index.php/access/Empleados?table=acsempleados"));
        $this->srvempleados = json_decode(file_get_contents("http://localhost/ETLC/index.php/sqlserver/Empleados?table=srvempleados"));
        $this->acsclientes  = json_decode(file_get_contents("http://localhost/ETLC/index.php/access/Clientes?table=acsclientes"));
        $this->srvclientes  = json_decode(file_get_contents("http://localhost/ETLC/index.php/sqlserver/Clientes?table=srvclientes"));
        $this->acsmascotas  = json_decode(file_get_contents("http://localhost/ETLC/index.php/Access/Mascotas?table=acsmascotas"));
        //$this->srvmascotas = json_decode(file_get_contents("http://localhost/ETLC/index.php/sqlserver/Mascotas?table=srvmascotas"));
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
                        $query = "INSERT INTO Empleados VALUES ($aid, '$an', '$aap', '$aam', '$arfc', '$terror', 'No')";
                        sqlsrv_query($this->errorcon,$query);
                        $errores++;
                    }
                    if ($aid != $sid && $arfc == $srfc){
                        $terror = "Error 2: RFC de usuarios duplicado";
                        $query = "INSERT INTO Empleados VALUES ($aid, '$an', '$aap', '$aam', '$arfc', '$terror', 'No')";
                        sqlsrv_query($this->errorcon,$query);
                        $errores++;
                    }
                endforeach;
            }
            if ((strlen($arfc) > 13 || strlen($arfc) < 13) || strlen($arfc) == 0) {
                $terror = "Error 3: RFC de tamaño incorrecto o vacio";
                $query = "INSERT INTO Empleados VALUES ($aid, '$an', '$aap', '$aam', '$arfc', '$terror', 'No')";
                sqlsrv_query($this->errorcon,$query);
                $errores++;
            }
            if ($errores == 0){
                $query = "INSERT INTO Empleados VALUES ($aid, '$an', '$aap', '$aam', '$arfc')";
                sqlsrv_query($this->dwhcon,$query);
                $errores=0;
            }else{
                $errores = 0;
            }
        endforeach;
    }

    public function Clientes () {
        $errores = 0;
        foreach($this->acsclientes as $ac):
        //Datos necesarios
            $aid    = intval($ac->id_Cliente); 
            $an     = $this->Misc->delete_numbers($ac->Nombre);
            $aap    = $this->Misc->delete_numbers($ac->Apellido_Paterno);
            $aam    = $this->Misc->delete_numbers($ac->Apellido_Materno);
            $arfc   = $ac->RFC;
            $afnac  = $this->Misc->fancy_date($ac->Fecha_Nac);
            $asexo  = strtoupper($this->Misc->delete_numbers($ac->Sexo));
        //Formacion de nombre completo
            $anc    = strtoupper( $an." ".$aap." ".$aam);
        //Validacion con datos ya ingresados    
            if (count($this->srvclientes) > 0){
                foreach ($this->srvclientes as $sc):
                    //Datos necesarios
                    $sid    = $sc->id_Cliente; 
                    $sn     = $sc->Nombre;
                    $sap    = $sc->Apellido_P;
                    $sam    = $sc->Apellido_M;
                    $srfc   = $sc->RFC;
                    //Formacion de nombre completo
                    $snc    = strtoupper( $sn." ".$sap." ".$sam);
                    //Validadcion nombre ya ingresado
                    if ($aid != $sid && $anc == $snc){
                        $terror = "Error 1: Nombre de cliente duplicado";
                        $query = "INSERT INTO Clientes VALUES ($aid, '$an', '$aap', '$aam', '$arfc','$afnac','$asexo' '$terror', 'No')";
                        sqlsrv_query($this->errorcon,$query);
                        $errores++;
                    }
                    if ($aid != $sid && $arfc == $srfc){
                        $terror = "Error 2: RFC de cliente duplicado";
                        $query = "INSERT INTO Clientes VALUES ($aid, '$sn', '$aap', '$aam', '$arfc','$afnac','$asexo' '$terror', 'No')";
                        sqlsrv_query($this->errorcon,$query);
                        $errores++;
                    }
                endforeach;
        //Fin
            }
            if(substr($afnac,6,10) > 2000 || substr($afnac,6,10) < 1950){
                $terror = "Error 3: Fecha invalida";
                $query = "INSERT INTO Clientes VALUES ($aid, '$an', '$aap', '$aam', '$arfc','$afnac','$asexo', '$terror', 'No')";
                sqlsrv_query($this->errorcon,$query);
                $errores++;
            }
            if ((strlen($arfc) > 13 || strlen($arfc) < 13) || strlen($arfc) == 0) {
                $terror = "Error 4: RFC de tamaño incorrecto o vacio";
                $query = "INSERT INTO Clientes VALUES ($aid, '$an', '$aap', '$aam', '$arfc','$afnac','$asexo', '$terror', 'No')";
                sqlsrv_query($this->errorcon,$query);
                $errores++;
            }
            if ($asexo != 'FEMENINO' && $asexo != 'MASCULINO'){
                $terror = "Error 5: Valor de campo sexo invalido";
                $query = "INSERT INTO Clientes VALUES ($aid, '$an', '$aap', '$aam', '$arfc','$afnac','$asexo', '$terror', 'No')";
                sqlsrv_query($this->errorcon,$query);
                $errores++;
            }
            if ($errores == 0){
                $query = "INSERT INTO Clientes VALUES ($aid, '$an', '$aap', '$aam', '$arfc','$afnac','$asexo')";
                sqlsrv_query($this->dwhcon,$query);
                $errores=0;
            }else{
                $errores = 0;
            }
        endforeach; 
    }

    public function Mascotas(){
        if (count($this->acsmascotas) > 0){
            echo 'Hay datos';
        }
        else{
            echo 'NO hay datos';
        }
    }
}