<?php

class ven_store_check extends FormCommon {

    //  Hace el update correspondiente sobre la tabla principal ven_store_check
    //  IN:     (0->$id_tabla  |  1->$ven_cliente_sucursales  |  2->$observaciones  |  3->$exhibiendo_mercaderia  |
    //              4-> $mercaderia_lugar  |  5->$buena_cantidad_productos  |  6->$poner_punto_venta  |  7->$poner_banner)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE ven_store_check
            SET id_ven_cliente_sucursales = $valores[1],
                    vstore_observaciones = '$valores[2]',
                    exhibiendo_mercaderia = '$valores[3]',
                    mercaderia_lugar = '$valores[4]',
                    buena_cantidad_productos = '$valores[5]',
                    poner_punto_venta = $valores[6],
                    poner_banner = $valores[7]
            WHERE id_ven_store_check = $valores[0]
            ;
        ";
    }

    // $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $producto, $cantidad, $precio, $fecha_alta), 'n');
    //  Hace el update correspondiente sobre la tabla principal ven_store_check
    //  IN:     (0->$id_tabla_sec  |  1->$cantidad  |  2->precio)
    //  OUT:    null o 1
    public  function update_tabla_sec ($valores=NULL){
        return "
            UPDATE ven_store_check_prod
            SET id_pro_productos = $valores[1],
                    cantidad = $valores[2],
                    vstore_precio = $valores[3],
                    activo = 1
            WHERE id_ven_store_check_prod = $valores[0]
            ;
        ";
    }

    //  Selecciona los valores para hacer un select combinado, con
    //  IN:     (0->xxxxxxx  |  1->xxxxxxx)
    //  OUT:    Devuelve los valores para poder hacer el select en la plantilla
    public  function ven_cliente_contacto ($valores=NULL){
        return "
            SELECT *
            FROM ven_cliente_contacto
            WHERE id_ven_cliente_sucursales = $valores[0]
            ;
        ";
    }

    // busca el producto según la referencia
    // Lo uso con AJAX para seleccionar
    public  function search_precio ($valores=NULL){
        return "
            SELECT id_pro_productos, precio
            FROM pro_productos
            WHERE id_pro_productos = $valores[0]
            ;
        ";
    }


}