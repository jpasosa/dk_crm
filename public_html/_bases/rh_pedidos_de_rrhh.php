<?php




class rh_pedidos_de_rrhh extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal de ven_pedido_precio_credito
    //  IN:     (0->$id_tabla  |  1->asunto  |  2->observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE rh_pedidos_de_rrhh
            SET  asunto = '$valores[1]',
                    observaciones = '$valores[2]'
            WHERE id_rh_pedidos_de_rrhh = $valores[0]
            ; 
        ";
    }



}