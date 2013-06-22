<?php

class ven_analisis_riesgo_crediticio extends FormCommon {

    //  Hace el update correspondiente sobre la tabla principal ven_analisis_riesgo_crediticio
    //  IN:     (0->$id_tabla  |  1->$id_ven_cliente_contacto  |  2->$asunto  |  3->$detalle)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE ven_analisis_riesgo_crediticio
            SET id_ven_cliente_contacto = $valores[1],
                    asunto = '$valores[2]',
                    detalle = '$valores[3]',
            WHERE id_ven_analisis_riesgo_crediticio = $valores[0]
            ;
        ";
    }

    // $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $producto, $cantidad, $precio, $fecha_alta), 'n');
    //  Hace el update correspondiente sobre la tabla principal ven_analisis_riesgo_crediticio
    //  IN:     (0->$id_tabla_sec  |  1->$id_ven_cliente_contacto  |  2->hora)
    //  OUT:    null o 1
    public  function update_tabla_sec ($valores=NULL){
        return "
            UPDATE ven_analisis_riesgo_crediticio_clientes
            SET id_ven_cliente_contacto = $valores[1],
                    hora = '$valores[2]',
                    activo = 1
            WHERE id_ven_analisis_riesgo_crediticio_clientes = $valores[0]
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