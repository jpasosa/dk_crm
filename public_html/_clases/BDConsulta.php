<?php

/**
 * Se utiliza para realizar una conexión con una base de datos determinada.
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
class BDConsulta {

    static public function consulta($nombre_consulta = null, $valores = null, $errores = null, $cache_segundos = null, $directorio = null) {

		$tardanza = microtime();

        // nombre real del archivo, este se toma directamente del script que llamo al metodo
        $archivo_origen = debug_backtrace();
        $archivo = basename($archivo_origen[0]['file']);
        $archivo = preg_replace("/([a-zA-Z0-9._.-.]+)\.php/", "\${1}", $archivo);
        
        if (($cache_segundos != null)) {

            if( isset($valores) && is_array($valores) && (count($valores) > 0) ){
                    $valores_cache = implode('_', $valores);
            }else{
                    $valores_cache = '';	
            }

            $nombre_archivo_cache = sha1( $archivo.'-'.$nombre_consulta.'-'.$valores_cache );

            $archivo_cache = VariableGet::sistema('directorio_cache_base').'/'.$nombre_archivo_cache.'.cache';

            if (CacheVariables::control($archivo_cache, $cache_segundos) !== false) {
                return CacheVariables::obtener($archivo_cache, $cache_segundos);
            }
        }

        if (!isset($valores) || !is_array($valores)) {
            $valores = array();
        }

        include_once( $directorio . VariableGet::sistema('directorio_bases') . '/' . $archivo . '.php' );

        if( end(explode('/',dirname($archivo_origen[0]['file']))) != '_clases_sitio' ){
            $archivo = ''.$archivo;            
        }else{
            $archivo = '_'.$archivo;
        }
        
        $bd = new $archivo;

        if ($nombre_consulta == NULL) {
            $nombre_consulta = $archivo;
        }

        $clase_de_bd = 'BD' . ucfirst(VariableGet::sistema('tipo_base')) . 'Consulta';

        eval('$valores = ' . $clase_de_bd . '::validaciones($valores);');

        $obtengo_query = $bd->$nombre_consulta($valores);

        eval('$bd = ' . $clase_de_bd . '::consulta($obtengo_query, $errores);');

        if (($cache_segundos != null)) {

            CacheVariables::cache($archivo_cache, $cache_segundos, $bd);
        }
		
		$tardanza = microtime() - $tardanza;

		if( $tardanza > 1 ){
			ReporteErrores::error( 'base', $archivo, $nombre_consulta, $obtengo_query, $tardanza );
		}

        return $bd;
    }

}
