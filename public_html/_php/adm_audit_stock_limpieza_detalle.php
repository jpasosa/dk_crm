<?php

if($_GET[1] != '' && $_GET[1] > 0)

{  // Si NO TIENE EL NÚMERO DE ID DE UN PROCESO, VUELVE AL MENU.TPL

	$tpl = new PlantillaReemplazos();
	require_once '_php/forms_start.php';


	//////////////////////////////////////////////////////////////////////////////      AJAX      ////////////////////////////////////////
	if(isset($_POST['id_prod_del']) && $_POST['id_prod_del'] > 0)
	{  // ELIMINAR un PRODUCTO
	        $id_prod_del = $_POST['id_prod_del'];
	        $del_tabla_sec = Process::DeleteSec('adm_audit_stock_limpieza_detalle', 'prod', $id_prod_del);
	        FormCommon::queryRespHeader($del_tabla_sec);
	}

	if(isset($_POST['id_prod_edit']) && $_POST['id_prod_edit'] > 0)
	{ // EDITAR  un PRODUCTO
	        $id_prod_edit = $_POST['id_prod_edit'];
	        $edit_tabla_sec = Process::ModifySec('adm_audit_stock_limpieza_detalle', 'prod', $id_prod_edit);
	        FormCommon::queryRespHeader($edit_tabla_sec);
	}



	///////////////////////////////// AGREGAR TABLA PRINCIPAL  |  POST
	if(isset($_POST['agregar']))
	{
		$bodega		=$_POST['bodega'];
		$limpieza_detalle=$_POST['limpieza_detalle'];
		$observaciones=$_POST['observaciones'];
		$first_time		=$_POST['first_time'];
		$id_tabla 		=$_POST['id_tabla'];
		$id_tabla_proc	=$_POST['id_tabla_proc'];
		do
		{
			$validations = Validations::General(array(
			array('field' => $bodega, 'null' => false, 'notice_error' => 'Debe ingresar el nombre de la bodega.')
			));
			if($validations['error'] == true) {
				$flash_error = $validations['notice_error'];
				break;
			}
			if($first_time == 'true' ) { // Primera VEZ
				$new_process = Process::CreateNewProcess('', $id_user, 'n');
				if($new_process['error'] == true) {
					$flash_error = 'No pudo agregar el registro principal';
					break;
				}
				$flash_notice = $new_process['notice_success'];
				$id_tabla 	= $new_process['id_tabla'];
				$id_tabla_proc = $new_process['id_tabla_proc'];
				$tpl->asignar('id_tabla', $id_tabla);
				$tpl->asignar('id_tabla_proc', $id_tabla_proc);
				$update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $bodega, $limpieza_detalle, $observaciones), 'n');
				if(is_null($update_tabla_princ)) {
					$flash_error = 'No pudo agregar el registro principal';
					break;
				}
				$flash_notice = 'Registro modificado correctamente.';
				$first_time = 'false';
			}else{ // Modificar tabla principal
				$update_tabla_princ =
				BDConsulta::consulta('update_tabla_princ', array($id_tabla, $bodega, $limpieza_detalle, $observaciones), 'n');
				if(is_null($update_tabla_princ)) {
					$flash_error = 'No se pudo modificar el registro';
					break;
				}
				$flash_notice = 'Registro modificado correctamente.';
			}
		}while(0);
		$tpl->asignar('first_time', $first_time);
	}



	///////////////////////////////// AGREGAR PRODUCTO |  POST
	if(isset($_POST['agregar_prod']))
	{
		$id_pro_producto = $_POST['id_pro_producto'];
		$id_sis_problemas = $_POST['id_sis_problemas'];
		$first_time = $_POST['first_time'];
		$id_tabla_proc = $_POST['id_tabla_proc'];
		$id_tabla = $_POST['id_tabla'];
		do {
			if($first_time == 'true') { // TODAVIA no llenó la tabla principal
				$flash_error = 'Debe completar antes el registro principal.';
				break;
			}
			$tabla_sec = Process::CreateSec('adm_audit_stock_limpieza_detalle', 'prod', $id_tabla_proc, 'n');
			if($tabla_sec['error'] == true) {
				$flash_error = $tabla_sec['notice_error'];
				break;
			}
			$id_tabla_sec = $tabla_sec['id_tabla_sec'];
			$update_tabla_sec = BDConsulta::consulta('update_tabla_sec', array($id_tabla_sec, $id_pro_producto, $id_sis_problemas), 'n');
			if(is_null($update_tabla_sec)) {
				$flash_error = 'No pudo insertar el producto.';
				break;
			}
			$flash_notice = 'Nuevo tema agregado correctamente.';
		}while(0);
		$tpl->asignar('first_time', $first_time);
	}

	// RESET PRINCIPALES
	require_once '_php/forms_reset.php';


	$id_tabla_limpieza = $_GET[1];
	$get_tabla_limpieza = BDConsulta::consulta('get_tabla_limpieza', array($id_tabla_limpieza), 'n'); // Tengo que agarrar el registro de adm_audit_stock_limpieza
	if(isset($get_tabla_limpieza) && isset($get_tabla_limpieza[0])) {
	    $adm_audit_stock_limpieza = $get_tabla_limpieza[0];
	    $tpl->asignar('adm_audit_stock_limpieza', $adm_audit_stock_limpieza);
	}


	// TABLA PRINCIPAL  (adm_audit_stock_limpieza_detalle)
	$get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
	$tpl->asignar('tabla', $get_tabla);
	// TABLA SECUNDARIA (Estado de los PRODUCTOS)
	$tabla_sec_prod = Process::getTablaSec('adm_audit_stock_limpieza_detalle', 'prod', $id_tabla_proc, 'n', 'pro_productos', 'sis_problemas');
	$tpl->asignar('tabla_sec', $tabla_sec_prod);
	// PARA EL SELECT de PRO_PRODUCTOS
	$pro_productos_select = Process::getValuesSelectRel('pro_productos', '', '', '', '', 'n');
	$tpl->asignar('pro_productos_select', $pro_productos_select);
	// PARA EL SELECT de LISTADO DE PROBLEMAS
	$sis_problemas = Process::getValuesSelectRel('sis_problemas', '', '', '', '', 'n');
	$tpl->asignar('sis_problemas', $sis_problemas);


	$tpl->asignar('flash_error', $flash_error);
	$tpl->asignar('flash_notice', $flash_notice);
	$tpl->obtenerPlantilla();


	unset($flash_error);
	unset($flash_notice);


}else{ // es el primer if, en donde si no pasó un id_tabla_sec, vuelve al menu principal.
        header('Location: /menu.html');
        exit();
}





