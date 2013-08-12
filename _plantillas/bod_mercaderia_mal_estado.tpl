<link href="/css/tra_packing_list.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/bod_mercaderia_mal_estado/abm.js"></script>

<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
	<div class="flash_error"></div>
	<div class="flash_notice"></div>
	{if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
	{if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
	{template tpl="menu_izq"}
	<div id="derecha" class="catalogo" style="background:url(/img/fondos/bg_cuenta.jpg) right top repeat-y;" >
		<div id="hilo"> Bienvenido: {$nombre_empleado}</div>
		<hr />
		<h1 class="azul bold"><span class="txt22 normal">Bodega | Mercaderia en Mal Estado</span></h1>
		<hr />
		<p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul"> {$date}</span></p>
		<form class="box-entrada" name="add_hotel" action="/bod_mercaderia_mal_estado.html" method="post" enctype="multipart/form-data" >
			<div class="box-entrada padding10" height="40" colspan="5" bgcolor="#D2E1F2">
				<div class="izq">
					<div class="campania">
						<label class="primerElement">Informe:</label>
						{if $first_time == 'true'}
							<input name="informe" type="text" readonly="readonly" value='valor automático'  title="Código del Informe" />
						{else}
							<input name="informe" type="text" readonly="readonly" value='{$tabla[0]["informe"]}'  title="Código del Informe" />
						{/if}
					</div>
				</div>
				<div class="observacionesChico clear">
					<label> Observaciones: </label>
					<textarea name="observaciones">{$tabla[0]['observaciones']}</textarea>
				</div>
				<input name="first_time" type="hidden" value="{$first_time}" />
				<input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
				<input name="id_tabla" type="hidden" value="{$id_tabla}" />
				<input name="agregar" class="agregar" type="submit" value="Agregar" />
			</div>
		</form>

		<!-- LISTADO DE LOS PRODUCTOS -->
		<table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
			<tr>
				<td width="20" align="left" bgcolor="#4685CA"><p class="blanco">Referencia</p></td>
				<td width="20" align="left" bgcolor="#4685CA"><p class="blanco">Producto</p></td>
				<td width="20" align="left" bgcolor="#4685CA"><p class="blanco">Nro. Caja</p></td>
				<td width="40" align="left" bgcolor="#4685CA"><p class="blanco">x caja</p></td>
				<td width="100" align="left" bgcolor="#4685CA"><p class="blanco">Aclaracion</p></td>
				<td width="20" align="left" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
			</tr>
			{if $tabla_sec['error'] == false }
				{foreach item=ts from=$tabla_sec }
					<tr id="id_prod-{$$ts[id_bod_mercaderia_mal_estado_prod]}">
						<td><span id="{$$ts[id_pro_productos]}" class="referencia">{$$ts[referencia]}</span></td>
						<td> <span class="producto">{$$ts[producto]}</span></td>
						<td> <span class="nro_caja">{$$ts[nro_caja_bmm]}</span></td>
						<td> <span class="productos_por_caja">{$$ts[productos_por_caja_bmm]}</span></td>
						<td> <span class="aclaracion">{$$ts[aclaracion]}</span></td>
						<td>
							<a href="#">
								<img id="id_prod-{$$ts[id_bod_mercaderia_mal_estado_prod]}" class="del_prod" src="/img/iconos/delete.gif" alt="quitar" border="0" />
							</a>
							<a href="#">
								<img id="id_prod-{$$ts[id_bod_mercaderia_mal_estado_prod]}" class="edit_prod" src="/img/iconos/edit.gif" alt="editar" border="0" />
							</a>
						</td>
					</tr>
				{/foreach}
			{/if}
		</table>

		<!-- BOX DE ENTRADA DE LOS PRODUCTOS -->
		<form class="box-entrada" name="add_hotel" action="/bod_mercaderia_mal_estado.html" method="post" enctype="multipart/form-data" >
			<div class="box-entrada padding10" height="40" colspan="5" bgcolor="#D2E1F2">
				<div class="izq">
					<div class="campania">
						<label class="primerElement"> Referencia: </label>
						<select name="id_pro_productos" class="referencia">
							{foreach item=pr from=$pro_productos_select}
								<option value="{$$pr[id_pro_productos]}" {if $$pr['id_pro_productos'] == $referencia } selected {/if}>
									{$$pr[referencia]} |  {$$pr[producto]}
								</option>
							{/foreach}
						</select>
					</div>
					<div class="campania">
						<label> Nro. Caja: </label>
						<input name="nro_caja" class="nro_caja" type="text" value=""  />
					</div>

				</div>
				<div class="der">
					<div class="campania">
						<label> x caja: </label>
						<input class="ultimoElement productos_por_caja" name="productos_por_caja" type="text" value="" />
					</div>
					<div class="campania">
						<label>Aclaracion: </label>
						<input name="aclaracion" class="aclaracion" type="text" value=""  />
					</div>
				</div>
				<input name="first_time" type="hidden" value="{$first_time}" />
				<input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
				<input name="id_tabla" type="hidden" value="{$id_tabla}" />
				<input name="agregar_prod" class="agregar" type="submit" value="Agregar" />
			</div>
		</form>

		<form class="box-entrada" name="add_hotel" action="/bod_mercaderia_mal_estado.html" method="post" enctype="multipart/form-data" >
			<div class="enviar_proceso">
				<input name="id_tabla" type="hidden" value="{$id_tabla}" />
				<input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
				<input name="enviar" class="enviar" type="submit" value="Enviar al siguiente Paso" />
			</div>
		</form>
	</div>
	<div style="width:741px; height:46px; float:right;" class="png_bg"></div>
	<br style="clear:both;" />
</div>
