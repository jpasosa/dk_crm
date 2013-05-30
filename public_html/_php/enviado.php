<?php

$tpl = new PlantillaReemplazos();

// no creo que lo siguiente sirva, verificar eso:
unset($_SESSION['first_time']);
unset($_SESSION['id_tabla']);
unset($_SESSION['id_tabla_proc']);


$tpl->obtenerPlantilla();

