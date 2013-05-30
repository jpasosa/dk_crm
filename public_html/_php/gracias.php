<?php

$tpl = new PlantillaReemplazos();

	if( isset($_GET[1]) && ($_GET[1] == 'e-Mail') ){
		$tpl->asignar('mensaje', 'Su mail ha sido enviado exitosamente');
	}elseif( isset($_GET[1]) && ($_GET[1] == 'Formulario 1') ){
		$tpl->asignar('mensaje', 'Los datos del formulario 1 han sigo enviados exitosamente');
	}elseif( isset($_GET[1]) && ($_GET[1] == 'Formulario 2') ){
		$tpl->asignar('mensaje', 'Los datos del formulario 2 han sigo enviados exitosamente');
	}

$tpl->obtenerPlantilla();
