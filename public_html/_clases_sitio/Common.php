<?php

class Common {

    public static function PutDot($number) {
        $value_point = str_replace(',', '.', $number);                             
        return $value_point;
    }

    public static function isLogin() {
        // USER LOGUEADO
        if(!isset($_SESSION['id_user'])) {
            header('Location: /logueo.html');
            exit();
        }
        return $_SESSION['id_user'];
    }

    public static function setErrorMessage($consulta) {
        $resp = '';
        if(isset($consulta['error'])) {
            if($consulta['error'] == true) {
                $resp = $consulta['notice_error'];
            }  
        }
        return $resp;
    }

    
    
    
}