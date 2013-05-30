<?php

$tpl = new PlantillaReemplazos();
	$consulta_detalle = BDConsulta::consulta('consulta_detalle', array( VariableGet::id() ) , 'n');
$tpl->asignar('consulta_detalle', $consulta_detalle[0]);
$tpl->obtenerPlantilla();
