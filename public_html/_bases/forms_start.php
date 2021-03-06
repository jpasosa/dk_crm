<?php

class forms_start extends FormCommon {

    //  nos dá el id del área del user logueado y el id de cv_datos_personales
    //  IN:     (id_user logueado)
    //  OUT:    array { ['id_sis_areas'']=>xx }
    public  function area ($valores=NULL){  // TODO volar a unas clases bases. .. . .
        return "
            SELECT id_sis_areas, id_cv_datos_personales
            FROM cv_datos_personales
            WHERE id_cv_datos_personales = $valores[0]
            ;
        ";
    }

    //  Ponemos en -2 id_tabla_proc de la tabla principal de AVE_CAMPANIA
    //  IN:     (id_tabla)
    public  function edit_ave_campania ($valores=NULL){
        return "
            UPDATE  ave_campania
            SET  id_ave_campania_proc =  -2
            WHERE  id_ave_campania = $valores[0]
            ;
        ";
    }

    //  Ponemos en -2 id_tabla_proc de la tabla principal de adm_audit_stock_limpieza
    //  IN:     (id_tabla)
    public  function edit_adm_audit_stock_limpieza ($valores=NULL){
        return "
            UPDATE  adm_audit_stock_limpieza
            SET  id_adm_audit_stock_limpieza_proc =  -2
            WHERE  id_adm_audit_stock_limpieza = $valores[0]
            ;
        ";
    }

    //  Ponemos en -2 id_tabla_proc de la tabla principal de tra_packing_list
    //  IN:     (id_tabla)
    public  function edit_tra_packing_list ($valores=NULL){
        return "
            UPDATE  tra_packing_list
            SET  id_tra_packing_list_proc =  -2
            WHERE  id_tra_packing_list = $valores[0]
            ;
        ";
    }

    //  Ponemos en -2 id_tabla_proc de la tabla principal de tra_carga_mercaderia_transito
    //  IN:     (id_tabla)
    public  function edit_tra_carga_mercaderia_transito ($valores=NULL){
        return "
            UPDATE  tra_carga_mercaderia_transito
            SET  id_tra_carga_mercaderia_transito_proc =  -2
            WHERE  id_tra_carga_mercaderia_transito = $valores[0]
            ;
        ";
    }

    //  Ponemos en -2 id_tabla_proc de la tabla principal de tra_carga_mercaderia_transito
    //  IN:     (id_tabla)
    public  function edit_tra_ytd_entrada ($valores=NULL){
        return "
            UPDATE  tra_ytd_entrada
            SET  id_tra_ytd_entrada_proc =  -2
            WHERE  id_tra_ytd_entrada = $valores[0]
            ;
        ";
    }

    //  IN:     (0->$id_tabla_prod_tmp
    public  function insert_tra_ytd_entrada_prod ($valores=NULL){
        return "
            INSERT INTO tra_ytd_entrada_prod
                (
                    SELECT * from tra_ytd_entrada_prod_tmp
                        WHERE id_tra_ytd_entrada_prod_tmp = $valores[0]
                )
            ;
        ";
    }

    //  IN:     (0->$id_tabla_prod_tmp
    public  function insert_bod_entrada_mercaderia_prod ($valores=NULL){
        return "
            INSERT INTO bod_entrada_mercaderia_prod
                (
                    SELECT * from bod_entrada_mercaderia_prod_tmp
                        WHERE id_bod_entrada_mercaderia_prod_tmp = $valores[0]
                )
            ;
        ";
    }



}