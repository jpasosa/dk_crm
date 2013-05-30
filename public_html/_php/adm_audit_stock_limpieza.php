<?php

$tpl = new PlantillaReemplazos();

require_once '_php/forms_start.php';

//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////

if(isset($_POST['id_file']) && $_POST['id_file'] > 0):  // ELIMINAR ARCHIVO
        $id_tabla = $_POST['id_file'];
        $del_file = ProcessFiles::DeleteFilePrinc('adm_audit_stock_limpieza', 'archivo', $id_tabla);
        FormCommon::queryRespHeader($del_file);        
endif;


///  Por POST, del FORM  |  Tabla Principal (pais ciudad, fecha_inicio, fecha_fin, observaciones)///
if(isset($_POST['agregar'])):
    $fecha = trim($_POST['fecha']);
    $fecha_unix = Dates::ConvertToUnix($fecha);
    $observaciones = trim($_POST['observaciones']);
    $first_time  = $_POST['first_time'];
    $id_tabla_proc  = $_POST['id_tabla_proc'];
    $id_tabla   = $_POST['id_tabla'];     
    do { // VALIDACIONES
           $validations = Validations::General(array(
                                    array('field' => $observaciones, 'null' => false, 'notice_error' => 'Debe completar las observaciones.'),
                                    array('field' => $fecha, 'null' => false, 'validation' => 'date', 'notice_error' => 'La fecha no es correcta o no fue ingresada.')
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
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $fecha_unix, $observaciones), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo hacer la actualización del mantenimiento.';
                    break;
                }
                $flash_notice = 'Se cargó correctamente';
                $first_time = 'false';
            }else{ // MODIFICA el MANTENIMIENTO
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $fecha_unix, $observaciones), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo hacer la actualización del mantenimiento.';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente';
            }
        } while (0);
        $tpl->asignar('first_time', $first_time);
endif;

///////////  Por POST, del FORM. SUBIDA DE ARCHIVOS.//////////////////////////////////
if(isset($_POST['subir_archivo'])):
    $first_time = $_POST['first_time'];
    do {
        if($first_time == 'true'){
            $flash_error = 'Debe cargar primero observaciones y fecha.';
            break;
        }
        $file = $_FILES['archivo'];
        $id_tabla_proc = $_POST['id_tabla_proc'];   $id_tabla = $_POST['id_tabla'];
        $file_upload = ProcessFiles::FileUploadOnePrinc('', 'archivo', $id_tabla, $file, 'n', true);
        if($file_upload['error'] == true) {
            $flash_error = $file_upload['notice_error'];
            break;
        }
        $flash_notice = $file_upload['notice_success'];
    }while(0);
    $tpl->asignar('first_time', $first_time);
endif;


// RESET PRINCIPALES
require_once '_php/forms_reset.php';
// TABLA PRINCIPAL
$get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
$tpl->asignar('tabla', $get_tabla);
// MENSAJES FLASH
$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);

$tpl->obtenerPlantilla();

