<?php

class _Validations {
    

    // T: sis_feriado //// selecciona las fechas feriadas, según un país.
    public  function select_feriados ($valores=NULL){
        return "
            SELECT FROM_UNIXTIME(fecha, '%d/%m/%Y') AS fecha
            FROM sis_feriados
            WHERE id_sis_pais = $valores[0]
            ; 
        ";
    }

    //  descripción del método
    //  IN:     (0->Tabla | 1->campo | 2->valor)
    //  OUT:    saber si existe el vamlos en ese campo
    public  function field_search ($valores=NULL){
        return "
            SELECT $valores[1]
            FROM $valores[0]
            WHERE $valores[1] = '$valores[2]'          
            ; 
        ";
    }
    
}