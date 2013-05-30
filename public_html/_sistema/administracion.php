<?php

if( isset($_POST['usuario']) && isset($_POST['clave']) ){
	if( ($_POST['usuario']==$_SERVER['KIRKE_USER']) && ($_POST['clave']==$_SERVER['KIRKE_PASS']) ){
		$_SESSION['kk_administracion_logueo'] = true;
		if( !isset($_GET['kk_administracion']) ){
			header( 'Location: /' ) ;
			exit();
		}
	}
}

if( isset($_SESSION['kk_administracion_logueo']) && ($_SESSION['kk_administracion_logueo']===true) && isset($_GET['accion']) && ($_GET['accion']=='salir') ){
	unset($_SESSION);
}

// ---------------------------------------------------------------------------------------------------------------

$mail_control = 'nnirich@kirke.ws';

echo '<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-size: 11px;
}
td {
	font-family: Arial, Helvetica, sans-serif;
	color:#000000;
}
.texto_color {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#FF0000;
}
.titulos {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color:#000000;
	font-weight: bold;
}
.titulos_colores {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color:#FF0000;
}
.titulo_encabezado {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color:#000000;
	font-weight: bold;
}
.version {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	color:#FF0000;
}
.link_paginas:link {
	font-family: Arial, Helvetica, sans-serif;
	color:#FF0000;
	font-size: 11px;
	text-decoration: none;
}
.link_paginas:visited {
	font-family: Arial, Helvetica, sans-serif;
	color:#FF0000;
	font-size: 11px;
	text-decoration: none;
}
.link_paginas:hover {
	font-family: Arial, Helvetica, sans-serif;
	color:#FF0000;
	font-size: 11px;
	text-decoration:underline;
}
.link_paginas:active {
	font-family: Arial, Helvetica, sans-serif;
	color:#FF0000;
	font-size: 11px;
	text-decoration: none;
}
</style>
</head>
<body>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td width="100%">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td height="54" width="200" align="left"><a href="http://kirke.ws/" target="_blank"><img src="http://kirke.ws/_imagenes/logo_kirke_ext.gif" alt="logo" width="200" height="54" border="0" /></a></td>
			  <td width="20"></td>
			  <td width="1" bgcolor="#000000"></td>
			  <td width="20"></td>
			  <td align="left">
				<span class="titulo_encabezado">[PHP] Administración del sitio:</span><br>
                  <span class="texto_gris">Control de configuraciones y borrados de cache</span><br>
                  <a href="http://kirke.ws/" target="_blank" class="link_paginas">www.kirke.ws</a><br>
                <span class="version">version: 4.0</span>
			  </td>
			</tr>
		</table>
	</td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td height="1" bgcolor="#000000"></td>
  </tr>
  <tr>
    <td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td width="50" height="25"></td>
			  <td align="center"><span class="titulos_colores">Administracion del Sitio</span></td>
			  <td width="50" align="right"><a href="index.php?kk_administracion&accion=salir" class="link_paginas">salir</a>&nbsp;&nbsp;</td>
			</tr>
		</table>
	</td>
  <tr>
    <td height="1" bgcolor="#000000"></td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
';

if( isset($_GET['kk_administracion']) && isset($_SESSION['kk_administracion_logueo']) && ($_SESSION['kk_administracion_logueo']===true) ){
echo '
  <tr>
    <td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td width="5"></td>
			  <td><a href="index.php?kk_administracion&accion=borrar_cache_todos" class="link_paginas">Borrar todos los cache</a></td>
			  <td width="5"></td>
			  <td><a href="index.php?kk_administracion&accion=borrar_cache_planillas" class="link_paginas">Borrar cache de plantillas</a></td>
			  <td width="5"></td>
			  <td><a href="index.php?kk_administracion&accion=regenerar_sitemap" class="link_paginas">Regenerar sitemap</a></td>
			  <td width="5"></td>
			</tr>
			<tr>
			  <td></td>
			  <td><a href="index.php?kk_administracion&accion=borrar_cache_bases" class="link_paginas">Borrar cache de bases</a></td>
			  <td></td>
			  <td><a href="index.php?kk_administracion&accion=borrar_cache_compilados_y_planillas" class="link_paginas">Borrar cache de compilados y plantillas</a></td>
			  <td></td>
			  <td><a href="index.php?kk_administracion&accion=controlar_sitio" class="link_paginas">Controlar sitio</a></td>
			  <td></td>
			</tr>
		</table>
	</td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td height="1" bgcolor="#000000"></td>
  </tr>
';	
} 
  
echo '  <tr>
    <td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		  <td width="20"></td>
		  <td align="left">
';

// -----------------------------------

if( !isset($_SESSION['kk_administracion_logueo']) ){
	
	if(isset($_GET['kk_administracion'])){
		$action = 'index.php?kk_administracion';
	}else{
		$action = '/';	
	}

echo '<form id="form1" name="form1" method="post" action="'.$action.'">
  		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td height="10"></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			</tr>
			<tr>
			  <td width="50"></td>
			  <td>Usuario</a></td>
			  <td width="30"></td>
			  <td><input name="usuario" style="width:200px"></td>
			  <td width="5"></td>
			</tr>
			<tr>
			  <td height="10"></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			</tr>
			<tr>
			  <td></td>
			  <td>Clave</td>
			  <td></td>
			  <td><input type="password" name="clave" style="width:200px"></td>
			  <td></td>
			</tr>
			<tr>
			  <td height="10"></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			</tr>
			<tr>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td><input type="submit" name="button" id="button" value="Enviar" /></td>
			  <td></td>
			</tr>
		</table>
</form>
';

}

// -----------------------------------

if( isset($_GET['kk_administracion']) && isset($_SESSION['kk_administracion_logueo']) && ($_SESSION['kk_administracion_logueo']===true) && isset($_GET['accion']) && ($_GET['accion']=='controlar_sitio') ){


	echo '<br />'."\n";
	echo '<span class="titulos">Control de los directorios cache del sitio, eliminación de los archivos de cache:</span><br /><br />'."\n";
	
	control_directorios_cache( VariableGet::sistema('directorio_cache_plantillas') );
	control_directorios_cache( VariableGet::sistema('directorio_cache_compilados') );
	control_directorios_cache( VariableGet::sistema('directorio_cache_base') );
	control_directorios_cache( VariableGet::sistema('directorio_cache_links') );
	control_directorios_cache( VariableGet::sistema('directorio_cache_links').'/principal' );
	control_directorios_cache( VariableGet::sistema('directorio_cache_links').'/secundario' );
	
	
	echo '<br />'."\n";
	echo '<span class="titulos">Control de los archivos del sitemap del sitio:</span><br /><br />'."\n";
	
	control_archivos_sitemap( 'robots.txt' );
	control_archivos_sitemap( 'sitemap.xml' );
	control_archivos_sitemap( 'sitemap_automatico_principal.xml' );
	control_archivos_sitemap( 'sitemap_automatico_secundario.xml' );
	
	
	echo '<br />'."\n";
	echo '<span class="titulos">Control de la conexión a la base de datos:</span><br /><br />'."\n";
	
	@control_variables( $bases['servidor'] , 'servidor');
	@control_variables( $bases['base'] , 'base');
	@control_variables( $bases['usuario'] , 'usuario');
	@control_variables( $bases['clave'] , 'clave');
		
	
	echo '<br />'."\n";
	$conexion =  mysql_connect($bases['servidor'], $bases['usuario'], $bases['clave']);
	if($conexion) {
		echo '[OK] - Conexión realizada exitosamente<br />'."\n";
	}else{
		echo '<span style="color: #F00;">[ERROR] - No pudo realizarse la conexión con la base de datos</span><br />'."\n";
	}
	
	
	echo '<br />'."\n";
	echo '<span class="titulos">Control del envío de mails desde localhost:</span><br /><br />'."\n";
	
	if( mail($mail_control, 'Control mail', 'Mail enviado desde '.$_SERVER['HTTP_HOST'] ) !== false ){
		echo '[OK] - Envío realizado exitosamente (solo valida si el e-mail se envío hacia el "MTA", pero no puede asegurar el envío)<br />'."\n";
		echo 'Se ha intentado enviar un mail a '.$mail_control.', verificar la recepción<br />'."\n";
	}else{
		echo '<span style="color: #F00;">[ERROR] - No pudo enviar el mail</span><br />'."\n";
	}

}

if( isset($_GET['kk_administracion']) && isset($_SESSION['kk_administracion_logueo']) && ($_SESSION['kk_administracion_logueo']===true) && isset($_GET['accion']) && (($_GET['accion']=='borrar_cache_bases') || ($_GET['accion']=='borrar_cache_todos')) ){

	echo '<br />'."\n";
	echo '<span class="titulos">Borrado de los archivos de cache de las bases:</span><br /><br />'."\n";
	
	borrar_directorios_cache( VariableGet::sistema('directorio_cache_base') );
	
}

if( isset($_GET['kk_administracion']) && isset($_SESSION['kk_administracion_logueo']) && ($_SESSION['kk_administracion_logueo']===true) && isset($_GET['accion']) && (($_GET['accion']=='borrar_cache_planillas') || ($_GET['accion']=='borrar_cache_todos')) ){

	echo '<br />'."\n";
	echo '<span class="titulos">Borrado de los archivos de cache de las plantillas:</span><br /><br />'."\n";

	borrar_directorios_cache( VariableGet::sistema('directorio_cache_plantillas') );
	
}

if( isset($_GET['kk_administracion']) && isset($_SESSION['kk_administracion_logueo']) && ($_SESSION['kk_administracion_logueo']===true) && isset($_GET['accion']) && (($_GET['accion']=='borrar_cache_compilados_y_planillas') || ($_GET['accion']=='borrar_cache_todos')) ){

	echo '<br />'."\n";
	echo '<span class="titulos">Borrado de los archivos de cache de los complilados y plantillas:</span><br /><br />'."\n";

	borrar_directorios_cache( VariableGet::sistema('directorio_cache_compilados') );	
	borrar_directorios_cache( VariableGet::sistema('directorio_cache_plantillas') );
	
}

if( isset($_GET['kk_administracion']) && isset($_SESSION['kk_administracion_logueo']) && ($_SESSION['kk_administracion_logueo']===true) && isset($_GET['accion']) && ($_GET['accion']=='regenerar_sitemap') ){

	echo '<br />'."\n";
	echo '<span class="titulos">Regenerado del sitemap:</span><br /><br />'."\n";

	borrar_archivo_sitemap( VariableGet::sistema('directorio_cache_links') );	
	
}

// -----------------------------------

echo '    
		  </td>
		  <td width="20"></td>
		</tr>
		</table>
    </td>
  </tr>
  <tr>
    <td height="20"></td>
  </tr>
  <tr>
    <td height="1" bgcolor="#000000"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>';















// funciones -----------------------------------------------------------------------------------------------------

function control_directorios_cache($directorio){
	if( @file_put_contents($directorio.'/prueba_cache.kirke', '') !== false ){
		echo '[OK] - Directorio "'.$directorio.'"<br />'."\n";
		@unlink($directorio.'/prueba_cache.kirke');
	}else{
		echo '<span style="color: #F00;">[ERROR] - Problema con el directorio "'.$directorio.'"</span><br />'."\n";
	}
}

function control_archivos_sitemap($archivo){
	$contenido_archivo = @file_get_contents($archivo);
	if( @file_get_contents($archivo) === false ){
		echo '<span style="color: #F00;">[ERROR] - No se pudo leer el archivo "'.$archivo.'"</span><br />'."\n";
	}elseif( @file_put_contents($archivo, $contenido_archivo) === false ){
		echo '<span style="color: #F00;">[ERROR] - No se pudo escribir el archivo "'.$archivo.'"</span><br />'."\n";
	}else{
		echo '[OK] - Archivo "'.$archivo.'"<br />'."\n";
	}
}

function control_variables($variable, $nombre){
	if( !isset($variable) ){ 
		echo '<span style="color: #F00;">[ERROR] - No se encuentra definida la variable "'.$nombre.'"</span><br />'."\n"; 
	}else{
		echo '[OK] - Variable "'.$nombre.'"<br />'."\n";
	}
}

function borrar_directorios_cache($directorio){
	$cont = 0;
	$mensaje = '[OK] - Se han borrado todos los archivos del siguiente directorio "'.$directorio.'"<br />'."\n";
	foreach (glob($directorio.'/*.cache') as $archivo) {
		if( @unlink($archivo) === false ){
			$mensaje = '<span style="color: #F00;">[ERROR] - No se pudieron borrar todos los archivos del siguiente directorio "'.$directorio.'"</span><br />'."\n"; 
		}
		$cont++;
	}
	if( $cont == 0 ){
		echo '[OK] - Los archivos del siguiente directorio "'.$directorio.'" ya se encontraban borrados<br />'."\n";
	}else{
		echo $mensaje;
	}
}

function borrar_archivo_sitemap($directorio){
	$cont = 0;
	foreach (glob($directorio.'/*.cache') as $archivo) {
		if( @unlink($archivo) === false ){
			echo '<span style="color: #F00;">[ERROR] - No se pudo borrar el siguiente archivo "'.$archivo.'"</span><br />'."\n"; 
		}else{
			echo '[OK] - Se han borrado el siguiente archivo "'.$archivo.'"<br />'."\n";		
		}
		$cont++;
	}
	if( $cont == 0 ){
		echo '[OK] - Los archivos del sitemap ya se encontraban borrados<br />'."\n";
	}
}








