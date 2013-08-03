<?php

class tra_carga_mercaderia_transito extends FormCommon {

    //  IN:     (0->$$id_tabla  |  1->$proveedor  |  2->$packing_list  |  3->$fecha_envio_unix  |  4->$fecha_llegada_unix  |  5->$observaciones)
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE tra_carga_mercaderia_transito
            SET id_cpr_proveedores = $valores[1],
                    nombre_trapackinglist = $valores[2],
                    fecha_envio = $valores[3],
                    fecha_llegada = $valores[4],
                    observaciones = '$valores[5]'
            WHERE id_tra_carga_mercaderia_transito = $valores[0]
            ;
        ";
    }

    //  IN:     (0->$id_tabla_sec  |  1->$id_pro_producto  |  2->$id_sis_problemas)
    public  function update_tabla_sec ($valores=NULL){
        return "
            UPDATE adm_audit_stock_limpieza_detalle_prod
            SET id_pro_productos = $valores[1],
                    id_sis_problemas = $valores[2],
                    activo = 1
            WHERE id_adm_audit_stock_limpieza_detalle_prod = $valores[0]
            ;
        ";
    }

    //  IN:     (0->$id_tabla_proc  |  1->$$tpl['id_pro_productos']  |  2->$tpl['nro_caja_tpl']  |  3->$tpl['productos_por_caja_tpl']  |  4->$tpl['alto_tpl']  |  5->$tpl['ancho_tpl']
    //                6->$tpl['fondo_tpl']  |  7->$tpl['volumen_tpl']  |  8->$tpl['peso_tpl']  |  9->$tpl['precio_nuevo'])
    public  function insert_tabla_sec ($valores=NULL){
        return "
            INSERT INTO tra_carga_mercaderia_transito_prod
                (
                    id_pro_productos, nro_caja_tcmt, productos_por_caja_tcmt, alto_tcmt, ancho_tcmt, fondo_tcmt,
                    volumen_tcmt, peso_tcmt, precio_tcmt, activo, id_tra_carga_mercaderia_transito_proc
                )
            VALUES
                (
                    $valores[1] , $valores[2], $valores[3], $valores[4], $valores[5] , $valores[6] , $valores[7] , $valores[8] , $valores[9] , 1, $valores[0]
                )
            ;
        ";
    }

    // Obtengo el registro de adm_audit_stock_limpieza, que estoy trayendo.
    public  function get_tra_packing_list ($valores=NULL){
        return "
            SELECT *
            FROM tra_packing_list AS princ
            JOIN cpr_proveedores AS sec
                ON princ.id_cpr_proveedores= sec.id_cpr_proveedores
            WHERE princ.id_tra_packing_list = $valores[0]
            ;
        ";
    }

}