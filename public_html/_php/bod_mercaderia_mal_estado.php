<?php


$tpl = new PlantillaReemplazos();

require_once '_php/forms_start.php';


//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////
if(isset($_POST['id_prod_del']) && $_POST['id_prod_del'] > 0)
{    // ELIMINAR PRODUCTO
	$delete_sec = Process::DeleteSec('', 'prod', $_POST['id_prod_del']);
	FormCommon::queryRespHeader($delete_sec);
}

if(isset($_POST['id_prod_edit']) && $_POST['id_prod_edit'] > 0)
{  // MODIFICAR PRODUCTO
	$edit_sec = Process::ModifySec('', 'prod', $_POST['id_prod_edit']);
	FormCommon::queryRespHeader($edit_sec);
}




///  Por POST, del FORM  |  Tabla Principal (observaciones)///
if(isset($_POST['agregar']))
{
	$informe		= trim($_POST['informe']);
	$observaciones	= trim($_POST['observaciones']);
	$first_time 		= $_POST['first_time'];
	$id_tabla_proc  	= $_POST['id_tabla_proc'];
	$id_tabla   		= $_POST['id_tabla'];
	do
	{ // VALIDACIONES
		$validations = Validations::General(array(
									array('field' => $observaciones, 'null' => false, 'notice_error' => 'Debe ingresar una observación.')
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
			$id_tabla_proc 	= $new_process['id_tabla_proc'];
			$id_tabla 		= $new_process['id_tabla'];
			$tpl->asignar('id_tabla_proc', $id_tabla_proc);
			$tpl->asignar('id_tabla', $new_process['id_tabla']);
			$informe = 'Informe Nro. ' . $id_tabla; // el código del packing list va a ser el mismo que el ID del registro.
			$update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $informe, $observaciones), 'n');
			if(is_null($update_tabla_princ)) {
				$flash_error = 'No pudo cargar el registro.';
				break;
			}
			$flash_notice	= 'Se cargó correctamente';
			$first_time 		= 'false';
		}else{ // MODIFICA
			$update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $informe, $observaciones), 'n');
			if(is_null($update_tabla_princ)) {
				$flash_error = 'No pudo hacer la actualización.';
				break;
			}
			$flash_notice = 'Registro modificado correctamente';
		}
	} while (0);
	$tpl->asignar('first_time', $first_time);
}


///////////////////////////////// AGREGAR TABLA SECUNDARIA (productos) |  POST
if(isset($_POST['agregar_prod']))
{
	$id_pro_productos	= trim($_POST['id_pro_productos']);
	$nro_caja 			= trim($_POST['nro_caja']);
	$productos_por_caja= trim($_POST['productos_por_caja']);
	$aclaracion 			= trim($_POST['aclaracion']);
	$first_time 			= $_POST['first_time'];
	$id_tabla_proc 		= $_POST['id_tabla_proc'];
	$id_tabla 			= $_POST['id_tabla'];
	do
	{
		if($first_time == 'true') {
			$flash_error = 'Debe ingresar antes las observaciones.';
			break;
		}
		$validations = Validations::General(array(
						array('field' => $nro_caja, 'null' => false, 'validation' => 'numeric', 'notice_error' => 'Debe ingresar número de caja y/o no es númerico.'),
						array('field' => $productos_por_caja, 'null' => false, 'validation' => 'numeric', 'notice_error' => 'Debe ingresar los productos por caja y/o no son númericos.'),
						array('field' => $aclaracion, 'null' => false, 'notice_error' => 'Debe ingresar la aclaración.'),
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
		$update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $id_pro_productos, $nro_caja, $productos_por_caja, $aclaracion), 'n');
		if(is_null($update_tabla_sec)) {
			$flash_error = 'No pudo insertar el producto.';
			break;
		}
		$flash_notice = 'Nuevo producto agregado correctamente.';
	}while(0);
	$tpl->asignar('first_time', $first_time);
}



// RESET PRINCIPALES
require_once '_php/forms_reset.php';
// TABLA PRINCIPAL
$get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
$tpl->asignar('tabla', $get_tabla);
// PARA EL SELECT de PRO_PRODUCTOS
$pro_productos_select = Process::getValuesSelectRel('pro_productos', '', '', '', '', 'n');
$tpl->asignar('pro_productos_select', $pro_productos_select);
// TABLA SECUNDARIA (los productos)
$gast_detalles = Process::getTablaSec('', 'prod', $id_tabla_proc, 'n', 'pro_productos');
$tpl->asignar('tabla_sec', $gast_detalles);
// MENSAJES FLASH
$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
// LEVANTO VISTA
$tpl->obtenerPlantilla();

