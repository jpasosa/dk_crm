<?php
$tpl = new PlantillaReemplazos();

require_once '_php/forms_start.php';


//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////
if(isset($_POST['id_tabla_sec']) && $_POST['id_tabla_sec'] > 0):  // ELIMINAR un pedido
        $id_tabla_sec = $_POST['id_tabla_sec'];
        $del_tabla_sec = Process::DeleteSec('', 'prod', $id_tabla_sec);
        FormCommon::queryRespHeader($del_tabla_sec);
endif;
if(isset($_POST['id_tabla_sec_edit']) && $_POST['id_tabla_sec_edit'] > 0): // EDITAR una SUCURSAL
        $id_tabla_sec_edit = $_POST['id_tabla_sec_edit'];
        $edit_tabla_sec = Process::ModifySec('', 'prod', $id_tabla_sec_edit);
        FormCommon::queryRespHeader($edit_tabla_sec);
endif;


///////////////////////////////// AGREGAR TABLA PRINCIPAL  |  POST
if(isset($_POST['agregar'])):
        $id_ven_cliente = $_POST['id_ven_cliente'];
        $observaciones  = trim($_POST['observaciones']);
        $first_time     = $_POST['first_time'];
        $id_tabla       = $_POST['id_tabla'];
        $id_tabla_proc  = $_POST['id_tabla_proc'];
        do {
            $validations = Validations::General(array(
                                    array('field' => $observaciones, 'null' => false, 'notice_error' => 'Debe ingresar observaciones.')));
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
	$flash_notice  = $new_process['notice_success'];
	$id_tabla      = $new_process['id_tabla'];
	$id_tabla_proc = $new_process['id_tabla_proc'];
                $tpl->asignar('id_tabla', $id_tabla);
                $tpl->asignar('id_tabla_proc', $id_tabla_proc);
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $id_ven_cliente, $observaciones), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No pudo agregar el registro principal';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente.';
                $first_time   = 'false';
            }else { // Modificar tabla principal
                $update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $id_ven_cliente, $observaciones), 'n');
                if(is_null($update_tabla_princ)) {
                    $flash_error = 'No se pudo modificar el registro';
                    break;
                }
                $flash_notice = 'Registro modificado correctamente.';
            }
        }while(0);
        $tpl->asignar('first_time', $first_time);
endif;


///////////////////////////////// AGREGAR SUCURSALES |  POST
if(isset($_POST['agregar_suc'])):
        $id_pro_producto = $_POST['id_pro_producto'];
        $cantidad        = $_POST['cantidad'];
        $first_time      = $_POST['first_time'];
        $id_tabla_proc   = $_POST['id_tabla_proc'];
        $id_tabla        = $_POST['id_tabla'];
        do {
            if($first_time == 'true') { // TODAVIA no llenó la tabla principal
                $flash_error = 'Debe ingresar antes los datos del cliente.';
                break;
            }
            $validations = Validations::General(array(
                                       array('field' => $id_pro_producto, 'null' => false, 'validation' => 'field_search', 'notice_error' => 'Debe ingresar la referencia.', 'table' => 'pro_productos.id_pro_productos'),
                                       array('field' => $cantidad, 'null' => false, 'validation' => 'numeric', 'notice_error' => 'Debe completar cantidad y/o debe ser numerica.')
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
            $update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $id_pro_producto, $cantidad), 'n');
            if(is_null($update_tabla_sec)) {
                $flash_error = 'No pudo insertar el pedido.';
                break;
            }
            $flash_notice = 'Nuevo pedido agregado correctamente.';
        }while(0);
        $tpl->asignar('first_time', $first_time);
endif;







// RESET PRINCIPALES
require_once '_php/forms_reset.php';



// Tabla PRINCIPAL
$get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
$tpl->asignar('tabla', $get_tabla);
// PARA EL SELECT de VEN_CLIENTE
$ven_cliente = Process::getValuesSelectRel('ven_cliente', '', '', '', '', 'n');
$tpl->asignar('ven_cliente', $ven_cliente);
// TABLA SECUNDARIA (muestras de PRODUCTOS)
$muestras = Process::getTablaSec('', 'prod', $id_tabla_proc, 'n', 'pro_productos');
$tpl->asignar('tabla_sec', $muestras);

// PARA EL SELECT de PRO_PRODUCTOS
$pro_productos_select = Process::getValuesSelectRel('pro_productos', '', '', '', '', 'n');
$tpl->asignar('pro_productos_select', $pro_productos_select);

$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->obtenerPlantilla();


unset($flash_error);
unset($flash_notice);




