<?php
if($_GET[1] != '' && $_GET[1] > 0):
    require_once '_php/forms_start_coment.php';


    ///////////////////////////////// AGREGAR TABLA PRINCIPAL  |  fecha_inicio, fecha_fin, observaciones, tiempo, per, etc   |  POST
    if(isset($_POST['add_mant'])):
       
        $fecha = trim($_POST['fecha']);                                  
        $resultado = $_POST['resultado'];
        $costo = trim($_POST['costo']);
        $costo = Common::PutDot($costo);                             
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
                    $fecha_unix = Dates::ConvertToUnix($fecha);
                    if($first_time == 'true' ) { // 1era VEZ que crea el MANTENIMIENTO
                        $insert_record = BDConsulta::consulta('insert_record', array($id_tabla_proc, $resultado, $detalle, $costo, $fecha_unix), 's');
                        if(is_null($insert_record)) {
                            $flash_error = 'No pudo insertar el mantenimiento';
                            break;
                        }
                        $id_tabla = $insert_record; 
                        $flash_notice = 'Cargado nuevo mantenimiento correctamente';
                        $first_time = 'false';
                    }else{ // MODIFICA el MANTENIMIENTO
                        $update_record = BDConsulta::consulta('update_record', array($id_tabla, $resultado, $detalle, $costo, $fecha_unix), 's');
                        if(is_null($update_record)) {
                            $flash_error = 'No pudo hacer la actualización del mantenimiento.';
                            break;
                        }
                        $flash_notice = 'Registro modificado correctamente';
                    }
            } while (0);
            $tpl->asignar('id_tabla_proc', $id_tabla_proc);
            $tpl->asignar('id_tabla', $id_tabla);
            $tpl->asignar('first_time', $first_time);
    endif;
     ///////////////////////////////// FIN DE POST, del FORM de agregar el mantenimiento principal  //////////////////////////////////

     ///////////  Por POST, del FORM. SUBIDA DE ARCHIVOS.////////////////////////////////// (pertenece también a la tabla principal)
    if(isset($_POST['subir_archivo'])):
        $id_tabla_proc = $_POST['id_tabla_proc'];
        $id_tabla = $_POST['id_tabla'];
        $first_time = $_POST['first_time'];
        do {
            if($first_time == 'true'):
                    $flash_error = 'Debe cargar primero el mantenimiento.';
                    break;
            endif;
            $file = $_FILES['archivo'];
            
            $ver_arch_libres = BDConsulta::consulta('ver_arch_libres', array($id_tabla), 'n'); 
            if(is_null($ver_arch_libres)) {
                $flash_error = 'No se pudo recuperar el mantenimiento';
                break;
            }
            if($ver_arch_libres[0]['archivo_1'] == '') {    // Tengo que controlar que archivo está sin subir
                $archivo = '1';
            }elseif($ver_arch_libres[0]['archivo_2'] == '') {
                $archivo = '2';
            }elseif($ver_arch_libres[0]['archivo_3'] == '') {
                $archivo = '3';
            }elseif($ver_arch_libres[0]['archivo_4'] == '') {
                $archivo = '4';
            }elseif($ver_arch_libres[0]['archivo_5'] == '') {
                $archivo = '5';
            }else{
                $flash_error = 'No se pueden subir más archivos';
                break;
            }
            $file_upload = ProcessFiles::FileUploadOnePrinc('adm_ytd_mantenimiento_recordatorio', 'archivo_' . $archivo, $id_tabla, $file, 'n', true);
            if($file_upload['error'] == true) {
                $flash_error = $file_upload['notice_error'];
                break;
            }
            $flash_notice = $file_upload['notice_success'];
        }while(0);
        $tpl->asignar('first_time', $first_time);
        $tpl->asignar('id_tabla', $id_tabla);
        $tpl->asignar('id_tabla_proc', $id_tabla_proc);
    endif;



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
    // MANTENIMIENTOS YA REALIZADOS
    $get_recordatorios = BDConsulta::consulta('get_recordatorios', array($id_tabla_proc), 'n');
    $tpl->asignar('recordatorios', $get_recordatorios);
    // MANTENIMIENTO ACTUAL
    $get_actual = BDConsulta::consulta('get_actual', array($id_tabla), 'n');
    $tpl->asignar('mant_actual', $get_actual);
    // ARCHIVOS DEL MANTENIMIENTO ACTUAL Q CARGO
    $archivos_mant = BDConsulta::consulta('archivos_mant', array($id_tabla), 'n');
    $tpl->asignar('files_mant', $archivos_mant);
    require_once '_php/forms_end_coment.php';
    $tpl->obtenerPlantilla();
    unset($flash_error);
    unset($flash_notice);

else: // error, no pudo obtener el id_tabla_proc PARA procesar los datos.
        header('Location: /menu.html');
        exit();
endif;
