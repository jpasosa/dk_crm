<?php




class ven_pedido_precio_credito extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal de ven_pedido_precio_credito
    //  IN:     (0->$id_tabla  |  1->pedido  |  2->ven_cliente)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE ven_pedido_precio_credito
            SET pedido = '$valores[1]',
                    id_ven_cliente_contacto = $valores[2]
            WHERE id_ven_pedido_precio_credito = $valores[0]
            ; 
        ";
    }

    

}