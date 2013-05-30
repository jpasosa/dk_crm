<?php
/**
 * Se utiliza para administrar los elementos de un carrito de compras.
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

class CarritoDeCompras {

    private $_productos;

    function __construct($nombre) {
        $this->_productos = $nombre;
    }

    public function agregarModificarProducto($id, $cantidad, $familia=NULL, $subfamilia=NULL) {

        if( $familia == NULL ) 		$familia 	= 0;
        if( $subfamilia == NULL ) 	$subfamilia = 0;

        $key_producto = $this->_encontrarProducto($id,$familia,$subfamilia);

        if( $key_producto !== false ) {

            $_SESSION['kk_sistema'][$this->_productos][$key_producto]['cantidad'] 	= $cantidad;
            return true;

        }else {

            $key_producto = $this->_keyInsercion();

            $_SESSION['kk_sistema'][$this->_productos][$key_producto]['familia']		= $familia;
            $_SESSION['kk_sistema'][$this->_productos][$key_producto]['subfamilia']	= $subfamilia;
            $_SESSION['kk_sistema'][$this->_productos][$key_producto]['id']			= $id;
            $_SESSION['kk_sistema'][$this->_productos][$key_producto]['cantidad'] 		= $cantidad;
            return true;

        }
        print_r($_SESSION['kk_sistema'][$this->_productos]);

    }

    public function obtenerCantidad($id, $familia=NULL, $subfamilia=NULL) {

        if( $familia == NULL ) 		$familia 	= 0;
        if( $subfamilia == NULL ) 	$subfamilia = 0;

        $key_producto = $this->_encontrarProducto($id,$familia,$subfamilia);

        if( $key_producto !== false ) {
            return $_SESSION['kk_sistema'][$this->_productos][$key_producto]['cantidad'];
        }
    }

    public function obtenerArray() {
        if( isset($_SESSION['kk_sistema'][$this->_productos]) ) {
            return $_SESSION['kk_sistema'][$this->_productos];
        }else {
			
            return false;
        }
    }

    public function eliminarProducto($id, $familia=NULL, $subfamilia=NULL) {
        if( isset($_SESSION['kk_sistema'][$this->_productos]) ) {

            if( $familia == NULL ) 		$familia 	= 0;
            if( $subfamilia == NULL ) 	$subfamilia = 0;

            $key_producto = $this->_encontrarProducto($id,$familia,$subfamilia);

            unset( $_SESSION['kk_sistema'][$this->_productos][$key_producto] );
            return true;

        }
    }

    public function eliminarTodos() {
        if( isset($_SESSION['kk_sistema'][$this->_productos]) ) {
            unset( $_SESSION['kk_sistema'][$this->_productos] );
            return true;
			echo ('es verdadero');
        }else {
            return false;
        }
    }

    public function verificarCarrito() {

        if(
        isset( $_SESSION['kk_sistema'][$this->_productos] )
                && count( $_SESSION['kk_sistema'][$this->_productos] ) > 0
        ) {
            return true;
        }else {
            return false;
        }

    }

    private function _encontrarProducto($id, $familia, $subfamilia) {
        if(isset($_SESSION['kk_sistema'][$this->_productos]) ) {
            foreach( $_SESSION['kk_sistema'][$this->_productos] as $key => $value ) {
                if(
                $_SESSION['kk_sistema'][$this->_productos][$key]['familia']	== $familia
                        && 	$_SESSION['kk_sistema'][$this->_productos][$key]['subfamilia']	== $subfamilia
                        && 	$_SESSION['kk_sistema'][$this->_productos][$key]['id']			== $id
                ) {
                    return $key;
                }
            }
            return false;
        }else {
            return false;
        }
    }

    private function _keyInsercion() {

        $ultimo_key = 0;

        if( isset($_SESSION['kk_sistema'][$this->_productos]) ) {
            foreach( $_SESSION['kk_sistema'][$this->_productos] as $key => $value ) {
                $ultimo_key = $key;
            }
            if( isset($ultimo_key) ) {
                $ultimo_key++;
            }
        }

        return $ultimo_key;
    }
}

