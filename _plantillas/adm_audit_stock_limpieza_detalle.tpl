<link href="/css/adm_audit_stock_limpieza_detalle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/adm_audit_stock_limpieza_detalle/abm.js"></script>

<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
	<div class="flash_error"></div>
	<div class="flash_notice"></div>
	{if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
	{if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
	{template tpl="menu_izq"}
	<div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
		<div id="hilo"> Bienvenido: {$nombre_empleado}</div>
		<hr />
		<h1 class="azul bold"><span class="txt22 normal">Resultados de auditorias físicas Stock y limpieza, detalle</span></h1>
		<hr />
		<p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
		<p>Sector: <span class="azul">{$area}</span></p>
		<p>Empleado:<span class="azul">{$nombre_empleado}</span></p>
		<form class="box-entrada" action="/adm_audit_stock_limpieza_detalle/{$adm_audit_stock_limpieza['id_adm_audit_stock_limpieza']}.html"
							name="add_hotel" method="post" enctype="multipart/form-data" >
			<div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E	1F2">
				<div class="campania">
					<label class="primerElement">Bodega:</label>
					<input class="ultimoElement" name="bodega" type="text" value='{$tabla[0]["bodega"]}'  alt="Bodega" />
				</div>
				<div class="izq clear">
					<p class="azul bold">LIMPIEZA</p>
					<div class="campania">
						<label class="primerElement">Detalle:</label>
						<select name="limpieza_detalle">
							<option value="MB"{if $tabla[0]['detalle'] == 'MB' }	selected {/if}>Muy Bueno</option>
							<option value="B" 	{if $tabla[0]['detalle'] == 'B' }	selected {/if}>Bueno</option>
							<option value="N" 	{if $tabla[0]['detalle'] == 'N' }	selected {/if}>Normal</option>
							<option value="M" 	{if $tabla[0]['detalle'] == 'M' }	selected {/if}>Mala</option>
							<option value="MM" {if $tabla[0]['detalle'] == 'MM' } selected {/if}>Muy Mala</option>
						</select>
					</div>
				</div>
				<div class="observacionesChico clear">
					<label> Observaciones: </label>
					{if $first_time == 'true'}
						<textarea class="ultimoElement" readonly="readonly" name="observaciones">{$adm_audit_stock_limpieza['observaciones']}</textarea>
					{else}
						<textarea class="ultimoElement" readonly="readonly" name="observaciones">{$tabla[0]['observaciones_anterior']}</textarea>
					{/if}
				</div>
				<input name="first_time" type="hidden" value="{$first_time}" />
				<input name="adm_audit_stock_limpieza" type="hidden" value="{$adm_audit_stock_limpieza['id_adm_audit_stock_limpieza']}" />
				<input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
				<input name="id_tabla" type="hidden" value="{$id_tabla}" />
				<input name="agregar" class="agregar" type="submit" value="Agregar" />
			</div>
		</form>

		<!-- LISTADO DE LOS PRODUCTOS -->
		<p class="izq clear azul bold">CONTROL DE PRODUCTOS</p>
		<table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
			<tr>
				<td bgcolor="#4685CA"><p class="blanco">Artículo </p></td>
				<td align="left" bgcolor="#4685CA"><p class="blanco">Referencia de Artículo</p></td>
				<td width="200" align="center" bgcolor="#4685CA"><p class="blanco">Problema</p></td>
				<td width="50" align="center" bgcolor="#4685CA"><p class="blanco">Unidades por Bulto</p></td>
				<td align="center" bgcolor="#4685CA"><p class="blanco">Foto</p></td>
				<td align="center" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
			</tr>
			{if $tabla_sec['error'] == false }
				{foreach item=prod from=$tabla_sec }
					<tr id="id_prod-{$$prod[id_adm_audit_stock_limpieza_detalle_prod]}">
						<td><span class="producto">{$$prod[producto]}</span></td>
						<td><span id="{$$prod[id_pro_productos]}" class="referencia">{$$prod[referencia]}</span></td>
						<td align="center" ><span id="{$$prod[id_sis_problemas]}" class="problema">{$$prod[problema]}</span></td>
						<td align="center" ><span class="productos_por_caja">{$$prod[productos_por_caja]}</span></td>
						<td align="center">
							<a href="#"><img id="id_prod-{$$prod[id]}" title="ver imágen"  class="ver_prod" src="/img/iconos/lupa.jpg" alt="quitar" border="0" /></a></span>
						</td>
						<td align="center">
							<a href="#"><img id="id_prod-{$$prod[id_adm_audit_stock_limpieza_detalle_prod]}" class="del_prod" src="/img/iconos/delete.gif" alt="quitar" border="0" /></a>
							<a href="#"><img id="id_prod-{$$prod[id_adm_audit_stock_limpieza_detalle_prod]}" class="edit_prod" src="/img/iconos/edit.gif" alt="editar" border="0" /></a>
						</td>
					</tr>
				{/foreach}
			{/if}
		</table>

		<!-- BOX DE ENTRADA DEL PRODUCTO -->
		<form class="box-entrada" name="add_hotel" action="/adm_audit_stock_limpieza_detalle/{$adm_audit_stock_limpieza['id_adm_audit_stock_limpieza']}.html"
					method="post" enctype="multipart/form-data" >
			<div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
				<div class="izq clear">
					<div class="campania">
						<label class="primerElement">Articulo:</label>
						<select name="id_pro_producto" class="referencia">
							{foreach item=pr from=$pro_productos_select}
								<option value="{$$pr[id_pro_productos]}" {if $$pr['id_pro_productos'] == $referencia } selected {/if}>
									{$$pr[referencia]} | {$$pr[producto]}
								</option>
							{/foreach}
						</select>
					</div>
				</div>
				<div class="der">
					<div class="campania">
						<label class="primerElement">Problemas:</label>
						<select name="id_sis_problemas" class="problemas">
							{foreach item=sp from=$sis_problemas}
								<option value="{$$sp[id_sis_problemas]}" {if $$sp['id_sis_problemas'] == $problema } selected {/if}>
									{$$sp[problema]}
								</option>
							{/foreach}
						</select>
					</div>
				</div>
				<input name="first_time" type="hidden" value="{$first_time}" />
				<input name="adm_audit_stock_limpieza" type="hidden" value="{$adm_audit_stock_limpieza['id_adm_audit_stock_limpieza']}" />
				<input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
				<input name="id_tabla" type="hidden" value="{$id_tabla}" />
				<input name="agregar_prod" class="agregar" type="submit" value="Agregar" />
			</div>
		</form>

		<!-- ENVIO AL SIGUIENTE PASO -->
		<form class="box-entrada" name="add_hotel" action="/adm_audit_stock_limpieza_detalle/{$adm_audit_stock_limpieza['id_adm_audit_stock_limpieza']}.html"
					method="post" enctype="multipart/form-data" >
			<div class="enviar_proceso">
				<input name="id_tabla" type="hidden" value="{$id_tabla}" />
				<input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
				<input name="adm_audit_stock_limpieza" type="hidden" value="{$adm_audit_stock_limpieza['id_adm_audit_stock_limpieza']}" />
				<input name="enviar" class="enviar" type="submit" value="Enviar al siguiente Paso" />
			</div>
		</form>
	</div>
	<div style="width:741px; height:46px; float:right;" class="png_bg"></div>
	<br style="clear:both;" />
</div>
