<?php

// === CONFIGURACION DEL SISTEMA ===================================================

$sistema['directorios_php'] = '_php';
$sistema['directorio_clases'] = '_clases';
$sistema['directorio_bases'] = '_bases';
$sistema['directorio_plantillas'] = '../_plantillas';
$sistema['directorio_plantillas_varias'] = '../_plantillas_varias';

$sistema['directorio_cache_plantillas'] = '../_cache/_plantillas';
$sistema['directorio_cache_compilados'] = '../_cache/_compilados';
$sistema['directorio_cache_base'] = '../_cache/_bases';
$sistema['directorio_cache_links'] = '../_cache/_links';

// con esta variable se define el nivel en que se encuentra la variable GET que define la secccion en la URL (esta siempre es $_GET), y se obtiene con $_GET['0']
$sistema['seccion_actual_nivel'] = 0;

// con esta variable se definen los subniveles inferiores, por si el sistema se instala en subdirectorios de la URL
$sistema['subniveles_inferiores'] = ''; // Ej: '/sitio_muestra'

// si el sistema no debe publicarse se elimina la generacion de armado sitemap con generar_sitemap == false
$sistema['generar_sitemap'] = true;

// variables de mails:

$sistema['mail_servidor'] = 'info@kirke.ws';
$sistema['nombre_servidor'] = 'Servidor sitio muestra';
$sistema['mail_responsable'] = 'control@kirke.ws';
$sistema['nombre_responsable'] = 'Control sitio muestra';
