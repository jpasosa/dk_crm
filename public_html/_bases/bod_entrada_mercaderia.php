<?php

class bod_entrada_mercaderia extends FormCommon {

    //  IN:     (0->$$id_tabla  |  1->$proveedor  |  2->$fecha_llegada_unix |  3->$observaciones)
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE bod_entrada_mercaderia
            SET id_cpr_proveedores = $valores[1],
                    fecha_llegada = $valores[2],
                    observaciones = '$valores[3]'
            WHERE id_bod_entrada_mercaderia = $valores[0]
            ;
        ";
    }

     //  IN:     (0->$id_tra_ytd_entrada_prod  |  1->$$piso  |  2->$pared  |  3->$estanteria  |  4->$cuadrante)
    public  function update_prod ($valores=NULL){
        return "
            UPDATE bod_entrada_mercaderia_prod_tmp
            SET  piso           = $valores[1],
                    pared        = $valores[2],
                    estanteria = $valores[3],
                    cuadrante = $valores[4]
            WHERE id_bod_entrada_mercaderia_prod_tmp = $valores[0]
            ;
        ";
    }


    // Obtengo el registro de adm_audit_stock_limpieza, que estoy trayendo.
    public  function get_tra_ytd_entrada ($valores=NULL){
        return "
            SELECT *
            FROM tra_ytd_entrada princ
            JOIN cpr_proveedores prov
                ON princ.id_cpr_proveedores=prov.id_cpr_proveedores
            WHERE id_tra_ytd_entrada = $valores[0]
            ;
        ";
    }

    // Obtengo el registro de adm_audit_stock_limpieza, que estoy trayendo.
    public  function select_prod ($valores=NULL){
        return "
            SELECT *
            FROM bod_entrada_mercaderia_prod_tmp
            WHERE id_bod_entrada_mercaderia_proc = $valores[0]
            ;
        ";
    }

    //  IN:     (0->$id_tabla_proc  |  1->$tcmt_prod['id_pro_productos']  |  2->$tcmt_prod['nro_caja_tcmt']  |  3->$tcmt_prod['productos_por_caja_tcmt']
    //  4->$tcmt_prod['alto_tcmt']  |  5->$tcmt_prod['ancho_tcmt']  |  6->$tcmt_prod['fondo_tcmt']  |  7->$tcmt_prod['volumen_tcmt']  8->$tcmt_prod['peso_tcmt']
    // 9->$tcmt_prod['precio_tcmt']  |  10->$tcmt_prod['foto_tcmt']  |  11->$tcmt_prod['activo'] )
    // Pongo por defecto id 1, los campos marca, subfamilia y problemas.
    public  function insert_tye_prod_tmp ($valores=NULL){
        return "
            INSERT INTO bod_entrada_mercaderia_prod_tmp
                (
                    id_pro_productos, nro_caja_bem, productos_por_caja_bem, alto_bem, ancho_bem, fondo_bem,
                    volumen_bem, peso_bem, precio_bem, foto_bem, activo, id_bod_entrada_mercaderia_proc, id_pro_marca, id_pro_subfamilia, id_sis_problemas,
                    piso, pared, estanteria, cuadrante
                )
            VALUES
                (
                    $valores[1] , $valores[2], $valores[3], $valores[4], $valores[5] , $valores[6] , $valores[7],
                    $valores[8] , $valores[9] , '$valores[10]', $valores[11], $valores[0], $valores[12], $valores[13], $valores[14],
                    0, 0, 0, 0
                )
            ;
        ";
    }

     // Obtengo el registro de adm_audit_stock_limpieza, que estoy trayendo.
    public  function get_bem_prod_tmp ($valores=NULL){
        return "
            SELECT *
            FROM bod_entrada_mercaderia_prod_tmp princ
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
            WHERE id_bod_entrada_mercaderia_proc = $valores[0]
            ;
        ";
    }

}