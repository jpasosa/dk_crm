<?php

if($_GET[1] != '' && $_GET[1] > 0)
{	// Si NO TIENE EL NÚMERO DE ID DE UN PROCESO, VUELVE AL MENU.TPL
	$tpl = new PlantillaReemplazos();
	require_once '_php/forms_start.php';


	///////////////////////////////// AGREGAR TABLA PRINCIPAL  |  POST
	if(isset($_POST['agregar']))
	{
		$proveedor 			=$_POST['id_cpr_proveedor'];
		$observaciones 		=$_POST['observaciones'];
		$fecha_llegada 		=$_POST['fecha_llegada'];
		$fecha_llegada_unix = Dates::ConvertToUnix($fecha_llegada);
		$id_tra_ytd_entrada = $_POST['id_tra_ytd_entrada'];
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

				$update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $proveedor, $fecha_llegada_unix, $observaciones), 'n');
				if(is_null($update_tabla_princ)) {
					$flash_error = 'No pudo agregar el registro principal';
					break;
				}
				$flash_notice = 'Registro modificado correctamente.';
				$first_time = 'false';

				// CREO TABLA TEMPORAL
				$tabla_sec_anterior = Process::getFirstProcess('tra_ytd_entrada', $id_tra_ytd_entrada);
				if(isset($tabla_sec_anterior) && isset($tabla_sec_anterior[0])) {
					$id_tabla_ant_proc = $tabla_sec_anterior[0]['id_tra_ytd_entrada_proc'];
				}

				// TABLA SECUNDARIA ANTERIOR
				$tabla_sec_anterior = Process::getFirstProcess('tra_ytd_entrada', $id_tra_ytd_entrada, 'n');
				if(isset($tabla_sec_anterior) && isset($tabla_sec_anterior[0]))
				{
					$id_tabla_ant_proc = $tabla_sec_anterior[0]['id_tra_ytd_entrada_proc'];
					$tabla_sec_anterior_prod = Process::getTablaSec('tra_ytd_entrada', 'prod', $id_tabla_ant_proc, 'n');
					foreach($tabla_sec_anterior_prod AS $tye_prod) {
						$insert_tcmt_prod_tmp = BDConsulta::consulta('insert_tye_prod_tmp', array($id_tabla_proc, $tye_prod['id_pro_productos'],
							$tye_prod['nro_caja_tye'], $tye_prod['productos_por_caja_tye'], $tye_prod['alto_tye'], $tye_prod['ancho_tye'],
							$tye_prod['fondo_tye'], $tye_prod['volumen_tye'], $tye_prod['peso_tye'], $tye_prod['precio_tye'],
							$tye_prod['foto_tye'], $tye_prod['activo'], $tye_prod['id_pro_marca'], $tye_prod['id_pro_subfamilia'], $tye_prod['id_sis_problemas']), 'n');
					}

					$select_prod = BDConsulta::consulta('select_prod', array($id_tabla_proc), 'n'); // seleccion de los productos de la tabla temporal.


				}
				$prod_tmp = 'true';

			}
			else
			{ // Modificar tabla principal
				$update_tabla_princ = BDConsulta::consulta('update_tabla_princ', array($id_tabla, $proveedor, $fecha_llegada_unix, $observaciones), 'n');
				if(is_null($update_tabla_princ)) {
					$flash_error = 'No se pudo modificar el registro';
					break;
				}
				$flash_notice = 'Registro modificado correctamente.';
				$select_prod = BDConsulta::consulta('get_bem_prod_tmp', array($id_tabla_proc), 'n'); // selección de los productos de la tabla temporal.
			}
		}while(0);
		// $tpl->asignar('id_bod_entrada_mercaderia_prod', $id_bod_entrada_mercaderia_prod);
		$tpl->asignar('id_tabla', 		$id_tabla);
		$tpl->asignar('id_tabla_proc', $id_tabla_proc);
		$tpl->asignar('bod_entrada_mercaderia', $select_prod);
		$tpl->asignar('prod_tmp', 	$prod_tmp);
		$tpl->asignar('first_time', 	$first_time);
	}


	///////////////////////////////// AGREGAR PRODUCTS (va agregando en la tabla temporal.)
	if(isset($_POST['agregar_prod']))
	{
		$id_bod_entrada_mercaderia_prod = $_POST['id_bod_entrada_mercaderia_prod'];
		$piso 		= $_POST['piso'];
		$pared 		= $_POST['pared'];
		$estanteria 	= $_POST['estanteria'];
		$cuadrante 	= $_POST['cuadrante'];
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
			$update_prod = BDConsulta::consulta('update_prod', array($id_bod_entrada_mercaderia_prod, $piso, $pared, $estanteria, $cuadrante), 'n');

			$flash_notice = 'Producto modificado correctamente.';
		} while(0);
		$tpl->asignar('id_bod_entrada_mercaderia_prod', $id_bod_entrada_mercaderia_prod);
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


	$id_tra_ytd_entrada = $_GET[1];
	$tpl->asignar('id_tra_ytd_entrada', $id_tra_ytd_entrada);



	// SIN TABLA TEMPORAL.
	if($prod_tmp == 'false')
	{
		// TABLA PRINCIPAL ANTERIOR
		$get_tra_ytd_entrada = BDConsulta::consulta('get_tra_ytd_entrada', array($id_tra_ytd_entrada), 'n');
		if(isset($get_tra_ytd_entrada) && isset($get_tra_ytd_entrada[0])) {
		    $tpl->asignar('tabla_princ_tmp', $get_tra_ytd_entrada);
		}
		// TABLA SECUNDARIA ANTERIOR
		$tabla_sec_anterior = Process::getFirstProcess('tra_ytd_entrada', $id_tra_ytd_entrada);
		if(isset($tabla_sec_anterior) && isset($tabla_sec_anterior[0])) {
			$id_tabla_ant_proc 		= $tabla_sec_anterior[0]['id_tra_ytd_entrada_proc'];
			$tabla_sec_anterior_prod = Process::getTablaSec('tra_ytd_entrada', 'prod', $id_tabla_ant_proc, 'n', 'pro_productos');
		}
		for( $i = 0 ; $i < count($tabla_sec_anterior_prod) ; $i++) {
			$tabla_sec_anterior_prod[$i]['piso'] 			= 0;
			$tabla_sec_anterior_prod[$i]['pared'] 		= 0;
			$tabla_sec_anterior_prod[$i]['estanteria'] 	= 0;
			$tabla_sec_anterior_prod[$i]['cuadrante']	= 0;
		}
		$tpl->asignar('bod_entrada_mercaderia_prod', $tabla_sec_anterior_prod);
	}

	// TABLA TEMPORAL EXISTENTE (cuando envia al proximo paso carga todos los datos en tra_ytd_entrada_prod)
	elseif ($prod_tmp == 'true')
	{
		$select_prod = BDConsulta::consulta('get_bem_prod_tmp', array($id_tabla_proc), 'n');
		$tpl->asignar('bod_entrada_mercaderia_prod', $select_prod);

	}

	$tpl->asignar('prod_tmp', $prod_tmp);

	// Tabla PRINCIPAL
	$get_tabla = Process::getTabla('', $id_tabla_proc, 'n', 'cpr_proveedores');
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





