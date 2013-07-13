<?php

class cpr_pedidos_ej_busqueda extends FormCommon {

    //  Hace el update correspondiente sobre la tabla principal cpr_pedidos_ej_busqueda
    //  IN:     (0->$id_tabla  |  1->$observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE cpr_pedidos_ej_busqueda
            SET nombre_pedido = '$valores[1]'
            WHERE id_cpr_pedidos_ej_busqueda = $valores[0]
            ;
        ";
    }

    //  IN:     (0->$id_tabla_sec  |  1->$nombre  |  2->$detalle  |  3->$cantidad  |  4->$precio_deseado  |  5->$observaciones)
    public  function update_tabla_sec ($valores=NULL){
        return "
            UPDATE cpr_pedidos_ej_busqueda_prod
            SET activo = 1,
                    nombre = '$valores[1]',
                    detalle = '$valores[2]',
                    cantidad = '$valores[3]',
                    precio_deseado = $valores[4],
                    observaciones = '$valores[5]'
            WHERE id_cpr_pedidos_ej_busqueda_prod = $valores[0]
            ;
        ";
    }


    public  function tabla_princ_fecha_actual ($valores=NULL){
        return "
            SELECT nombre_pedido
            FROM cpr_pedidos_ej_busqueda
            WHERE nombre_pedido  LIKE '%$valores[0]%'
            ;
        ";
    }




}