<?php

$tpl = new PlantillaReemplazos();
$tpl->asignar('sistema_plantilla', array('Variables', 'Modificadores', 'Estructuras de Control', 'Etiquetas HTML', 'Links') );
	$botones = array(
		0 => array('titulo'=>'BDConsulta()','link'=>'BD Consulta',),
		1 => array('titulo'=>'Formulario()','link'=>'Formulario',),
		2 => array('titulo'=>'ArmadoMail()','link'=>'Armado Mail',),		
		3 => array('titulo'=>'Tabla()','link'=>'Tabla',),
		4 => array('titulo'=>'ArchivoObtenerDatos()','link'=>'Archivo obtener datos',),
		5 => array('titulo'=>'Paginado()','link'=>'Paginado',),	
	);
$tpl->asignar('clases', $botones);
$tpl->obtenerPlantilla();
