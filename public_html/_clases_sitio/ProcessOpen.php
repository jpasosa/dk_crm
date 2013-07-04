<?php

class ProcessOpen {

// Arma el array con todos los Procesos ABIERTOS | También pueden ser cerrados que levantan a otros formularios una vez cerrados.
    public static function getAll($id_user, $debug = 'n') {
        $debug == 's' ? $deb = 's' : $deb = 'n';
        // $test = '14/4/2013';
                                // $test_unix = Dates::ConvertToUnix($test);
                                // echo 'fecha: ' , $test , ' Fecha Unix: ' , $test_unix;
                                // echo '<hr />' , $pasaron_dias , ' dias que pasaron';
                                // die();
        do {

            // Comprueba que exista el usuario
            $exist_user = BDConsulta::consulta('exist_user', array($id_user), $deb);
            if(is_null($exist_user)) {
                $error = true;
                $notice_error = 'El usuario ingresado no existe.';
                break;
            }
            // Obtengo id del area
            $id_user_area = BDConsulta::consulta('user_area', array($id_user), $deb);
            if(is_null($id_user_area)) { // comprueba el área del user
                $error = true;
                $notice_error = 'Área desconocida.';
                break;
            }
            $id_area = reset($id_user_area);
            $id_area = $id_area['id_sis_areas'];

            // Obtengo los id_fl_dias, a los que puede acceder este user según su área.
            $fl_dias_accesibles = BDConsulta::consulta('fl_dias_accesibles', array($id_area), $deb);
            if(is_null($fl_dias_accesibles)) {
                $error = true;
                $notice_error = 'El área no tiene asignado ningún proceso al cual acceder.';
                break;
            }
            // Creo los Arrays para ir guardando todos los procesos abiertos.
            $all_process['rojo']['propia'] = Array();
            $all_process['rojo']['terceros'] = Array();
            $all_process['amarillo']['propia'] = Array();
            $all_process['amarillo']['terceros'] = Array();
            $all_process['verde']['propia'] = Array();
            $all_process['verde']['terceros'] = Array();
            $all_process['azul'] = Array();
            // Fecha actual, para luego calcular.
            $date = date('d/m/Y');
            $date_unix = Dates::ConvertToUnix($date);
            $dia = 60 * 60 * 24;
            // Procesos accesibles, según su área.
            $sis_procesos_accesibles = BDConsulta::consulta('sis_procesos_accesibles', array($id_area), $deb);

            foreach($sis_procesos_accesibles as $k => $pa) { // Cada Proceso que tenga acceso.

                $procesos_activos = BDConsulta::consulta('procesos_activos', array($pa['proceso'], $id_area), $deb);
                if(!is_null($procesos_activos)) {

                    foreach($procesos_activos as $k => $pr_act) { // Todos los procesos que están activos
                       $last_process = Process::isLastProcess($pr_act['proceso_proceso'], $pr_act['id_tabla_proc']);

                        if($last_process) {
                            // Obtengo Ultimo Proceso
                            $last_process = Process::getLastProcess($pr_act['proceso_proceso'], $pr_act['id_tabla_proc']);
                            $dias_activo = $last_process['dias_activo']; // los días que puede estar activo. Por alarmas.
                            if($last_process['fecha_alta'] == null) { // tengo que agarrar el anterior al último para leer fecha de alta.
                                $last_last_process = Process::getLastLastProcess($pr_act['proceso_proceso'], $pr_act['id_tabla_proc']);
                                $last_process = $last_last_process[0];
                            }

                            $fecha_alta = $last_process['fecha_alta'];
                            $dias_activo = $last_process['dias_activo'];

                            $days = Dates::CalculateDaysExpire($fecha_alta, $dias_activo, '1');




                            $fecha_alta_unix = Dates::ConvertToUnix($fecha_alta);
                            // $pasaron_dias = ($fecha_alta_unix - $date_unix) / $dia;
                            // $pasaron_dias = Dates::RealDays($fecha_alta, $date, 1);



                            // $pasaron_dias = $pasaron_dias['pasaron_dias'];
                            // $restan_dias = $last_process['dias_activo'] - (($date_unix - $fecha_alta_unix) / $dia);
                            // $fecha_vence_unix = $fecha_alta_unix + ( $last_process['dias_activo'] * $dia);
                            // $fecha_vence = Dates::ConvertToPhpdate($fecha_vence_unix);
                            // $prioridad = 'MEDIA';
                            // Obtengo 1er proceso.

                            $first_process = Process::getFirstProcess($pr_act['proceso_proceso'], $pr_act['id_tabla']);
                            $first_process = $first_process[0];
                            $fecha_inicio = Dates::ConvertToPhpdate($first_process['fecha_alta']);
                            // procesos PROPIOS
                            if($first_process['id_sis_areas'] == $id_area):
                                if($days['alarma'] == 'verde'): // procesos de TAREAS PENDIENTES (verde)
                                        array_push($all_process['verde']['propia'], array('id_tabla_proc' => $pr_act['id_tabla_proc'],
                                                                                                                'id_tabla' => $pr_act['id_tabla'],
                                                                                                                'id_fl_dias' => $pr_act['id_fl_dias'],
                                                                                                                'proceso_orden' => $pr_act['proceso_orden'],
                                                                                                                'dias_activo' => $pr_act['dias_activo'],
                                                                                                                'id_proceso' => $pr_act['id_proceso'],
                                                                                                                'proceso_proceso' => $pr_act['proceso_proceso'] . '_coment',
                                                                                                                'proceso_nombre' => $pr_act['proceso_nombre'],
                                                                                                                'id_areas' => $pr_act['id_areas'],
                                                                                                                'fecha_inicio' => $fecha_inicio,
                                                                                                                'fecha_vence' => $days['fecha_vence'],
                                                                                                                'pasaron_dias' => $days['pasaron_dias'],
                                                                                                                'restan_dias' => $days['restan_dias'],
                                                                                                                'prioridad' => $days['prioridad']
                                                                                                                ));
                                endif;
                                // if($days['pasaron_dias'] == $dias_activo): // procesos de TAREAS ULTIMO DÍA (amarillo)
                                if($days['alarma'] == 'amarillo'): // procesos de TAREAS ULTIMO DÍA (amarillo)
                                        array_push($all_process['amarillo']['propia'], array('id_tabla_proc' => $pr_act['id_tabla_proc'],
                                                                                                                'id_tabla' => $pr_act['id_tabla'],
                                                                                                                'id_fl_dias' => $pr_act['id_fl_dias'],
                                                                                                                'proceso_orden' => $pr_act['proceso_orden'],
                                                                                                                'dias_activo' => $pr_act['dias_activo'],
                                                                                                                'id_proceso' => $pr_act['id_proceso'],
                                                                                                                'proceso_proceso' => $pr_act['proceso_proceso'] . '_coment',
                                                                                                                'proceso_nombre' => $pr_act['proceso_nombre'],
                                                                                                                'id_areas' => $pr_act['id_areas'],
                                                                                                                'fecha_inicio' => $fecha_inicio,
                                                                                                                'fecha_vence' => $days['fecha_vence'],
                                                                                                                'pasaron_dias' => $days['pasaron_dias'],
                                                                                                                'restan_dias' => $days['restan_dias'],
                                                                                                                'prioridad' => $days['prioridad']
                                                                                                                ));
                                endif;
                                if($days['alarma'] == 'rojo'): // procesos de ALARMAS (rojo)
                                        array_push($all_process['rojo']['propia'], array('id_tabla_proc' => $pr_act['id_tabla_proc'],
                                                                                                                'id_tabla' => $pr_act['id_tabla'],
                                                                                                                'id_fl_dias' => $pr_act['id_fl_dias'],
                                                                                                                'proceso_orden' => $pr_act['proceso_orden'],
                                                                                                                'dias_activo' => $pr_act['dias_activo'],
                                                                                                                'id_proceso' => $pr_act['id_proceso'],
                                                                                                                'proceso_proceso' => $pr_act['proceso_proceso'] . '_coment',
                                                                                                                'proceso_nombre' => $pr_act['proceso_nombre'],
                                                                                                                'id_areas' => $pr_act['id_areas'],
                                                                                                                'fecha_inicio' => $fecha_inicio,
                                                                                                                'fecha_vence' => $days['fecha_vence'],
                                                                                                                'pasaron_dias' => $days['pasaron_dias'],
                                                                                                                'restan_dias' => $days['restan_dias'],
                                                                                                                'prioridad' => $days['prioridad']
                                                                                                                ));
                                endif;
                            endif;

                            // Son los procesos de TERCEROS
                            if($first_process['id_sis_areas'] != $id_area):
                                if($days['alarma'] == 'verde'): // procesos de TAREAS PENDIENTES (verde)
                                        array_push($all_process['verde']['terceros'], array('id_tabla_proc' => $pr_act['id_tabla_proc'],
                                                                                                                'id_tabla' => $pr_act['id_tabla'],
                                                                                                                'id_fl_dias' => $pr_act['id_fl_dias'],
                                                                                                                'proceso_orden' => $pr_act['proceso_orden'],
                                                                                                                'dias_activo' => $pr_act['dias_activo'],
                                                                                                                'id_proceso' => $pr_act['id_proceso'],
                                                                                                                'proceso_proceso' => $pr_act['proceso_proceso'] . '_coment',
                                                                                                                'proceso_nombre' => $pr_act['proceso_nombre'],
                                                                                                                'id_areas' => $pr_act['id_areas'],
                                                                                                                'fecha_inicio' => $fecha_inicio,
                                                                                                                'fecha_vence' => $days['fecha_vence'],
                                                                                                                'pasaron_dias' => $days['pasaron_dias'],
                                                                                                                'restan_dias' => $days['restan_dias'],
                                                                                                                'prioridad' => $days['prioridad']
                                                                                                                ));
                                endif;
                                if($days['alarma'] == 'amarillo' ): // procesos de TAREAS ULTIMO DÍA (amarillo)
                                        array_push($all_process['amarillo']['terceros'], array('id_tabla_proc' => $pr_act['id_tabla_proc'],
                                                                                                                'id_tabla' => $pr_act['id_tabla'],
                                                                                                                'id_fl_dias' => $pr_act['id_fl_dias'],
                                                                                                                'proceso_orden' => $pr_act['proceso_orden'],
                                                                                                                'dias_activo' => $pr_act['dias_activo'],
                                                                                                                'id_proceso' => $pr_act['id_proceso'],
                                                                                                                'proceso_proceso' => $pr_act['proceso_proceso'] . '_coment',
                                                                                                                'proceso_nombre' => $pr_act['proceso_nombre'],
                                                                                                                'id_areas' => $pr_act['id_areas'],
                                                                                                                'fecha_inicio' => $fecha_inicio,
                                                                                                                'fecha_vence' => $days['fecha_vence'],
                                                                                                                'pasaron_dias' => $days['pasaron_dias'],
                                                                                                                'restan_dias' => $days['restan_dias'],
                                                                                                                'prioridad' => $days['prioridad']
                                                                                                                ));
                                endif;
                                if($days['alarma'] == 'rojo' ): // procesos de ALARMAS (rojo)
                                        array_push($all_process['rojo']['terceros'], array('id_tabla_proc' => $pr_act['id_tabla_proc'],
                                                                                                                'id_tabla' => $pr_act['id_tabla'],
                                                                                                                'id_fl_dias' => $pr_act['id_fl_dias'],
                                                                                                                'proceso_orden' => $pr_act['proceso_orden'],
                                                                                                                'dias_activo' => $pr_act['dias_activo'],
                                                                                                                'id_proceso' => $pr_act['id_proceso'],
                                                                                                                'proceso_proceso' => $pr_act['proceso_proceso'] . '_coment',
                                                                                                                'proceso_nombre' => $pr_act['proceso_nombre'],
                                                                                                                'id_areas' => $pr_act['id_areas'],
                                                                                                                'fecha_inicio' => $fecha_inicio,
                                                                                                                'fecha_vence' => $days['fecha_vence'],
                                                                                                                'pasaron_dias' => $days['pasaron_dias'],
                                                                                                                'restan_dias' => $days['restan_dias'],
                                                                                                                'prioridad' => $days['prioridad']
                                                                                                                ));
                                endif;
                            endif;

                        }else{
                            // no me sirve por que no es el último proceso.
                        }

                    } //Cierra el foreach de los procesos que están activos.
                } // Cierra el if, que pregunta si de los procesos accesibles, encontró algun proceso abierto.
            } // cierra el foreach de los procesos accesibles.



            // Busco si hay ven_rendicion_viaticos. . . . solamente puede comenzar área 1 (ventas)
            if($id_area == 1) {
                // busca procesos cerrados con fecha_fin < date
                $search_viaticos_rendir = BDConsulta::consulta('search_viaticos_rendir', array($date_unix), 'n');
                if(!is_null($search_viaticos_rendir)) {
                    foreach($search_viaticos_rendir as $rendir) {
                            $procesos_ver = Process::getFirstProcess('ven_solicitud_viaticos_viajes', $rendir['id_ven_solicitud_viaticos_viajes'], 'n');
                            $id_tabla_proc_rendir = $procesos_ver[0]['id_ven_solicitud_viaticos_viajes_proc'];
                            array_push($all_process['azul'], array('id_tabla_proc' => $id_tabla_proc_rendir,
                                                                                        'id_tabla' => $rendir['id_ven_solicitud_viaticos_viajes'],
                                                                                        'proceso_proceso' => 'ven_rendicion_viaticos_viajes',
                                                                                        'proceso_nombre' => 'Rendición de Viaticos para Viajes',
                                                                                        'fecha_inicio' => Dates::ConvertToPhpdate($rendir['fecha_inicio']),
                                                                                        'fecha_fin' => Dates::ConvertToPhpdate($rendir['fecha_fin']),
                                                                                        'aprobada' => 'NO'
                                                                                        ));
                    }
                }

                // $all_process['azul'][0]=  array('proceso_nombre' => 'Rendición de Viaticos para Viajes',
                //                                             'fecha_inicio' => '14/03/2013',
                //                                             'fecha_fin' => '34/65/6565',
                //                                             'aprobada' => 'SI');

                // buscar todos los ven_solicitud_viaticos_viajes  = 0 y fecha
            }

        }while(0);





        // BUSCO MANTENIMIENTOS que pasaron por todos los procesos. Es decir, ya va estar abierto el RECORDATORIO.
        $search_mant_cerrados = BDConsulta::consulta('search_mant_cerrados', array(), 'n');
        if(!is_null($search_mant_cerrados)) {
            foreach($search_mant_cerrados as $k => $mant) {
                $id_tabla_proc = ProcessMaint::getRecordatorys($mant['id_adm_ytd_mantenimientos'], $id_area, 'n');
                if(!isset($id_tabla_proc['error'])) { // voy cargando datos que necesito para calcular el recordatorio.
                    $mantenimientos[$k]['id_mant_tabla'] = $mant['id_adm_ytd_mantenimientos'];   // id de adm_ytd_mantenimientos
                    $mantenimientos[$k]['id_mant_tabla_proc'] = $id_tabla_proc['id_adm_ytd_mantenimientos_proc']; // id de adm_ytd_mantenimientos_proc (el primero)
                    $mantenimientos[$k]['fecha_inicio'] = $mant['fecha_inicio']; // fecha_inicio de adm_ytd_mantenimientos
                    $mantenimientos[$k]['period'] = $mant['id_sis_periodicidad']; // periodicidad de adm_ytd_mantenimientos
                    $mantenimientos[$k]['x_tiempo'] = $mant['cada_x_tiempo']; // cada_x_tiempo de adm_ytd_mantenimientos

                }
            }
            if(isset($mantenimientos)) {
                    foreach($mantenimientos as $mant) {
                        // Va a buscar los recordatorios que ya fueron realizados de cada mantenimiento
                        $search_recordatorios = BDConsulta::consulta('search_recordatorios', array($mant['id_mant_tabla_proc']), 'n');
                        if(!is_null($search_recordatorios)) { // HAY ya cargado algun mantenimiento hecho
                                $last_recordatorio = end($search_recordatorios); // agarro ultimo mantenimiento
                                $last_fecha_mant = $last_recordatorio['fecha'];
                                $last_fecha_mant = Dates::ConvertToPhpdate($last_fecha_mant);
                                $rec = ProcessMaint::CalculateMant($last_fecha_mant, $mant['period'], $mant['x_tiempo'], $mant['id_mant_tabla_proc']);
                        }else{      // Aún no se hizo el primer Mantenimiento.
                            $fecha_inicio = Dates::ConvertToPhpdate($mant['fecha_inicio']);
                            $rec = ProcessMaint::CalculateFirstMant($fecha_inicio, $mant['id_mant_tabla_proc']);
                        }

                        foreach($rec['rojo'] as $rec_rojo) { // cargo ROJO en all_process
                            array_push($all_process['rojo']['propia'], $rec_rojo);
                        }
                        foreach($rec['amarillo'] as $rec_amarillo) { // cargo AMARILLO en all_process
                            array_push($all_process['amarillo']['propia'], $rec_amarillo);
                        }
                        foreach($rec['verde'] as $rec_verde) { // cargo VERDE en all_process
                            array_push($all_process['verde']['propia'], $rec_verde);
                        }
                    }
            } // si estaba seteado mantenimientos


        }




        // BUSCO procesos abiertos de VEN_LLAMADAS, que comienzan en ave_campania
        if($id_area == 2) { // Comienza área 2. TODO: Sacar como formulario nuevo a Asist Ventas el ven_llamadas.


        }

        // busco CPR_PEDIDOS_MUESTRAS cerrados -> Van a levantar datos para los CPR_PEDIDOS_EJ_BUSQUEDA
        if($id_area == 9) { // son los compradores
            $search_pedidos_muestras_cerrados = BDConsulta::consulta('search_pedidos_muestras_cerrados', array(), 'n');

            foreach($search_pedidos_muestras_cerrados AS $pdc) {
                $fp = Process::getOnlyFirstProcess('cpr_pedidos_muestras', $pdc['id_cpr_pedidos_muestras'], 'n');
                $last_process = Process::getLastProcess('cpr_pedidos_muestras', $fp['id_cpr_pedidos_muestras_proc']);
                $fecha_alta = $last_process['fecha_alta'];

                $data_sec = Process::getTablaSec('cpr_pedidos_muestras', 'prod', $fp['id_cpr_pedidos_muestras_proc'], 'n');

            }



        }









        // $area = BDConsulta::consulta('user_area', array($user), 'n');
        return $all_process;
    }

}