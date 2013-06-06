<?php





class adm_ytd_mantenimientos_recordatorio extends FormCommon {

     //  descripción del método
    //  IN:     (0->id_tabla_proc)
    //  OUT:    saber si existe el vamlos en ese campo
    public  function get_recordatorios ($valores=NULL){
        return "
            SELECT *
            FROM adm_ytd_mantenimiento_recordatorio
            WHERE id_adm_ytd_mantenimientos_proc = $valores[0]          
            ; 
        ";
    }

    //  inserta el recordatorio
    //  IN:     (0->id_tabla_proc  |  1->resultado  |  2->detalle  |  3->costo  |  4->fecha)
    //  OUT:    hace el insert, nos dá nro de id si está todo bien. si falla NULL
    public  function insert_record ($valores=NULL){
        return "
            INSERT INTO adm_ytd_mantenimiento_recordatorio
            (id_adm_ytd_mantenimientos_proc, activo, resultado, detalle, costo, fecha) VALUES ($valores[0], $valores[1])
            ; 
        ";
    }

    //  update record
    //  IN:     (0->id_tabla_proc  |  1->resultado  |  2->detalle  |  3->costo  |  4->fecha)
    //  OUT:    hace el insert, nos dá nro de id si está todo bien. si falla NULL
    public  function update_record ($valores=NULL){
        return "
            INSERT INTO adm_ytd_mantenimiento_recordatorio
            (id_adm_ytd_mantenimientos_proc, activo, resultado, detalle, costo, fecha) VALUES ($valores[0], $valores[1])
            ; 
        ";
    }


}