<?php

/**
 * Se utiliza para realizar cache de archivos y variables.
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

class CacheGenerar {

	static public function cache($archivo_cache, $tiempo_segundos, $contenido, $es_variable=false) {
	// este metodo manda el contenido, y lo devuelve, y si corresponde genera el cache
	// $contenido puede se un string o una variable, en cuyo caso seria "$es_variable=true"
		
		if (
			!file_exists($archivo_cache)
			||
			( (filemtime($archivo_cache) + $tiempo_segundos) < time() )
		) {

			if($es_variable===false){
				file_put_contents($archivo_cache, $contenido);
			}else{
				file_put_contents($archivo_cache, serialize($contenido));
			}
			
			return $contenido;

		}else{

			if($es_variable===false){
				return file_get_contents($archivo_cache, FILE_USE_INCLUDE_PATH);
			}else{
				return unserialize(file_get_contents($archivo_cache, FILE_USE_INCLUDE_PATH));
			}
		
		}
	}
	
	static public function control($archivo_cache, $tiempo_segundos) {
	// este metodo sirve para controlar si el cache se encuentra vencido

		if (
			!file_exists($archivo_cache)
			||
			( (filemtime($archivo_cache) + $tiempo_segundos) < time() )
		) {

			return false;

		}else{

			return true;			
		
		}
	}
	
	static public function obtener($archivo_cache, $tiempo_segundos=0, $es_variable=false) {
	// este metodo solo obtiene el cache si no se encuentra vencido, no lo genera

		if (
			!file_exists($archivo_cache)
			||
			( (filemtime($archivo_cache) + $tiempo_segundos) < time() )
		) {

			return false;

		}else{

			if($es_variable===false){
				return file_get_contents($archivo_cache, FILE_USE_INCLUDE_PATH);
			}else{
				return unserialize(file_get_contents($archivo_cache, FILE_USE_INCLUDE_PATH));
			}			
		
		}
	}
	
}


