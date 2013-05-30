<?php

/**
 * Se utiliza para validar que no se utilice un robot para la carga de datos en un formulario.
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
class ArmadoCaptcha {

    private $_captcha;

    function __construct() {
        include_once "_clases/captcha/securimage.php";
        $this->_captcha = new Securimage();
    }

    public function generar($path_imagen_fondo=null) {
        if ($path_imagen_fondo == null) {
            $this->_captcha->show();
        } else {
            $this->_captcha->show($path_imagen_fondo);
        }
    }

    public function mostrar() {

        // muestra la imagen
        return "<a href=\"#\" onclick=\"document.getElementById('image').src = '/index.php?kk_captcha=captcha&sid=' + Math.random(); return false\"><img src=\"/index.php?kk_captcha=captcha&sid=" . md5(uniqid(time())) . "\" id=\"image\" border=\"0\"/></a>";
    }

    public function verificar($nombre_campo) {
        if (isset($_POST[$nombre_campo]) && ($_POST[$nombre_campo] != '')) {
            return $this->_captcha->check($_POST[$nombre_campo]);
        } else {
            return false;
        }
    }

    public function verificar_ajax($valor=null) {
        if (isset($valor) && ($valor != '')) {
            return $this->_captcha->check($valor);
        } else {
            return false;
        }
    }

}

