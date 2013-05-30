<?php

$tpl = new PlantillaReemplazos();

$nombres = array(
	0=>array('Pablo','Lopez'),
	1=>array('Hernan','Gonzales'),
	2=>array('Juan','Guitierres'),
	3=>array('Ignacio','Martín'),
);

$arr_asoc = array(	'tel' => '652652',
			'direccion' => '24 de noviembre 583');
$tpl->asignar('asoc',$arr_asoc);

$tpl->asignar('nombres',$nombres);
	
$contactos = array(
	array(	'telefono' => '1',  	// 0
		'fax' => '2',
		'celular' => '3'
	),
	array(	'telefono' => '555-4444',  // 1
		'fax' => '555-3333',
		'celular' => '760-1234'
	),
);

$tpl->asignar('contactos',$contactos);
$tpl->asignar('nada',$contactos);
$tpl->asignar('nombre','Pablo');
$tpl->obtenerPlantilla();
