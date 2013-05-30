<?php

$tpl = new PlantillaReemplazos();
$tpl->asignar('consulta', BDConsulta::consulta('consulta_general', '', 's', ''));
$tpl->asignar('consulta_sv', BDConsulta::consulta('sin_valores', '', 's', ''));
$tpl->asignar('opciones', BDConsulta::consulta('html_checkboxes', '', 's', ''));
$tpl->obtenerPlantilla();
