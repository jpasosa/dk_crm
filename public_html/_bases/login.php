<?php

class login extends formCommon {
    

    // trae las observaciones
    public  function get_observaciones ($valores=NULL){
        return "
            SELECT observaciones
            FROM ger_planificacion_gastos
            WHERE id_ger_planificacion_gastos = $valores[0]          
            ; 
        ";
    }


}