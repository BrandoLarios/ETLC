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
        $query = "SELECT * FROM Empleados";
        $acsempleados = $this->peticion($query);
        echo json_encode($acsempleados);
    }
    public function acsClientes() {
        $query = "SELECT * FROM Clientes";
        $acsclientes = $this->peticion($query);
        echo json_encode($acsclientes);
    }
    public function acsEspecies() {
        $query = "SELECT * FROM Especies";
        $acsmascotas = $this->peticion($query);
        echo json_encode($acsmascotas);
    }
    public function acsRazas() {
        $query = "SELECT * FROM Razas";
        $acsmascotas = $this->peticion($query);
        echo json_encode($acsmascotas);
    } 
    public function acsMascotas() {
        $query = "SELECT * FROM Mascotas";
        $acsmascotas = $this->peticion($query);
        echo json_encode($acsmascotas);
    }   

}
