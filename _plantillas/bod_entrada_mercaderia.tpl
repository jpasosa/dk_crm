<link href="/css/bod_entrada_mercaderia.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" /><!-- para del datepicker -->
<script> $(function() {$( "#fecha_llegada" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>
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
		<p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
		<form class="box-entrada" name="add_hotel" action="/bod_entrada_mercaderia/{$id_tra_ytd_entrada}.html" method="post" enctype="multipart/form-data" >
			<div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
				<div class="campania">
					<label class="primerElement">Proveedor:</label>
					{if $first_time == 'true'}
						<input class="ultimoElement" name="proveedor_nombre" readonly="readonly" type="text" value='{$tabla_princ_tmp[0]["nombre"]}'  alt="Proveedor" />
						<input name="id_cpr_proveedor" type="hidden" value='{$tabla_princ_tmp[0]["id_cpr_proveedores"]}' />
					{else}
						<input class="ultimoElement" name="proveedor_nombre" readonly="readonly" type="text" value='{$tabla[0]["nombre"]}'  alt="Proveedor" />
						<input name="id_cpr_proveedor" type="hidden" value='{$tabla[0]["id_cpr_proveedores"]}' />
					{/if}
				</div>
				<div class="izq clear">
					<p class="azul bold">ENTREGA    </p>
					<div class="campania">
						<label class="primerElement">Fecha Llegada:</label>
						{if $tabla[0]['fecha_llegada'] == '' }
							<input name="fecha_llegada" id="fecha_llegada" type="text" value=''  alt="Cantidad Días" />
						{else}
                            			<input id="fecha_llegada" name="fecha_llegada" type="text" value='{$tabla[0]["fecha_llegada"]|date_format:"d/m/Y"}'  alt="Fecha" />
						{/if}
					</div>
				</div>
				<div class="observacionesChico clear">
					<label> Observaciones: </label>
					<textarea class="ultimoElement" name="observaciones">{$tabla[0]['observaciones']}</textarea>
				</div>
				<input name="first_time" type="hidden" value="{$first_time}" />
				<input name="id_tra_ytd_entrada" type="hidden" value="{$id_tra_ytd_entrada}" />
				<input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
				<input name="id_tabla" type="hidden" value="{$id_tabla}" />
				<input name="prod_tmp" type="hidden" value="{$prod_tmp}" />
				<input name="agregar" class="agregar" type="submit" value="Agregar Observación" />
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
				<td align="center" bgcolor="#4685CA"><p class="blanco">Accion</p></td>
			</tr>
			{if $tabla_sec['error'] == false }
				{foreach item=prod from=$bod_entrada_mercaderia_prod }
					<tr id="id_gast-{$$prod[id]}">
						<td><span class="detalle">{$$prod[referencia]}</span></td>
						<td><span id="ref-{$$prod[id_ref]}" title="{$$prod[detalle]}" class="referencia">{$$prod[producto]}</span></td>
						<td align="center"><span >{$$prod[piso]}</span></td>
						<td align="center"><span >{$$prod[pared]}</span></td>
						<td align="center"><span >{$$prod[estanteria]}</span></td>
						<td align="center"><span class="detalle">{$$prod[cuadrante]}</span></td>
						<td align="center">
							<a href="#"><img id="id_gast-{$$prod[id]}" class="del_gasto" src="/img/iconos/delete.gif" alt="quitar" border="0" /></a>
						</td>
					</tr>
				{/foreach}
			{/if}
		</table>

		{foreach item=prod from=$bod_entrada_mercaderia_prod }
			<form class="box-entrada" name="add_hotel" action="/bod_entrada_mercaderia/{$id_tra_ytd_entrada}.html" method="post" enctype="multipart/form-data" >
				<div class="box-entrada padding10" height="40" colspan="5" bgcolor="#D2E1F2">
					<div class="izq clear">
						<div class="campania">
							<label class="primerElement">Producto:</label>
							<input type="text" readonly="readonly" value='{$$prod[producto]}'  title="{$$prod[detalle]}" />
						</div>
						<div class="campania">
							<label >Piso:</label>
							<input name="piso" type="text" value='{$$prod[piso]}'  alt="Piso" />
						</div>
						<div class="campania">
							<label >Pared:</label>
							<input name="pared" type="text" value='{$$prod[pared]}'  alt="Pared" />
						</div>
					</div>
					<div class="der">
						<div class="campania">
							<label >Nivel Estantería:</label>
							<input name="estanteria" type="text" value='{$$prod[estanteria]}'  alt="Nivel Estanteria" />
						</div>
						<div class="campania">
							<label >Cuadrante:</label>
							<input name="cuadrante" type="text" value='{$$prod[cuadrante]}'  alt="Cuadrante" />
						</div>
					</div>
					<input name="first_time" type="hidden" value="{$first_time}" />
					<input name="id_bod_entrada_mercaderia_prod" type="hidden" value="{$$prod[id_bod_entrada_mercaderia_prod_tmp]}" />
					<input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
					<input name="id_tabla" type="hidden" value="{$id_tabla}" />
					<input name="prod_tmp" type="hidden" value="{$prod_tmp}" />
					<input name="agregar_prod" class="agregar" type="submit" value="Agregar" />
				</div>
			</form>
		{/foreach}

		<form class="box-entrada" name="add_hotel" action="/bod_entrada_mercaderia/{$id_tra_ytd_entrada}.html" method="post" enctype="multipart/form-data" >
			<div class="enviar_proceso">
				{foreach item=prod from=$bod_entrada_mercaderia_prod }
					<input name="id_prod[]" type="hidden" value="{$$prod[id_bod_entrada_mercaderia_prod_tmp]}" />
				{/foreach}
				<input name="id_tra_ytd_entrada" type="hidden" value="{$id_tra_ytd_entrada}" />
				<input name="id_tabla" type="hidden" value="{$id_tabla}" />
				<input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
				<input name="enviar" class="enviar" type="submit" value="Enviar al siguiente Paso" />
			</div>
		</form>
	</div>
	<div style="width:741px; height:46px; float:right;" class="png_bg"></div>
	<br style="clear:both;" />
</div>
