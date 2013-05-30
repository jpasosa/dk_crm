<?php

require_once '_funciones/validations.php';
require_once '_funciones/common.php';

$tpl = new PlantillaReemplazos();

$flash_error = '';
$flash_notice = '';
$detalle = '';
$reload = false;


/// Agregar la observación. 
if(isset($_POST['send_process'])) {
    var_dump($_POST);
}



$tpl->obtenerPlantilla();

unset($flash_error);
unset($flash_notice);






