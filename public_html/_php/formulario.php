<?php

$tpl = new PlantillaReemplazos();

//== Configuracion de mail ================================================================

$m_asunto = 'Mail de control';
$m_destinatario = 'nnirich@kirke.ws';
$m_nombre_destinatario = 'Nicolas Nirich';
$m_mail_origen = 'prueba@kirke.ws';
$m_nombre_origen = 'KIRKE.servidor-test';

//-- Formulario 1 ----------------

$frm = new ArmadoFormulario('formuario1');
$frm->campo( 'usuario_general', 'Usuario general', 's' );
$frm->campo( 'usuarios_habilitados', 'Usuarios habilitados', 's' );
$frm->campo( 'administrador', 'Administrador', 's' );
$frm->campo( 'nombre', 'Nombre completo', 's', 100 );
$frm->campoValor( 'filtro', 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ ' );
$frm->envioMailCampos( array('usuario_general','usuarios_habilitados','nombre','administrador') );
$frm->envioMail( $m_asunto, $m_destinatario, $m_nombre_destinatario, $m_mail_origen, $m_nombre_origen );

// ControlVariables(), solo debe ser utilizado en casos muy especificos, ya que si se no se hace el reenvio, si el usuario
// refresca la pagina, los datos serian enviados nuevamente
if( $frm->controlVariables() ){

   // todas las variables son controladas y validadas, pero no se ha procesado la clase ArmadoFormulario();

}else{

   // todas las variables son controladas y NO validadas, pero no se ha procesado la clase ArmadoFormulario();

}

$id_insertado = $frm->recepcionControl();

if( $id_insertado !== false ){

	// Se utiliza $id_insertado pra realizar otras operaciones
	
	header( 'Location: '.ArmadoLinks::url(array('Gracias','Formulario 1')) );
	exit();

}

//-- Formulario 2 ----------------

$frm2 = new ArmadoFormulario('formuario2');

$frm2->campo( 'email', 'E-Mail', 's', 100 );
$frm2->campoValor( 'mail' );
$frm2->campo( 'numero', 'Número', 's', 10 );
$frm2->campoValor( 'filtro', '0123456789' );
$frm2->campo( 'clave', '', 's', 10 );
$frm2->campo( 'archivo', '', '');
$frm2->campo( 'descripcion', '', 's',  10 );
$frm2->campoCaptcha();
$frm2->envioMailCampos( array('usuario_general','usuarios_habilitados','nombre','administrador') );
$frm2->envioMail( $m_asunto, $m_destinatario, $m_nombre_destinatario, $m_mail_origen, $m_nombre_origen );

if($frm2->recepcionControl()!==false){

	header( 'Location: '.ArmadoLinks::url(array('Gracias','Formulario 2')) ) ;
	exit();
	
}

	$opciones_valores = array(
			0 => array('valor'=> 'Pablo','etiqueta' =>'Pablo'),
			1 => array('valor'=> 'Juan','etiqueta' =>'Juan'),
			2 => array('valor'=> 'Pedro','etiqueta' =>'Pedro'),
			3 => array('valor'=> 'Marcelo','etiqueta' =>'Marcelo'),
			4 => array('valor'=> 'Ezequiel','etiqueta' =>'Ezequiel'),
	);
$tpl->asignar('opciones', $opciones_valores);
$tpl->asignar('seleccionado', array('Pedro','Ezequiel') );
$tpl->asignar('seleccionado_uno', 'Marcelo');
$tpl->asignar('valor_inicial', 'valor');
$tpl->obtenerPlantilla();
