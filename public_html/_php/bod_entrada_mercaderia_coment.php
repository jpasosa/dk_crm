<?php


if($_GET[1] != '' && $_GET[1] > 0)
{
	require_once '_php/forms_start_coment.php';
	// TABLA PRINCIPAL
	$get_tabla = Process::getTabla('', $id_tabla_proc, 'n', 'cpr_proveedores');
	$tpl->asignar('tabla', $get_tabla);

	// TABLA SECUNDARIA, PRODUCTOS
	$first_process = Process::getFirstProcess('bod_entrada_mercaderia', $get_tabla[0]['id_bod_entrada_mercaderia_proc']);
	$select_tabla_sec = BDConsulta::consulta('select_tabla_sec', array($first_process[0]['id_bod_entrada_mercaderia_proc']), 'n');
	$tpl->asignar('tabla_sec', $select_tabla_sec);

	require_once '_php/forms_end_coment.php';
	$tpl->obtenerPlantilla();
	unset($flash_error);
	unset($flash_notice);

}else{
	header('Location: /menu.html');
	exit();
}
