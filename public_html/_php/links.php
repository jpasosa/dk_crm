<?php

$tpl = new PlantillaReemplazos();

$valores = array(
		0 => array('valor' => 'valor 1'),
		1 => array('valor' => 'valor 2'),
);

$tpl->asignar('valores_get', $valores);
$tpl->asignar('valor', 'valor ok');

$tpl->obtenerPlantilla();
