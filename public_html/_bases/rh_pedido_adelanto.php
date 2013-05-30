<?php




class rh_pedido_adelanto extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal de ven_pedido_precio_credito
    //  IN:     (0->$id_tabla  |  1->asunto  |  2->observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE rh_pedido_adelanto
            SET  monto = $valores[1],
                    observaciones = '$valores[2]'
            WHERE id_rh_pedido_adelanto = $valores[0]
            ; 
        ";
    }



}