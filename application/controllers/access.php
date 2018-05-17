<?php
class Access extends CI_Controller {

    protected $acscon;

    public function __construct () {
        parent :: __construct();
        $this->acscon = odbc_connect('C', '', '') or die ('no se pudo establecer conexión');
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
    
    
    public function Clientes () {
        $query = "SELECT * FROM Clientes";
        $acsclientes = $this->peticion($query);
        echo json_encode($acsclientes);
    }
    public function Mascotas () {
        $query = "SELECT m.id_Mascota, m.Nombre, m.Genero, r.Nombre as Raza, m.id_Cliente  From Mascotas as m LEFT JOIN Razas as r ON m.id_Raza=r.id_Raza";
        $acsmascotas = $this->peticion($query);
        echo json_encode($acsmascotas);
        //var_dump($acsmascotas);  
    }
    public function Razas () {
        $query = "SELECT * From Razas";
        $acsrazas = $this->peticion($query);
        echo json_encode($acsrazas);
    }  


    
}
