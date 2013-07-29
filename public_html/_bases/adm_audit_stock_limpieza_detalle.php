<?php

class adm_audit_stock_limpieza_detalle extends FormCommon {

    //  IN:     (0->$$id_tabla  |  1->$bodega  |  2->$limpieza_detalle  |  3->$observaciones)
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE adm_audit_stock_limpieza_detalle
            SET bodega = '$valores[1]',
                    detalle = '$valores[2]',
                    observaciones_anterior = '$valores[3]'
            WHERE id_adm_audit_stock_limpieza_detalle = $valores[0]
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

    // Obtengo el registro de adm_audit_stock_limpieza, que estoy trayendo.
    public  function get_tabla_limpieza ($valores=NULL){
        return "
            SELECT *
            FROM adm_audit_stock_limpieza AS princ
            WHERE princ.id_adm_audit_stock_limpieza = $valores[0]
            ;
        ";
    }

}