<?php
class Excel extends CI_Controller {

    protected $exccon;

    public function __construct () {
        parent :: __construct();
        $this->exccon = odbc_connect('CE', '', '') or die ('no se pudo establecer conexión');
    }


    public function peticion ($query) {  
        $ptt = odbc_exec($this->exccon,$query);
        $tabla = array();
        $i=0;
        while ($row = odbc_fetch_array ($ptt)) {
            $tabla [$i] = $row;
            $i++;
        }
        return $tabla;
        
    }
    public function Mascotas  () {
        $query = "SELECT * FROM [Mascotas$]";
        $acsmascotas = $this->peticion($query);
        echo json_encode($acsmascotas);
        //var_dump($acsmascotas);  
    }


}