<?php

$tpl = new PlantillaReemplazos();

$tpl->asignar('texto','este es un texto de prueba: 10 no es igual a 20, solo si no lo reemplazo.');

$tpl->asignar('fecha_unix',1500000000);

$tpl->asignar('numero',1000);

$tpl->asignar('variable_vacia','');

$tpl->asignar('html','<span style="color:#006633;font-style:italic;">valor</span>');

$tpl->asignar('url','?variable1=puede ser nula&variable2=/&%$#"');

$tpl->obtenerPlantilla();
