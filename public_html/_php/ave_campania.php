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
        $campania = trim($_POST['campania']);
        $motivo = $_POST['motivo'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_inicio_unix = Dates::ConvertToUnix($fecha_inicio);
        $mlg_fecha_inicio = $_POST['mlg_fecha_inicio'];
        $mlg_fecha_inicio_unix = Dates::ConvertToUnix($mlg_fecha_inicio);
        $hora = $_POST['hora'];
        $mlg_asunto = $_POST['mlg_asunto'];
        $mlg_texto = $_POST['mlg_texto'];
        $first_time = $_POST['first_time'];
        $id_tabla = $_POST['id_tabla'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        do {
            $validations = Validations::General(array(
                                        array('field' => $campania, 'null' => false, 'notice_error' => 'Debe haberse completado automáticamente Campaña.'),
                                        array('field' => $motivo, 'null' => false, 'notice_error' => 'Debe completar el Motivo.'),
                                        array('field' => $fecha_inicio, 'null' => false, 'validation' => 'date', 'notice_error' => 'La fecha no es correcta y/o no fue ingresada.'),
                                        array('field' => $fecha_inicio, 'null' => false, 'validation' => 'date_is_weekend', 'notice_error' => 'Fecha de Inicio cae un fin de semana.'),
                                        array('field' => $fecha_inicio, 'null' => false, 'validation' => 'is_day_off', 'notice_error' => 'La fecha de inicio cae un feriado.',
                                                    'extra' => '1'),
                                        array('field' => $mlg_fecha_inicio, 'null' => false, 'validation' => 'date', 'notice_error' => 'La fecha de inicio del Mailing no es correcta y/o no fue ingresada.'),
                                        array('field' => $hora, 'null' => false, 'notice_error' => 'La hora no fue ingresada.'),
                                        array('field' => $mlg_asunto, 'null' => false, 'notice_error' => 'El asunto del Mailing no fue ingresado.'),
                                        array('field' => $mlg_texto, 'null' => false, 'notice_error' => 'El texto del mailing no fue ingresado.')
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
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $campania, $motivo, $fecha_inicio_unix, $hora, $mlg_fecha_inicio_unix, $mlg_asunto, $mlg_texto), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente.';
                $first_time = 'false';
            }else { // Modificar tabla principal
                $update_tabla_princ =
                    BDConsulta::consulta('update_tabla_princ', array($id_tabla, $campania, $motivo, $fecha_inicio_unix, $hora, $mlg_fecha_inicio_unix, $mlg_asunto, $mlg_texto), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No se pudo modificar el registro';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente.';
            }
        }while(0);
        $tpl->asignar('first_time', $first_time);
endif;

///////////  Por POST, del FORM. SUBIDA DE ARCHIVOS, el mail.//////////////////////////////////
if(isset($_POST['subir_mail'])):
    $first_time = $_POST['first_time'];
    do {
        if($first_time == 'true'){
            $flash_error = 'Debe cargar primero los demás campos.';
            break;
        }
        $file = $_FILES['archivo'];
        $id_tabla_proc = $_POST['id_tabla_proc'];   $id_tabla = $_POST['id_tabla'];
        $file_upload = ProcessFiles::FileUploadOnePrinc('', 'mlg_plantilla', $id_tabla, $file, 'n', true);
        if($file_upload['error'] == true) {
            $flash_error = $file_upload['notice_error'];
            break;
        }
        $flash_notice = $file_upload['notice_success'];
    }while(0);
    $tpl->asignar('first_time', $first_time);
endif;




///////////////////////////////// AGREGAR LLAMADA DE CLIENTES |  POST
if(isset($_POST['agregar_cliente'])):
        $ven_cliente_contacto = $_POST['ven_cliente_contacto'];
        $horario = $_POST['horario'];
        $first_time = $_POST['first_time'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        $id_tabla = $_POST['id_tabla'];
        do {
            if($first_time == 'true') { // TODAVIA no llenó la tabla principal
                $flash_error = 'Debe ingresar antes, observaciones y cliente.';
                break;
            }
            $validations = Validations::General(array(
                                       array('field' => $ven_cliente_contacto, 'null' => false, 'validation' => 'field_search', 'notice_error' => 'Debe ingresar cliente.', 'table' => 'ven_cliente_contacto.id_ven_cliente_contacto'),
                                       array('field' => $horario, 'null' => false, 'notice_error' => 'Debe completar el horario.')
                                       ));
            if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break;
            }
            $tabla_sec = Process::CreateSec('', 'clientes', $id_tabla_proc, 'n');
            if($tabla_sec['error'] == true) {
                $flash_error = $tabla_sec['notice_error'];
                break;
            }
            $id_tabla_sec = $tabla_sec['id_tabla_sec'];
            $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $ven_cliente_contacto, $horario), 's');
            if(is_null($update_tabla_sec)) {
                $flash_error = 'No pudo insertar el gasto.';
                break;
            }
            $flash_notice = 'Nuevo cliente agregado correctamente.';
        }while(0);
        $tpl->asignar('first_time', $first_time);
endif;

// RESET PRINCIPALES
require_once '_php/forms_reset.php';

// Tabla PRINCIPAL
$get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
$tpl->asignar('tabla', $get_tabla);
if($first_time == 'true') {
    $campania = date('d/m/Y - G:i') . ' - ' . $nombres; // Lo que va en Campania, luego se inserta en tabla.
    $tpl->asignar('campania', $campania);
}

// PARA EL SELECT de VEN_CLIENTE_SUCURSALES
$ven_clientes = Process::getValuesSelectRel('ven_cliente_contacto', 'ven_cliente_sucursales', 'ven_cliente', '', '', 'n');
$tpl->asignar('ven_clientes', $ven_clientes);
// TABLA SECUNDARIA (Llamadas a Clientes)
$get_tabla_sec_clientes = Process::getTablaSec('', 'clientes', $id_tabla_proc, 'n', 'ven_cliente_contacto', '', '', 'ven_cliente_sucursales', 'ven_cliente');
$tpl->asignar('tabla_sec', $get_tabla_sec_clientes);

$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->obtenerPlantilla();


unset($flash_error);
unset($flash_notice);




