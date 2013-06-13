<?php

class ven_pedido_muestra extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal ven_cliente
    //  IN:     (0->$id_tabla  |  1->$id_ven_cliente  |  2->observaciones )
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE ven_pedido_muestra
            SET id_ven_cliente = $valores[1],
                    observaciones = '$valores[2]'
            WHERE id_ven_pedido_muestra = $valores[0]
            ; 
        ";
    }

     //  Hace el update correspondiente sobre la tabla principal ven_cliente
    //  IN:     (0->$id_tabla  |  1->$id_pro_producto  |  2->cantidad )
    //  OUT:    null o 1
    public  function update_tabla_sec ($valores=NULL){
        return "
            UPDATE ven_pedido_muestra_prod
            SET id_pro_productos = $valores[1],
                    cantidad = $valores[2],
                    activo = 1
            WHERE id_ven_pedido_muestra_prod = $valores[0]
            ; 
        ";
    }




}