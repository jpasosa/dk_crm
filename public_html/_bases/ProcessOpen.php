<?php

// CONSULTAS DE LOS PROCESOS PRINCIPALES QUE MANEJAN EL CRM


class _ProcessOpen {


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

       // selecciono el registro de sis_procesos_flujos_dias busco por orden y proceso (encuentro el anterior)
    //  IN:     (0->id_area)
    //  OUT:    nos devuelve el id de sis_procesos_flujos_dias
    public  function fl_dias_accesibles ($valores=NULL){
        return "
            SELECT *
            FROM sis_procesos_flujos_dias
            WHERE id_sis_areas = $valores[0]
            GROUP BY id_sis_procesos
            ; 
        ";
    }

     // me determina los procesos a los que puede acceder según su área.
    //  IN:     (0->name_process  1->id_area)
    //  OUT:    me devuelve el nombre del proceso en ['proceso']
    public  function procesos_activos ($valores=NULL){
        return "
            SELECT p.id_$valores[0] AS id_tabla, pr.id_$valores[0]_proc AS id_tabla_proc, fd.id_sis_procesos_flujos_dias AS id_fl_dias,
                        fd.proceso_orden AS proceso_orden, fd.dias_activo AS dias_activo, procesos.id_sis_procesos AS id_proceso, procesos.proceso AS proceso_proceso,
                        procesos.nombre AS proceso_nombre, fd.id_sis_areas AS id_areas
            FROM $valores[0] AS p
            
            JOIN $valores[0]_proc AS pr
                ON p.id_$valores[0] = pr.id_$valores[0]
            JOIN sis_procesos_flujos_dias AS fd
                ON pr.id_sis_procesos_flujos_dias=fd.id_sis_procesos_flujos_dias
            JOIN sis_procesos AS procesos
                ON fd.id_sis_procesos=procesos.id_sis_procesos
            WHERE p.id_$valores[0]_proc !=0 AND p.id_$valores[0]_proc != -1 
                            AND fd.id_sis_areas=$valores[1]
            ;
        ";
    }

    // me determina los procesos a los que puede acceder según su área.
    //  IN:     (0->id_area)
    //  OUT:    me devuelve el nombre del proceso en ['proceso']
    public  function sis_procesos_accesibles ($valores=NULL){
        return "
            SELECT *
            FROM sis_procesos_flujos_dias  AS fd
            JOIN sis_procesos AS p
                ON p.id_sis_procesos=fd.id_sis_procesos
            WHERE fd.id_sis_areas = $valores[0]
            GROUP BY fd.id_sis_procesos
            ; 
        ";
    }



    //  me devuelve todos los reg de ven_solicitud_viaticos_viajes, que estén cerrados y fecha_fin < date
    //  IN:     (0->date_unix)
    //  OUT:    todos los registros que cumplan dicha condicion
    public  function search_viaticos_rendir ($valores=NULL){
        return "
            SELECT *
            FROM ven_solicitud_viaticos_viajes
            WHERE id_ven_solicitud_viaticos_viajes_proc = 0
                AND fecha_fin < $valores[0];
            ;
        ";
    }













    // Busca todos los mantenimientos que ya están cerrados
    //  IN:     (0->id_area)
    //  OUT:    me devuelve el nombre del proceso en ['proceso']
    public  function search_mant_cerrados ($valores=NULL){
        return "
            SELECT *
            FROM adm_ytd_mantenimientos
            WHERE id_adm_ytd_mantenimientos_proc = 0
            ; 
        ";
    }





}