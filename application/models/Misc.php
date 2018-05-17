<?php

class Misc extends CI_Model{

    public static function cast_float($number){
        return number_format((float)preg_replace('/[^A-Za-z0-9\.]/', '', $number), 2, '.', '');
    }
    public static function contains_number($str){
        if(strcspn($str, '0123456789') != strlen($str))
            return true;
        return false;
    }
    public static function delete_numbers($str){
        return preg_replace('/[0-9]+/', '', $str);
    }
    public static function fancy_date($fecha = NULL){
        if(empty($fecha)){
            return "Error";
        }
        $meses = [
            //Cambia los numero por texto 
            "[Mes 0]",
            "01",
            "02",
            "03",
            "04",
            "05",
            "06",
            "07",
            "08",
            "09",
            "10",
            "11",
            "12",
        ];
        $dia = date('d', strtotime($fecha));
        $mes = $meses[(int)date('m', strtotime($fecha))];
        $ano = date('Y', strtotime($fecha));
        return $dia."/".$mes."/".$ano;
    }
}