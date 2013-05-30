<?php




class adm_audit_stock_limpieza extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal de ave_comparacion_hoteles
    //  IN:     (0->$id_tabla  |  1->fecha  |  2->observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE adm_audit_stock_limpieza
            SET fecha = $valores[1],
                    observaciones = '$valores[2]'
            WHERE id_adm_audit_stock_limpieza = $valores[0]
            ; 
        ";
    }

}