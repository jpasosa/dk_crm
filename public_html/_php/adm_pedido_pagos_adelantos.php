<?php


$tpl = new PlantillaReemplazos();
require_once '_php/forms_start.php';


//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////
if(isset($_POST['id_file']) && $_POST['id_file'] > 0):          // ELIMINAR ARCHIVO
        $id_tabla_arch = $_POST['id_file'];
        $del_file = ProcessFiles::DeleteFile('', $id_tabla_arch);
        FormCommon::queryRespHeader($del_file);        
endif;


///  Por POST, del FORM  |  Tabla Principal (pedido)///
if(isset($_POST['agregar'])):
    $asunto = trim($_POST['asunto']);
    $pedido = trim($_POST['pedido']);
    $first_time = $_POST['first_time'];
    $id_tabla_proc  = $_POST['id_tabla_proc'];
    $id_tabla   = $_POST['id_tabla'];     
    do { // VALIDACIONES
           $validations = Validations::General(array(
                                    array('field' => $asunto, 'null' => false, 'notice_error' => 'Debe ingresar un asunto.'),
                                    array('field' => $pedido, 'null' => false, 'notice_error' => 'Debe ingresar un pedido.')
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
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $asunto, $pedido), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo cargar el registro.';
                    break;
                }
                $flash_notice = 'Se cargó correctamente';
                $first_time = 'false';
            }else{ // MODIFICA
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $asunto, $pedido), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo hacer la actualización.';
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
        if($first_time == 'true'):
                $flash_error = 'Debe cargar primero el pedido.';
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
    $tpl->asignar('first_time', $first_time);
endif;








// RESET PRINCIPALES
require_once '_php/forms_reset.php';
// TABLA PRINCIPAL
$get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
$tpl->asignar('tabla', $get_tabla);
// NOMBRE DE ARCHIVOS CARGADOS
$files = Process::getFiles('', $id_tabla_proc);
$tpl->asignar('files', $files);
// MENSAJES FLASH
$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
// LEVANTO VISTA
$tpl->obtenerPlantilla();

