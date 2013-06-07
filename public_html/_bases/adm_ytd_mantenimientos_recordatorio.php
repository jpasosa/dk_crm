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
                            AND activo = 1    
            ; 
        ";
    }

    //  inserta el recordatorio
    //  IN:     (0->id_tabla_proc  |  1->resultado  |  2->detalle  |  3->costo  |  4->fecha)
    //  OUT:    hace el insert, nos dá nro de id si está todo bien. si falla NULL
    public  function insert_record ($valores=NULL){
        return "
            INSERT INTO adm_ytd_mantenimiento_recordatorio
            (id_adm_ytd_mantenimientos_proc, activo, resultado, detalle, costo, fecha) VALUES ($valores[0], 0, $valores[1], '$valores[2]', $valores[3], $valores[4])
            ; 
        ";
    }

    //  Hace el update en adm_ytd_mantenimiento_recordatorio; teniendo el id_tabla
    //  IN:     (0->id_tabla  |  1->resultado  |  2->detalle  |  3->costo  |  4->fecha)
    public  function update_record ($valores=NULL){
        return "
            UPDATE adm_ytd_mantenimiento_recordatorio
            SET activo = 0, resultado = $valores[1], detalle = '$valores[2]', costo = $valores[3], fecha = $valores[4]
            WHERE id_adm_ytd_mantenimiento_recordatorio = $valores[0];
        ";
    }

    //  descripción del método
    //  IN:     (0->id_tabla)
    //  OUT:    saber si existe el vamlos en ese campo
    public  function get_actual ($valores=NULL){
        return "
            SELECT *
            FROM adm_ytd_mantenimiento_recordatorio
            WHERE id_adm_ytd_mantenimiento_recordatorio = $valores[0]          
            ; 
        ";
    }

    //  Selecciona la tabla, pata ver que campo está libre de los archivos.
    //  IN:     (0->id_tabla)
    public  function ver_arch_libres ($valores=NULL){
        return "
            SELECT *
            FROM adm_ytd_mantenimiento_recordatorio
            WHERE id_adm_ytd_mantenimiento_recordatorio = $valores[0]          
            ; 
        ";
    }

    //  Selecciona la tabla, para mostrar los archivos en la vista.
    //  IN:     (0->id_tabla)
    public  function archivos_mant ($valores=NULL){
        return "
            SELECT archivo_1, archivo_2, archivo_3, archivo_4, archivo_5 
            FROM adm_ytd_mantenimiento_recordatorio
            WHERE id_adm_ytd_mantenimiento_recordatorio = $valores[0]          
            ; 
        ";
    }


}