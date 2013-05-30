<?php




class ven_propuestas_comerciales extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal de ven_pedido_precio_credito
    //  IN:     (0->$id_tabla  |  1->asunto  |  2->propuesta  |  3->id_ven_cliente_contacto)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE ven_propuestas_comerciales
            SET asunto = '$valores[1]',
                    propuesta = '$valores[2]',
                    id_ven_cliente_contacto = $valores[3]
            WHERE id_ven_propuestas_comerciales = $valores[0]
            ; 
        ";
    }



}