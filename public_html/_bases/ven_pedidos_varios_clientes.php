<?php




class ven_pedidos_varios_clientes extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal de ven_pedido_precio_credito
    //  IN:     (0->$id_tabla  |  1->asunto  |  2->pedido  |  3->id_ven_cliente_contacto)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE ven_pedidos_varios_clientes
            SET asunto = '$valores[1]',
                    pedido = '$valores[2]',
                    id_ven_cliente_contacto = $valores[3]
            WHERE id_ven_pedidos_varios_clientes = $valores[0]
            ; 
        ";
    }



}