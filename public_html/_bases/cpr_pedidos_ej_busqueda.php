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

    // $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $producto, $cantidad, $precio, $fecha_alta), 'n');
    //  Hace el update correspondiente sobre la tabla principal cpr_pedidos_ej_busqueda
    //  IN:     (0->$id_tabla_sec  |  1->$cuenta  |  2->$detalle  |  3->$proveedor  |  4->$factura  |  5->$area  |  6->$monto)
    //  OUT:    null o 1
    public  function update_tabla_sec ($valores=NULL){
        return "
            UPDATE cpr_pedidos_ej_busqueda_detalle
            SET id_sis_cuentas = $valores[1],
                    detalle = '$valores[2]',
                    id_cpr_proveedores = $valores[3],
                    factura = '$valores[4]',
                    id_sis_areas = $valores[5],
                    monto = $valores[6],
                    activo = 1
            WHERE id_cpr_pedidos_ej_busqueda_detalle = $valores[0]
            ;
        ";
    }




}