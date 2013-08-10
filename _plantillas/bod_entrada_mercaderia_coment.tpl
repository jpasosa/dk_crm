<link href="/css/bod_entrada_mercaderia.css" rel="stylesheet" type="text/css" />
<div style="width:994px; height:23px; background:url(img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
	<div class="flash_error"></div>
	<div class="flash_notice"></div>
	{if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
	{if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
	{template tpl="menu_izq"}
	<div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
		<div id="hilo"> Bienvenido: {$nombre_empleado}</div>
		<hr />
		<h1 class="azul bold"><span class="txt22 normal">Bodega  |  Entrada de Mercaderia</span></h1>
		<hr />
		<p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$fecha_inicio}</span></p>
        	<p>Empleado:<span class="azul">{$nombre_inicio}</span></p>
		<form class="box-entrada" name="add_hotel" action="#" method="post" >
			<div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
				<div class="campania">
					<label class="primerElement">Proveedor:</label>
					<input class="ultimoElement" name="proveedor_nombre" readonly="readonly" type="text" value='{$tabla[0]["nombre"]}'  alt="Proveedor" />
				</div>
				<div class="izq clear">
				<p class="azul bold">ENTREGA</p>
				<div class="campania">
					<label class="primerElement">Fecha Llegada:</label>
					<input id="fecha_llegada" name="fecha_llegada" readonly="readonly" type="text" value='{$tabla[0]["fecha_llegada"]|date_format:"d/m/Y"}'  alt="Fecha" />
				</div>
				</div>
				<div class="observacionesChico clear">
					<label> Observaciones: </label>
					<textarea class="ultimoElement" name="observaciones" readonly="readonly">{$tabla[0]['observaciones']}</textarea>
				</div>
				<input name="id_tra_ytd_entrada" type="hidden" value="{$id_tra_ytd_entrada}" />
				<input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
				<input name="id_tabla" type="hidden" value="{$id_tabla}" />
			</div>
		</form>

		<p class="izq clear azul bold">CONTROL DE PRODUCTOS</p>
		<table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
			<tr>
				<td bgcolor="#4685CA"><p class="blanco">Referencia</p></td>
				<td align="left" bgcolor="#4685CA"><p class="blanco">Producto</p></td>
				<td align="center" bgcolor="#4685CA"><p class="blanco">Piso</p></td>
				<td align="center" bgcolor="#4685CA"><p class="blanco">Pared</p></td>
				<td width="60" align="center" bgcolor="#4685CA"><p class="blanco">Nivel Estantería</p></td>
				<td width="60" align="center" bgcolor="#4685CA"><p class="blanco">Cuadrante</p></td>
			</tr>
			{if $tabla_sec['error'] == false }
				{foreach item=prod from=$tabla_sec }
					<tr id="id_gast-{$$prod[id]}">
						<td><span class="detalle" title="Marca: {$$prod[marca]}  |   Familia: {$$prod[familia]} / {$$prod[marca]}  |  Precio: {$$prod[precio]}">{$$prod[referencia]}</span></td>
						<td><span id="ref-{$$prod[id_ref]}" title="{$$prod[detalle]}" class="referencia">{$$prod[producto]}</span></td>
						<td align="center"><span >{$$prod[piso]}</span></td>
						<td align="center"><span >{$$prod[pared]}</span></td>
						<td align="center"><span >{$$prod[estanteria]}</span></td>
						<td align="center"><span class="detalle">{$$prod[cuadrante]}</span></td>
					</tr>
				{/foreach}
			{/if}
		</table>

		<form class="box-coment" name="box_coment" action="/bod_entrada_mercaderia_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
			<div class="title"> Comentarios: </div>
			{if $all_comments['error'] != true }
				{foreach item=com from=$all_comments }
					<div class="coment_ant">
						<div class="fecha"> {$$com[fecha_alta]} </div>
						<div class="area"> {$$com[area]} </div>
						<div class="estado"> {$$com[estado]} </div>
						<div class="comentario"> {$$com[comentario]} </div>
					</div>
				{/foreach}
			{else}
				No existen comentarios
			{/if}
			<div class="coment_actual">
			<div class="comentario">
			<div class="fecha"> {$date} </div>
			<div class="area"> {$area[0]['area']} </div>
			<label> Comentario: </label>
			<textarea name="comentario" rows="2" redonly="true"></textarea>
			</div>
			<div class="aceptar">
			<input name="aprobar" class="aprobar" type="submit" value="Aprobar" />
			{if $first_process != true}
			{if $repeat_process != true}
			<input name="solicitar_correccion" class="solicitar_correccion" type="submit" value="Solicitar Corrección" />
			{/if}
			{/if}
			{if $first_process != true }
			<input name="desaprobar" class="desaprobar" type="submit" value="Desaprobar" />
			{/if}
			</div>
			</div>
		</form>

	</div>
	<div style="width:741px; height:46px; float:right;" class="png_bg"></div>
	<br style="clear:both;" />
</div>





