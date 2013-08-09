<?php

if($_GET[1] != '' && $_GET[1] > 0)
{  // Si NO TIENE EL NÚMERO DE ID DE UN PROCESO, VUELVE AL MENU.TPL
	$tpl = new PlantillaReemplazos();
	require_once '_php/forms_start.php';


	///////////////////////////////// AGREGAR TABLA PRINCIPAL  |  POST
	if(isset($_POST['agregar']))
	{
		$packing_list 		=$_POST['packing_list'];
		$observaciones 		=$_POST['observaciones'];
		$id_tra_carga_mercaderia_transito = $_POST['id_tra_carga_mercaderia_transito'];
		$id_cpr_proveedor 	= $_POST['id_cpr_proveedor'];
		$prod_tmp			=$_POST['prod_tmp'];
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
			if($first_time == 'true' )
			{ // Primera VEZ
				$new_process = Process::CreateNewProcess('', $id_user, 'n');
				if($new_process['error'] == true) {
					$flash_error = 'No pudo agregar el registro principal';
					break;
				}
				$flash_notice 	= $new_process['notice_success'];
				$id_tabla 		= $new_process['id_tabla'];
				$id_tabla_proc 	= $new_process['id_tabla_proc'];

				$update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $packing_list, $id_cpr_proveedor, $observaciones), 'n');
				if(is_null($update_tabla_princ)) {
					$flash_error = 'No pudo agregar el registro principal';
					break;
				}
				$flash_notice = 'Registro modificado correctamente.';
				$first_time = 'false';

				// CREO TABLA TEMPORAL
				$tabla_sec_anterior = Process::getFirstProcess('tra_carga_mercaderia_transito', $id_tra_carga_mercaderia_transito);
				if(isset($tabla_sec_anterior) && isset($tabla_sec_anterior[0])) {
					$id_tabla_ant_proc = $tabla_sec_anterior[0]['id_tra_carga_mercaderia_transito_proc'];
				}

				// TABLA SECUNDARIA ANTERIOR
				$tabla_sec_anterior = Process::getFirstProcess('tra_carga_mercaderia_transito', $id_tra_carga_mercaderia_transito);

				if(isset($tabla_sec_anterior) && isset($tabla_sec_anterior[0]))
				{
					$id_tabla_ant_proc = $tabla_sec_anterior[0]['id_tra_carga_mercaderia_transito_proc'];
					$tabla_sec_anterior_prod = Process::getTablaSec('tra_carga_mercaderia_transito', 'prod', $id_tabla_ant_proc, 'n', 'pro_productos');

					foreach($tabla_sec_anterior_prod AS $tcmt_prod) {
						$insert_tcmt_prod_tmp = BDConsulta::consulta('insert_tcmt_prod_tmp', array($id_tabla_proc, $tcmt_prod['id_pro_productos'],
							$tcmt_prod['nro_caja_tcmt'], $tcmt_prod['productos_por_caja_tcmt'], $tcmt_prod['alto_tcmt'], $tcmt_prod['ancho_tcmt'],
							$tcmt_prod['fondo_tcmt'], $tcmt_prod['volumen_tcmt'], $tcmt_prod['peso_tcmt'], $tcmt_prod['precio_tcmt'],
							$tcmt_prod['foto_tcmt'], $tcmt_prod['activo']), 'n');
					}
					$select_prod = BDConsulta::consulta('select_prod', array($id_tabla_proc), 'n'); // seleccion de los productos de la tabla temporal.
				}
				$prod_tmp = 'true';

			}
			else
			{ // Modificar tabla principal
				$update_tabla_princ =
				BDConsulta::consulta('update_tabla_princ', array($id_tabla, $packing_list, $id_cpr_proveedor, $observaciones), 'n');
				if(is_null($update_tabla_princ)) {
					$flash_error = 'No se pudo modificar el registro';
					break;
				}
				$flash_notice = 'Registro modificado correctamente.';
				$select_prod = BDConsulta::consulta('get_tye_prod_tmp', array($id_tabla_proc), 'n'); // selección de los productos de la tabla temporal.
			}
		}while(0);
		$tpl->asignar('id_tabla', 		$id_tabla);
		$tpl->asignar('id_tabla_proc', $id_tabla_proc);
		$tpl->asignar('tra_ytd_entrada_prod', $select_prod);
		$tpl->asignar('prod_tmp', 	$prod_tmp);
		$tpl->asignar('first_time', 	$first_time);
	}


	///////////////////////////////// AGREGAR PRODUCTS (va agregando en la tabla temporal.)
	if(isset($_POST['agregar_prod']))
	{
		$id_tra_ytd_entrada_prod = $_POST['id_tra_ytd_entrada_prod'];
		$marca 	= $_POST['marca'];
		$problema 	= $_POST['problema'];
		$familia 	= $_POST['familia'];
		$first_time 	= $_POST['first_time'];
		$id_tabla_proc= $_POST['id_tabla_proc'];
		$id_tabla 	= $_POST['id_tabla'];
		$prod_tmp 	= $_POST['prod_tmp'];

		do
		{
			if($first_time == 'true') { // TODAVIA no llenó la tabla principal
				$flash_error = 'Debe completar antes el registro principal.';
				break;
			}
			$update_prod = BDConsulta::consulta('update_prod', array($id_tra_ytd_entrada_prod, $marca, $problema, $familia), 'n');

			$flash_notice = 'Producto modificado correctamente.';
		} while(0);
		$tpl->asignar('first_time', $first_time);
		$tpl->asignar('prod_tmp', $prod_tmp);
		$tpl->asignar('id_tabla_proc', $id_tabla_proc);
		$tpl->asignar('id_tabla', $id_tabla);
	}


	// RESET PRINCIPALES
	require_once '_php/forms_reset.php';

	if(!isset($prod_tmp)) {
		$prod_tmp = 'false';
	}


	$id_tra_carga_mercaderia_transito = $_GET[1];
	$tpl->asignar('id_tra_carga_mercaderia_transito', $id_tra_carga_mercaderia_transito);

	// SIN TABLA TEMPORAL.
	if($prod_tmp == 'false')
	{
		// TABLA PRINCIPAL ANTERIOR
		$get_tra_carga_mercaderia_transito = BDConsulta::consulta('get_tra_carga_mercaderia_transito', array($id_tra_carga_mercaderia_transito), 'n');
		if(isset($get_tra_carga_mercaderia_transito) && isset($get_tra_carga_mercaderia_transito[0])) {
		    $tpl->asignar('tabla_princ_tmp', $get_tra_carga_mercaderia_transito);
		}
		// TABLA SECUNDARIA ANTERIOR
		$tabla_sec_anterior = Process::getFirstProcess('tra_carga_mercaderia_transito', $id_tra_carga_mercaderia_transito);
		if(isset($tabla_sec_anterior) && isset($tabla_sec_anterior[0])) {
			$id_tabla_ant_proc 		= $tabla_sec_anterior[0]['id_tra_carga_mercaderia_transito_proc'];
			$tabla_sec_anterior_prod = Process::getTablaSec('tra_carga_mercaderia_transito', 'prod', $id_tabla_ant_proc, 'n', 'pro_productos');
		}
		for( $i = 0 ; $i < count($tabla_sec_anterior_prod) ; $i++) {
			$tabla_sec_anterior_prod[$i]['subfamilia'] = 'no ingresado';
			$tabla_sec_anterior_prod[$i]['familia'] 	= 'no ingresado';
			$tabla_sec_anterior_prod[$i]['marca'] 	= 'no ingresado';
			$tabla_sec_anterior_prod[$i]['problema']	= 'no ingresado';
		}
		$tpl->asignar('tra_ytd_entrada_prod', $tabla_sec_anterior_prod);
	}

	// TABLA TEMPORAL EXISTENTE (cuando envia al proximo paso carga todos los datos en tra_ytd_entrada_prod)
	elseif ($prod_tmp == 'true')
	{
		$select_prod = BDConsulta::consulta('get_tye_prod_tmp', array($id_tabla_proc), 'n');
		$tpl->asignar('tra_ytd_entrada_prod', $select_prod);

	}

	$tpl->asignar('prod_tmp', $prod_tmp);

	// Tabla PRINCIPAL
	$get_tabla = Process::getTabla('', $id_tabla_proc, 'n', 'cpr_proveedores');
	$tpl->asignar('tabla', $get_tabla);

	// PARA EL SELECT de FAMILIA
	$familias = Process::getValuesSelectRel('pro_subfamilia', 'pro_familia');
	$tpl->asignar('familias', $familias);
	// PARA EL SELECT de PROBLEMAS
	$problemas = Process::getValuesSelectRel('sis_problemas');
	$tpl->asignar('problemas', $problemas);
	// PARA EL SELECT de MARCAS
	$marcas = Process::getValuesSelectRel('pro_marca');
	$tpl->asignar('marcas', $marcas);

	$tpl->asignar('flash_error', $flash_error);
	$tpl->asignar('flash_notice', $flash_notice);
	$tpl->obtenerPlantilla();


	unset($flash_error);
	unset($flash_notice);


}else{ // es el primer if, en donde si no pasó un id_tabla_sec, vuelve al menu principal.
        header('Location: /menu.html');
        exit();
}





