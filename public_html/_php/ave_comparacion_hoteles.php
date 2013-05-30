<?php

$tpl = new PlantillaReemplazos();
require_once '_php/forms_start.php';

// AJAX ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['id_gasto_del']) && $_POST['id_gasto_del'] > 0): // ELIMINAR
    $delete_sec = Process::DeleteSec('', 'opc', $_POST['id_gasto_del']);
    FormCommon::queryRespHeader($delete_sec);
endif;
if(isset($_POST['id_gasto_edit']) && $_POST['id_gasto_edit'] > 0):  // EDITAR
    $edit_sec = Process::ModifySec('', 'opc', $_POST['id_gasto_edit']);
    FormCommon::queryRespHeader($edit_sec);  // verifica si fue hecha correctamente la consulta
endif;
if(isset($_POST['id_file']) && $_POST['id_file'] > 0):          // ELIMINAR ARCHIVO
    $id_tabla = $_POST['id_file'];
    echo 'id_tabla: ' , $id_tabla;
    $del_file = ProcessFiles::DeleteFilePrinc('ave_comparacion_hoteles_opc', 'archivo', $id_tabla, 'n');
    FormCommon::queryRespHeader($del_file);        
endif;




///  Por POST, del FORM  |  Tabla Principal (pais ciudad, fecha_inicio, fecha_fin, observaciones)///
if(isset($_POST['agregar'])):
    $pais_ciudad = $_POST['pais_ciudad'];                                  
    $fecha_inicio = trim($_POST['fecha_inicio']);
    $fecha_inicio_unix = Dates::ConvertToUnix($fecha_inicio);
    $fecha_fin = trim($_POST['fecha_fin']);
    $fecha_fin_unix = Dates::ConvertToUnix($fecha_fin);
    $observaciones = trim($_POST['observaciones']);
    $first_time = $_POST['first_time'];
    $id_tabla_proc  = $_POST['id_tabla_proc'];
    $id_tabla   = $_POST['id_tabla'];     
    do { // VALIDACIONES
           $validations = Validations::General(array(
                                    array('field' => $pais_ciudad, 'null' => false, 'notice_error' => 'Debe seleccionar una ciudad.'),
                                    array('field' => $observaciones, 'null' => false, 'notice_error' => 'Debe completar las observaciones.'),
                                    array('field' => $fecha_inicio, 'null' => false, 'validation' => 'date', 'notice_error' => 'La fecha no es correcta o no fue ingresada.'),
                                    array('field' => $fecha_fin, 'null' => false, 'validation' => 'date', 'notice_error' => 'La fecha no es correcta o no fue ingresada.')
                                    ));
            if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break; 
            }
            if($first_time == 'true' ) { // 1era VEZ
                $new_process = Process::CreateNewProcess('', $id_user, 'n' );
                if($new_process['error'] == true) {
                    $flash_error = $new_process['notice_error'];
                    break;
                }
                $id_tabla_proc = $new_process['id_tabla_proc'];     $id_tabla = $new_process['id_tabla'];
                $tpl->asignar('id_tabla_proc', $id_tabla_proc);       $tpl->asignar('id_tabla', $new_process['id_tabla']);
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $pais_ciudad, $fecha_inicio_unix, $fecha_fin_unix, $observaciones), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo hacer la actualización del mantenimiento.';
                    break;
                }
                $flash_notice = 'Se cargó correctamente';
                $first_time = 'false';
            }else{ // MODIFICA
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $pais_ciudad, $fecha_inicio_unix, $fecha_fin_unix, $observaciones), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo hacer la actualización del mantenimiento.';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente';
                $first_time = 'false';
            }
        } while (0);
        $tpl->asignar('first_time', $first_time);
endif;


///////////////////////////////// AGREGAR TABLA SECUNDARIA (Hoteles) |  POST 
if(isset($_POST['agregar_hotel'])):
    $hotel = trim($_POST['hotel']);                           
    $comentario = trim($_POST['comentario']);     
    $costo = Common::PutDot($_POST['costo']);
    $first_time = $_POST['first_time'];
    $id_tabla_proc = $_POST['id_tabla_proc'];
    $id_tabla = $_POST['id_tabla'];
    $nombre_archivo = $_POST['nombre_archivo'];
    do {
        if($first_time == 'true') {
            $flash_error = 'Debe ingresar antes, fecha de inicio, fin, ciudad y observaciones.';
            break;
        }
        $validations = Validations::General(array(
                                array('field' => $hotel, 'null' => false, 'validation' => 'text', 'notice_error' => 'Debe ingresar nombre del Hotel.'),
                                array('field' => $comentario, 'null' => false, 'validation' => 'text', 'notice_error' => 'Debe ingresar un comentario.'),
                                array('field' => $costo, 'null' => false, 'validation' => 'numeric', 'notice_error' => 'El costo falta y/o debe ser númerico')
                                ));
        if($validations['error'] == true) {
           $flash_error = $validations['notice_error'];
            break; 
        }
        $tabla_sec = Process::CreateSec('', 'opc', $id_tabla_proc, 'n');
        if($tabla_sec['error'] == true) {
            $flash_error = $tabla_sec['notice_error'];
            break;
        }
        $id_tabla_sec = $tabla_sec['id_tabla_sec'];
        if($nombre_archivo == 'no existe archivo.' || $nombre_archivo == '' ) { 
            $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $hotel, $comentario, $costo), 'n');    
        }else { // Viene del EDIT con un archivo ya cargado.
            $update_tabla_sec = BDConsulta::consulta('update_tabla_sec_archivo', array($id_tabla_sec, $hotel, $comentario, $costo, $nombre_archivo), 'n');    
        }
        if(is_null($update_tabla_sec)) {
            $flash_error = 'No pudo insertar el gasto.';
            break;  
        }
        if(isset($_FILES['archivo']) && $_FILES['archivo']['name'] != '' ) {
            $file = $_FILES['archivo'];
            $file_upload = ProcessFiles::FileUploadOne('', 'opc', 'archivo', $id_tabla_sec, $file, 'n');
            if($file_upload['error'] == true) {
                $flash_error = $file_upload['notice_error'];
                break;
            }
        }
        $flash_notice = 'Nuevo gasto agregado correctamente.';
    }while(0);
    $tpl->asignar('first_time', $first_time);
endif;


// RESET PRINCIPALES
require_once '_php/forms_reset.php';

// PARA EL SELECT de PAIS | CIUDAD
$pais_ciudad = Process::getValuesSelect('sis_provincia', 'id_sis_provincia', 'provincia', $debug = 'n', 'sis_pais', 'id_sis_pais', 'pais');
$tpl->asignar('pais_ciudad', $pais_ciudad);
// TABLA PRINCIPAL
$get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
$tpl->asignar('tabla', $get_tabla);
// TABLA SECUNDARIA (los hoteles)
$get_tabla_sec_opc = Process::getTablaSec('', 'opc', $id_tabla_proc, 'n');
$tpl->asignar('tabla_sec', $get_tabla_sec_opc);
// MENSAJES FLASH
$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);


$tpl->obtenerPlantilla();
