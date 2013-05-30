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

class ArmadoLinks extends PlantillaFunciones {

	static private $_variablesURL;
	static private $_subdirectorios = false;

    public static function url( $valores ) {

		return parent::_links( $valores );

	}

    public static function setVariablesGet() {

		// asigno las variables de URL de pagina anterior y limpio para comenzar a cargar nuevamente
		self::seTvariablesURL();

		unset($_GET);
		$variables_url = explode("/", $_SERVER['REQUEST_URI']);
		array_shift($variables_url);

		// para guardar el cache de URLs segun su nivel, para el armado del XML
		if( (count($variables_url)-VariableGet::sistema('seccion_actual_nivel')) > 1 ){
			self::$_subdirectorios = true;
		}

		$url = self::getCacheURL();
		$variables_get = explode("/", $url[1]);
		array_shift($variables_get);


		if( VariableGet::sistema('seccion_actual_nivel') == 0 ){
			$posicion_get = 0;	
		}else{
			$posicion_get = -VariableGet::sistema('seccion_actual_nivel');
		}

		foreach ($variables_get as $valor) {

			VariableControl::setGet($valor,$posicion_get);
			$posicion_get++;
			
		}

		preg_match("/[0-9]+$/", self::urlNvaLimpia(), $id);

		if( count($id) > 0 ){
			
			$id = (int) $id[0];
			VariableControl::setGet($id,'id');

		}

		if( strpos( $_SERVER['REQUEST_URI'], '?' ) !== false ){

			$valor_param = explode('?', $_SERVER['REQUEST_URI']);
			VariableControl::setGetParam($valor_param[1]);

		}

		VariableControl::bloquearGetParam();

	}

    public static function setCacheURL() {

		$urlNvaLimpia = self::urlNvaLimpia();

		if( self::_geTvariablesURL($urlNvaLimpia) !== false ){

			$archivo_nombre = sha1($urlNvaLimpia).'.cache';

			if( self::$_subdirectorios === false ){
				// si es solo un nivel principal	
				$directorio = '/principal/';
			}else{
				// si es un nivel secundario y primer nivel con variables
				$directorio = '/secundario/';
			}

			file_put_contents( VariableGet::sistema('directorio_cache_links').$directorio.$archivo_nombre , $urlNvaLimpia.'</>'.self::_geTvariablesURL($urlNvaLimpia) );

		}

	}

    public static function getCacheURL() {

		$urlNvaLimpia = self::urlNvaLimpia();

		if( self::_geTvariablesURL($urlNvaLimpia) !== false ){

			return array( $urlNvaLimpia, self::_geTvariablesURL($urlNvaLimpia) );

		}else{

			$archivo_nombre = sha1($urlNvaLimpia).'.cache';

			if( self::$_subdirectorios === false ){
				// si es solo un nivel principal
				$directorio = '/principal/';
			}else{
				// si es un nivel secundario y primer nivel con variables
				$directorio = '/secundario/';
			}

			if( file_exists( VariableGet::sistema('directorio_cache_links').$directorio.$archivo_nombre ) ){

				$contenido = file_get_contents( VariableGet::sistema('directorio_cache_links').$directorio.$archivo_nombre );

				$contenido = explode('</>', $contenido);

				return array( $contenido[0], $contenido[1] );

			}else{

				$urlNva = ucfirst(strtolower(strtr($urlNvaLimpia, "-", " ")));

				return array( $urlNvaLimpia, $urlNva );

			}

		}

	}

    public static function guardarLinkURL( $urlNvaLimpia, $urlNva ) {

		if( !isset( $_SESSION['kk_sistema']['LinkURL'][$urlNvaLimpia]) && ($urlNvaLimpia!='') ){
			$_SESSION['kk_sistema']['LinkURL'][$urlNvaLimpia] = $urlNva;
		}

    }

	public static function seTvariablesURL(){

		if( isset( $_SESSION['kk_sistema']['LinkURL'] ) ){
			self::$_variablesURL = $_SESSION['kk_sistema']['LinkURL'];
			unset($_SESSION['kk_sistema']['LinkURL']);
		}

	}

	private static function _geTvariablesURL($variable){

		if( isset( self::$_variablesURL[$variable] ) ){

			return self::$_variablesURL[$variable];

		}else{

			return false;

		}

	}

	public static function urlNvaLimpia(){

		$url = explode('?', $_SERVER['REQUEST_URI']);
		return substr($url[0], 0, -5);

	}

	public static function generar_xml() {

		self::generar_xml_nvo('principal');
		self::generar_xml_nvo('secundario');

	}

    public static function generar_xml_nvo( $nivel ) {

		if( $nivel == 'principal' ){
			$tiempo = 30;
			$changefreq = 'monthly';
			$priority = '1.0';
		}elseif( $nivel == 'secundario' ){
			$tiempo = 7;
			$changefreq = 'weekly';
			$priority = '0.8';
		}


		// datos del archivo de cache de control
		$directorio_cache_control = VariableGet::sistema('directorio_cache_links');
		$archivo_cache_control = 'xml_'.$nivel.'.cache';

		// controlo si ya se hizo en control de la hora actual
		if( !file_exists($directorio_cache_control . '/' . $archivo_cache_control) ){

			// elimino el archivo de control anterior
			foreach (@glob($directorio_cache_control.'xml_'.$nivel.'_*') as $eliminar_cache_control) {
				unlink($eliminar_cache_control);
			}

			// se crea el archivo de control nuevamente
			file_put_contents( $directorio_cache_control . '/' . $archivo_cache_control, date('Y-m-d h:i:s') );

			$elementos_sitemap = '';
			foreach (@glob(VariableGet::sistema('directorio_cache_links').'/'.$nivel.'/*.cache') as $recorrer_archivos) {

				if( filemtime($recorrer_archivos) > (time() - (60*60*24*$tiempo)) ){

					$contenido = file_get_contents( $recorrer_archivos );
					$contenido = explode('</>', $contenido);

$elementos_sitemap .= '   <url>
      <loc>http://' . $_SERVER['SERVER_NAME'] . $contenido[0] . '.html' . '</loc>
      <lastmod>' . date("Y-m-d", filemtime($recorrer_archivos)) . '</lastmod>
      <changefreq>'.$changefreq .'</changefreq>
      <priority>'.$priority.'</priority>
   </url>
';

				}

			}

			// armo el sitemap
			self::generar_sitemap_automatico_xml($elementos_sitemap, $nivel);

			// si no existe el archivo de control, lo genero
			$archivo_control = 'sitemap.cache';
			if( !file_exists($directorio_cache_control . '/' . $archivo_control) ){
				file_put_contents( $directorio_cache_control . '/' . $archivo_control, date('Y-m-d h:i:s') );
				self::generar_sitemap_xml();
			}

			// si no existe el archivo de control, lo genero
			$archivo_control = 'robots_xml.cache';
			if( !file_exists($directorio_cache_control . '/' . $archivo_control) ){
				file_put_contents( $directorio_cache_control . '/' . $archivo_control, date('Y-m-d h:i:s') );
				self::generar_robots_xml();
			}

		}

    }

	public static function generar_sitemap_automatico_xml($elementos_sitemap, $nivel) {

		file_put_contents( 'sitemap_automatico_'.$nivel.'.xml', '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
' . $elementos_sitemap. '</urlset>
		' );

	}

	public static function generar_sitemap_xml() {

		file_put_contents( 'sitemap.xml', '<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
   <sitemap>
      <loc>http://' . $_SERVER['SERVER_NAME'] . '/sitemap_automatico_principal.xml</loc>
	  <loc>http://' . $_SERVER['SERVER_NAME'] . '/sitemap_automatico_secundario.xml</loc>
   </sitemap>
</sitemapindex>
		' );

	}

	public static function generar_robots_xml() {

		file_put_contents( 'robots.txt', '# robots.txt for http://kirke.ws/

# Mapa del sitio en:
Sitemap: http://' . $_SERVER['SERVER_NAME'] . '/sitemap.xml

# Ocultar para todos los robots de busqueda:
User-agent: *
		' );

	}

}
