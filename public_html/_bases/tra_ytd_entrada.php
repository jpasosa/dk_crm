<?php

class tra_ytd_entrada extends FormCommon {

    //  IN:     (0->$$id_tabla  |  1->$packing_list  |  2->$cpr_proveedores  |  3->observaciones)
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE tra_ytd_entrada
            SET nombre_trapackinglist = $valores[1],
                    id_cpr_proveedores = $valores[2],
                    observaciones = '$valores[3]'
            WHERE id_tra_ytd_entrada = $valores[0]
            ;
        ";
    }

     //  IN:     (0->$id_tabla  |  1->$marca  |  2->$problema  |  3->Familia)
    public  function update_prod ($valores=NULL){
        return "
            UPDATE tra_ytd_entrada_prod_tmp
            SET  id_pro_marca       = $valores[1],
                    id_pro_subfamilia = $valores[3],
                    id_sis_problemas = $valores[2]
            WHERE id_tra_ytd_entrada_prod_tmp = $valores[0]
            ;
        ";
    }

    //  IN:     (0->$id_tabla_proc  |  1->$$tpl['id_pro_productos']  |  2->$tpl['nro_caja_tpl']  |  3->$tpl['productos_por_caja_tpl']  |  4->$tpl['alto_tpl']  |  5->$tpl['ancho_tpl']
    //                6->$tpl['fondo_tpl']  |  7->$tpl['volumen_tpl']  |  8->$tpl['peso_tpl']  |  9->$tpl['precio_nuevo'])
    // public  function insert_tabla_sec ($valores=NULL){
    //     return "
    //         INSERT INTO tra_carga_mercaderia_transito_prod
    //             (
    //                 id_pro_productos, nro_caja_tcmt, productos_por_caja_tcmt, alto_tcmt, ancho_tcmt, fondo_tcmt,
    //                 volumen_tcmt, peso_tcmt, precio_tcmt, activo, id_tra_carga_mercaderia_transito_proc
    //             )
    //         VALUES
    //             (
    //                 $valores[1] , $valores[2], $valores[3], $valores[4], $valores[5] , $valores[6] , $valores[7] , $valores[8] , $valores[9] , 1, $valores[0]
    //             )
    //         ;
    //     ";
    // }

    // Obtengo el registro de adm_audit_stock_limpieza, que estoy trayendo.
    public  function get_tra_carga_mercaderia_transito ($valores=NULL){
        return "
            SELECT *
            FROM tra_carga_mercaderia_transito princ
            JOIN cpr_proveedores prov
                ON princ.id_cpr_proveedores=prov.id_cpr_proveedores
            WHERE id_tra_carga_mercaderia_transito = $valores[0]
            ;
        ";
    }

    // Obtengo el registro de adm_audit_stock_limpieza, que estoy trayendo.
    public  function select_prod ($valores=NULL){
        return "
            SELECT *
            FROM tra_ytd_entrada_prod_tmp
            WHERE id_tra_ytd_entrada_proc = $valores[0]
            ;
        ";
    }

    //  IN:     (0->$id_tabla_proc  |  1->$tcmt_prod['id_pro_productos']  |  2->$tcmt_prod['nro_caja_tcmt']  |  3->$tcmt_prod['productos_por_caja_tcmt']
    //  4->$tcmt_prod['alto_tcmt']  |  5->$tcmt_prod['ancho_tcmt']  |  6->$tcmt_prod['fondo_tcmt']  |  7->$tcmt_prod['volumen_tcmt']  8->$tcmt_prod['peso_tcmt']
    // 9->$tcmt_prod['precio_tcmt']  |  10->$tcmt_prod['foto_tcmt']  |  11->$tcmt_prod['activo'] )
    // Pongo por defecto id 1, los campos marca, subfamilia y problemas.
    public  function insert_tcmt_prod_tmp ($valores=NULL){
        return "
            INSERT INTO tra_ytd_entrada_prod_tmp
                (
                    id_pro_productos, nro_caja_tye, productos_por_caja_tye, alto_tye, ancho_tye, fondo_tye,
                    volumen_tye, peso_tye, precio_tye, foto_tye, activo, id_tra_ytd_entrada_proc, id_pro_marca, id_pro_subfamilia, id_sis_problemas
                )
            VALUES
                (
                    $valores[1] , $valores[2], $valores[3], $valores[4], $valores[5] , $valores[6] , $valores[7],
                    $valores[8] , $valores[9] , '$valores[10]', $valores[11], $valores[0], 1, 1, 1
                )
            ;
        ";
    }

     // Obtengo el registro de adm_audit_stock_limpieza, que estoy trayendo.
    public  function get_tye_prod_tmp ($valores=NULL){
        return "
            SELECT *
            FROM tra_ytd_entrada_prod_tmp princ
            JOIN pro_productos prod
                ON princ.id_pro_productos=prod.id_pro_productos
            JOIN pro_marca marca
                ON princ.id_pro_marca=marca.id_pro_marca
            JOIN pro_subfamilia subf
                ON princ.id_pro_subfamilia=subf.id_pro_subfamilia
            JOIN sis_problemas pr
                ON princ.id_sis_problemas=pr.id_sis_problemas
            JOIN pro_familia fam
                ON subf.id_pro_familia=fam.id_pro_familia
            WHERE id_tra_ytd_entrada_proc = $valores[0]
            ;
        ";
    }

}