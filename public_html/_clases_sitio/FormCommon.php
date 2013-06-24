<?php

class FormCommon {


    public static function queryRespHeader($response){
        if($response == false || null) {
            $res = header("success_query: false");
        }elseif($response >= 1 || (isset($response['error']) && $response['error'] == false)) {
            $res = header("success_query: true");
        }
        return $res;
    }

    // es cuando recibo respuesta de un Process.
    public static function queryRespHeaderProcess($response){
        if($response['error'] == true) {
            $res = header("success_query: false");
        }elseif($response['error'] == false) {
            $res = header("success_query: true");
        }
        echo 'pepe';
        echo $res;
        die();
        return $res;
    }

    public static function debug($obj, $die){
        echo ' <br/> <div style="font-weight: bold; color: green;"> $a1: </div> <pre>' ;
        echo '<div style="color: #3741c6;">';
        if(is_array($obj)) {
            print_r($obj);
        }else {
        var_dump($obj);
        }
        echo '</div>';
        echo '</pre>';
        if(!$die) {

        }else{
            die('--FIN--DEBUGEO----');
        }

    }





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
            SELECT id_cpr_proveedores AS id_p
            FROM cpr_proveedores
            WHERE nombre = '$valores[0]'
            ;
        ";
    }

    // T: cd_datos_personales //// Nombre y apellido del empleado logueado
    public  function empleado_nombres ($valores=NULL){
        return "
            SELECT nombre, apellido
            FROM cv_datos_personales
            WHERE id_cv_datos_personales = $valores[0]
            ;
        ";
    }

    // T: sis_feriado //// selecciona las fechas feriadas, según un país.
    // public  function select_feriados ($valores=NULL){
    //     return "
    //         SELECT FROM_UNIXTIME(fecha, '%d/%m/%Y') AS fecha
    //         FROM sis_feriados
    //         WHERE id_sis_pais = $valores[0]
    //         ;
    //     ";
    // }









    ///////////////////////////////////////////////////////
    // Las siguientes consultas se usan para la clase Process
    /////////////////////////////////////////////////


    //  Nos va a hacer un insert en flujos_dias, comenzando el proceso nuevo. .pone en 1 proceso_orden
    //  IN:     (0->id_sis_procesos,   1->id_sis_areas)
    //  OUT:    hace el insert, nos dá nro de id si está todo bien. si falla NULL
    public  function insert_flujos_dias ($valores=NULL){
        return "
            INSERT INTO sis_procesos_flujos_dias
            (id_sis_areas, id_sis_procesos, proceso_orden) VALUES ($valores[1], $valores[0], 1)
            ;
        ";
    }

    //  nos dá el id del área del user logueado y el id de cv_datos_personales
    //  IN:     (id_user logueado)
    //  OUT:    array { ['id_sis_areas'']=>xx }
    public  function user_area ($valores=NULL){
        return "
            SELECT cv.id_sis_areas, cv.id_cv_datos_personales, a.area
            FROM cv_datos_personales AS cv
            JOIN sis_areas AS a
                ON cv.id_sis_areas=a.id_sis_areas
            WHERE cv.id_cv_datos_personales = $valores[0]
            ;
        ";
    }

    //  nos dá el id del nombre del proceso del formulario que estemos haciendo en ese momento
    //  IN:     (recibe el nombre del proceso, saca directo del nombre del archivo)
    //  OUT:    array { ['id_sis_procesos'']=>xx,  }
    public  function id_proceso ($valores=NULL){
        return "
            SELECT id_sis_procesos
            FROM sis_procesos
            WHERE proceso = '$valores[0]'
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












}
