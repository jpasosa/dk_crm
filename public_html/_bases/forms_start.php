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



}