<?php
/**
 * Se utiliza como sistema de template, para que realice las sustituciones de variables y ciclos de datos.
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

class PlantillaFunciones {

    protected function _modificadores( $valor, $modificadores=null ) {

        if( $modificadores != '' ) {

            $modificadoresArmar = explode('|', $modificadores);

            if( is_array($modificadoresArmar) ) {

                foreach ( $modificadoresArmar as $modificador) {

                    switch ($modificador) {
                        case "strip_tags":
                            $valor = strip_tags($valor);
                            break;
                        case "upper":
                            $valor = strtoupper($valor);
                            break;
                        case "lower":
                            $valor = strtolower($valor);
                            break;
                        case "capitalize":
                            $valor = ucfirst($valor);
                            break;
                        case "nl2br":
                            $valor = nl2br($valor);
                            break;
                    }

					$modificador = str_replace('<#1#>',"'",$modificador);
					$modificador = str_replace('<#2#>','"',$modificador);
                    if( preg_match("/date_format:(\"(.*?)\"|'(.*?)')+/",$modificador) ) {
                        $formato = preg_replace("/date_format:(\"(.*?)\"|'(.*?)+')/",'${2}',$modificador);
                        $valor = date($formato,$valor);
                    }
                    if( preg_match("/truncate:([0-9]+):(\"(.*?)\"|'(.*?)')(:(true|false))?+/",$modificador) ) {
                        $largo = preg_replace("/truncate:([0-9]+):(\"(.*?)\"|'(.*?)')(:(true|false))?+/",'${1}',$modificador);
                        $final = preg_replace("/truncate:([0-9]+):(\"(.*?)\"|'(.*?)')(:(true|false))?+/",'${3}',$modificador);
						$completa = preg_replace("/truncate:([0-9]+):(\"(.*?)\"|'(.*?)')(:(true|false))?+/",'${5}',$modificador);
                        if( strlen($valor) > $largo ) {
							$valor = mb_substr($valor,0,$largo).$final;
							if( $completa == ':true' ){
								$valor = mb_substr($valor,0, -(strlen($valor)-strrpos($valor,' ')) ).$final;
							}
                        }
                    }
                    if( preg_match("/default:(\"(.*?)\"|'(.*?)')+/",$modificador) ) {
                        if( !isset($valor) || (trim($valor) == '') ) {
                            $valor = preg_replace("/default:(\"(.*?)\"|'(.*?)+')/",'${2}',$modificador);
                        }
                    }
                    if( preg_match("/regex_replace:(\"(.*?)\"|'(.*?)')+:(\"(.*?)\"|'(.*?)')+/",$modificador) ) {
                        $patron = preg_replace("/regex_replace:(\"(.*?)\"|'(.*?)')+:(\"(.*?)\"|'(.*?)')+/",'${2}',$modificador);
                        $cadena = preg_replace("/regex_replace:(\"(.*?)\"|'(.*?)')+:(\"(.*?)\"|'(.*?)')+/",'${5}',$modificador);
                        $valor = preg_replace($patron,$cadena,$valor);
                    }
                    if( preg_match("/replace:(\"(.*?)\"|'(.*?)')+:(\"(.*?)\"|'(.*?)')+/",$modificador) ) {
                        $buscar = preg_replace("/replace:(\"(.*?)\"|'(.*?)+'):(\"(.*?)\"|'(.*?)+')/",'${2}',$modificador);
                        $reemplazar = preg_replace("/replace:(\"(.*?)\"|'(.*?)+'):(\"(.*?)\"|'(.*?)+')/",'${5}',$modificador);
                        $valor = str_replace($buscar,$reemplazar,$valor);
                    }
                    if( preg_match("/string_format:(\"(.*?)\"|'(.*?)')+/",$modificador) ) {
                        $formato = preg_replace("/string_format:(\"(.*?)\"|'(.*?)')+/",'${2}',$modificador);
                        $valor = sprintf($formato,$valor);
                    }
                    if( preg_match("/number_format:([0-9]):(\"(.*?)\"|'(.*?)')+:(\"(.*?)\"|'(.*?)')+/",$modificador) ) {
                        $formato = preg_replace("/number_format:([0-9]):(\"(.*?)\"|'(.*?)')+:(\"(.*?)\"|'(.*?)')+/",'${1}, "${3}", "${6}"',$modificador);
                        eval("\$valor = number_format(\$valor, $formato);");
                    }
                    if( preg_match("/escape:(\"(.*?)\"|'(.*?)')+/",$modificador) ) {
                        $tipo = preg_replace("/escape:(\"(.*?)\"|'(.*?)')+/",'${2}',$modificador);
                        switch ($tipo) {
                            case 'html':
                                $valor = html_entity_decode($valor);
                                break;
                            case 'htmlall':
                                $valor = htmlspecialchars($valor);
                                break;
                            case 'url':
                                $valor = urlencode($valor);
                                break;
                            case 'quotes':
                                $valor = addslashes($valor);
                                break;
                        }
                    }

                }
            }
        }
        return $valor;
    }

    protected function _htmlError( $nombre=null ) {

        if($nombre) {
            return "<div id='VC_".$nombre."' class=\"VC_error\"></div>";
        }else {
            return false;
        }

    }

    protected function _htmlErrores() {

        return "<div id='VF_todos' class=\"VC_error\"></div>";

    }

    protected function _indexMarco( $nombre=null ) {

        if($nombre) {
			VariableSet::indexMarco($nombre);
        }else {
            return false;
        }

    }

    public function _htmlCaptcha( $elemento, $estilo=null ) {

        if( $elemento == 'img' ) {

            $captcha = new ArmadoCaptcha();
			echo $captcha->mostrar();

        }

    }

    static public function _obtenerNombreTpl( $nombre, $tipo=null ){

        $url_actual = getcwd();
        chdir ( VariableGet::sistema('directorios_php') );
        $directorio = getcwd();
        chdir ( $url_actual );
        $archivo_php = $directorio.'/'.$nombre.'.php';

        $url_actual = getcwd();
        chdir ( VariableGet::sistema('directorio_plantillas') );
        $directorio = getcwd();
        chdir ( $url_actual );
        $archivo_tpl = $directorio.'/'.$nombre.'.tpl';

		if( $tipo!==true ){
			// si no es seccion tambien tiene que controlar el directorio de plantillas alternativo
			$url_actual = getcwd();
			chdir ( VariableGet::sistema('directorio_plantillas_varias') );
			$directorio = getcwd();
			chdir ( $url_actual );
			$archivo_varias_tpl = $directorio.'/'.$nombre.'.tpl';
		}

        if (file_exists($archivo_php)) {
			if( $tipo!==true ){
            	return $archivo_php;
			}else{
				return array($archivo_php,'php');
			}
        }elseif(file_exists($archivo_tpl)) {
            return $archivo_tpl;
        }elseif(isset($archivo_varias_tpl) && file_exists($archivo_varias_tpl) && ($tipo!==true) ) {
            return $archivo_varias_tpl;
        }else{
			if( $nombre != '' ){
				ReporteErrores::error( 'archivo', $nombre );
			}
            return false;
        }

    }

	protected function _links( $valores ){

		$urlNva = VariableGet::sistema('subniveles_inferiores');

		foreach ($valores as $valor) {
			
			$urlNva .= '/';

			if( is_array($valor) ){
				if( count($valor)>0 ){
					$urlNvaValor = implode('-', $valor);
					
				}else{
					$urlNvaValor = $valor[0];
				}
			}else{
				$urlNvaValor = $valor;
			}
			
			// Limpio las barras que puedan generar problemas de navegacion
			$urlNvaValor = strtr($urlNvaValor, '/', '-');
			
			$urlNva .= $urlNvaValor;
		
		}
		
		$urlNvaLimpia = self::_LimpiarURL($urlNva);

		ArmadoLinks::guardarLinkURL( $urlNvaLimpia, $urlNva );
		
		return $urlNvaLimpia.'.html';
	
	}

	private static function _LimpiarURL($url){
		
		$url = str_replace(array('á','à','â','ã','ª','ä','Á','À','Â','Ã','Ä'),'a',$url);
		$url = str_replace(array('Í','Ì','Î','Ï','í','ì','î','ï'),'i',$url);
		$url = str_replace(array('é','è','ê','ë','É','È','Ê','Ë'),'e',$url);
		$url = str_replace(array('ó','ò','ô','õ','ö','º','Ó','Ò','Ô','Õ','Ö'),'o',$url);
		$url = str_replace(array('ú','ù','û','ü','Ú','Ù','Û','Ü'),'u',$url);
		$url = str_replace(array('[','^','´','`','¨','~',']'),'',$url);
		$url = str_replace('ç','c',$url);
		$url = str_replace('Ç','C',$url);
		$url = str_replace('ñ','n',$url);
		$url = str_replace('Ñ','N',$url);
		$url = str_replace('Ý','Y',$url);
		$url = str_replace('ý','y',$url);

		$url = str_replace (array(' ', '&', "\r\n", "\n", '+', '_'), '-', $url);
	
		$url = preg_replace('/[^\/A-Za-z0-9_-]/', '', $url);
		
		$url = preg_replace('/[-]+/', '-', $url);
	
		return strtolower($url);
	
	}

	protected function _htmlArmadoSelect( $opciones, $seleccionado ){
		
		$armado = '';
		if (is_array($opciones)) {
			foreach ($opciones as $valores) {
				if (isset($valores['valor']) && ( (string) $valores['valor'] == (string) $seleccionado)) {
					$chequeado = ' selected="selected"';
				} else {
					$chequeado = '';
				}
				if (isset($valores['etiqueta'])) {
					$etiqueta = $valores['etiqueta'];
				} else {
					$etiqueta = '';
				}
				if (isset($valores['valor'])) {
					$valor = $valores['valor'];
				} else {
					$valor = '';
				}

				$armado .= '<option value="' . $valor . '" ' . $chequeado . '>' . $etiqueta . '</option>';
			}
		}
		
		echo $armado;
		
	}

	protected function _htmlArmadoCheckboxes( $nombre, $opciones, $seleccionado, $estilo, $html ){
		
		$armado = '';
		if (is_array($opciones)) {
			$cantidad_opciones = count($opciones);
			$cont = 1;
			foreach ($opciones as $valores) {
				$chequeado = '';
				if (isset($valores['valor']) && !is_array($seleccionado) && ($valores['valor'] == $seleccionado)) {
					$chequeado = ' checked="checked"';
				} elseif (isset($valores['valor']) && is_array($seleccionado) && (array_search($valores['valor'], $seleccionado) !== false)) {
					$chequeado = ' checked="checked"';
				}
				if (isset($valores['etiqueta'])) {
					$etiqueta = $valores['etiqueta'];
				} else {
					$etiqueta = '';
				}
				if (isset($valores['valor'])) {
					$valor = $valores['valor'];
				} else {
					$valor = '';
				}
				$armado .= '<input type="checkbox" name="' . $nombre . '[]" id="' . $nombre . '[]" value="' . $valor . '" ' . $estilo . $chequeado . '>' . $etiqueta;
				if( $cont < $cantidad_opciones ){
					$armado .= $html;
				}
				$cont++;
			}
		}
		
		echo $armado;
		
	}
	
	protected function _htmlArmadoRadios( $nombre, $opciones, $seleccionado, $estilo, $html ){

		$armado = '';
		if (!isset($seleccionado) || ($seleccionado == '')) {
			$sin_valor = true;
		} else {
			$sin_valor = false;
		}
		if (is_array($opciones)) {
			$cantidad_opciones = count($opciones);
			$cont = 1;
			foreach ($opciones as $valores) {
				if ((isset($valores['valor']) && ($valores['valor'] == $seleccionado)) || $sin_valor === true) {
					$chequeado = ' checked="checked"';
					$sin_valor = false;
				} else {
					$chequeado = '';
				}
				if (isset($valores['etiqueta'])) {
					$etiqueta = $valores['etiqueta'];
				} else {
					$etiqueta = '';
				}
				if (isset($valores['valor'])) {
					$valor = $valores['valor'];
				} else {
					$valor = '';
				}
				$armado .= '<input type="radio" name="' . $nombre . '" id="' . $nombre . '" value="' . $valor . '"' . $estilo . $chequeado . '>' . $etiqueta;
				if( $cont < $cantidad_opciones ){
					$armado .= $html;
				}
				$cont++;
			}
		}

		echo $armado;
		
	}

    protected function _table($plantilla, $valores, $cols, $rows, $show_all) {

        $tabla = new ArmadoTabla();
		$tabla->nombreArchivo($plantilla);
        $tabla->datos($valores);
        $tabla->nColumnas($cols);
        $tabla->nFilas($rows);
		//$tabla->sinBordes(); // <- en el caso que la tabla no tenga bordes
        if ($show_all == 'yes') {
            $tabla->completarFilas();
        }
        $tabla->tablaImp();

    }

}
