<?php

class adm_ytd_gastos_costos extends FormCommon {

    //  Hace el update correspondiente sobre la tabla principal adm_ytd_gastos_costos
    //  IN:     (0->$id_tabla  |  1->$observaciones)
    //  OUT:    null o 1
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE adm_ytd_gastos_costos
            SET observaciones = '$valores[1]'
            WHERE id_adm_ytd_gastos_costos = $valores[0]
            ;
        ";
    }

    // $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $producto, $cantidad, $precio, $fecha_alta), 'n');
    //  Hace el update correspondiente sobre la tabla principal adm_ytd_gastos_costos
    //  IN:     (0->$id_tabla_sec  |  1->$cuenta  |  2->$detalle  |  3->$proveedor  |  4->$factura  |  5->$area  |  6->$monto)
    //  OUT:    null o 1
    public  function update_tabla_sec ($valores=NULL){
        return "
            UPDATE adm_ytd_gastos_costos_detalle
            SET id_sis_cuentas = $valores[1],
                    detalle = '$valores[2]',
                    id_crp_proveedores = $valores[3],
                    factura = '$valores[4]',
                    id_sis_areas = $valores[5],
                    monto = $valores[6],
                    activo = 1
            WHERE id_adm_ytd_gastos_costos_detalle = $valores[0]
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