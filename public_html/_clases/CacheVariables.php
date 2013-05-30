<?php

/**
 * Se utiliza para realizar cache de variables en archivos.
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

class CacheVariables {

	static public function cache($archivo_cache, $tiempo_segundos, $variable) {

		if (
			!file_exists($archivo_cache)
			||
			( (filemtime($archivo_cache) + $tiempo_segundos) < time() )
		) {

			file_put_contents($archivo_cache, serialize($variable));
			return $variable;

		}else{

			return unserialize(file_get_contents($archivo_cache, FILE_USE_INCLUDE_PATH));			
		
		}
	}
	
	static public function control($archivo_cache, $tiempo_segundos) {

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
	
	static public function obtener($archivo_cache, $tiempo_segundos=0) {

		if (
			!file_exists($archivo_cache)
			||
			( (filemtime($archivo_cache) + $tiempo_segundos) < time() )
		) {

			return false;

		}else{

			return unserialize(file_get_contents($archivo_cache, FILE_USE_INCLUDE_PATH));			
		
		}
	}
	
}


