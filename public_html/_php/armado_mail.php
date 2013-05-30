<?php

$tpl = new PlantillaReemplazos();

if( isset($_GET[1]) && ($_GET[1] == 'Enviar') ){
	
	$obj_mail = new ArmadoMail;
	$obj_mail->servidorMail( 'prueba@kirke.ws' );
	$obj_mail->servidorNombre( 'KIRKE.servidor-test' );
	$obj_mail->mailDestinatario( 'nnirich@kirke.ws' , 'Nicolas Nirich' );
	$obj_mail->asunto( 'Señor {$nombre} muchas gracias por su contacto su {$nombre_producto} ha sido enviado', array('nombre'=>'Gustavo Medina', 'nombre_producto'=>'Lápiz mina') );
	$obj_mail->mailRespuesta( 'nnirich@kirke.ws' );
	$obj_mail->nombreArchivo( 'mail_general' );
	$obj_mail->asignar('nombre_ejemplo', 'Pablo Torres');
	$obj_mail->asignar('nombres', array( 0=>array('nombre'=>'Pablo','apellido'=>'Lopez'), 1=>array('nombre'=>'Hernan','apellido'=>'Gonzales'), 2=>array('nombre'=>'Juan','apellido'=>'Guitierres'), 3=>array('nombre'=>'Ignacio','apellido'=>'Martín')));
	$obj_mail->asignar('imagen_nombre', 'logo/');
	$obj_mail->envio();
	
	// se separo la e de mail, para mostrar que se puede enviar un solo valor o valores que luego se concatenan con '-' guiones, va a pasar a se una sola variable $_GET
	// al recibir las variables, va a tomar la forma en que fue pasado, mayusculas, simbolos, etc, solo cambia las barras '/' por guiones '-'
	header( 'Location: '.ArmadoLinks::url(array('Gracias',array('e','Mail'))) ) ;
	
}

$tpl->obtenerPlantilla();
