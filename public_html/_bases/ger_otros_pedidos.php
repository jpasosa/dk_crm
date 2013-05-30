<?php


class ger_otros_pedidos extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal de ven_pedido_precio_credito
    //  IN:     (0->$id_tabla  |  1->asunto  |  2->pedido  |  3->id_sis_areas)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE ger_otros_pedidos
            SET asunto = '$valores[1]', 
                    pedido = '$valores[2]',
                    id_sis_areas = $valores[3]
            WHERE id_ger_otros_pedidos = $valores[0]
            ; 
        ";
    }

}