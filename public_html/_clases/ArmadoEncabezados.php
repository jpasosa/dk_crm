<?php
/**
 * Se utiliza para limitar la cantidad de veces que se visita una página.
 *
 * @category   Clases_Sitios_Web
 * @package    Sitios
 * @copyright  2010 KIRKE
 * @license    GPL
 * @version    Release: 2.0
 * @link       http://kirke.ws
 * @since      Class available since Release 1.0
 * @deprecated
 */

class ArmadoEncabezados {

    public static function set() {
		
		// Trabajo con las URL para obtener el nombre del sitio
		ArmadoLinks::setCacheURL();
		$url = ArmadoLinks::getCacheURL();

		$secciones = '';
		if( VariableControl::getSitioNombre() === false ){
			$secciones = strtr($url[1], array('/' => ' | ',  '-' => ' - ') );
			if( isset($_GET['id']) ){
				$secciones = substr( $secciones, 0, -(strlen($_GET['id'])+3) );
			}			
		}
		
		$sitio_nombre = VariableGet::globales('sitio_nombre').$secciones;

$encabezados = '<meta charset="UTF-8">
<title>'.$sitio_nombre.'</title>
<link rel="icon" href="./favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
<meta name="title" CONTENT="'.$sitio_nombre.'">
<meta name="description" CONTENT="'.VariableGet::globales('sitio_description').'">
<meta name="Keywords" CONTENT="'.VariableGet::globales('sitio_palabras_claves').'">
<meta name="Language" CONTENT="Spanish">
<meta name="Revisit" CONTENT="30 days">
<meta name="author" CONTENT="www.kirke.ws">
<meta name="robots" CONTENT="all">
<meta name="rating" content="General">
<link rel="stylesheet" type="text/css" href="/css/estilos.css">';

if( ArmadoFormulario::existeFormulario() ){
$encabezados .= '
<link rel="stylesheet" type="text/css" href="/css/formulario.css">';
}

$encabezados .= '
<script type="text/javascript" language="javascript" src="/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="/js/nav_seccion.js"></script>';

if( ArmadoFormulario::existeFormulario() ){
$encabezados .= '
<script type="text/javascript" language="javascript" src="/js/formulario.js"></script>
<script type="text/javascript" language="javascript" src="/js/formulario_validaciones.js"></script>';
}

$encabezados .= '
<script type="text/javascript">
$(document).ready(function(){
	nav_seccion("'.VariableGet::globales('seccion_actual').'");
';

if( ArmadoFormulario::existeFormulario() ){
$encabezados .= '	formulario();
';
}

$encabezados .= '});
</script>		
';	

		VariableSet::globales( 'kk_encabezados', $encabezados );

    }

}
