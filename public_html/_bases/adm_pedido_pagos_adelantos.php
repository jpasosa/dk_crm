<?php




class adm_pedido_pagos_adelantos extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal de ven_pedido_precio_credito
    //  IN:     (0->$id_tabla  |  1->asunto  |  2->pedido)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE adm_pedido_pagos_adelantos
            SET asunto = '$valores[1]',
                    pedido = '$valores[2]'
            WHERE id_adm_pedido_pagos_adelantos = $valores[0]
            ; 
        ";
    }



}