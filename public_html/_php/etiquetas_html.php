<?php

$tpl = new PlantillaReemplazos();

$opciones_valores = array(
	0 => array('valor' => 1, 'etiqueta' => 'valor 1'),
	1 => array('valor' => 2, 'etiqueta' => 'valor 2'),
	2 => array('valor' => 3, 'etiqueta' => 'valor 3'),
	3 => array('valor' => 4, 'etiqueta' => 'valor 4'),
	4 => array('valor' => 5, 'etiqueta' => 'valor 5'),
);

$tpl->asignar('opciones', $opciones_valores);

$tpl->asignar('seleccionado', array(1, 3));

$tpl->asignar('seleccionado_uno', 4);

$tpl->asignar('valor_inicial', 'valor');

$tpl->obtenerPlantilla();
