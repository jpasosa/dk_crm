<?php

class Process {
    
    public static function NameProcess() { // TODO si llamamos del _coment, tiene que volar ese '_coment'
        $exception = new Exception; 
        $trace = $exception->getTrace();
        $file = $trace[1]['file'];
        $file = explode('/', $file);
        $file = end($file);
        $file = explode('.', $file);
        $pr_proceso = $file[0];
        if(!stristr($pr_proceso, '_coment') === FALSE) { // si tiene _coment, debe eliminarlo, para escribir bien el proceso.
            $pr_proceso = str_replace('_coment', '', $pr_proceso);
        }
        return $pr_proceso;
    }

    // CREACIÓN DEL PROCESOS POR PRIMERA VEZ; PREPARA LOS REGISTROS.
    // Retorna ('id_tabla', 'id_proceso', 'id_flujo', 'error', 'notice_error','notice_success')
    public static function CreateNewProcess($pr_proceso = '', $id_user, $debug = 'n') {
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = self::NameProcess();
        }
        do {
            $id_user_area = BDConsulta::consulta('user_area', array($id_user), $deb); // obtengo id del area
            if(is_null($id_user_area)) { // comprueba el área del user
                $error = true;
                $notice_error = 'Área desconocida.';
                break;
            }
            $id_area = reset($id_user_area);
            $id_area = $id_area['id_sis_areas']; 
            // $id_cv_datos_personales = $id_user_area['id_cv_datos_personales']; 
            $id_proceso = BDConsulta::consulta('id_proceso', array($pr_proceso), $deb); // obtengo id del proceso
            if(is_null($id_proceso)) { // comprueba el proceso
                $error = true;
                $notice_error = 'Nombre del Proceso desconocido.';
                break;  
            }
            $id_proceso = reset($id_proceso);
            $id_proceso = $id_proceso['id_sis_procesos'];
            
            // Busca el id_sis_procesos_flujos_dias que corresponde con el proceso y el area, en orden 1, por que comienza.
            $search_sis_fl_dias = BDConsulta::consulta('search_sis_fl_dias', array($pr_proceso, $id_area, $id_proceso), $deb);
            if(count($search_sis_fl_dias) != 1 || is_null($search_sis_fl_dias) ) {
                $error = true;
                $notice_error = 'No puede comenzar el proceso.';
                break;  
            }
            $id_fl_dias = $search_sis_fl_dias[0]['id_fl_dias'];            
            // Inserto en tabla_proc
            $fecha_actual = date('d/m/Y');
            $fecha_actual_unix = Dates::ConvertToUnix($fecha_actual);

            $id_tabla_proc = BDConsulta::consulta('insert_tabla_proc', array($pr_proceso, $id_fl_dias, $id_user, $fecha_actual_unix), $deb);
                                        //hago el insert de tabla_proc, pongo fecha_alta, user, sis_procesos_flujos_dias
            if(is_null($id_tabla_proc)) {
                $error = true;
                $notice_error = 'No pudo crear registro del Proceso.';
                break;
            }

            // Hago el insert en id_tabla
            $id_tabla = BDConsulta::consulta('insert_tabla', array($pr_proceso, $id_tabla_proc), $deb);
            if(is_null($id_tabla)) { 
                $error = true;
                $notice_error = 'No pudo crear registro de la tabla Principal.';
                break;
            }

            // ingreso el id_tabla en la tabla_proc, me estaba faltando.
            $update_tabla_proc = BDConsulta::consulta('update_tabla_proc', array($pr_proceso, $id_tabla_proc, $id_tabla), 'n');
            if(is_null($update_tabla_proc)) {
                $error = true;
                $notice_error = 'No se pudo actualizar la tabla proceso.';
                break;  
            }

            $error = false;
            $notice_success = 'Se creó correctamente.';
            $notice_error = 'No existió ningún error.';
            $_SESSION['primer_proceso_creado'] = true;
            $_SESSION['id_tabla_proc'] = $id_tabla_proc;
            $_SESSION['id_tabla'] = $id_tabla;
            $resp = array(
                 'id_tabla' => $id_tabla,
                 'id_tabla_proc' => $id_tabla_proc,
                 'id_flujo' => $id_fl_dias,
                 'error' => $error,
                 'notice_error' => $notice_error,
                  'notice_success' => $notice_success,
                 );
        } while (0);

        
        if(!isset($resp)) { // salida con errores
            $resp = array(
                 'id_tabla' => '',
                 'id_tabla_proc' => '',
                 'id_flujo' => '',
                 'error' => $error,
                 'notice_error' => $notice_error,
                  'notice_success' => '',
                 );
        }
    
        return $resp;

    }



    // TABLA PRINCIPAL, MODIFICACION
    public static function ModifyPrinc($pr_proceso, $id_tabla, $id_tabla_proc) {
        do {
            $create_tmp = BDConsulta::consulta('create_tmp', array($pr_proceso, $id_tabla), 'n');
            $select_last = BDConsulta::consulta('select_last', array($pr_proceso), 'n');
            if(is_null($select_last)) {
                $error = true;
                $notice_error = 'No Pudo seleccionar ultimo id.';
                break;  
            }
            $select_last = reset($select_last);
            $id_select_last = $select_last['id_' . $pr_proceso];
            $future_insert = $id_select_last + 1;
            $update_tmp = BDConsulta::consulta('update_tmp', array($pr_proceso, $future_insert, $id_tabla), 'n');
            if(is_null($update_tmp)) {
                $error = true;
                $notice_error = 'No pudo hacer el update correspondiente.';
                break;  
            }
            $duplicate_reg = BDConsulta::consulta('duplicate_reg', array($pr_proceso, $future_insert), 'n');
            if(is_null($duplicate_reg)) {
                $error = true;
                $notice_error = 'No pudo duplicar el registro para hacer la modificación.';
                break;  
            }
            $update_tabla = BDConsulta::consulta('update_tabla', array($pr_proceso, $id_tabla_proc, $duplicate_reg), 'n');
            if(is_null($update_tabla)) {
                $error = true;
                $notice_error = 'No pudo hacer el update de la tabla para hacer la modifincación correspondiente.';
                break;  
            }
            $update_id_proc = BDConsulta::consulta('update_id_proc_null', array($pr_proceso, $id_tabla), 'n');
            if(is_null($update_id_proc)) {
                $error = true;
                $notice_error = 'No pudo hacer el update de la tabla para hacer la modificación correspondiente.';
                break;  
            }
            $error = false;
            $notice_success = 'Registro modificado correctamente';
            $resp = array(
                 'error' => $error,
                 'notice_error' => 'No hubo errores',
                  'notice_success' => $notice_success,
                 );
        } while(0);

        if(!isset($resp)) { // salida con errores
            $resp = array(
                 'error' => $error,
                 'notice_error' => $notice_error,
                  'notice_success' => 'Hubo un error',
                 );
        }

        return $resp;


    }

    public static function UpdatePrinc($pr_proceso, $id_tabla, $observacion, $debug = 'n') {
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = self::NameProcess();
        }
        do {
            $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($pr_proceso, $id_tabla, $observacion), $deb);
            if(is_null($update_tabla_princ)) {
                $error = true;
                $notice_error = 'no pudo hacer el update en tabla principal.';
                $notice_success = '';
                break;  
            }
            $error = false;
            $notice_success = 'Registro modificado correctamente';
            $notice_error = '';
        } while(0);

        $resp = array(
                 'error' => $error,
                 'notice_error' => $notice_error,
                  'notice_success' => $notice_success,
                 );
        
        
        
        return $resp;
    }


    // TABLA SECUNDARIA, CREACION
    public static function CreateSec($pr_proceso, $name_sec, $id_tabla_proc, $debug = 'n') {
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = self::NameProcess();
        }
        $insert_sec = BDConsulta::consulta('insert_sec', array($pr_proceso, $name_sec, $id_tabla_proc), $deb);
        if(is_null($insert_sec)) {
            $resp = array(
                 'id_tabla_sec' => '',
                 'error' => true,
                 'notice_error' => 'No pudo ser insertado el registro.',
                  'notice_success' => 'Hubo un error',
                 );
        }else{
            $resp = array(
                 'id_tabla_sec' => $insert_sec,
                 'error' => false,
                 'notice_error' => '',
                  'notice_success' => 'Registro creado.',
                 );
        }
        return $resp;
    }

    // TABLA SECUNDARIA, MODIFICACION.
    public static function ModifySec($pr_proceso, $name_sec, $id_tabla_sec, $debug = 'n') {
        $notice_error = ''; $notice_success = ''; $error = false;
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = self::NameProcess();
        }
        do {
            $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($pr_proceso, $name_sec,  $id_tabla_sec), $deb);
            if(is_null($update_tmp_sec)) {
                $error = true;
                $notice_error = 'No pudo hacer un update correctamente. No se pudo eliminar.';
                break;  
            }
            $notice_success = 'Modificado';
        } while(0);
        $resp = array(
                         'error' => $error,
                         'notice_error' => $notice_error,
                         'notice_success' => $notice_success,
                         );
        return $resp;
    }

    // TABLA SECUNDARIA, ELIMINACION.
    public static function DeleteSec($pr_proceso, $name_sec, $id_tabla_sec, $debug = 'n') {
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = self::NameProcess();
        }
        do {
            $create_tmp_sec = BDConsulta::consulta('create_tmp_sec', array($pr_proceso, $name_sec, $id_tabla_sec), $deb);
            
            $select_last_sec = BDConsulta::consulta('select_last_sec', array($pr_proceso, $name_sec), $deb);
            if(is_null($select_last_sec)) {
                $error = true;
                $notice_error = 'No pudo seleccionar ultimo registro correctamente. No se pudo eliminar.';
                break;  
            }
            
            $select_last_sec = reset($select_last_sec);
            $id_select_last_sec = $select_last_sec['id_' . $pr_proceso . '_' . $name_sec];
            $future_insert_sec = $id_select_last_sec + 1;
            $update_tmp_sec = BDConsulta::consulta('update_tmp_sec', array($pr_proceso, $name_sec,  $future_insert_sec, $id_tabla_sec), $deb);
            if(is_null($update_tmp_sec)) {
                $error = true;
                $notice_error = 'No pudo hacer un update correctamente. No se pudo eliminar.';
                break;  
            }

            $duplicate_reg_sec = BDConsulta::consulta('duplicate_reg_sec', array($pr_proceso, $name_sec,  $future_insert_sec), $deb);
            if(is_null($duplicate_reg_sec)) {
                $error = true;
                $notice_error = 'No pudo duplicar el registro correctamente. No se pudo eliminar.';
                break;  
            }

            $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($pr_proceso, $name_sec,  $duplicate_reg_sec), $deb);
            if(is_null($update_tabla_sec)) {
                $error = true;
                $notice_error = 'No pudo hacer un update correctamente. No se pudo eliminar.';
                break;  
            }

            $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($pr_proceso, $name_sec,  $id_tabla_sec), $deb);
            if(is_null($update_tmp_sec)) {
                $error = true;
                $notice_error = 'No pudo hacer un update correctamente. No se pudo eliminar.';
                break;  
            }
            $resp = array(
                 'error' => false,
                 'notice_error' => 'No hubo error.',
                  'notice_success' => 'Se eliminó correctamente el registro',
                 );
        } while(0);
        if(!isset($resp)) { // salida con errores
            $resp = array(
                 'error' => $error,
                 'notice_error' => $notice_error,
                  'notice_success' => 'Hubo un error',
                 );
        }
        return $resp;
    }


    // me devuelve el id_sis_prosesos_flujos_dias anterior al que le ingreso.
    public static function ProcesoAnterior($id_fl_dias, $debug = 'n') {
        $debug == 's' ? $deb = 's' : $deb = 'n';
        $notice_success = ''; $notice_error = ''; $id_fl_dias_ant = 0; 
        do {
            // selecciono el registro del sis_proceso_flujos_dias
            $select_pr_dias = BDConsulta::consulta('select_pr_dias', array($id_fl_dias), $deb);
            if(is_null($select_pr_dias)) {
                $error = true;
                $notice_error = 'No pudo encontrar el orden del proceso correspondiente.';
                break;  
            }
            $select_pr_dias = reset($select_pr_dias);
            $pr_orden = $select_pr_dias['pr_orden'];
            $pr_orden_anterior = $pr_orden - 1;
            $id_proceso = $select_pr_dias['id_proceso'];
            
            // selecciono el registro anterior del sis_proceso_flujos_dias
            $select_pr_dias_anterior = BDConsulta::consulta('select_pr_dias_anterior', array($id_proceso, $pr_orden_anterior), $deb);
            if(is_null($select_pr_dias_anterior)) {
                $error = true;
                $notice_error = 'No pudo encontrar el orden del proceso anterior';
                break;  
            }
            $select_pr_dias_anterior = reset($select_pr_dias_anterior);
            $id_fl_dias_ant = $select_pr_dias_anterior['id_sis_procesos_flujos_dias'];
            // llegó hasta acá sin errores.
            $error = false;
            $notice_success = 'Proceso anterior encontrado';
        }while(0);

        $resp = array('error' => $error,
                                'notice_error' => $notice_error,
                                'notice_success' => $notice_success,
                                'id_fl_dias_ant' => $id_fl_dias_ant,
                                );
        return $resp;
    }


    // me devuelve el id_sis_prosesos_flujos_dias anterior al que le ingreso.
    // Aqui paso el tabla_proc, asi que me devuelve el id_flujo_dia exacto anterior.
    public static function FlDiasAnterior($pr_proceso, $id_tabla_proc, $debug = 'n') {
        $debug == 's' ? $deb = 's' : $deb = 'n';
        $notice_error = ''; $notice_success = ''; $id_fl_dias_ant = ''; $error = false;
        if($pr_proceso == '') {
            $pr_proceso = self::NameProcess();
        }
        do {
            // selecciono el registro del sis_proceso_flujos_dias
            $proceso_anterior = self::getProcesoAnterior($pr_proceso, $id_tabla_proc);
            if(is_null($proceso_anterior)) {
                $error = true;
                $notice_error = 'No pudo encontrar el proceso anterior';
                break;  
            }
            $id_fl_dias_ant = $proceso_anterior['id_fl_dias'];
        }while(0);

        $resp = array('error' => $error,
                                'notice_error' => $notice_error,
                                'notice_success' => $notice_success,
                                'id_fl_dias_ant' => $id_fl_dias_ant,
                                );
        return $resp;
    }


    public static function getFirstProcess($pr_proceso, $id_tabla) {
        $notice_error = ''; $notice_success = ''; $error = false;
        $first_process = BDConsulta::consulta('first_process', array($pr_proceso, $id_tabla), 'n');
        return $first_process;
    }

    // Una version mejorada de getFisrtProcess(la anterior)
    public static function getOnlyFirstProcess($pr_proceso, $id_tabla, $debug) {
        $notice_error = ''; $notice_success = ''; $error = false;
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = self::NameProcess();
        }
        do {
            $first_process = BDConsulta::consulta('first_process', array($pr_proceso, $id_tabla), $deb);
            if(is_null($first_process)) {
                $error = true;
                $notice_error = 'No existe un primer proceso para ese registro.';
                break;
            }
            $first_process = $first_process[0];
        }while(0);

        if($error == false) {
            $resp = $first_process; // Si no hubo errores, devuelve el array
        }else{ // HUBO ERRORES
            $resp = array(
                'error' => $error,
                 'notice_error' => $notice_error,
                  'notice_success' => $notice_success,
                 );
        }

        return $resp;
    }

    public static function getLastProcess($pr_proceso, $id_tabla_proc) {
        $notice_error = ''; $notice_success = ''; $error = false;
        $all_proc = self::getAllTablaProc($pr_proceso, $id_tabla_proc);



        

        $last_proc = end($all_proc);
        return $last_proc;
    }

    public static function getLastLastProcess($pr_proceso, $id_tabla_proc) {
        $notice_error = ''; $notice_success = ''; $error = false;
        $all_proc = self::getAllTablaProc($pr_proceso, $id_tabla_proc);
        
        $cant_elem = count($all_proc);

        if($cant_elem == 1) {
            $last_last_proc = $all_proc;    
        }elseif($cant_elem == 2){
            array_pop($all_proc);
            $last_last_proc = $all_proc;
        }elseif($cant_elem > 2){
            $last_last_proc = array_slice($all_proc, $cant_elem - 2, 1 );
        }
        return $last_last_proc;
    }

    // Nos develve el id_tabla_proc anterior al dado.
    public static function getProcesoAnterior($pr_proceso, $id_tabla_proc) {
        $notice_error = ''; $notice_success = ''; $error = false;
        $all_proc = self::getAllTablaProc($pr_proceso, $id_tabla_proc);
        $cant_elem = count($all_proc);
        if($cant_elem == 1) {
            // $proceso_anterior = $all_proc;    
            $proceso_anterior = null;    // no tiene un proceso anterior
        }elseif($cant_elem > 1){
            $cant_elem = $cant_elem - 2;
            $proceso_anterior = $all_proc[$cant_elem];
        }
        return $proceso_anterior;
    }


    public static function getFlDias($pr_proceso, $id_tabla_proc, $debug = 'n') {
        $notice_error = ''; $notice_success = ''; $error = false;
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = self::NameProcess();
        }
        // obtengo orden_proceso actual (antes de click en enviar)
        $proceso_orden_flujos = BDConsulta::consulta('proceso_orden_flujos', array($pr_proceso, $id_tabla_proc), $deb);
        if(is_null($proceso_orden_flujos)) {
            $error = true;
            $notice_error = 'no existe el orden del proceso actual.';
            break;  
        }
        $id_fl_dias = $proceso_orden_flujos[0]['id_fl_dias'];

        if($error == false) {
            $resp = $id_fl_dias; // Si no hubo errores
        }else{ // HUBO ERRORES
            $resp = array(
                'error' => $error,
                 'notice_error' => $notice_error,
                  'notice_success' => $notice_success,
                 );
        }

        return $resp;
    }



    // Nos devuelve todos los registros de tabla_proc en el proceso dado ordenado por id_tabla_proc
    public static function getAllTablaProc($pr_proceso, $id_tabla_proc, $debug = 'n') {
        $notice_error = ''; $notice_success = ''; $error = false;
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = self::NameProcess();
        }
        do {
            // selecciono el registro tabla_proc para obtener el id_tabla
            $select_tabla_proc = BDConsulta::consulta('select_tabla_proc', array($pr_proceso, $id_tabla_proc), $deb);
            if(is_null($select_tabla_proc)) {
                $error = true;
                $notice_error = 'Error en consulta. Vueva a intentarlo.';
                break;      
            }
            $id_tabla = $select_tabla_proc[0]['id_' . $pr_proceso];


            $id_proceso = BDConsulta::consulta('id_proceso', array($pr_proceso), $deb); // obtengo id del proceso
            if(is_null($id_proceso)) {
                $error = true;
                $notice_error = 'No pudo obtener ir id del nombre del proceso';
                break;      
            }
            $id_proceso = $id_proceso[0]['id_sis_procesos'];

            // selecciona todas las tabla_proc referidas a este proceso, ya ordenadas por pr_orden
            $select_all_proc_same_tabla = BDConsulta::consulta('select_all_proc_same_tabla', array($pr_proceso, $id_proceso, $id_tabla), $deb);
            if(is_null($select_all_proc_same_tabla)) {
                $error = true;
                $notice_error = 'No pudo seleccionar todas las tablas_proc ordenadas por número de proceso.';
                break;      
            }
            // Debe poner el esatdo en cada proceso. COMENZADO / ACEPTADO / RECHAZADO
            foreach($select_all_proc_same_tabla as $k => &$pr) {
                
                if($pr['pr_orden'] == 1 && $pr['id_relacionado'] == null || $pr['pr_orden'] != 1 && $pr['id_relacionado'] == null ) {
                    $pr['estado'] = "ACEPTADO";    
                }
                if($pr['pr_orden'] == 1 && $k == 0) {
                    $pr['estado'] = "COMENZADO";    
                }
                if($pr['pr_orden'] != 1 && $pr['id_relacionado'] != null) {
                    $pr['estado'] = "SOLICITA CORRECCIÓN";    
                }
            }
        } while(0);

        if($error == false) {
            $resp = $select_all_proc_same_tabla; // Si no hubo errores, devuelve el array con todos los tabla_proc ordenados por proceso.
        }else{ // HUBO ERRORES
            $resp = array(
                'error' => $error,
                 'notice_error' => $notice_error,
                  'notice_success' => $notice_success,
                 );
        }

        return $resp;
    }




    // devuelve el registro principal de id_tabla_proc
    public static function getTabla($pr_proceso, $id_tabla_proc, $debug = 'n', $id_uno = '', $id_dos = '', $id_tres = '', $id_cuatro = '') {
        // action -> 'enviar', 'aprobar', 'desaprobar', 'correccion'
        $notice_error = ''; $notice_success = ''; $error = false;
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = self::NameProcess();
        }
        do {
            // selecciono el registro tabla_proc para obtener el id_tabla
            $select_tabla_proc = BDConsulta::consulta('select_tabla_proc', array($pr_proceso, $id_tabla_proc), $deb);
            if(is_null($select_tabla_proc)) {
                $error = true;
                $notice_error = 'No pudo hallar la tabla principal';
                break;      
            }
            $id_tabla = $select_tabla_proc[0]['id_' . $pr_proceso];
            
            // Selecciona los registros de tabla
            if($id_uno == '' && $id_dos == '' && $id_tres == '' && $id_cuatro == '') {
                $select_tabla = BDConsulta::consulta('select_tabla', array($pr_proceso, $id_tabla), $deb);    
                if(is_null($select_tabla)) {
                    $error = true;
                    $notice_error = 'No pudo hallar la tabla principal';
                    break;      
                }
            // Selecciona los registros de tabla, con UNA RELACION
            }elseif($id_uno != '' && $id_dos == '' && $id_tres == '' && $id_cuatro == ''){ 
                $select_tabla = BDConsulta::consulta('select_tabla_rel_una', array($pr_proceso, $id_uno, $id_tabla), $deb);
                if(is_null($select_tabla)) {
                    $error = true;
                    $notice_error = 'No pudo hacer la consulta correctamente o no existen registros';
                    break;      
                }
            // Selecciona los registros de tabla, con DOS RELACIONES
            }elseif($id_uno != '' && $id_dos != '' && $id_tres == '' && $id_cuatro == ''){ 
                $select_tabla = BDConsulta::consulta('select_tabla_rel_dos', array($pr_proceso, $id_uno, $id_dos, $id_tabla), $deb);
                if(is_null($select_tabla)) {
                    $error = true;
                    $notice_error = 'No pudo hacer la consulta correctamente o no existen registros';
                    break;      
                }
            // Selecciona los registros de tabla, con TRES RELACIONES
            }elseif($id_uno != '' && $id_dos != '' && $id_tres != '' && $id_cuatro == ''){ 
                $select_tabla = BDConsulta::consulta('select_tabla_rel_tres', array($pr_proceso, $id_uno, $id_dos, $id_tres, $id_tabla), $deb);
                if(is_null($select_tabla)) {
                    $error = true;
                    $notice_error = 'No pudo hacer la consulta correctamente o no existen registros';
                    break;      
                }
            // Selecciona los registros de tabla, con CUATRO RELACIONES
            }elseif($id_uno != '' && $id_dos != '' && $id_tres != '' && $id_cuatro != ''){ 
                $select_tabla = BDConsulta::consulta('select_tabla_rel_cuatro', array($pr_proceso, $id_uno, $id_dos, $id_tres, $id_cuatro, $id_tabla), $deb);
                if(is_null($select_tabla)) {
                    $error = true;
                    $notice_error = 'No pudo hacer la consulta correctamente o no existen registros';
                    break;      
                }
            }else{ // hay algo mal en los parametros de las relaciones.
                $error = true;
                $notice_error = 'Mal ingresados los parámetros de las relaciones';
            }

            // $select_tabla = BDConsulta::consulta('select_tabla', array($pr_proceso, $id_tabla), $deb);    
            // if(is_null($select_tabla)) {
            //         $error = true;
            //         $notice_error = 'No pudo hallar la tabla principal';
            //         break;      
            //     }
        }while(0);

        if($error == false) {
            $resp = $select_tabla; // Si no hubo errores, devuelve el array con los registros de tabla
        }else{ // HUBO ERRORES
            $resp = array(
                'error' => $error,
                 'notice_error' => $notice_error,
                  'notice_success' => $notice_success,
                 );
        }

        return $resp;
    }



    // devuelve los registros de la tabla secundaria segun tabla_proc. Podemos poner hasta 3 campos relacionados
    public static function getTablaSec($pr_proceso, $pr_proceso_sec, $id_tabla_proc, $debug = 'n',
                                                            $id_uno = '', $id_dos = '', $id_tres = '', $id_rel_uno = '', $id_rel_uno_otra = '', $id_rel_ult = '' ) {
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = self::NameProcess();
        }
        $notice_error = '';
        $notice_success = '';
        $error = false;
        do {
            $all_tabla_proc = self::getAllTablaProc($pr_proceso, $id_tabla_proc, $deb);
            if(is_null($all_tabla_proc) || isset($all_tabla_proc['error']) && $all_tabla_proc['error']  == true) {
                $error = true;
                $notice_error = 'No pudo hallar registros para mostrar Tablas secundarias.';
                break;
            }
            // detecta el Primer id_tabla_proc para relacionarlo con tabla_sec
            foreach($all_tabla_proc as $k => $p) {
                if($p['pr_orden'] == 1 && $p['id_relacionado'] == null) {
                    $id_tabla_proc = $p['id_tabla_proc']; 
                    break;
                }
            }

            // Selecciona los registros de tabla_sec
            if($id_uno == '' && $id_dos == '' && $id_tres == '' && $id_rel_uno == '' && $id_rel_uno_otra == '' && $id_rel_ult == '') {
                $select_tabla_sec = BDConsulta::consulta('select_tabla_sec', array($pr_proceso, $pr_proceso_sec, $id_tabla_proc), $deb);        
                if(is_null($select_tabla_sec)) {
                    $error = true;
                    $notice_error = 'No pudo hacer la consulta correctamente o no existen registros';
                    break;      
                }
            // Selecciona los registros de tabla_sec, con UNA RELACION
            }elseif($id_uno != '' && $id_dos == '' && $id_tres == '' && $id_rel_uno == '' && $id_rel_uno_otra == '' && $id_rel_ult == ''){ 
                $select_tabla_sec = BDConsulta::consulta('select_tabla_sec_rel_una', array($pr_proceso, $pr_proceso_sec, $id_uno, $id_tabla_proc), $deb);
                if(is_null($select_tabla_sec)) {
                    $error = true;
                    $notice_error = 'No pudo hacer la consulta correctamente o no existen registros';
                    break;      
                }
            // Selecciona los registros de tabla_sec, con DOS RELACIONES
            }elseif($id_uno != '' && $id_dos != '' && $id_tres == '' && $id_rel_uno == '' && $id_rel_uno_otra == '' && $id_rel_ult == ''){ 
                $select_tabla_sec = BDConsulta::consulta('select_tabla_sec_rel_dos', array($pr_proceso, $pr_proceso_sec, $id_uno, $id_dos, $id_tabla_proc), $deb);
                if(is_null($select_tabla_sec)) {
                    $error = true;
                    $notice_error = 'No pudo hacer la consulta correctamente o no existen registros';
                    break;      
                }
            // Selecciona los registros de tabla_sec, con TRES RELACIONES
            }elseif($id_uno != '' && $id_dos != '' && $id_tres != '' && $id_rel_uno == '' && $id_rel_uno_otra == '' && $id_rel_ult == ''){ 
                $select_tabla_sec = BDConsulta::consulta('select_tabla_sec_rel_tres', array($pr_proceso, $pr_proceso_sec, $id_uno, $id_dos, $id_tres, $id_tabla_proc), $deb);
                if(is_null($select_tabla_sec)) {
                    $error = true;
                    $notice_error = 'No pudo hacer la consulta correctamente o no existen registros';
                    break;      
                }
            // una relacion, y esta a su vez con otra.
            }elseif($id_uno != '' && $id_dos == '' && $id_tres == '' && $id_rel_uno != '' && $id_rel_uno_otra == '' && $id_rel_ult == ''){ 
                $select_tabla_sec = BDConsulta::consulta('select_tabla_sec_rel_una_otra', array($pr_proceso, $pr_proceso_sec, $id_uno, $id_rel_uno, $id_tabla_proc), $deb);
                if(is_null($select_tabla_sec)) {
                    $error = true;
                    $notice_error = 'No pudo hacer la consulta correctamente o no existen registros';
                    break;      
                }
            // una relacion, a su vez con otra, y a su vez con otra más.
            }elseif($id_uno != '' && $id_dos == '' && $id_tres == '' && $id_rel_uno != '' && $id_rel_uno_otra != '' && $id_rel_ult == ''){ 
                $select_tabla_sec = BDConsulta::consulta('select_tabla_sec_rel_una_otra_otra', array($pr_proceso, $pr_proceso_sec, $id_uno, $id_rel_uno, $id_rel_uno_otra, $id_tabla_proc), $deb);
                if(is_null($select_tabla_sec)) {
                    $error = true;
                    $notice_error = 'No pudo hacer la consulta correctamente o no existen registros';
                    break;      
                }
            }elseif($id_uno != '' && $id_dos == '' && $id_tres == '' && $id_rel_uno != '' && $id_rel_uno_otra != '' && $id_rel_ult != ''){ 
                $select_tabla_sec = BDConsulta::consulta('select_tabla_sec_rel_una_ult', array($pr_proceso, $pr_proceso_sec, $id_uno, $id_rel_uno, $id_rel_uno_otra, $id_rel_ult, $id_tabla_proc), $deb);
                if(is_null($select_tabla_sec)) {
                    $error = true;
                    $notice_error = 'No pudo hacer la consulta correctamente o no existen registros';
                    break;      
                }
            }else{ // hay algo mal en los parametros de las relaciones.
                $error = true;
                $notice_error = 'Mal ingresados los parámetros de las relaciones';
            }

        }while(0);

        if($error == false) {
            $resp = $select_tabla_sec; // Si no hubo errores, devuelve el array con los registros de tabla_sec
        }else{ // HUBO ERRORES
            $resp = array(
                'error' => $error,
                 'notice_error' => $notice_error,
                  'notice_success' => $notice_success,
                 );
        }

        return $resp;
    }


    // Devuelve la suma del campo dado
    public static function getTablaSecTotal($pr_proceso, $pr_proceso_sec, $id_tabla_proc, $sum = '', $debug = 'n') {
        $notice_error = ''; $notice_success = ''; $error = false;
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = self::NameProcess();
        }

        do {
            $all_tabla_proc = self::getAllTablaProc($pr_proceso, $id_tabla_proc, $deb);
           
            if(is_null($all_tabla_proc) || isset($all_tabla_proc['error']) && $all_tabla_proc['error']  == true) {
                $error = true;
                $notice_error = 'No pudo hallar registros para mostrar Tablas secundarias.';
                break;
            }
            // detecta el Primer id_tabla_proc para relacionarlo con tabla_sec
            foreach($all_tabla_proc as $k => $p) {
                if($p['pr_orden'] == 1 && $p['id_relacionado'] == null) {
                    $id_tabla_proc = $p['id_tabla_proc']; 
                    break;
                }
            }
            // Selecciona los registros de tabla_sec
            $tabla_sec_monto_total = BDConsulta::consulta('tabla_sec_monto_total', array($pr_proceso, $pr_proceso_sec, $id_tabla_proc, $sum), $deb);
            
            
            if(is_null($tabla_sec_monto_total)) {
                $error = true;
                $notice_error = 'No pudo calcular el monto total';
                break;      
            }
        }while(0);
        if($error == false) {
            $resp = $tabla_sec_monto_total[0]; // Si no hubo errores, devuelve el monto total.
        }else{ // HUBO ERRORES
            $resp = array(
                'error' => $error,
                 'notice_error' => $notice_error,
                  'notice_success' => $notice_success,
                 );
        }
        return $resp;
    }

    public static function getValuesSelect($tabla, $id_valor, $valor, $debug = 'n', $tabla_rel = '', $id_valor_rel = '', $valor_rel = '') {
        $notice_error = ''; $notice_success = ''; $error = false;
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($tabla_rel == '' && $id_valor_rel == '' && $valor_rel == '') {
            $values_select = BDConsulta::consulta('values_select', array($tabla, $id_valor, $valor), $deb);    
        }
        if($tabla_rel != '' && $id_valor_rel != '' && $valor_rel != '') {
            $values_select = BDConsulta::consulta('values_select_rel', array($tabla, $id_valor, $valor, $tabla_rel, $id_valor_rel, $valor_rel), $deb);    
        }
        
        
        if(is_null($values_select)) {
            $resp = 0; // no pudo hacer el array con los valores
        }else{
            $resp = $values_select;
        }
        return $resp;
    }

    public static function getValuesSelectRel($tabla_uno, $tabla_dos, $tabla_tres, $tabla_cuatro, $where, $debug = 'n') {
        $notice_error = ''; $notice_success = ''; $error = false;
        $debug == 's' ? $deb = 's' : $deb = 'n';

        if($tabla_uno != '' && $tabla_dos == '' && $tabla_tres == '' && $tabla_cuatro == '' && $where == '') {
            $values_select = BDConsulta::consulta('select_uno', array($tabla_uno), $deb);    
        }elseif($tabla_uno != '' && $tabla_dos != '' && $tabla_tres == '' && $tabla_cuatro == '' && $where == '') {
            $values_select = BDConsulta::consulta('select_dos', array($tabla_uno, $tabla_dos), $deb);    
        }elseif($tabla_uno != '' && $tabla_dos != '' && $tabla_tres != '' && $tabla_cuatro == '' && $where == '') {
            $values_select = BDConsulta::consulta('select_tres', array($tabla_uno, $tabla_dos, $tabla_tres), $deb);        
        }elseif($tabla_uno != '' && $tabla_dos != '' && $tabla_tres != '' && $tabla_cuatro != '' && $where == '') {
            $values_select = BDConsulta::consulta('select_cuatro', array($tabla_uno, $tabla_dos, $tabla_tres, $tabla_cuatro), $deb);    
        }else{
            $values_select = null; // Es posible que estén mal ingresados los parámetros. Hay un orden para ingresarlos.
        }
        if(is_null($values_select)) {
            $resp = false; // No pudo hacer correctamente la consulta o los parámteros fueron mal ingresados.
        }else{
            $resp = $values_select;
        }
        return $resp;
    }

    public static function getFiles($pr_proceso, $id_tabla_proc, $debug = 'n') {
        $notice_error = ''; $notice_success = ''; $error = false;
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = self::NameProcess();
        }

        do {
            // selecciono el registro tabla_proc para obtener el id_tabla
            $select_tabla_proc = BDConsulta::consulta('select_tabla_proc', array($pr_proceso, $id_tabla_proc), $deb);
            if(is_null($select_tabla_proc)) {
                $error = true;
                $notice_error = 'No pudo hallar la tabla principal';
                break;      
            }
            $id_tabla = $select_tabla_proc[0]['id_' . $pr_proceso];
            $first_process = self::getFirstProcess($pr_proceso, $id_tabla);
            if(is_null($first_process)) {
                $error = true;
                $notice_error = 'No pudo hallar primer proceso';
                break;      
            }
            $id_tabla_proc = $first_process[0]['id_' . $pr_proceso . '_proc'];
            $nombres_archivos = BDConsulta::consulta('nombres_archivos', array($pr_proceso, $id_tabla_proc), $deb);  
            if(is_null($nombres_archivos)) {
                $error = true;
                $notice_error = 'No pudo hallar los nombres de los archivos';
                break;      
            }
        }while(0);
        if($error == false):
                $resp = $nombres_archivos;
        else: // HUBO ERRORES
            $resp = array(
                            'error' => $error,
                            'notice_error' => $notice_error,
                            'notice_success' => $notice_success);
        endif;
        return $resp;
    }

    // devuelve el registro principal de id_tabla_proc
    public static function getUser($id_user, $debug = 'n') {
        // action -> 'enviar', 'aprobar', 'desaprobar', 'correccion'
        $notice_error = ''; $notice_success = ''; $error = false;
        $debug == 's' ? $deb = 's' : $deb = 'n';
        do {
            // selecciono el registro tabla_proc para obtener el id_tabla
            $user = BDConsulta::consulta('empleado_nombres', array($id_user), $deb);
            if(is_null($user)) {
                $error = true;
                $notice_error = 'No pudo hallar el usuario';
                break;      
            }
        }while(0);
        if($error == false) {
            $resp = $user; // Si no hubo errores, devuelve el array con el user(nombre, apellido, area)
        }else{ // HUBO ERRORES
            $resp = array(
                'error' => $error,
                 'notice_error' => $notice_error,
                  'notice_success' => $notice_success,
                 );
        }

        return $resp;
    }

    public static function isLastProcess($pr_proceso, $id_tabla_proc) {
        $notice_error = ''; $notice_success = ''; $is_last = false;
        $all_proc = self::getAllTablaProc($pr_proceso, $id_tabla_proc);
        $last_proc = end($all_proc);
        if(isset($last_proc['id_tabla_proc']) && $last_proc['id_tabla_proc'] == $id_tabla_proc) {
            $is_last = true;
        }
        return $is_last;
    }


    public static function isFirstProcess($pr_proceso, $id_tabla_proc) {
        if($pr_proceso == '') {
            $pr_proceso = self::NameProcess();
        }
        $id_fl_dias_ant = self::FlDiasAnterior($pr_proceso, $id_tabla_proc);
        if($id_fl_dias_ant['error'] == false) {
            $resp = false;
        }else{
            
            $resp = true;
        }
        return $resp;
    }

    public static function isRepeatProcess($pr_proceso, $id_tabla_proc) {
        $is_repeat = false;
        if($pr_proceso == '') {
            $pr_proceso = self::NameProcess();
        }
        $id_fl_dias = self::getFlDias($pr_proceso, $id_tabla_proc);
        $all_proc = self::getAllTablaProc($pr_proceso, $id_tabla_proc);
        foreach($all_proc as $k => $pr) { // deseteo el proceso dado.
            if($pr['id_tabla_proc'] == $id_tabla_proc) {
                unset($all_proc[$k]);
            }
        }
        foreach($all_proc as $pr) { // Busco si existe otro fl_dias en los procesos
            if($pr['id_fl_dias'] == $id_fl_dias) {
                $is_repeat = true;
            }
        }
        return $is_repeat;
    }


    





















}