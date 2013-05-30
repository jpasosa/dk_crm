<?php

// CONSULTAS DE LOS PROCESOS PRINCIPALES QUE MANEJAN EL CRM


class _Process {



    // T: sis_cuentas //// me devuelve el id de una cuenta.
    public  function search_sis_cuentas ($valores=NULL){
        return "
            SELECT id_sis_cuentas AS id_sc
            FROM sis_cuentas
            WHERE cuenta = '$valores[0]'          
            ; 
        ";
    }

    // T: crp_proveedores //// Con el nombre del proveedor, me devuelve el id del proveedor
    public  function search_proveedores ($valores=NULL){
        return "
            SELECT id_crp_proveedores AS id_p
            FROM crp_proveedores
            WHERE nombre = '$valores[0]'          
            ; 
        ";
    }

    // T: cd_datos_personales //// Nombre y apellido del empleado logueado
    public  function empleado_nombres ($valores=NULL){
        return "
            SELECT cv.nombre, cv.apellido, a.area
            FROM cv_datos_personales AS cv
            JOIN sis_areas AS a
                ON cv.id_sis_areas=a.id_sis_areas
            WHERE id_cv_datos_personales = $valores[0]
            ; 
        ";
    } 

    // T: sis_feriado //// selecciona las fechas feriadas, según un país.
    public  function select_feriados ($valores=NULL){
        return "
            SELECT FROM_UNIXTIME(fecha, '%d/%m/%Y') AS fecha
            FROM sis_feriados
            WHERE id_sis_pais = $valores[0]
            ; 
        ";
    }

    







    ///////////////////////////////////////////////////////
    // Las siguientes consultas se usan para la clase Process
    /////////////////////////////////////////////////



    //  nos dá el id del área del user logueado y el id de cv_datos_personales
    //  IN:     (id_user logueado)
    //  OUT:    array { ['id_sis_areas'']=>xx }
    public  function user_area ($valores=NULL){  // TODO volar a unas clases bases. .. . . 
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


    // busca el id_sis_procesos_flujos_dias que corresponde con el proceso y el area, en orden 1, por que comienza.
    //  IN:     (0->nombre proceso, 1->id_area, 2->id_proceso)
    //  OUT:    array { ['id_sis_procesos'']=>xx,  }
    public  function search_sis_fl_dias ($valores=NULL){
        return "
            SELECT id_sis_procesos_flujos_dias AS id_fl_dias
            FROM sis_procesos_flujos_dias
            WHERE id_sis_areas = $valores[1]
                    AND id_sis_procesos = $valores[2]
                    AND proceso_orden = 1
            ; 
        ";
    }





    //  hace el insert en la tablaxx_proc
    //  IN:     (0->nombre del proceso 1->id_sis_procesos_flujos_dias 2->id_cv_datos_personales, 3->fecha)
    //  OUT:    hace el insert, nos dá nro de id si está todo bien. si falla NULL
    public  function insert_tabla_proc ($valores=NULL){
        return "
            INSERT INTO $valores[0]_proc
            (fecha_alta, id_cv_datos_personales, id_sis_procesos_flujos_dias) VALUES ($valores[3], $valores[2], $valores[1])
            ; 
        ";
    }

    //  hace el primer insert en la tabla principal
    //  IN:     (0->nombre del proceso, 1->id_tabla_proc)
    //  OUT:    hace el insert, nos dá nro de id si está todo bien. si falla NULL
    public  function insert_tabla ($valores=NULL){
        return "
            INSERT INTO $valores[0]
            (id_$valores[0]_proc) VALUES ($valores[1])
            ; 
        ";
    }

    // $update_tabla_proc = BDConsulta::consulta('update_tabla_proc', array($nombre_proceso, $id_tabla_proc, $id_tabla), 's'); // ingreso el id_tabla en la tabla_proc, me estaba faltando.

    //  hace el update en tabla_proc, agregando el id_tabla que se relaciona.
    //  IN:     (0->nombre del proceso, 1->id_tabla_proc, 2->id_tabla)
    //  OUT:    hace el insert, nos dá nro de id si está todo bien. si falla NULL
    public  function update_tabla_proc ($valores=NULL){
        return "
            UPDATE $valores[0]_proc SET id_$valores[0] = $valores[2]
                WHERE id_$valores[0]_proc = $valores[1]
            ; 
        ";
    }

    //  nos devuelve los nombres de las columnas de la tabla xx en un array
    //  IN:     (0->nombre_tabla)
    //  OUT:    nombre de los campos de la tabla
    public  function nombre_columnas ($valores=NULL){
        return "
            SELECT COLUMN_NAME
            FROM information_schema.COLUMNS
            WHERE TABLE_SCHEMA  LIKE 'dreamkyds_crm'
                AND TABLE_NAME = 'ger_planificacion_gastos';
            ; 
        ";
    }

    //  nos devuelve un registro de la tabla principal
    //  IN:     (0->nombre_proces 1->id_tabla)
    //  OUT:    registro entero
    public  function select_princ ($valores=NULL){
        return "
            SELECT *
            FROM $valores[0]
            WHERE id_$valores[0] = $valores[1]
            ; 
        ";
    }


    //  crea una tabla temporal con el registro a duplicar
    //  IN:     (0->nombre_proces 1->id_tabla)
    //  OUT:    registro entero a duplicar puesto en tabla temporal
    public  function create_tmp ($valores=NULL){
        return "
            CREATE TEMPORARY TABLE tmp
                SELECT * FROM $valores[0]
                WHERE id_$valores[0] = $valores[1]
            ; 
        ";
    }

    //  selecciona ultimo id
    //  IN:     (0->nombre_proces)
    //  OUT:    registro entero a duplicar puesto en tabla temporal
    public  function select_last ($valores=NULL){
        return "
            SELECT id_$valores[0] FROM $valores[0] ORDER BY id_$valores[0] DESC LIMIT 0,1
            ; 
        ";
    }

    //  hago el update de la tabla temporal, para modificarle el id, que corresponda con el insert que va a hacer en tabla principal
    //  IN:     (0->nombre_proceso  1->id nuevo 2->id_tabla 
    //  OUT:    registro entero a duplicar puesto en tabla temporal
    public  function update_tmp ($valores=NULL){
        return "
            UPDATE tmp SET id_$valores[0]=$valores[1] WHERE id_$valores[0] = $valores[2]
            ; 
        ";
    }

    //  hago el update de la tabla temporal, para modificarle el id, que corresponda con el insert que va a hacer en tabla principal
    //  IN:     (0->nombre_proceso  1->id nuevo
    //  OUT:    registro entero a duplicar puesto en tabla temporal
    public  function duplicate_reg ($valores=NULL){
        return "
            INSERT INTO $valores[0] SELECT * FROM tmp WHERE id_$valores[0] = $valores[1]
            ; 
        ";
    }

    //  hago el update en el reg duplicado de la tabla princ, para ponerle el id_proc que lo modificó
    //  IN:     (0->nombre_proceso  1->id_process 2->id_tabla del duplicado
    //  OUT:    hace un update en el reg. duplicado
    public  function update_tabla ($valores=NULL){
        return "
            UPDATE $valores[0] SET id_$valores[0]_proc = $valores[1]
                WHERE id_$valores[0] = $valores[2]
            ; 
        ";
    }



    //  hago el update de la tabla temporal, para modificarle el id, que corresponda con el insert que va a hacer en tabla principal
    //  IN:     (0->nombre_proceso  1->tabla id
    //  OUT:    registro entero a duplicar puesto en tabla temporal
    public  function update_id_proc_null ($valores=NULL){
        return "
            UPDATE $valores[0] SET id_$valores[0]_proc = NULL
                WHERE id_$valores[0] = $valores[1]
            ; 
        ";
    }



    // CONSULTAS PARA Process::UpdatePrinc

    //  hago el update en el reg duplicado de la tabla princ, para ponerle el id_proc que lo modificó
    //  IN:     (0->nombre_proceso  1->$id_tabla 2->observaciones
    //  OUT:    hace un update en el reg. duplicado
    public  function update_tabla_princ ($valores=NULL){
        return "
            UPDATE $valores[0] SET observaciones = '$valores[2]'
                WHERE id_$valores[0] = $valores[1]
            ; 
        ";
    }







    //
    // Ahora vienen las consultas para el métodos Process::CreateSec
    //

    //  hago el primer insert en la tabla secundario. Pongo id_process y activo en 1.
    //  IN:     (0->nombre_proceso  1->sigla de tabla secundaria 2->id_proccess
    //  OUT:    registro entero a duplicar puesto en tabla temporal
    public  function insert_sec ($valores=NULL){
        return "
            INSERT INTO $valores[0]_$valores[1]
            (activo, id_$valores[0]_proc) VALUES (1, $valores[2])
            ; 
        ";
    }

    

    
    // Ahora vienen las consultas para el métodos Process::ModifySec
    
    
    //  hago el primer insert en la tabla secundario. Pongo id_process y activo en 1.
    //  IN:     (0->nombre_proceso  1->sigla de tabla secundaria 2->id_tabla_sec
    //  OUT:    registro entero a duplicar puesto en tabla temporal
    public  function update_detalle_inactivo ($valores=NULL){
        return "
            UPDATE $valores[0]_$valores[1]
            SET activo = 0
            WHERE id_$valores[0]_$valores[1] = $valores[2]
            ; 
        ";
    }

    

    // Ahora vienen las consultas para el métodos Process::DeleteSec

    //  crea una tabla temporal con el registro a duplicar
    //  IN:     (0->nombre_proces 1-> sigla_sec 2->id_tabla)
    //  OUT:    registro entero a duplicar puesto en tabla temporal
    public  function create_tmp_sec ($valores=NULL){
        return "
            CREATE TEMPORARY TABLE tmp
                SELECT * FROM $valores[0]_$valores[1]
                WHERE id_$valores[0]_$valores[1] = $valores[2]
            ; 
        ";
    }

     // selecciona ultimo id
     // IN:     (0->nombre_proces)
     // OUT:    registro entero a duplicar puesto en tabla temporal
    public  function select_last_sec ($valores=NULL){
        return "
            SELECT id_$valores[0]_$valores[1] FROM $valores[0]_$valores[1] ORDER BY id_$valores[0]_$valores[1] DESC LIMIT 0,1
            ; 
        ";
    }

    //  hago el update de la tabla temporal, para modificarle el id, que corresponda con el insert que va a hacer en tabla principal
    //  IN:     (0->nombre_proceso  1->sigla sec 2->id nuevo 3->id_tabla_sec 
    //  OUT:    registro entero a duplicar puesto en tabla temporal
    public  function update_tmp_sec ($valores=NULL){
        return "
            UPDATE tmp SET id_$valores[0]_$valores[1]=$valores[2] WHERE id_$valores[0]_$valores[1] = $valores[3]
            ; 
        ";
    }

    //  hago el update de la tabla temporal, para modificarle el id, que corresponda con el insert que va a hacer en tabla principal
    //  IN:     (0->nombre_proceso    1->siga sec   2->id nuevo
    //  OUT:    registro entero a duplicar puesto en tabla temporal
    public  function duplicate_reg_sec ($valores=NULL){
        return "
            INSERT INTO $valores[0]_$valores[1] SELECT * FROM tmp WHERE id_$valores[0]_$valores[1] = $valores[2]
            ; 
        ";
    }

    //  hago el update en el reg duplicado de la tabla princ, para ponerle el id_proc que lo modificó
    //  IN:     (0->nombre_proceso     1->sigla sec     2->id_tabla del duplicado
    //  OUT:    hace un update en el reg. duplicado
    public  function update_tabla_sec ($valores=NULL){
        return "
            UPDATE $valores[0]_$valores[1] SET activo = 0
                WHERE id_$valores[0]_$valores[1] = $valores[2]
            ; 
        ";
    }















    //  inserta una fecha en adm_ytd_mantenimiento_recordatorio
    //  IN:     (0->id del proceso, 1->fecha_unix)
    //  OUT:    hace el insert, nos dá nro de id si está todo bien. si falla NULL
    public  function set_fecha_recordatorio ($valores=NULL){
        return "
            INSERT INTO adm_ytd_mantenimiento_recordatorio
            (id_adm_ytd_mantenimientos_proc, fecha) VALUES ($valores[0], $valores[1])
            ; 
        ";
    }

    //  inserta una fecha en adm_ytd_mantenimiento_recordatorio
    //  IN:     (0->id del proceso, 1->fecha_unix)
    //  OUT:    hace el insert, nos dá nro de id si está todo bien. si falla NULL
    public  function fechas_recordatorio ($valores=NULL){
        return "
            SELECT FROM_UNIXTIME(fecha, '%d/%m/%Y') AS fecha
            FROM adm_ytd_mantenimiento_recordatorio
            WHERE id_adm_ytd_mantenimientos_proc = $valores[0]
            ; 
        ";
    }





    // las siguiente se usan para el método SEND


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

    // debe comprobar que exista el user id
    //  IN:     (0->id_user)
    //  OUT:    nos devuelve el proceso
    public  function exist_user ($valores=NULL){ // TODO volar a unas clases bases. .. . . 
        return "
            SELECT id_cv_datos_personales
            FROM cv_datos_personales
            WHERE id_cv_datos_personales = $valores[0]
            ; 
        ";
    }

    // debe comprobar que exista el user id
    //  IN:     (0->nombre proceso 1->id_proc)
    //  OUT:    nos devuelve el proceso
    public  function id_tabla ($valores=NULL){
        return "
            SELECT id_$valores[0] AS id
            FROM $valores[0]
            WHERE id_$valores[0]_proc = $valores[1]
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

    // selecciono el registro de sis_procesos_flujos_dias busco por orden y proceso (encuentro el anterior)
    //  IN:     (0->id_proceso, 1->id_orden)
    //  OUT:    nos devuelve el id de sis_procesos_flujos_dias
    public  function select_pr_dias_anterior ($valores=NULL){
        return "
            SELECT *
            FROM sis_procesos_flujos_dias
            WHERE id_sis_procesos = $valores[0]
                AND proceso_orden = $valores[1]
            ; 
        ";
    }







    //  descripción del método
    //  IN:     (0->pr_proceso, 1->id_tabla_proc)
    //  OUT:    array { ['key'']=>tipoDeDato, ['key'']=>tipoDeDato, ['key'']=>tipoDeDato }
    public  function select_tabla_proc ($valores=NULL){
        return "
            SELECT * FROM $valores[0]_proc
            WHERE id_$valores[0]_proc = $valores[1]
            ;
        ";
    }

    //  descripción del método
    //  IN:     (0->pr_proceso, 1->id_proceso 2->id_tabla)
    //  OUT:    array { ['key'']=>tipoDeDato, ['key'']=>tipoDeDato, ['key'']=>tipoDeDato }
    public  function select_all_proc_same_tabla ($valores=NULL){
        return "
            SELECT id_$valores[0]_proc AS id_tabla_proc, id_$valores[0] AS id_tabla, proc.id_sis_procesos_flujos_dias AS id_fl_dias,
                        proc.id_cv_datos_personales AS id_user, proc.id_relacionado AS id_relacionado, FROM_UNIXTIME(fecha_alta, '%d/%m/%Y') AS fecha_alta,
                        proc.comentario, fd.id_sis_areas AS id_area, fd.id_sis_procesos AS id_proceso, fd.proceso_orden AS pr_orden, fd.dias_activo AS dias_activo,
                        a.area AS area, null AS estado
                FROM $valores[0]_proc AS proc
            JOIN sis_procesos_flujos_dias AS fd
                ON proc.id_sis_procesos_flujos_dias=fd.id_sis_procesos_flujos_dias
            JOIN sis_areas AS a
                ON fd.id_sis_areas=a.id_sis_areas
            WHERE id_$valores[0] = $valores[2] AND id_sis_procesos = $valores[1]
            ORDER BY proc.id_$valores[0]_proc
            ;
        ";
    }

    //  selecciona todos los campos de tabla principal
    //  IN:     (0->pr_proceso, 1->id_tabla)
    //  OUT:    devuelve el registro
    public  function select_tabla ($valores=NULL){
        return "
            SELECT *, id_$valores[0] AS id_tabla, id_$valores[0]_proc AS id_tabla_proc FROM $valores[0]
            WHERE id_$valores[0] = $valores[1]
            ;
        ";
    }

    //  selecciono los registros de tabla_sec, teniendo tabla_proc
    //  IN:     (0->pr_proceso, 1->pr_proceso_sec, 2->id_tabla_proc)
    //  OUT:    devuelve los registros de tabla SEC
    public  function select_tabla_sec ($valores=NULL){
        return "
            SELECT * FROM $valores[0]_$valores[1]
            WHERE id_$valores[0]_proc = $valores[2]
                AND activo = 1
            ;
        ";
    }

    //  selecciono los registros de tabla_sec, teniendo tabla_proc  Ademas hace una suma de un campo dado
    //  IN:     (0->pr_proceso, 1->pr_proceso_sec, 2->id_tabla_proc, 3->campo a sumar)
    //  OUT:    devuelve los registros de tabla SEC
    public  function tabla_sec_monto_total ($valores=NULL){
        return "
            SELECT SUM($valores[3]) AS monto_total
            FROM $valores[0]_$valores[1]
            WHERE id_$valores[0]_proc = $valores[2]
                AND activo = 1
            ;
        ";
    }

    //  selecciono los registros de tabla, teniendo tabla_proc, Haciendo UNA relacion con otra tabla
    //  IN:     (0->pr_proceso, 1->id_rel, 2->id_tabla_proc)
    //  OUT:    devuelve los registros de tabla
    public  function select_tabla_rel_una ($valores=NULL){
        return "
            SELECT *
            FROM $valores[0] AS princ
            JOIN $valores[1] AS rel
                ON princ.id_$valores[1]=rel.id_$valores[1]
            WHERE princ.id_$valores[0] = $valores[2]
            ;
        ";
    }

    public  function select_tabla_rel_dos ($valores=NULL){
        return "
            SELECT *
            FROM $valores[0] AS princ
            JOIN $valores[1] AS rel
                ON princ.id_$valores[1]=rel.id_$valores[1]
            JOIN $valores[2] AS rel_dos
                ON rel.id_$valores[2]=rel_dos.id_$valores[2]
            WHERE princ.id_$valores[0] = $valores[3]
            ;
        ";
    }

    public  function select_tabla_rel_tres ($valores=NULL){
        return "
            SELECT *
            FROM $valores[0] AS princ
            JOIN $valores[1] AS rel
                ON princ.id_$valores[1]=rel.id_$valores[1]
            JOIN $valores[2] AS rel_dos
                ON rel.id_$valores[2]=rel_dos.id_$valores[2]
            JOIN $valores[3] AS rel_tres
                ON rel_dos.id_$valores[3]=rel_tres.id_$valores[3]
            WHERE princ.id_$valores[0] = $valores[4]
            ;
        ";
    }

    public  function select_tabla_rel_cuatro ($valores=NULL){
        return "
            SELECT *
            FROM $valores[0] AS princ
            JOIN $valores[1] AS rel
                ON princ.id_$valores[1]=rel.id_$valores[1]
            JOIN $valores[2] AS rel_dos
                ON rel.id_$valores[2]=rel_dos.id_$valores[2]
            JOIN $valores[3] AS rel_tres
                ON rel_dos.id_$valores[3]=rel_tres.id_$valores[3]
            JOIN $valores[4] AS rel_cuatro
                ON rel_tres.id_$valores[4]=rel_cuatro.id_$valores[4]
            WHERE princ.id_$valores[0] = $valores[5]
            ;
        ";
    }




    //  selecciono los registros de tabla_sec, teniendo tabla_proc, Haciendo UNA relacion con tabla
    //  IN:     (0->pr_proceso, 1->pr_proceso_sec, 2->id_rel, 3->id_tabla)
    //  OUT:    devuelve los registros de tabla SEC
    public  function select_tabla_sec_rel_una ($valores=NULL){
        return "
            SELECT *
            FROM $valores[0]_$valores[1] AS princ
            JOIN $valores[2] AS rel
                ON princ.id_$valores[2]=rel.id_$valores[2]
            WHERE princ.id_$valores[0]_proc = $valores[3]
                AND activo = 1
            ;
        ";
    }

    //  selecciono los registros de tabla_sec, teniendo tabla_proc, Haciendo UNA relacion con tabla
    //  IN:     (0->pr_proceso, 1->pr_proceso_sec, 2->id_rel, 3->id_rel_otra 4->id_tabla)
    //  OUT:    devuelve los registros de tabla SEC
    public  function select_tabla_sec_rel_una_otra ($valores=NULL){
        return "
            SELECT *
            FROM $valores[0]_$valores[1] AS princ
            JOIN $valores[2] AS rel
                ON princ.id_$valores[2]=rel.id_$valores[2]
            JOIN $valores[3] AS rel_otra
                ON rel.id_$valores[3]=rel_otra.id_$valores[3]
            WHERE princ.id_$valores[0]_proc = $valores[4]
                AND activo = 1
            ;
        ";
    }

    //  selecciono los registros de tabla_sec, teniendo tabla_proc, Haciendo UNA relacion con tabla
    //  IN:     (0->pr_proceso  |  1->pr_proceso_sec  |  2->id_rel  |  3->id_rel_otra  |  4->otra_relacion  |  5->id_tabla)
    //  OUT:    devuelve los registros de tabla SEC
    public  function select_tabla_sec_rel_una_otra_otra ($valores=NULL){
        return "
            SELECT *
            FROM $valores[0]_$valores[1] AS princ
            JOIN $valores[2] AS rel
                ON princ.id_$valores[2]=rel.id_$valores[2]
            JOIN $valores[3] AS rel_otra
                ON rel.id_$valores[3]=rel_otra.id_$valores[3]
            JOIN $valores[4] AS rel_otra_n
                ON rel_otra.id_$valores[4]=rel_otra_n.id_$valores[4]
            WHERE princ.id_$valores[0]_proc = $valores[5]
                AND activo = 1
            ;
        ";
    }

    //  selecciono los registros de tabla_sec, teniendo tabla_proc, Haciendo UNA relacion, y a la vez con 3 tablas mas de rlaciones anidadas
    //  IN:     (0->pr_proceso  |  1->pr_proceso_sec  |  2->id_rel  |  3->id_rel_otra  |  4->otra_relacion  |  5->ult_relacion | 6->id_tabla)
    //  OUT:    devuelve los registros de tabla SEC
    public  function select_tabla_sec_rel_una_ult ($valores=NULL){
        return "
            SELECT *
            FROM $valores[0]_$valores[1] AS princ
            JOIN $valores[2] AS rel
                ON princ.id_$valores[2]=rel.id_$valores[2]
            JOIN $valores[3] AS rel_otra
                ON rel.id_$valores[3]=rel_otra.id_$valores[3]
            JOIN $valores[4] AS rel_otra_n
                ON rel_otra.id_$valores[4]=rel_otra_n.id_$valores[4]
            JOIN $valores[5] AS rel_otra_ult
                ON rel_otra_n.id_$valores[5]=rel_otra_ult.id_$valores[5]
            WHERE princ.id_$valores[0]_proc = $valores[6]
                AND activo = 1
            ;
        ";
    }

    //  selecciono los registros de tabla_sec, teniendo tabla_proc, Haciendo DOS relaciones con tablas
    //  IN:     (0->pr_proceso, 1->pr_proceso_sec, 2->id_rel(1), 3->id_rel(2),  4->id_tabla_proc)
    //  OUT:    devuelve los registros de tabla SEC
    public  function select_tabla_sec_rel_dos ($valores=NULL){
        return "
            SELECT * FROM $valores[0]_$valores[1] AS princ
            JOIN $valores[2] AS rel
                ON princ.id_$valores[2]=rel.id_$valores[2]
            JOIN $valores[3] AS rel_uno
                ON princ.id_$valores[3]=rel_uno.id_$valores[3]
            WHERE princ.id_$valores[0]_proc = $valores[4]
                AND activo = 1
            ;
        ";
    }

    //  selecciono los registros de tabla_sec, teniendo tabla_proc, Haciendo TRES relaciones con tablas
    //  IN:     (0->pr_proceso  |  1->pr_proceso_sec  |  2->id_rel1  |  3->id_rel2  |  4->id_rel3  |  5->id_tabla_proc)
    //  OUT:    devuelve los registros de tabla SEC
    public  function select_tabla_sec_rel_tres ($valores=NULL){
        return "
            SELECT * FROM $valores[0]_$valores[1] AS princ
            JOIN $valores[2] AS rel
                ON princ.id_$valores[2]=rel.id_$valores[2]
            JOIN $valores[3] AS rel_uno
                ON princ.id_$valores[3]=rel_uno.id_$valores[3]
            JOIN $valores[4] AS rel_dos
                ON princ.id_$valores[4]=rel_dos.id_$valores[4]
            WHERE princ.id_$valores[0]_proc = $valores[5]
                AND activo = 1
            ;
        ";
    }

 
    //  selecciono 1er proceso pr_orden = 1, del tabla_proc dado
    //  IN:     (0->pr_proceso  |  1->id_tabla)
    //  OUT:    devuelve los registros de tabla SEC
    public  function first_process ($valores=NULL){
        return "
            SELECT *
            FROM $valores[0]_proc AS proc
            JOIN sis_procesos_flujos_dias AS fd
                ON proc.id_sis_procesos_flujos_dias=fd.id_sis_procesos_flujos_dias
            WHERE proc.id_$valores[0] = $valores[1]
                AND fd.proceso_orden = 1
            ;
        ";
    }

    //  Selecciona los valores para hacer un select
    //  IN:     (0->pr_proceso  |  1->id_valor  |  2->valor)
    //  OUT:    Devuelve los valores para poder hacer el select en la plantilla
    public  function values_select ($valores=NULL){
        return "
            SELECT $valores[1] AS id_valor, $valores[2] AS valor
            FROM $valores[0]
            ;
        ";
    }

    //  Selecciona los valores para hacer un select combinado
    //  IN:     (0->pr_proceso  |  1->id_valor  |  2->valor  |  3->tabla_rel  |  4->id_valor_rel  |  5->valor_rel)
    //  OUT:    Devuelve los valores para poder hacer el select en la plantilla
    public  function values_select_rel ($valores=NULL){
        return "
            SELECT princ.$valores[1] AS id_valor, princ.$valores[2] AS valor, sec.$valores[4] AS id_rel, sec.$valores[5] AS valor_sec
            FROM $valores[0] AS princ
            JOIN $valores[3] AS sec
                ON princ.$valores[4]=sec.$valores[4]
            ;
        ";
    }






    //  me trae todos los nombres de los archivos que están activos para ese proceso
    //  IN:     (0->pr_proceso  |  id_tabla_proc)
    //  OUT:    Todos los nombres de archivos
    public  function nombres_archivos ($valores=NULL){
        return "
            SELECT id_$valores[0]_arch AS id, archivo AS nombre
            FROM $valores[0]_arch
            WHERE id_$valores[0]_proc = $valores[1] AND activo = 1;
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



    //  Selecciona los valores para hacer un select. 
    //  IN:     (0->tabla_uno)
    //  OUT:    Devuelve los valores para poder hacer el select en la plantilla
    public  function select_uno ($valores=NULL){
        return "
            SELECT *
            FROM $valores[0] AS una
            ;
        ";
    }

    //  Selecciona los valores para hacer un select combinado, con dos tablas
    //  IN:     (0->tabla_uno  |  1->tabla_dos)
    //  OUT:    Devuelve los valores para poder hacer el select en la plantilla
    public  function select_dos ($valores=NULL){
        return "
            SELECT *
            FROM $valores[0] AS una
            JOIN $valores[1] AS dos
                ON una.id_$valores[1]=dos.id_$valores[1]
            ;
        ";
    }

    //  Selecciona los valores para hacer un select combinado, con tres tablas
    //  IN:     (0->tabla_uno  |  1->tabla_dos  |  2->tabla_tres)
    //  OUT:    Devuelve los valores para poder hacer el select en la plantilla
    public  function select_tres ($valores=NULL){
        return "
            SELECT *
            FROM $valores[0] AS una
            JOIN $valores[1] AS dos
                ON una.id_$valores[1]=dos.id_$valores[1]
            JOIN $valores[2] AS tres
                ON dos.id_$valores[2]=tres.id_$valores[2]
            ;
        ";
    }

    //  Selecciona los valores para hacer un select combinado, con cuatro tablas
    //  IN:     (0->tabla_uno  |  1->tabla_dos  |  2->tabla_tres  |  3->tabla_cuatro)
    //  OUT:    Devuelve los valores para poder hacer el select en la plantilla
    public  function select_cuatro ($valores=NULL){
        return "
            SELECT *
            FROM $valores[0] AS una
            JOIN $valores[1] AS dos
                ON una.id_$valores[1]=dos.id_$valores[1]
            JOIN $valores[2] AS tres
                ON dos.id_$valores[2]=tres.id_$valores[2]
            JOIN $valores[3] AS cuatro
                ON tres.id_$valores[3]=cuatro.id_$valores[3]
            ;
        ";
    }










}
