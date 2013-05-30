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
class PlantillaReemplazos extends PlantillaFunciones {

    private $_nombreArchivo;
    private $_nombrePlantilla = false;
    private $_var_tpl = array();
    private $_var_tpl_glob = array();
    private $_controlTpl = false;
    private $_cache = 0;
    private $_contenidoArchivo = '';
    private static $_seccionTplCont = 0;
    private static $_bloquearPlantilla;

    public function nombreArchivo($nombre) {
        $this->_nombreArchivo = $nombre;
    }

    public function nombrePlantillaMarco($nombre) {
        VariableSet::indexMarco($nombre);
    }

    public function nombrePlantilla($nombre) {
        $this->_nombrePlantilla = $nombre;
    }

    public function asignar($variable, $valor=NULL) {
        $this->_var_tpl[$variable] = $valor;
    }

    public function asignarGlobal($variable, $valor=NULL) {
        VariableSet::globales($variable, $valor);
    }

    public function controlTpl() {
        $this->_controlTpl = true;
    }

    public function cache($segundos) {
        $this->_cache = $segundos;
    }

    protected function bloquearPlantilla($nombre) {
        self::$_bloquearPlantilla = $nombre;
    }

    public function modificarArchivoMarco($nombre) {
        VariableSet::indexMarco($nombre);
    }
	
    public function contenidoArchivo($contenido) {
        $this->_contenidoArchivo = $contenido;
    }

    public function obtenerPlantilla($imprimir=true) {

        $this->_var_tpl_glob = VariableControl::getArrayGlobales();

        // nombre real del archivo, este se toma directamente del script que llamo al metodo
        $archivo_real = debug_backtrace(false);
        $archivo_real = basename($archivo_real[0]['file']);

        // si no se envio el nombre del archivo, se toma el nombre real
        if (!$this->_nombreArchivo) {
            $archivo = $archivo_real;
        } else {
            $archivo = $this->_nombreArchivo;
        }

        $this->_nombreArchivo = preg_replace("/([a-zA-Z0-9._.-.]+)\.php/", "\${1}", $archivo);

        // control de archivo en cache

        $variablesGet = '';
        if( isset($_GET) && is_array($_GET) ){
            foreach ($_GET as $valor) {
                $variablesGet .= '-'.$valor;
            }
        }

        $directorio = $this->_obtenerDirectorio(VariableGet::sistema('directorio_cache_plantillas'));
        $plantilla_archivo_cache = $directorio.'/'.sha1($this->_nombreArchivo.$variablesGet).'.cache';

        if (
                $this->_cache > 0
                &&
                VariableGet::sistema('generar_cache')
                &&
                !VariableGet::sistema('mostrar_errores')
        ) {

            if (
                !file_exists($plantilla_archivo_cache)
                &&
                ((filemtime($plantilla_archivo_cache) + $this->_cache) < time())
            ) {
                $armar_cache = true;
                ob_start();
            } elseif( !isset($_POST) || (count($_POST)==0) ) {
                echo file_get_contents($plantilla_archivo_cache, FILE_USE_INCLUDE_PATH);
                $terminar_procesos = true;
            }
        }

        if (
            ($this->_nombreArchivo != self::$_bloquearPlantilla)
            &&
            !isset($terminar_procesos)
        ) {

			// obtengo las plantillas de secciones u otras			
			if( ($this->_nombreArchivo == VariableGet::globales('seccion_actual')) && ($this->_nombrePlantilla === false) ){
				$directorio = $this->_obtenerDirectorio(VariableGet::sistema('directorio_plantillas'));
				$plantilla_archivo = $directorio . '/' . $this->_nombreArchivo . '.tpl';
			}elseif( $this->_nombrePlantilla !== false ){
				$directorio = $this->_obtenerDirectorio(VariableGet::sistema('directorio_plantillas'));
				$plantilla_archivo = $directorio . '/' . $this->_nombrePlantilla . '.tpl';
			}else{
				// busca en directorio alternativo si no es seccion
	            $directorio = $this->_obtenerDirectorio(VariableGet::sistema('directorio_plantillas_varias'));
	            $plantilla_archivo = $directorio . '/' . $this->_nombreArchivo . '.tpl';
			}

            $directorio = $this->_obtenerDirectorio(VariableGet::sistema('directorio_cache_compilados'));
            $plantilla_archivo_compilado = $directorio . '/' . sha1($this->_nombreArchivo) . '.cache';

            if (
                    !VariableGet::sistema('mostrar_errores')
                    &&
                    VariableGet::sistema('generar_cache')
                    &&
                    file_exists($plantilla_archivo)
                    &&
                    file_exists($plantilla_archivo_compilado)
                    &&
                    ( filemtime($plantilla_archivo_compilado) > filemtime($plantilla_archivo) )
            ) {

                $plantilla = file_get_contents($plantilla_archivo_compilado, FILE_USE_INCLUDE_PATH);

            } else {

				if( $this->_contenidoArchivo == '' ){
                	$plantilla = file_get_contents($plantilla_archivo, FILE_USE_INCLUDE_PATH);
				}else{
					$plantilla = $this->_contenidoArchivo;
				}

                // armado plantilla

                $plantilla = PlantillaElementos::plantilla($plantilla, $this->_nombreArchivo);

                // guarda el cache del template compilado
                if (
                        !VariableGet::sistema('mostrar_errores')
                        &&
                        VariableGet::sistema('generar_cache')
                ) {
                    $fp = fopen($plantilla_archivo_compilado, 'w');
                    fwrite($fp, $plantilla);
                    fclose($fp);
                }
            }

            // mostrar plantilla para control
            if ($this->_controlTpl == true) {
                echo MostrarErrores::plantilla($plantilla, $this->_nombreArchivo, $this->_var_tpl);
            }

			if( $imprimir===true){
				// para armar la plantilla
				eval("?>".$plantilla."<?");
				/* // descomentar para controlar los problemas en la plantilla
				echo $plantilla;
				// */
			}else{
				return $plantilla;
			}

            // guarda la plantilla compilada
            if ( isset($armar_cache) ) {
                $plantilla_cache = ob_get_contents();
                ob_end_clean();

                $fp = fopen($plantilla_archivo_cache, 'w');
                fwrite($fp, $plantilla_cache);
                fclose($fp);

                echo file_get_contents($plantilla_archivo_cache, FILE_USE_INCLUDE_PATH);

            }
        }
    }

    private function _plantilla($nombre=null, $seccion=null) {

        if ($seccion == 's') {
            if (self::$_seccionTplCont < 5) {
                echo VariableGet::seccion();
                self::$_seccionTplCont++;
            } else {
                return false;
            }
        }

        if ($this->_obtenerNombreTpl($nombre)) {

            if (substr($this->_obtenerNombreTpl($nombre), -4, 4) == '.php') {

                include($this->_obtenerNombreTpl($nombre));

            } else {

                $plantilla = file_get_contents($this->_obtenerNombreTpl($nombre), FILE_USE_INCLUDE_PATH);

                $plantilla = PlantillaElementos::plantilla($plantilla, $this->_nombreArchivo);

                // para armar la plantilla
                return eval("?>" . $plantilla );
            }
        } else {
            return false;
        }
    }

    /**
     * Obtencion del directorio.
     *
     * @return string $directorio
     */
    private function _obtenerDirectorio($directorio) {

        // guardo la imagen original en el directorio de destino con nombre t_g_[id-tabla]_[id-registro]_xxx

        $url_actual = getcwd();
        chdir($directorio);
        $directorio = getcwd();
        chdir($url_actual);

        return $directorio;
    }

}

