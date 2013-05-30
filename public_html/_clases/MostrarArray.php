<?php
/**
 * Se utiliza para mostrar la estructura del array dentro de un HTML.
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

class MostrarArray {

    private $_armado;

    public function arrayVer($array, $arrayNombre) {


        //==================================

        // VER var_export()

        //==================================


        $this->_armado = '';

        if( is_array($array) ) {
            return $this->_arrayArmar($array, $arrayNombre)."<br />";
        }else {
            return $arrayNombre.' = "'.$array.'";'."<br />";
        }

    }

    private function _arrayArmar($array, $nombreArray) {

        //$this->_armado .= $nombreArray . " = new Array();<br />";
        reset($array);

        while (list($key, $value) = each($array)) {
            if (is_numeric($key)) {
                $verKey = "[".$key."]";
            } else {
                $verKey = "['".$key."']";
            }

            if(is_array($value)) {
                $this->_arrayArmar($value, $nombreArray . $verKey);
            }else {
                $this->_armado .= $nombreArray . $verKey . " = ";
                if(is_string($value)) {
                    $this->_armado .= "'".$value."';<br />";
                }else if ($value === false) {
                    $this->_armado .= "false;<br />";
                } else if ($value === NULL) {
                    $this->_armado .= "null;<br />";
                } else if ($value === true) {
                    $this->_armado .= "true;<br />";
                } else {
                    $this->_armado .= $value.";<br />";
                }
            }
        }

        return $this->_armado;

    }

}