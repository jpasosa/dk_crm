<?php

class _ProcessSends {
    

    // CONSULTAS BASE, QUE SE USAN EN VARIAS CLASES.
    // TODO: habría que ver de unificarlas en una misma
    // Una idea que se me ocurre es crea otra clase ProcessBase::xxxx
    // debe comprobar que exista el user id
    //  IN:     (0->id_user)
    //  OUT:    nos devuelve el proceso
    public  function exist_user ($valores=NULL){
        return "
            SELECT id_cv_datos_personales
            FROM cv_datos_personales
            WHERE id_cv_datos_personales = $valores[0]
            ; 
        ";
    }

    //  nos dá el id del área del user logueado y el id de cv_datos_personales
    //  IN:     (id_user logueado)
    //  OUT:    array { ['id_sis_areas'']=>xx }
    public  function user_area ($valores=NULL){
        return "
            SELECT id_sis_areas, id_cv_datos_personales
            FROM cv_datos_personales
            WHERE id_cv_datos_personales = $valores[0]
            ; 
        ";
    }

    //  nos dá el id del nombre del proceso del formulario que estemos haciendo en ese momento
    //  IN:     (recibe el nombre del proceso, saca directo del nombre del archivo)
    //  OUT:    array { ['id_sis_procesos'']=>xx,  }
    public  function id_proceso ($valores=NULL){  // TODO volar a unas clases bases. .. . . 
        return "
            SELECT id_sis_procesos
            FROM sis_procesos
            WHERE proceso = '$valores[0]'
            ; 
        ";
    }

    // nos debe dar el proceso_orden actual en que nos encontramos.
    //  IN:     (0->nombre del proceso 1->id del proceso)
    //  OUT:    nos devuelve el proceso
    public  function proceso_orden_flujos ($valores=NULL){
        return "
            SELECT p.id_sis_procesos_flujos_dias AS id_fl_dias, d.proceso_orden AS orden
            FROM $valores[0]_proc AS p
            JOIN sis_procesos_flujos_dias AS d
                ON d.id_sis_procesos_flujos_dias=p.id_sis_procesos_flujos_dias
            WHERE id_$valores[0]_proc = $valores[1]
            ; 
        ";
    }


    // consulto si existe siguiente paso para este proceso. Saco el id del siguiente proceso de sis_procesos_flujos_dias
    //  IN:     (0->id del nombre del proceso 1->orden del proceso siguiente)
    //  OUT:    nos devuelve el id de sis_procesos_flujos_dias del siguiente paso.
    public  function id_next_proc_orden ($valores=NULL){
        return "
            SELECT id_sis_procesos_flujos_dias AS id
            FROM sis_procesos_flujos_dias
            WHERE id_sis_procesos = $valores[0]
                AND proceso_orden = $valores[1]
            ; 
        ";
    }

    // Saco el id del siguiente paso, pero ya me especifica también el área a donde va a seleccionar el siguiente paso.
    //  IN:     (0->id del nombre del proceso 1->orden del proceso siguiente  |  2->id_next_area)
    //  OUT:    nos devuelve el id de sis_procesos_flujos_dias del siguiente paso.
    public  function id_next_proc_orden_area ($valores=NULL){
        return "
            SELECT *
            FROM sis_procesos_flujos_dias
            WHERE id_sis_procesos = $valores[0]
                AND proceso_orden = $valores[1]
                AND id_sis_areas = $valores[2]
            ; 
        ";
    }

    //  pone enviar, pero no existe un siguiente paso. asi que lo cierra. pone id_tabla_proc en 0 de la tabla principal
    //  IN:     (0->$name_process, 1->$id_tabla)
    //  OUT:    pone en 0 el id_proc de la tabla principal
    public  function insert_proc_enviado_cierre ($valores=NULL){
        return "
            UPDATE $valores[0]
            SET id_$valores[0]_proc = 0
            WHERE id_$valores[0] = $valores[1]
            ; 
        ";
    }

    // selecciono el registro de sis_procesos_flujos_dias
    //  IN:     (0->id_fl_dias)
    //  OUT:    nos devuelve el id de sis_procesos_flujos_dias.
    public  function select_pr_dias ($valores=NULL){
        return "
            SELECT proceso_orden AS pr_orden, id_sis_procesos AS id_proceso, id_sis_areas AS id_area
            FROM sis_procesos_flujos_dias
            WHERE id_sis_procesos_flujos_dias = $valores[0]
            ; 
        ";
    }

    //  hago el primer insert en la tabla _proc, cuando hacen click en 'enviar'.
    //  IN:     (0->$name_process, 1->$id_tabla, 2->$id_next_proc_flujos_dias)
    //  OUT:    registro entero a duplicar puesto en tabla temporal
    public  function insert_proc_enviado ($valores=NULL){
        return "
            INSERT INTO $valores[0]_proc
            (id_$valores[0], id_sis_procesos_flujos_dias) VALUES ($valores[1], $valores[2])
            ; 
        ";
    }

    //  Hace el udpate en tabla_proc, cuando hacemos click en APROBADO después de escribir un comentario
    //  IN:     (0->pr_proceso  |  1->id_user  |  2->fecha  |  3->comment  |  4->id_tabla_proc
    //  OUT:    devuelve los registros de tabla SEC
    public  function update_tabla_proc_aprobado ($valores=NULL){
        return "
            UPDATE $valores[0]_proc
            SET id_cv_datos_personales = $valores[1], fecha_alta = $valores[2], id_relacionado = null,
                    comentario = '$valores[3]'
            WHERE id_$valores[0]_proc = $valores[4]
            ;
        ";
    }

    public  function proc_desaprobado ($valores=NULL){
        return "
            UPDATE $valores[0]
            SET id_$valores[0]_proc = -1
            WHERE id_$valores[0] = $valores[1]
            ; 
        ";
    }

    //  va a buscar el id_tabla_proc, del proceso anterior al tabla_proc actual
    //  IN:     (0->pr_proceso  |  1->id_tabla  |  2->id_fl_dias_ant
    //  OUT:    devuelve el registro de tabla_proc del proceso anterior al acutal
    public  function search_proc_ant ($valores=NULL){
        return "
            SELECT id_$valores[0]_proc AS id_tabla_proc_ant
            FROM $valores[0]_proc
            WHERE id_$valores[0] = $valores[1]
                            AND id_sis_procesos_flujos_dias = $valores[2]
            ;
        ";
    }

    //  Hace el udpate en tabla_proc, cuando hacemos click en SOLICITAR CORRECCIÓN después de escribir un comentario
    //  IN:     (0->pr_proceso  |  1->id_user  |  2->fecha  |  3->comment  |  4->id_tabla_proc 5->id_relacionado
    //  OUT:    devuelve los registros de tabla SEC
    public  function update_tabla_proc_correccion ($valores=NULL){
        return "
            UPDATE $valores[0]_proc
            SET id_cv_datos_personales = $valores[1], fecha_alta = $valores[2],
                    comentario = '$valores[3]', id_relacionado = $valores[5]
            WHERE id_$valores[0]_proc = $valores[4]
            ;
        ";
    }

    //  hago el insert en tabla_proc, cuando hicieron click en SOLICITAR CORRECCIÓN.
    //  IN:     (0->$pr_proceso  |  1->$id_tabla  |  2->$id_fl_dias_ant |  3->  $id_tabla_proc_ant)
    //  OUT:    Me hizo en INSERT de un registro, cuando hicimos SOLICITAR CORRECCIÓN.
    public  function insert_proc_correccion ($valores=NULL){
        return "
            INSERT INTO $valores[0]_proc
            (id_$valores[0], id_sis_procesos_flujos_dias, id_relacionado) VALUES ($valores[1], $valores[2], null)
            ; 
        ";
    }


}