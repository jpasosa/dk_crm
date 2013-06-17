<?php

// ### version 5.0 ###

session_start();

require_once '../_configuraciones/sistema.php';
require_once '../_configuraciones/desarrollo.php';
require_once '../_configuraciones/bases.php';
require_once '../_configuraciones/sitio.php';
require_once '../_configuraciones/variables.php';

if (isset($_GET['kk_captcha']) && ($_GET['kk_captcha'] == 'captcha')) {
    require_once '_sistema/captcha.php';
    exit();
}

if ($desarrollo['mostrar_errores'] === false) {
    ini_set('display_errors', 0);
    error_reporting(0);
} elseif ($desarrollo['mostrar_errores'] === true) {
    ini_set('display_errors', 1);
    // error_reporting(E_ALL);
    error_reporting(E_ALL & ~E_STRICT); // no muestre los estrictos
}

// para que ciertas funciones se realicen en UTF-8
mb_internal_encoding("UTF-8");

// 'require_once' las clases solicitadas 
function __autoload($nombre_clase) {
	if( file_exists('_clases_sitio/' . $nombre_clase . '.php') ){
    	require_once '_clases_sitio/' . $nombre_clase . '.php';
	}elseif( file_exists('_clases/' . $nombre_clase . '.php') ){
    	require_once '_clases/' . $nombre_clase . '.php';
	}
}

// se elimina la vairable request para que no sea utilizada
unset($_REQUEST);

// asignacion de variables de sistema
foreach ($sistema as $id => $valor) {
    VariableSet::sistema($id, $valor);
}
VariableSet::sistema('generar_cache', $desarrollo['generar_cache']);
VariableSet::sistema('mostrar_errores', $desarrollo['mostrar_errores']);
VariableSet::sistema('tipo_base', $bases['tipo_base']);
VariableSet::sistema('seccion_inicio', $sitio['seccion_inicio']);
VariableSet::sistema('enviar_mail_debug', $sitio['enviar_mail_debug']);
VariableControl::bloquearSistema();

// asignacion de variables del sitio
VariableSet::globales('sitio_nombre', $sitio['sitio_nombre'], true);
VariableSet::globales('sitio_description', $sitio['sitio_description']);
VariableSet::globales('sitio_palabras_claves', $sitio['sitio_palabras_claves']);

// asignacion de variables generales
foreach ($variables as $id => $valor) {
    VariableSet::globales($id, $valor);
}

// conexion a base de datos
if (
        ( $bases['servidor'] != '' )
        && ( $bases['base'] != '' )
        && ( $bases['usuario'] != '' )
        && ( $bases['clave'] != '' )
) {
    BDConexion::consulta(VariableGet::sistema('tipo_base'), $bases['servidor'], $bases['base'], $bases['usuario'], $bases['clave']);
} else {
    if ( (VariableGet::sistema('mostrar_errores') === true) && ($bases['base'] != '') && !isset($_GET['kk_administracion']) ) {
        echo 'No se han ingresado todas las variables de configuración de la base de datos';
    }
}

// control de configuraciones del sitio y logueo
if( isset($_GET['kk_administracion']) || ( (isset($_SERVER['KIRKE_DEV']) && $_SERVER['KIRKE_DEV']) && (substr($_SERVER['REMOTE_ADDR'],0,8) != "192.168.") && !isset($_SESSION['kk_administracion_logueo']) ) ) {
	require_once '_sistema/administracion.php';
    exit();
}

// importacion y destrucción de variables $_GET y parametros para casos especiales
ArmadoLinks::setVariablesGet();

// elimino todas las variables de configuracion
unset($bases);
unset($sitio);
unset($desarrollo);
unset($variables);

include_once '_funciones/kk_funcion_inicio.php';

include_once '_funciones/kk_funciones_sitio.php';

if ( isset($_GET[0]) ) {

	$variables_url = explode("/", ArmadoLinks::urlNvaLimpia());
	array_shift($variables_url);

	$nombre = strtr($variables_url[VariableGet::sistema('seccion_actual_nivel')], '-', '_');
	
	$archivo_nombre = PlantillaFunciones::_obtenerNombreTpl($nombre,true);
	
	if( ($archivo_nombre[0]!='/') && (strlen($archivo_nombre[0])>1) && !file_exists($archivo_nombre[0]) ){ 
		$nombre = VariableGet::sistema('seccion_inicio');				
	}

} else {

	$nombre = VariableGet::sistema('seccion_inicio');

}


VariableSet::globales('seccion_actual', $nombre);

ob_start();

$plantilla_tipo = PlantillaFunciones::_obtenerNombreTpl($nombre,true);

if( $plantilla_tipo[1] == 'php' ){
	require_once $plantilla_tipo[0];
}else{
	$tpl = new PlantillaReemplazos();
	$tpl->nombreArchivo($nombre);
	$tpl->obtenerPlantilla();
}

$plantilla_seccion = ob_get_contents();
ob_end_clean();

VariableSet::seccion($plantilla_seccion);

ArmadoEncabezados::set();

if( file_exists('_php/'.VariableGet::indexMarco().'.php') !== false ){
	require_once '_php/'.VariableGet::indexMarco().'.php';
}else{
	$tpl = new PlantillaReemplazos();
	$tpl->nombreArchivo(VariableGet::indexMarco());
	$tpl->obtenerPlantilla();
}

include_once '_funciones/kk_funcion_fin.php';

if( VariableGet::sistema('generar_sitemap')===true ){
	ArmadoLinks::generar_xml();
}
