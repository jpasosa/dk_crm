<?php

$tpl = new PlantillaReemplazos();

$obtener_datos = new ArchivoObtenerDatos;
$obtener_datos->archivo('./archivos_varios/clase_archivo_obtener_datos.csv');
$obtener_datos->directorio('./');
$obtener_datos->separador(',');
$obtener_datos->contieneTitulos();
$obtener_datos->eliminarComillasInicioFin();

$tpl->asignar('datos', $obtener_datos->obtenerDatos());
$tpl->obtenerPlantilla();
