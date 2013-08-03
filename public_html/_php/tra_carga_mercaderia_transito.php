<?php



$precios_tcmt = array();	// Precios pasados a la vista.
function getPrecios($precios) {
	$precios_arr = array();
	if(isset($precios)) {
		foreach($precios as $pr) {
			$precios_arr[] .= $pr;
		}
	}
	return $precios_arr;
}


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




	///////////////////////////////// AGREGAR TABLA PRINCIPAL  |  POST
	if(isset($_POST['agregar']))
	{
		$proveedor			=$_POST['proveedor'];
		$packing_list 		=$_POST['packing_list'];
		$observaciones 		=$_POST['observaciones'];
		$fecha_envio		=$_POST['fecha_envio'];
		$fecha_envio_unix 	= Dates::ConvertToUnix($fecha_envio);
		$fecha_llegada 		=$_POST['fecha_llegada'];
		$fecha_llegada_unix= Dates::ConvertToUnix($fecha_llegada);
		$observaciones		=$_POST['observaciones'];
		$first_time			=$_POST['first_time'];
		$id_tabla_proc		=$_POST['id_tabla_proc'];
		$id_tabla			=$_POST['id_tabla'];
		do
		{
			$validations = Validations::General(array(
										array('field' => $observaciones, 'null' => false, 'notice_error' => 'Debe ingresar las observaciones.')
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
				$update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $proveedor, $packing_list, $fecha_envio_unix, $fecha_llegada_unix, $observaciones), 'n');
				if(is_null($update_tabla_princ)) {
					$flash_error = 'No pudo agregar el registro principal';
					break;
				}
				$flash_notice = 'Registro modificado correctamente.';
				$first_time = 'false';
			}else{ // Modificar tabla principal
				$update_tabla_princ =
				BDConsulta::consulta('update_tabla_princ', array($id_tabla, $proveedor, $packing_list, $fecha_envio_unix, $fecha_llegada_unix, $observaciones), 'n');
				if(is_null($update_tabla_princ)) {
					$flash_error = 'No se pudo modificar el registro';
					break;
				}
				$flash_notice = 'Registro modificado correctamente.';
			}
		}while(0);
		$precios_tcmt = getPrecios($_POST['precio']);
		$tpl->asignar('precios', $precios_tcmt);
		$tpl->asignar('first_time', $first_time);
	}


	///////////////////////////////// AGREGAR PRECIOS AL ARRAY
	if(isset($_POST['agregar_precio']))
	{
		$id_tra_packing_list = $_POST['id_tra_packing_list'];
		$first_time = $_POST['first_time'];
		$id_tabla_proc = $_POST['id_tabla_proc'];
		$id_tabla = $_POST['id_tabla'];
		$precios_tcmt = getPrecios($_POST['precio']);
		do
		{
			if($first_time == 'true') { // TODAVIA no llenó la tabla principal
				$flash_error = 'Debe completar antes el registro principal.';
				break;
			}
			$tpl->asignar('precios', $precios_tcmt);
			$tpl->asignar('id_tra_packing_list', $id_tra_packing_list);
			$tpl->asignar('first_time', $first_time);
			$tpl->asignar('id_tabla_proc', $id_tabla_proc);
			$tpl->asignar('id_tabla', $id_tabla);
			$flash_notice = 'Precios modificados correctamente.';
		} while(0);

	}



	///////////////////////////////// SUBIR FOTO A CADA PRODUCTO
	if(isset($_POST['subir_foto']))
	{
		// TODO: falta realizar esta funcionalidad.
		$precios_tcmt = getPrecios($_POST['precio']);
		$first_time = $_POST['first_time'];
		$id_tabla_proc = $_POST['id_tabla_proc'];
		$id_tabla = $_POST['id_tabla'];
		$tpl->asignar('first_time', $first_time);
		$tpl->asignar('precios', $precios_tcmt);
	}



	if(isset($_POST['salvar_datos']))
	{

		$datos_pasados 	= $_POST['datos_pasados'];
		$id_tra_packing_list = $_POST['id_tra_packing_list'];
		$first_time 			= $_POST['first_time'];
		$id_tabla_proc 		= $_POST['id_tabla_proc'];
		$id_tabla 			= $_POST['id_tabla'];
		$precios_tcmt 		= getPrecios($_POST['precio']);
		do
		{
			if($datos_pasados == 'true') { // TODAVIA no llenó la tabla principal
				$flash_error = 'Sus datos ya fueron registrados. No puede volver a registrarlos, debe pasar al siguiente paso.';
				$datos_pasados = 'true';
				break;
			}
			if($first_time == 'true') { // TODAVIA no llenó la tabla principal
				$flash_error = 'Debe completar antes el registro principal. Y recuerde modificar los precios.';
				break;
			}
			// TABLA secundaria, la anterior, de tra_packing_list_prdd.
			$tabla_sec_anterior = Process::getFirstProcess('tra_packing_list', $id_tra_packing_list);
			if(isset($tabla_sec_anterior) && isset($tabla_sec_anterior[0])) {
				$id_tabla_ant_proc = $tabla_sec_anterior[0]['id_tra_packing_list_proc'];
				$tabla_sec_anterior_prod = Process::getTablaSec('tra_packing_list', 'prod', $id_tabla_ant_proc, 'n', 'pro_productos');
				if(isset($precios_tcmt)) {
					foreach($precios_tcmt as $k=>$price) {
						$tabla_sec_anterior_prod[$k]['precio_nuevo'] = Common::PutDot($price);
					}
				}
				foreach($tabla_sec_anterior_prod as $ant) {
					$insert_tabla_sec = BDConsulta::consulta('insert_tabla_sec', array($id_tabla_proc, $ant['id_pro_productos'], $ant['nro_caja_tpl'], $ant['productos_por_caja_tpl'],
																$ant['alto_tpl'], $ant['ancho_tpl'], $ant['fondo_tpl'], $ant['volumen_tpl'], $ant['peso_tpl'], $ant['precio_nuevo']), 'n');
				}
			}
			$flash_notice = 'Datos agregados a la tabla. Debe pasar al siguiente Paso.';
			$datos_pasados = 'true';

		}while(0);
		$tpl->asignar('precios', $precios_tcmt);
		$tpl->asignar('id_tra_packing_list', $id_tra_packing_list);
		$tpl->asignar('id_tabla_proc', $id_tabla_proc);
		$tpl->asignar('id_tabla', $id_tabla);
		$tpl->asignar('first_time', $first_time);
		$tpl->asignar('datos_pasados', $datos_pasados);
	}

	// RESET PRINCIPALES
	require_once '_php/forms_reset.php';



	$id_tra_packing_list = $_GET[1];
	$tpl->asignar('id_tra_packing_list', $id_tra_packing_list);

	// Tabla principal anterior; la de tra_packing_list
	$get_tra_packing_list = BDConsulta::consulta('get_tra_packing_list', array($id_tra_packing_list), 'n'); // Tengo que agarrar el registro de adm_audit_stock_limpieza
	if(isset($get_tra_packing_list) && isset($get_tra_packing_list[0])) {
	    $tra_packing_list = $get_tra_packing_list[0];
	    $tpl->asignar('tra_packing_list', $tra_packing_list);
	}

	// TABLA secundaria, la anterior, de tra_packing_list_prdd.
	$tabla_sec_anterior = Process::getFirstProcess('tra_packing_list', $id_tra_packing_list);
	if(isset($tabla_sec_anterior) && isset($tabla_sec_anterior[0])) {
		$id_tabla_ant_proc = $tabla_sec_anterior[0]['id_tra_packing_list_proc'];
		$tabla_sec_anterior_prod = Process::getTablaSec('tra_packing_list', 'prod', $id_tabla_ant_proc, 'n', 'pro_productos');
		// debo ingresarle un nuevo array a la tabla secundaria para guardar los nuevos precios.
		if(isset($precios_tcmt)) {
			foreach($precios_tcmt as $k=>$price) {
				$tabla_sec_anterior_prod[$k]['precio_nuevo'] = $price;
			}
		}
		$tpl->asignar('tabla_sec_anterior_prod', $tabla_sec_anterior_prod); // tabla anterior, la tabla secundaria.
	}

	// TABLA PRINCIPAL  (adm_audit_stock_limpieza_detalle)
	$get_tabla = Process::getTabla('', $id_tabla_proc, 'n');
	$tpl->asignar('tabla', $get_tabla);






	$tpl->asignar('flash_error', $flash_error);
	$tpl->asignar('flash_notice', $flash_notice);
	$tpl->obtenerPlantilla();


	unset($flash_error);
	unset($flash_notice);


}else{ // es el primer if, en donde si no pasó un id_tabla_sec, vuelve al menu principal.
        header('Location: /menu.html');
        exit();
}





