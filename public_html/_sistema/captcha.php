<?php

if( isset($_GET['sid']) ){
	$img = new ArmadoCaptcha();
	$img->generar(); // alternate use:  $img->show('/path/to/background.jpg');
	$_SESSION['kk_sistema']['captcha']['control'] = 0;	
}elseif( isset($_GET['imagen']) && ($_GET['imagen'] != '') ){
	$partes_ruta    = pathinfo( '_imagenes/'.$_GET['imagen'] );
	$extencion      = $partes_ruta['extension'];
	if( ($extencion=='gif') || ($extencion=='jpg') || ($extencion=='png') ){
		Header("Content-Type: image/".$extencion);
		readfile( '_imagenes/'.$_GET['imagen'] );
	}
}elseif( isset($_GET['codigo']) ){
	$validacion = new ArmadoCaptcha();
	if( $validacion->verificar_ajax($_GET['codigo']) && ($_SESSION['kk_sistema']['captcha']['control'] < 10) ) {
		echo 'ok';
	}elseif( $_SESSION['kk_sistema']['captcha']['control'] >= 10 ){
		echo '10';
	}else{
		$_SESSION['kk_sistema']['captcha']['control']++;
	}
}
