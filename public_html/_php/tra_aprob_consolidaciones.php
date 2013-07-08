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
    $fecha = trim($_POST['fecha']);
    $fecha_unix = Dates::ConvertToUnix($fecha);
    $ven_cliente_contacto = trim($_POST['ven_cliente_contacto']);
    $contacto = trim($_POST['contacto']);
    $direccion = trim($_POST['direccion']);
    $telefono = trim($_POST['telefono']);
    $mail = trim($_POST['mail']);
    $hora = trim($_POST['hora']);
    $observaciones = trim($_POST['observaciones']);
    $first_time = $_POST['first_time'];
    $id_tabla_proc  = $_POST['id_tabla_proc'];
    $id_tabla   = $_POST['id_tabla'];
    do { // VALIDACIONES
           $validations = Validations::General(array(
                                    array('field' => $fecha, 'null' => false, 'validation' => 'date', 'notice_error' => 'La fecha de inicio no es correcta.'),
                                    array('field' => $contacto, 'null' => false, 'notice_error' => 'Debe ingresar contacto.'),
                                    array('field' => $direccion, 'null' => false, 'notice_error' => 'Debe ingresar dirección.'),
                                    array('field' => $telefono, 'null' => false, 'notice_error' => 'Debe ingresar teléfono.'),
                                    array('field' => $mail, 'null' => false, 'notice_error' => 'Debe ingresar mail.'),
                                    array('field' => $hora, 'null' => false, 'notice_error' => 'Debe ingresar hora.'),
                                    array('field' => $observaciones, 'null' => false, 'notice_error' => 'Debe ingresar observaciones.')
                                    ));
            if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break;
            }
            if($first_time == 'true'  ) { // 1era VEZ
                $new_process = Process::CreateNewProcess('', $id_user, 'n' );
                if($new_process['error'] == true) {
                    $flash_error = $new_process['notice_error'];
                    break;
                }
                $id_tabla_proc = $new_process['id_tabla_proc'];     $id_tabla = $new_process['id_tabla'];
                $tpl->asignar('id_tabla_proc', $id_tabla_proc);       $tpl->asignar('id_tabla', $new_process['id_tabla']);
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $fecha_unix, $ven_cliente_contacto, $contacto, $direccion, $telefono, $mail, $hora, $observaciones), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo cargar el registro.';
                    break;
                }
                $flash_notice = 'Se cargó correctamente';
                $first_time = 'false';
            }else{ // MODIFICA
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $fecha_unix, $ven_cliente_contacto, $contacto, $direccion, $telefono, $mail, $hora, $observaciones), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo hacer la actualización.';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente';
            }
        } while (0);
        $tpl->asignar('first_time', $first_time);
endif;








// RESET PRINCIPALES
require_once '_php/forms_reset.php';

// TABLA PRINCIPAL
$get_tabla = Process::getTabla('', $id_tabla_proc, 'n', 'ven_cliente_contacto', 'ven_cliente_sucursales', 'ven_cliente');
$tpl->asignar('tabla', $get_tabla);
// PARA EL SELECT de VEN_CLIENTE_CONTACTO
$ven_cliente_contacto = Process::getValuesSelectRel('ven_cliente_contacto', 'ven_cliente_sucursales', '', '', '', 'n');
$tpl->asignar('ven_cliente_contacto', $ven_cliente_contacto);
// MENSAJES FLASH
$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
// LEVANTO VISTA
$tpl->obtenerPlantilla();

