<?php

$tpl = new PlantillaReemplazos();
$tpl->asignar('tabla1', BDConsulta::consulta('consulta_general', '', 'n', ''));
$tpl->asignar('tabla2', BDConsulta::consulta('consulta_general', '', 'n', ''));
$tpl->obtenerPlantilla();
