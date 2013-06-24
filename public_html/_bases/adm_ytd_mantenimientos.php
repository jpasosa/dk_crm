<?php





class adm_ytd_mantenimientos extends FormCommon {


    // la dejo de ejemplo, después hay que volarla
    public  function planificacion_gastos_detalle ($valores=NULL){
        return "
            SELECT gd.id_ger_planificacion_gastos_detalle AS id, c.cuenta AS cuenta, c.descripcion AS descripcion,
                        gd.detalle AS detalle, p.nombre AS proveedor, gd.mes AS mes, gd.monto AS monto
            FROM ger_planificacion_gastos AS gg
            JOIN ger_planificacion_gastos_proc AS gp
            ON gg.id_planificacion_gastos_proc=gp.id_ger_planificacion_gastos_proc
            JOIN ger_planificacion_gastos_detalle AS gd
            ON gp.id_ger_planificacion_gastos_proc=gd.id_ger_planificacion_gastos_proc
            LEFT JOIN sis_cuentas AS c
            ON gd.id_sis_cuentas=c.id_sis_cuentas
            LEFT JOIN cpr_proveedores AS p
            ON gd.id_cpr_proveedores=p.id_cpr_proveedores
            WHERE gd.id_ger_planificacion_gastos_proc = $valores[0] AND gd.activo = 1
            ;
        ";
    }


    // periodicidad para el select
    public  function periodicidad ($valores=NULL){
        return "
            SELECT id_sis_periodicidad AS id, periodicidad
            FROM sis_periodicidad
            ;
        ";
    }


    //  Hace un update de la tabla adm_ytd_mantenimientos
    //  IN:     (0 proceso / 1-id_adm_ytd_mantenimientos / 2 asunto / 3 cadaxtiempo / 4 fechainicio / 5-id_periodicidad / 6 observaciones)
    //  OUT:    hace el update en el registro
    public  function update_mant_principal ($valores=NULL){
        return "
            UPDATE adm_ytd_mantenimientos AS m
            SET id_ytd_mantenimientos_proc = $valores[0], asunto = '$valores[2]', cada_x_tiempo = $valores[3], fecha_inicio = $valores[4], id_sis_periodicidad = $valores[5], observaciones = '$valores[6]'
            WHERE id_adm_ytd_mantenimientos = $valores[1];
            ;
        ";
    }

    //  descripción del método
    //  IN:     (id_adm_ytd_mantenimientos)
    //  OUT:    nos devuelve el registro entero con ese id
    public  function mant_principal ($valores=NULL){
        return "
            SELECT
                m.id_adm_ytd_mantenimientos AS id_ytd_mant, m.asunto, m.cada_x_tiempo,
                FROM_UNIXTIME(m.fecha_inicio, '%d/%m/%Y') AS fecha_inicio, m.id_sis_periodicidad AS periodicidad,
                m.id_ytd_mantenimientos_proc AS id_proccess, m.observaciones
            FROM adm_ytd_mantenimientos AS m
            WHERE id_adm_ytd_mantenimientos = $valores[0];
            ;
        ";
    }


    //  Hace el update de la tabla principal.
    //  IN:     (0->id_tabla | 1->asunto | 2->observaciones  |  3->fecha_inicio | 4->periodicidad | 5->x_tiempo | )
    //  OUT:    Hace el update
    public  function update_mant ($valores=NULL){
        return "
            UPDATE adm_ytd_mantenimientos
            SET asunto = '$valores[1]', observaciones = '$valores[2]', fecha_inicio = $valores[3], id_sis_periodicidad = $valores[4], cada_x_tiempo = $valores[5]
            WHERE id_adm_ytd_mantenimientos = $valores[0];
            ;
        ";
    }





}