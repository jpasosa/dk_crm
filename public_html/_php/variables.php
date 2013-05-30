<?php

$tpl = new PlantillaReemplazos();

$tpl->asignar('texto','Esta es una variable asignada desde el php, solo puede ser utilizada en la plantilla que llama el php.');

$tpl->asignarGlobal('general','Esta es una variable asignada desde el php y puede ser utilizado en otras plantillas.');

$matriz = array( 0 => 'Esta es una variable generada dentro de la plantilla.' );

$tpl->asignar('nombre',$matriz);

$array[0]['valor'] = 'Esta es una matriz, pero desde el template se llama al elemento que contiene este valor.';

$tpl->asignar('numero',$array);

$tpl->obtenerPlantilla();
