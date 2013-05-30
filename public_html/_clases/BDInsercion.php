<?php

/**
 * Se utiliza para realizar un INSERT con una base de datos determinada.
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
class BDInsercion {

    private $_contador = 0;
    private $_tablaNombre;
    private $_camposValores = array();

    public function baseTabla($tabla_nombre) {

        $this->_tablaNombre = $tabla_nombre;
    }

    public function campoValor($campo_nombre, $valor) {

        $this->_camposValores[$this->_contador]['campo'] = $campo_nombre;
        $this->_camposValores[$this->_contador]['valor'] = $valor;

        $this->_contador++;

    }

    public function obtenerQuery() {

        $claseInicializar = 'BD'.ucwords(VariableGet::sistema('tipo_base')).'Insercion';
        $insercion = new $claseInicializar;
		
        $insercion->tablaNombre($this->_tablaNombre);

        foreach ($this->_camposValores as $valor) {
            $insercion->insercion($valor['campo'], $valor['valor']);
        }

        return $insercion->obtenerQuery();
    }

    public function insertar($errores) {

		$clase_de_bd = 'BD' . ucfirst(VariableGet::sistema('tipo_base')) . 'Consulta';
		eval('$bd = ' . $clase_de_bd . '::consulta($this->obtenerQuery(), $errores);');
		
		return $bd;

    }

}
