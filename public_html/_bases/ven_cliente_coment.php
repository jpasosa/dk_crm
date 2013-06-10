<?php


class ven_cliente_coment extends FormCommon {
    
    //  Hace el update correspondiente sobre la tabla principal de adm_pedido_compras
    //  IN:     (0->$id_tabla  |  1->$asunto  |  2->pedido)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE adm_pedido_compras
            SET asunto = '$valores[1]',
                    pedido = '$valores[2]'
            WHERE id_adm_pedido_compras = $valores[0]
            ; 
        ";
    }

    //  Hace el update correspondiente sobre la tabla secundaria "ave_comparacion_hoteles_opc"
    //  IN:     (0->$id_tabla_sec  |  1->$hotel  |  2->comentario  |  3->costo)
    //  OUT:    null o 1. Hace el update
    public  function update_tabla_sec ($valores=NULL){
        return "
            UPDATE ave_comparacion_aerolineas_opc
            SET aerolinea = '$valores[1]',
                    comentario = '$valores[2]',
                    costo = $valores[3]
            WHERE id_ave_comparacion_aerolineas_opc = $valores[0]
            ; 
        ";
    }

        //  Selecciona las sucursales cargadas del cliente que cargó en la tabla principal
    //  IN:     (0->id_tabla, que es id_ven_cliente)
    public  function get_tabla_suc ($valores=NULL){
        return "
            SELECT *
            FROM ven_cliente_sucursales
            WHERE id_ven_cliente = $valores[0]
                        AND activo = 1
            ;
        ";
    }



}