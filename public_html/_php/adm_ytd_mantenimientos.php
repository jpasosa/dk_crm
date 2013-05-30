<?php

$tpl = new PlantillaReemplazos();
$flash_error = '';$flash_notice = '';$detalle = '';$reload = false;

$id_user = Common::isLogin();

// ENVIO DEL FORMULARIO AL SIGUIENTE PASO
if(isset($_POST['enviar'])) { 
    $send = ProcessSends::toNextProcess('', $id_user, $_POST['id_tabla_proc'], '', 'enviar', 'n');
    if($send['error'] == false) {
        header('Location: /enviado.html');
        exit();    
    }
    $id_tabla = $_POST['id_tabla'];
    $id_tabla_proc = $_POST['id_tabla_proc'];
}


//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////
// ELIMINAR ARCHIVO
if(isset($_POST['id_file']) && $_POST['id_file'] > 0)  {
    $id_tabla_sec = $_POST['id_file'];
    $delete_sec = Process::DeleteSec('',  'arch', $id_tabla_sec);
    FormCommon::queryRespHeader($delete_sec);
}



///////////////////////////////// AGREGAR TABLA PRINCIPAL  |  fecha_inicio, fecha_fin, observaciones, tiempo, per, etc   |  POST
if(isset($_POST['asunto']) && isset($_POST['observaciones']) && isset($_POST['fecha_inicio']) && isset($_POST['id_tabla_proc'])
    && isset($_POST['x_tiempo']) && isset($_POST['periodicidad'])  && isset($_POST['agregar_mantenimiento'])):
	$asunto = trim($_POST['asunto']);                                  
	$observaciones = trim($_POST['observaciones']);
	$fecha_inicio = trim($_POST['fecha_inicio']);
            $fecha_inicio_unix = Dates::ConvertToUnix($fecha_inicio);
	$x_tiempo = trim($_POST['x_tiempo']);        
	$periodicidad	= $_POST['periodicidad'];                                    
	$id_tabla_proc	= $_POST['id_tabla_proc'];
	$id_tabla  	= $_POST['id_tabla'];     
	do { // VALIDACIONES
               $validations = Validations::General(array(
                                        array('field' => $asunto, 'null' => false, 'notice_error' => 'Debe completar el asunto.'),
                                        array('field' => $observaciones, 'null' => false, 'notice_error' => 'Debe completar las observaciones.'),
                                        array('field' => $fecha_inicio, 'null' => false, 'validation' => 'date', 'notice_error' => 'La fecha no es correcta.'),
                                        array('field' => $fecha_inicio, 'null' => false, 'validation' => 'date_is_weekend', 'notice_error' => 'Fecha de Inicio cae un fin de semana.'),
                                        array('field' => $x_tiempo, 'null' => false, 'validation' => 'numeric', 'notice_error' => 'El tiempo ingresado no es numerico o No fue ingresado.'),
                                        array('field' => $periodicidad, 'null' => false, 'validation' => 'is_correct_period', 'notice_error' => 'El período ingresado es incorrecto.',
                                                    'extra' => $x_tiempo . '.' . $periodicidad),
                                        array('field' => $fecha_inicio, 'null' => false, 'validation' => 'is_day_off', 'notice_error' => 'La fecha de inicio cae un feriado.',
                                                    'extra' => '1')
                                        ));
                if($validations['error'] == true) {
                   $flash_error = $validations['notice_error'];
                    break; 
                }
                // Common::CreateMantRecordat();
                if(isset($_SESSION['first_time']) && $_SESSION['first_time'] == true ) { // 1era VEZ que crea el MANTENIMIENTO
                    $new_process = Process::CreateNewProcess('', $id_user, 'n' );
                    if($new_process['error'] == true) {
                        $flash_error = $new_process['notice_error'];
                        $_SESSION['first_time'] = true;
                        break;
                    }
                    $id_tabla_proc = $new_process['id_tabla_proc'];     $id_tabla = $new_process['id_tabla'];
                    $tpl->asignar('id_tabla_proc', $id_tabla_proc);       $tpl->asignar('id_tabla', $new_process['id_tabla']);
                    $update_princ = Process::UpdatePrinc('', $id_tabla, $observaciones, 'n');
                    if($update_princ['error'] == true){
                        $flash_error = $update_princ['notice_error'];
                        $_SESSION['first_time'] = true;
                    }
                    $update_mant = BDConsulta::consulta('update_mant', array($id_tabla, $asunto, $observaciones, $fecha_inicio_unix, $periodicidad, $x_tiempo), 'n');
                    if(is_null($update_mant)) {
                        $flash_error = 'No pudo hacer la actualización del mantenimiento.';
                        $_SESSION['first_time'] = true;
                        break;
                    }
                    $flash_notice = $update_princ['notice_success'];
                    $_SESSION['first_time'] = false;
                }else{ // MODIFICA el MANTENIMIENTO
                    $update_mant = BDConsulta::consulta('update_mant', array($id_tabla, $asunto, $observaciones, $fecha_inicio_unix, $periodicidad, $x_tiempo), 'n');
                    if(is_null($update_mant)) {
                        $flash_error = 'No pudo hacer la actualización del mantenimiento.';
                        break;
                    }
                    $flash_notice = 'Registro modificado correctamente';
                }
        } while (0);
endif;
 ///////////////////////////////// FIN DE POST, del FORM de agregar el mantenimiento principal  //////////////////////////////////






///////////  Por POST, del FORM. SUBIDA DE ARCHIVOS.//////////////////////////////////
if(isset($_POST['subir_archivo'])) {
    do {
        if(isset($_SESSION['first_time']) && $_SESSION['first_time'] == true):
                $flash_error = 'Debe cargar primero el mantenimiento';
                break;
        endif;
        $file = $_FILES['archivo'];
        $id_tabla_proc = $_POST['id_tabla_proc'];   $id_tabla = $_POST['id_tabla'];
        $file_upload = ProcessFiles::FileUpload('', $id_tabla_proc, $file, 'n');
        if($file_upload['error'] == true) {
            $flash_error = $file_upload['notice_error'];
            break;
        }
        $flash_notice = $file_upload['notice_success'];
    }while(0);
    // Recargo las variables del formulario
}
///////////////////////////////// FIN DE  POST, del FORM. //////////////////////////////////


// RESET PRINCIPALES
$nombre_empleado = BDConsulta::consulta('empleado_nombres', array($id_user), 'n');
$nombres = $nombre_empleado[0]['nombre'] . ', ' . $nombre_empleado[0]['apellido'];
$tpl->asignar('nombre_empleado', $nombres);
if(!isset($id_tabla_proc))                  $id_tabla_proc = -10;
if(!isset($id_tabla))                           $id_tabla = -10;
if(!isset($_SESSION['first_time']))     $_SESSION['first_time'] = true;
$tpl->asignar('id_tabla_proc', $id_tabla_proc); // id del tabla_proc
$tpl->asignar('id_tabla', $id_tabla); // id del tabla_proc
$tpl->asignar('date', date('d/m/Y'));


// PARA EL SELECT
$sel_period = Process::getValuesSelect('sis_periodicidad', 'id_sis_periodicidad', 'periodicidad', 'n');
$tpl->asignar('sel_period', $sel_period);

// TABLA PRINCIPAL
$get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
$tpl->asignar('tabla', $get_tabla);

// NOMBRE DE ARCHIVOS CARGADOS
$files = Process::getFiles('', $id_tabla_proc);
$tpl->asignar('files', $files);

// MENSAJES FLASH
$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);

$tpl->obtenerPlantilla();

// unset($flash_error);
// unset($flash_notice);
