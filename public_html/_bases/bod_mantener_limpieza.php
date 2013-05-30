<?php




class bod_mantener_limpieza extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal de ven_pedido_precio_credito
    //  IN:     (0->$id_tabla  |  1->observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE bod_mantener_limpieza
            SET  observaciones = '$valores[1]'
            WHERE id_bod_mantener_limpieza = $valores[0]
            ; 
        ";
    }



}