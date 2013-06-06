<?php
if($_GET[1] != '' && $_GET[1] > 0):
    require_once '_php/forms_start_coment.php';


    ///////////////////////////////// AGREGAR TABLA PRINCIPAL  |  fecha_inicio, fecha_fin, observaciones, tiempo, per, etc   |  POST
    if(isset($_POST['add_mant'])):
       
        $fecha = trim($_POST['fecha']);                                  
        $resultado = 'pepe';                                  
        $costo = trim($_POST['costo']);                                  
        $detalle = trim($_POST['detalle']);                                  
        $first_time  = $_POST['first_time'];
        $id_tabla_proc  = $_POST['id_tabla_proc'];
        $id_tabla   = $_POST['id_tabla'];
        do { // VALIDACIONES
                   $validations = Validations::General(array(
                                            array('field' => $resultado, 'null' => false, 'notice_error' => 'Debe completar el resultado.'),
                                            array('field' => $costo, 'null' => false, 'validation' => 'numeric', 'notice_error' => 'Debe completar el costo y/o no es númerico.'),
                                            array('field' => $fecha, 'null' => false, 'validation' => 'date', 'notice_error' => 'La fecha no es correcta y/o no fue ingresada.'),
                                            array('field' => $fecha, 'null' => false, 'validation' => 'date_is_weekend', 'notice_error' => 'Fecha de Inicio cae un fin de semana.'),
                                            array('field' => $detalle, 'null' => false, 'notice_error' => 'Debes ingresar detalle.'),
                                            array('field' => $fecha, 'null' => false, 'validation' => 'is_day_off', 'notice_error' => 'La fecha de inicio cae un feriado.',
                                                        'extra' => '1')
                                            ));
                    
                    if($validations['error'] == true) {
                        
                       $flash_error = $validations['notice_error'];
                        break; 
                    }

                    // Common::CreateMantRecordat();
                    if($first_time == 'true' ) { // 1era VEZ que crea el MANTENIMIENTO
                        $insert_record = BDConsulta::consulta('insert_record', array($id_tabla_proc, $resultado, $detalle, $costo, $fecha), 'n');
                        var_dump($insert_record);die();


                        if($new_process['error'] == true) {
                            $flash_error = $new_process['notice_error'];
                            break;
                        }
                        $id_tabla_proc = $new_process['id_tabla_proc'];     $id_tabla = $new_process['id_tabla'];
                        $tpl->asignar('id_tabla_proc', $id_tabla_proc);       $tpl->asignar('id_tabla', $new_process['id_tabla']);
                        $update_princ = Process::UpdatePrinc('', $id_tabla, $observaciones, 'n');
                        if($update_princ['error'] == true){
                            $flash_error = $update_princ['notice_error'];
                        }
                        $update_mant = BDConsulta::consulta('update_mant', array($id_tabla, $asunto, $observaciones, $fecha_inicio_unix, $periodicidad, $x_tiempo), 'n');
                        if(is_null($update_mant)) {
                            $flash_error = 'No pudo hacer la actualización del mantenimiento.';
                            break;
                        }
                        $flash_notice = $update_princ['notice_success'];
                        $first_time = 'false';
                    }else{ // MODIFICA el MANTENIMIENTO
                        $update_mant = BDConsulta::consulta('update_mant', array($id_tabla, $asunto, $observaciones, $fecha_inicio_unix, $periodicidad, $x_tiempo), 'n');
                        if(is_null($update_mant)) {
                            $flash_error = 'No pudo hacer la actualización del mantenimiento.';
                            break;
                        }
                        $flash_notice = 'Registro modificado correctamente';
                    }
            } while (0);
            $tpl->asignar('first_time', $first_time);
    endif;
     ///////////////////////////////// FIN DE POST, del FORM de agregar el mantenimiento principal  //////////////////////////////////

     // RESETS
    if(!isset($id_tabla_proc))                  $id_tabla_proc = -10;
    if(!isset($id_tabla))                           $id_tabla = -10;
    if(!isset($first_time))                         $first_time = 'true';
    $tpl->asignar('first_time', $first_time);
    // TABLA PRINCIPAL
    $get_tabla = Process::getTabla('adm_ytd_mantenimientos', $id_tabla_proc, 'n', 'sis_periodicidad');
    //$flash_error = Common::setErrorMessage($get_tabla); // Si tuviera error, lo carga en $flash_error para mostrar.
    $tpl->asignar('tabla', $get_tabla);
    // // NOMBRE DE ARCHIVOS CARGADOS
    $files = Process::getFiles('adm_ytd_mantenimientos', $id_tabla_proc);
    $tpl->asignar('files', $files);
    // MANTENIMIENTOS REALIZADOS
    $get_recordatorios = BDConsulta::consulta('get_recordatorios', array($id_tabla_proc), 'n');
    $tpl->asignar('recordatorios', $get_recordatorios);
    require_once '_php/forms_end_coment.php';
    

    
    $tpl->obtenerPlantilla();
    unset($flash_error);
    unset($flash_notice);

else: // error, no pudo obtener el id_tabla_proc PARA procesar los datos.
        header('Location: /menu.html');
        exit();
endif;
