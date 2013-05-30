<?php
$tpl = new PlantillaReemplazos();
$flash_error = '';
$flash_notice = '';
$user = '';
unset($_SESSION['id_user']);
unset($_SESSION['first_time']);
// USER LOGUEADO
// $id_user = $_SESSION['id_user'] = '100003'; // gerencia
if(isset($_POST['login'])) { 
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        do {
            if($user == '') {
                $flash_error = 'Debe ingresar un nombre de Usuario';

                break;
            }
            if($pass == '') {
                $flash_error = 'Debe ingresar una clave';
                break;
            }
            $user_pass = BDConsulta::consulta('user_pass', array($user, $pass), 'n');
            $user_pass_cliente = BDConsulta::consulta('user_pass_cliente', array($user, $pass), 'n');
            if(is_null($user_pass) || count($user_pass) > 1) {
                if(is_null($user_pass_cliente) || count($user_pass) > 1) {
                    $flash_error = 'Usuario y/o Contraseña incorrectos';
                    break;
                }else{ // cliente encontrado
                    $id_user = $_SESSION['id_user'] = -100; // Le asignamos este numero, ya que está cargado en cv_datos_personales como CLIENTE de afuera.
                    $id_client_user = $_SESSION['id_client_user'] = $user_pass_cliente[0]['id_ven_cliente_contacto'];
                    header('Location: /menu.html');
                    exit();        
                }
            }else{ // usuario encontrado
                $id_user = $_SESSION['id_user'] = $user_pass[0]['id_cv_datos_personales'];
                header('Location: /menu.html');
                exit();    
            }
            
        }while(0);
}
$tpl->asignar('flash_error', $flash_error);
$tpl->asignar('flash_notice', $flash_notice);
$tpl->asignar('user', $user);

$tpl->obtenerPlantilla();

// unset($flash_error);
// unset($flash_notice);







