<?php

$tpl = new PlantillaReemplazos();
$tpl->asignar( 'nombres', 
                        array( 0=>array('Pablo','Lopez'),
                                 1=>array('Hernan','Gonzales'),
                                 2=>array('Juan','Guitierres'),
                                 3=>array('Ignacio','Martín') ) );
$tpl->asignar('variable_uno', 1);


$tpl->asignar('cosas', array(    0 =>  'casa',
                                2 => 'telefono',
                                4 => 'omnibus'));


$tpl->obtenerPlantilla();



