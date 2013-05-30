<?php

class ProcessSends {
    
    // Envía al proximo proceso. El parámetro $id_area si no está en cero, debe especificar a que área lo vamos a enviar;
    // es para pocos casos, por ejemplo en "ger_otros_pedidos"
    public static function toNextProcess($pr_proceso, $id_user, $id_tabla_proc, $comment, $action = 'enviar', $debug = 'n', $id_next_area = 0) {
        // $action  ->  'enviar', 'aprobar', 'desaprobar', 'correccion'
        $notice_error = ''; $notice_success = ''; $error = false;
        $debug == 's' ? $deb = 's' : $deb = 'n';
        if($pr_proceso == '') {
            $pr_proceso = Process::NameProcess();
        }

        do {
            // Fecha Actual, normal y UNIX
            $date = date('d/m/Y');
            $date_unix = Dates::ConvertToUnix($date);
            // Comprueba que exista el usuario
            $exist_user = BDConsulta::consulta('exist_user', array($id_user), $deb);
            if(is_null($exist_user)) {
                $error = true;
                $notice_error = 'El usuario ingresado no existe.';
                break;  
            }
            // obtengo $id_area
            $id_area = BDConsulta::consulta('user_area', array($id_user), $deb);
            if(is_null($id_area)) { // comprueba el área del user
                $error = true;
                $notice_error = 'Área desconocida.';
                break;
            }
            $id_area = $id_area[0]['id_sis_areas'];
            // obtengo id del nombre del proceso
            $id_sis_procesos = BDConsulta::consulta('id_proceso', array($pr_proceso), $deb); 
            if(is_null($id_sis_procesos)) {
                $error = true;
                $notice_error = 'No existe el id del nombre del proceso.';
                break;  
            }else{
                $id_proceso = $id_sis_procesos[0]['id_sis_procesos'];
            }
            // obtengo orden_proceso actual (antes de click en enviar)
            $proceso_orden_flujos = BDConsulta::consulta('proceso_orden_flujos', array($pr_proceso, $id_tabla_proc), $deb);
            if(is_null($proceso_orden_flujos)) {
                $error = true;
                $notice_error = 'no existe el orden del proceso actual.';
                break;  
            }
            $id_fl_dias = $proceso_orden_flujos[0]['id_fl_dias'];
            $pr_orden = $proceso_orden_flujos[0]['orden']; // nro de orden del proceso
            $pr_orden_next = $pr_orden + 1;
            
            // Consulto si existe un orden_proceso siguiente. Y si es así guardo id del sis_proceso_flujos_dias
            if($action != 'enviar_area') { // ME ASEGURO DE QUE NO TENGA Q MANDAR A UN AREA ESPECIFICA, SI NO AL SIGUIENTE PROCESO.
                $id_next_proc_orden = BDConsulta::consulta('id_next_proc_orden', array($id_proceso, $pr_orden_next), $deb); 
                if(is_null($id_next_proc_orden)) {
                    $next_proc = false; // no existe un siguiente paso
                }else{
                    $next_proc = true; // existe un siguiente paso
                    $id_fl_dias_next = $id_next_proc_orden[0]['id'];
                }    
            
            }elseif($action == 'enviar_area') { // HAY QUE ENVIAR A UN ÁREA ESPECIFICA
                if($id_next_area == 0) {
                    $error = true;
                    $notice_error = 'falta especificar el área a donde va a estar enviado.';
                    break;        
                }
                // TODO: también debe verificar que el área ingresada sea una existente.
                $id_next_proc_orden = BDConsulta::consulta('id_next_proc_orden_area', array($id_proceso, $pr_orden_next, $id_next_area), $deb); 
                if(is_null($id_next_proc_orden)) {
                    $next_proc = false; // no existe un siguiente paso
                }else{
                    $next_proc = true; // existe un siguiente paso
                    $id_fl_dias_next = $id_next_proc_orden[0]['id_sis_procesos_flujos_dias'];
                }
            }
            
            // obtengo el id_tabla (id de tabla principal)
            $id_tabla = Process::getTabla($pr_proceso, $id_tabla_proc, $deb);
            if(is_null($id_tabla)) {
                $error = true;
                $notice_error = 'no está relacionado con un id_tabla este id_process.';
                break;  
            }
            $id_tabla = $id_tabla[0]['id_tabla'];


            switch($action) {

                case 'enviar':
                    // Realizo en insert en id_proc (Hago un nuevo registro por que avanza un proceso)
                    if($next_proc == false) { // NO Existe un siguiente paso
                        $insert_proc_enviado_cierre = BDConsulta::consulta('insert_proc_enviado_cierre', array($pr_proceso, $id_tabla), $deb);
                        if(is_null($insert_proc_enviado_cierre)) {
                            $error = true;
                            $notice_error = 'no pudo hacer el insert del nuevo proceso';
                            break;
                        }
                        $error = false;
                        $notice_success = 'Proceso enviado correctamente y Proceso Cerrado ya que no existe siguiente Paso.';
                        $notice_error = '';
                    }else{ // Existe un siguiente PASO
                        // controlo que el siguiente paso no corresponda al mismo área, si as así avanzo otro orden más directamente.
                        $area_cons = BDConsulta::consulta('select_pr_dias', array($id_fl_dias_next), $deb); // consulto area q perteneces
                        if(is_null($area_cons)) {
                            $flash_error = 'error';
                            break;
                        }
                        if($area_cons[0]['id_area'] == $id_area) { // en el siguiente paso coinciden las áreas, etonces debe adelantar oto id_pr_fl_dias
                            // Consulto si existe un orden_proceso siguiente. Y si es así guardo id del sis_proceso_flujos_dias
                            $pr_orden_next++;
                            $id_next_proc_orden = BDConsulta::consulta('id_next_proc_orden', array($id_proceso, $pr_orden_next), $deb); 
                            if(is_null($id_next_proc_orden)) { // no existe un siguiente paso, debe guardar y cerrar.
                                $insert_proc_enviado_cierre = BDConsulta::consulta('insert_proc_enviado_cierre', array($pr_proceso, $id_tabla), $deb);
                                if(is_null($insert_proc_enviado_cierre)) {
                                    $error = true;
                                    $notice_error = 'no pudo hacer el insert del nuevo proceso';
                                    break;
                                }
                                $error = false;
                                $notice_success = 'Proceso enviado correctamente y Proceso Cerrado ya que no existe siguiente Paso.';
                                $notice_error = '';
                            }else{ //existe un siguiente paso
                                // $next_proc = true; 
                                $id_fl_dias_next = $id_next_proc_orden[0]['id'];
                            }
                        }
                        $insert_proc_enviado = BDConsulta::consulta('insert_proc_enviado', array($pr_proceso, $id_tabla, $id_fl_dias_next), $deb);
                        if(is_null($insert_proc_enviado)) {
                            $error = true;
                            $notice_error = 'no pudo hacer el insert del nuevo proceso';
                            break;
                        }
                        $error = false;
                        $notice_success = 'Proceso enviado correctamente';
                        $notice_error = '';    
                    }
                break;


            case 'enviar_area': // TODO. esto es muy parecido a 'enviar', pero destina a un área especificada en $id_area. Se puede mejorar, poniendo en 'enviar' para
                                        // no duplicar código. Tener en cuenta, futuras modificaciones, si son genereales deben hacerse en los dos case (enviar y enviar_area)
                    // Realizo en insert en id_proc (Hago un nuevo registro por que avanza un proceso)
                    if($next_proc == false) { // NO Existe un siguiente paso
                        $insert_proc_enviado_cierre = BDConsulta::consulta('insert_proc_enviado_cierre', array($pr_proceso, $id_tabla), $deb);
                        if(is_null($insert_proc_enviado_cierre)) {
                            $error = true;
                            $notice_error = 'no pudo hacer el insert del nuevo proceso';
                            break;
                        }
                        $error = false;
                        $notice_success = 'Proceso enviado correctamente y Proceso Cerrado ya que no existe siguiente Paso.';
                        $notice_error = '';
                    }else{ // Existe un siguiente PASO
                        // controlo que el siguiente paso no corresponda al mismo área, si as así avanzo otro orden más directamente.
                        // $area_cons = BDConsulta::consulta('select_pr_dias', array($id_fl_dias_next), $deb); // consulto area q perteneces
                        // if(is_null($area_cons)) {
                        //     $flash_error = 'error';
                        //     break;
                        // }
                        // if($area_cons[0]['id_area'] == $id_area) { // en el siguiente paso coinciden las áreas, etonces debe adelantar oto id_pr_fl_dias
                        //     // Consulto si existe un orden_proceso siguiente. Y si es así guardo id del sis_proceso_flujos_dias
                        //     $pr_orden_next++;
                        //     $id_next_proc_orden = BDConsulta::consulta('id_next_proc_orden', array($id_proceso, $pr_orden_next), $deb); 
                        //     if(is_null($id_next_proc_orden)) { // no existe un siguiente paso, debe guardar y cerrar.
                        //         $insert_proc_enviado_cierre = BDConsulta::consulta('insert_proc_enviado_cierre', array($pr_proceso, $id_tabla), $deb);
                        //         if(is_null($insert_proc_enviado_cierre)) {
                        //             $error = true;
                        //             $notice_error = 'no pudo hacer el insert del nuevo proceso';
                        //             break;
                        //         }
                        //         $error = false;
                        //         $notice_success = 'Proceso enviado correctamente y Proceso Cerrado ya que no existe siguiente Paso.';
                        //         $notice_error = '';
                        //     }else{ //existe un siguiente paso
                        //         // $next_proc = true; 
                        //         $id_fl_dias_next = $id_next_proc_orden[0]['id'];
                        //     }
                        // }
                        $insert_proc_enviado = BDConsulta::consulta('insert_proc_enviado', array($pr_proceso, $id_tabla, $id_fl_dias_next), $deb);
                        if(is_null($insert_proc_enviado)) {
                            $error = true;
                            $notice_error = 'no pudo hacer el insert del nuevo proceso';
                            break;
                        }
                        $error = false;
                        $notice_success = 'Proceso enviado correctamente';
                        $notice_error = '';    
                    }
                break;


            case 'aprobar':
                $update_tabla_proc_aprobado = BDConsulta::consulta('update_tabla_proc_aprobado', array($pr_proceso, $id_user, $date_unix, $comment, $id_tabla_proc), $deb);
                if(is_null($update_tabla_proc_aprobado)) {
                    $error = true;
                    $notice_error = 'no pudo hacer el update del proceso';
                    break;
                }
                if($next_proc == true) { // Existe un proceso siguiente
                    $insert_proc_enviado = BDConsulta::consulta('insert_proc_enviado', array($pr_proceso, $id_tabla, $id_fl_dias_next), $deb);
                    if(is_null($insert_proc_enviado)) {
                        $error = true;
                        $notice_error = 'no pudo hacer el insert del nuevo proceso';
                        break;
                    }
                    $error = false;
                    $notice_success = 'Proceso enviado correctamente';
                    $notice_error = '';
                    break;
                }else { // No existe un proceso siguiente
                    $insert_proc_enviado_cierre = BDConsulta::consulta('insert_proc_enviado_cierre', array($pr_proceso, $id_tabla), $deb);
                    $error = false;
                    $notice_success = 'Proceso enviado correctamente Y ya cerrado.';
                    $notice_error = '';
                    break;
                }
                break;


            case 'desaprobar':
                $update_tabla_proc_aprobado = BDConsulta::consulta('update_tabla_proc_aprobado', array($pr_proceso, $id_user, $date_unix, $comment, $id_tabla_proc), $deb);
                if(is_null($update_tabla_proc_aprobado)) {
                    $error = true;
                    $notice_error = 'no pudo hacer el update del proceso';
                    break;
                }
                $insert_proc_enviado_cierre = BDConsulta::consulta('proc_desaprobado', array($pr_proceso, $id_tabla), $deb);
                $error = false;
                $notice_success = 'Proceso Desaprobado Y ya cerrado.';
                $notice_error = '';
                break;


            case 'correccion':
                $id_fl_dias_ant = Process::FlDiasAnterior($pr_proceso, $id_tabla_proc);
                if($id_fl_dias_ant['error'] == true) {
                    $error = true;
                    $notice_error = 'No pudo encontrar el proceso anterior';
                    break;
                }
                $id_fl_dias_ant = $id_fl_dias_ant['id_fl_dias_ant'];
                
                $search_proc_ant = BDConsulta::consulta('search_proc_ant', array($pr_proceso, $id_tabla, $id_fl_dias_ant), $deb);
                

                
                if(is_null($search_proc_ant)) {
                    $error = true;
                    $notice_error = 'No encontro el proceso anterior';
                    break;
                }
                $id_tabla_proc_ant = $search_proc_ant[0]['id_tabla_proc_ant'];
                // hago el update, poniendo id_relacionado
                $update_tabla_proc_correccion = BDConsulta::consulta('update_tabla_proc_correccion', array($pr_proceso, $id_user, $date_unix, $comment, $id_tabla_proc, $id_tabla_proc_ant), $deb);
                if(is_null($update_tabla_proc_correccion)) {
                    $error = true;
                    $notice_error = 'no pudo hacer el update del proceso';
                    break;
                }
                $insert_proc_correccion = BDConsulta::consulta('insert_proc_correccion', array($pr_proceso, $id_tabla, $id_fl_dias_ant, $id_tabla_proc_ant), $deb);
                if(is_null($insert_proc_correccion)) {
                    $error = true;
                    $notice_error = 'no pudo hacer el insert del nuevo proceso';
                    break;
                }
                $notice_success = 'Hizo el update correspondiente';
                break;
            default:
                $error = true;
                $notice_error = 'No seleccionó una acción válida para el envio';

            }

        }while(0);
        $resp = array('error' => $error,
                                'notice_error' => $notice_error,
                                'notice_success' => $notice_success);
        return $resp;
    }
}