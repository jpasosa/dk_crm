<?php
$tpl = new PlantillaReemplazos();

require_once '_php/forms_start.php';


//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////
if(isset($_POST['id_cliente_del']) && $_POST['id_cliente_del'] > 0):  // ELIMINAR un cliente
        $id_cliente_del = $_POST['id_cliente_del'];
        $del_tabla_sec = Process::DeleteSec('', 'clientes', $id_cliente_del);
        FormCommon::queryRespHeader($del_tabla_sec);
endif;

if(isset($_POST['id_cliente_edit']) && $_POST['id_cliente_edit'] > 0): // EDITAR  item tabla secundaria
        $id_cliente_edit = $_POST['id_cliente_edit'];
        $edit_tabla_sec = Process::ModifySec('', 'clientes', $id_cliente_edit);
        FormCommon::queryRespHeader($edit_tabla_sec);
endif;

///////////////////////////////// AGREGAR TABLA PRINCIPAL  |  POST
if(isset($_POST['agregar'])):
        $ven_cliente_contacto = trim($_POST['ven_cliente_contacto']);
        $asunto = $_POST['asunto'];
        $detalle = $_POST['detalle'];
        $first_time = $_POST['first_time'];
        $id_tabla = $_POST['id_tabla'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        do {
            $validations = Validations::General(array(
                                        array('field' => $asunto, 'null' => false, 'notice_error' => 'Debe completar el asunto.'),
                                        array('field' => $detalle, 'null' => false, 'notice_error' => 'Debe completar el detalle.'),
                                        ));
            if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break;
            }
            if($first_time == 'true' ) { // Primera VEZ
                $new_process = Process::CreateNewProcess('', $id_user);
                if($new_process['error'] == true) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;
                }
                $flash_notice = $new_process['notice_success'];
                $id_tabla = $new_process['id_tabla'];
                $id_tabla_proc = $new_process['id_tabla_proc'];
                $tpl->asignar('id_tabla', $id_tabla);
                $tpl->asignar('id_tabla_proc', $id_tabla_proc);
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $ven_cliente_contacto, $asunto, $detalle), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente.';
                $first_time = 'false';
            }else { // Modificar tabla principal
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $ven_cliente_contacto, $asunto, $detalle), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No se pudo modificar el registro';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente.';
            }
        }while(0);
        $tpl->asignar('first_time', $first_time);
endif;





///////////  Por POST, del FORM. SUBIDA DE ARCHIVOS,  AUTORIZACIONES.//////////////////////////////////
if(isset($_POST['pacto'])):
    $first_time = $_POST['first_time'];
    do {
        if($first_time == 'true'){
            $flash_error = 'Debe cargar primero los demás campos.';
            break;
        }
        $file = $_FILES['archivo_pacto'];
        $id_tabla_proc = $_POST['id_tabla_proc'];   $id_tabla = $_POST['id_tabla'];
        $file_upload = ProcessFiles::FileUploadOnePrinc('', 'archivo_pacto_social', $id_tabla, $file, 's', true, 'archivo_pacto');
        if($file_upload['error'] == true) {
            $flash_error = $file_upload['notice_error'];
            break;
        }
        $flash_notice = $file_upload['notice_success'];
    }while(0);
    $tpl->asignar('first_time', $first_time);
endif;
///////////  Por POST, del FORM. SUBIDA DE ARCHIVOS,  AUTORIZACIONES.//////////////////////////////////
if(isset($_POST['cert_publico'])):
    $first_time = $_POST['first_time'];
    do {
        if($first_time == 'true'){
            $flash_error = 'Debe cargar primero los demás campos.';
            break;
        }
        $file = $_FILES['archivo_publico'];
        $id_tabla_proc = $_POST['id_tabla_proc'];   $id_tabla = $_POST['id_tabla'];
        $file_upload = ProcessFiles::FileUploadOnePrinc('', 'archivo_certificado_registro_p', $id_tabla, $file, 'n', true, 'archivo_publico');
        if($file_upload['error'] == true) {
            $flash_error = $file_upload['notice_error'];
            break;
        }
        $flash_notice = $file_upload['notice_success'];
    }while(0);
    $tpl->asignar('first_time', $first_time);
endif;
///////////  Por POST, del FORM. SUBIDA DE ARCHIVOS,  AUTORIZACIONES.//////////////////////////////////
if(isset($_POST['cert_incumb'])):
    $first_time = $_POST['first_time'];
    do {
        if($first_time == 'true'){
            $flash_error = 'Debe cargar primero los demás campos.';
            break;
        }
        $file = $_FILES['archivo_incumb'];
        $id_tabla_proc = $_POST['id_tabla_proc'];   $id_tabla = $_POST['id_tabla'];
        $file_upload = ProcessFiles::FileUploadOnePrinc('', 'archivo_certificado_incumb', $id_tabla, $file, 'n', true, 'archivo_incumb');
        if($file_upload['error'] == true) {
            $flash_error = $file_upload['notice_error'];
            break;
        }
        $flash_notice = $file_upload['notice_success'];
    }while(0);
    $tpl->asignar('first_time', $first_time);
endif;
///////////  Por POST, del FORM. SUBIDA DE ARCHIVOS,  AUTORIZACIONES.//////////////////////////////////
if(isset($_POST['bancarias'])):
    $first_time = $_POST['first_time'];
    do {
        if($first_time == 'true'){
            $flash_error = 'Debe cargar primero los demás campos.';
            break;
        }
        $file = $_FILES['archivo_bancarias'];
        $id_tabla_proc = $_POST['id_tabla_proc'];   $id_tabla = $_POST['id_tabla'];
        $file_upload = ProcessFiles::FileUploadOnePrinc('', 'archivo_referencias_bancarias', $id_tabla, $file, 'n', true, 'archivo_bancarias');
        if($file_upload['error'] == true) {
            $flash_error = $file_upload['notice_error'];
            break;
        }
        $flash_notice = $file_upload['notice_success'];
    }while(0);
    $tpl->asignar('first_time', $first_time);
endif;
///////////  Por POST, del FORM. SUBIDA DE ARCHIVOS,  AUTORIZACIONES.//////////////////////////////////
if(isset($_POST['comerciales'])):
    $first_time = $_POST['first_time'];
    do {
        if($first_time == 'true'){
            $flash_error = 'Debe cargar primero los demás campos.';
            break;
        }
        $file = $_FILES['archivo_comerciales'];
        $id_tabla_proc = $_POST['id_tabla_proc'];   $id_tabla = $_POST['id_tabla'];
        $file_upload = ProcessFiles::FileUploadOnePrinc('', 'archivo_referencias_com', $id_tabla, $file, 'n', true, 'archivo_comerciales');
        if($file_upload['error'] == true) {
            $flash_error = $file_upload['notice_error'];
            break;
        }
        $flash_notice = $file_upload['notice_success'];
    }while(0);
    $tpl->asignar('first_time', $first_time);
endif;
///////////  Por POST, del FORM. SUBIDA DE ARCHIVOS,  AUTORIZACIONES.//////////////////////////////////
if(isset($_POST['autorizaciones'])):
    $first_time = $_POST['first_time'];
    do {
        if($first_time == 'true'){
            $flash_error = 'Debe cargar primero los demás campos.';
            break;
        }
        $file = $_FILES['archivo_autorizaciones'];
        $id_tabla_proc = $_POST['id_tabla_proc'];   $id_tabla = $_POST['id_tabla'];
        $file_upload = ProcessFiles::FileUploadOnePrinc('', 'archivo_autorizaciones', $id_tabla, $file, 'n', true, 'archivo_autorizaciones');
        if($file_upload['error'] == true) {
            $flash_error = $file_upload['notice_error'];
            break;
        }
        $flash_notice = $file_upload['notice_success'];
    }while(0);
    $tpl->asignar('first_time', $first_time);
endif;
///////////  Por POST, del FORM. SUBIDA DE ARCHIVOS,  CONTRATO CREDITO.//////////////////////////////////
if(isset($_POST['credito'])):
    $first_time = $_POST['first_time'];
    do {
        if($first_time == 'true'){
            $flash_error = 'Debe cargar primero los demás campos.';
            break;
        }
        $file = $_FILES['archivo_credito'];
        $id_tabla_proc = $_POST['id_tabla_proc'];   $id_tabla = $_POST['id_tabla'];
        $file_upload = ProcessFiles::FileUploadOnePrinc('', 'archivo_contrato_credito', $id_tabla, $file, 'n', true, 'archivo_credito');
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



// Tabla PRINCIPAL
$get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
$tpl->asignar('tabla', $get_tabla);
// PARA EL SELECT de VEN_CLIENTE_CONTACTOS
$ven_cliente_contacto = Process::getValuesSelectRel('ven_cliente_contacto', 'ven_cliente_sucursales', 'ven_cliente', '', '', 'n');
$tpl->asignar('ven_cliente_contacto', $ven_cliente_contacto);

$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->obtenerPlantilla();


unset($flash_error);
unset($flash_notice);




