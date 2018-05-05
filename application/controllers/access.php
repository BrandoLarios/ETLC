<?php
class Access extends CI_Controller {

    protected $acscon;

    public function __construct () {
        parent :: __construct();
        $this->acscon = odbc_connect('Clinica', '', '') or die ('no se pudo establecer conexión');
    }


    public function peticion ($query) {  
        $ptt = odbc_exec ($this->acscon,$query);
        $tabla = array();
        $i=0;
        while ($row = odbc_fetch_array ($ptt)) {
            $tabla [$i] = $row;
            $i++;
        }
        return $tabla;
        
    }
    
    public function acsEmpleados() {
        $query = "SELECT id_Empleado,Nombre,Apellido_Paterno,Apellido_Materno,RFC FROM Empleados";
        $acsclientes = $this->peticion($query);
        echo json_encode($acsclientes);
    }
}
