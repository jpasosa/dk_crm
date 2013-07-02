<?php
$tpl = new PlantillaReemplazos();

require_once '_php/forms_start.php';


//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////
if(isset($_POST['id_detalle_del']) && $_POST['id_detalle_del'] > 0):  // ELIMINAR un detalle
        $id_detalle_del = $_POST['id_detalle_del'];
        $del_tabla_sec = Process::DeleteSec('', 'detalle', $id_detalle_del);
        FormCommon::queryRespHeader($del_tabla_sec);
endif;

if(isset($_POST['id_detalle_edit']) && $_POST['id_detalle_edit'] > 0): // EDITAR  item tabla secundaria
        $id_detalle_edit = $_POST['id_detalle_edit'];
        $edit_tabla_sec = Process::ModifySec('', 'detalle', $id_detalle_edit);
        FormCommon::queryRespHeader($edit_tabla_sec);
endif;

///////////////////////////////// AGREGAR TABLA PRINCIPAL  |  POST
if(isset($_POST['agregar'])):
        $nombre_pedido = $_POST['nombre_pedido'];
        $first_time = $_POST['first_time'];
        $id_tabla = $_POST['id_tabla'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        do {
            $validations = Validations::General(array(
                                        array('field' => $nombre_pedido, 'null' => false, 'notice_error' => 'Debe ingresar el nombre del Pedido.')));
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
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $nombre_pedido), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente.';
                $first_time = 'false';
            }else { // Modificar tabla principal
                $update_tabla_princ =
                    BDConsulta::consulta('update_tabla_princ', array($id_tabla, $nombre_pedido), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No se pudo modificar el registro';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente.';
            }
        }while(0);
        $tpl->asignar('first_time', $first_time);
endif;




///////////////////////////////// AGREGAR PRODUCTOS |  POST
if(isset($_POST['agregar_det'])):
        $nombre = $_POST['nombre'];
        $detalle = $_POST['detalle'];
        $cantidad = $_POST['cantidad'];
        $observaciones = $_POST['observaciones'];
        $precio_deseado = Common::PutDot($_POST['precio_deseado']);
        $first_time = $_POST['first_time'];
        $id_tabla_proc = $_POST['id_tabla_proc'];
        $id_tabla = $_POST['id_tabla'];
        // Archivos y fotos
        $foto_1 = $_POST['foto_1'];$foto_2 = $_POST['foto_2'];$foto_3 = $_POST['foto_3'];$foto_4 = $_POST['foto_4'];$foto_5 = $_POST['foto_5'];
        $archivo_1 = $_POST['archivo_1'];$archivo_2 = $_POST['archivo_2'];$archivo_3 = $_POST['archivo_3'];$archivo_4 = $_POST['archivo_4'];$archivo_5 = $_POST['archivo_5'];
        do {
            if($first_time == 'true') { // TODAVIA no llenó la tabla principal
                $flash_error = 'Debe ingresar antes, observaciones y cliente.';
                break;
            }
            $validations = Validations::General(array(
                                        array('field' => $monto, 'null' => false, 'validation' => 'numeric', 'notice_error' => 'El monto no es correcto y/o no fue ingresado.'),
                                        array('field' => $detalle, 'null' => false, 'notice_error' => 'El detalle no fue ingresado.'),
                                        array('field' => $factura, 'null' => false, 'notice_error' => 'Debe ingresar la factura.')
                                        ));
            if($validations['error'] == true) {
               $flash_error = $validations['notice_error'];
                break;
            }
            $tabla_sec = Process::CreateSec('', 'prod', $id_tabla_proc, 'n');
            if($tabla_sec['error'] == true) {
                $flash_error = $tabla_sec['notice_error'];
                break;
            }
            $id_tabla_sec = $tabla_sec['id_tabla_sec'];
            $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $nombre, $detalle, $cantidad, $precio_deseado, $observaciones,
                                                                                                                    $foto_1, $foto_2, $foto_3, $foto_4, $foto_5,
                                                                                                                    $archivo_1, $archivo_2, $archivo_3, $archivo_4, $archivo_5), 'n');
            if(is_null($update_tabla_sec)) {
                $flash_error = 'No pudo insertar el detalle.';
                break;
            }
            $flash_notice = 'Nuevo detalle agregado correctamente.';
        }while(0);
        $tpl->asignar('first_time', $first_time);
endif;

///////////  Por POST, del FORM. SUBIDA DE ARCHIVOS.////////////////////////////////// (pertenece también a la tabla principal)
if(isset($_POST['subir_archivo'])):
    $first_time = $_POST['first_time'];
    do {
        if($first_time == 'true'):
                $flash_error = 'Debe cargar primero observaciones.';
                break;
        endif;
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

var_dump(Process::isEmptyColumn('', 'prod', 'foto_1', 2, 's')) ;




// RESET PRINCIPALES
require_once '_php/forms_reset.php';

// Tabla PRINCIPAL
$get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
$tpl->asignar('tabla', $get_tabla);
// // PARA EL SELECT de SIS_CUENTAS
$sis_cuentas = Process::getValuesSelectRel('sis_cuentas', '', '', '', '', 'n');
$tpl->asignar('sis_cuentas', $sis_cuentas);
// // PARA EL SELECT de CRP_PROVEEDORES
$crp_proveedores = Process::getValuesSelectRel('cpr_proveedores', '', '', '', '', 'n');
$tpl->asignar('crp_proveedores', $crp_proveedores);
// // PARA EL SELECT de SIS_AREAS
$sis_areas = Process::getValuesSelectRel('sis_areas', '', '', '', '', 'n');
$tpl->asignar('sis_areas', $sis_areas);
// TABLA SECUNDARIA (los detalles)
$detalles = Process::getTablaSec('', 'detalle', $id_tabla_proc, 'n', 'sis_cuentas', 'cpr_proveedores', 'sis_areas');
$tpl->asignar('tabla_sec', $detalles);
// MONTO TOTAL
$monto_total = Process::getTablaSecTotal('', 'detalle', $id_tabla_proc, 'monto');
if(isset($monto_total['error']) && $monto_total['error'] == true) {
    $monto_total = 0.00;
}else{
    $monto_total = $monto_total['monto_total'];
}
$tpl->asignar('monto_total', $monto_total);

$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->obtenerPlantilla();

unset($flash_error);
unset($flash_notice);




