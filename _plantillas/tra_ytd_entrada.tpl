<link href="/css/tra_ytd_entrada.css" rel="stylesheet" type="text/css" />

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
		<h1 class="azul bold"><span class="txt22 normal">Carga de Mercadería en Tránsito</span></h1>
		<hr />
		<p>Sector:<span class="azul">{$area}</span></p>
		<p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>

		<form class="box-entrada" name="add_hotel" action="/tra_ytd_entrada/{$id_tra_carga_mercaderia_transito}.html"
				method="post" enctype="multipart/form-data" >
			<div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
				<div class="izq">
					<div class="campania">
						<label class="primerElement">Packing List:</label>
						{if $first_time == 'true'}
							<input name="packing_list" type="text" readonly="readonly" value="{$tabla_princ_tmp[0]['nombre_trapackinglist']}"  alt="Packing List" />
						{else}
							<input name="packing_list" type="text" readonly="readonly" value="{$tabla[0]['nombre_trapackinglist']}"  alt="Packing List" />
						{/if}
					</div>
				</div>
				<div class="observacionesChico clear">
					<label> Observaciones: </label>
					<textarea name="observaciones">{$tabla[0]['observaciones']}</textarea>
				</div>
				<input name="first_time" type="hidden" value="{$first_time}" />
				<input name="id_tra_carga_mercaderia_transito" type="hidden" value="{$id_tra_carga_mercaderia_transito}" />
				<input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
				<input name="id_tabla" type="hidden" value="{$id_tabla}" />
				<input name="prod_tmp" type="hidden" value="{$prod_tmp}" />
				<input name="agregar" class="agregar" type="submit" value="Agregar Observación" />
			</div>
		</form>

		<div class="marginTop20"><p class="azul bold">CONTROL DE PRODUCTOS</p></div>
		<table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
			<tr>
				<td align="left" bgcolor="#4685CA"><p class="blanco">Producto</p></td>
				<td align="left" bgcolor="#4685CA"><p class="blanco">Marca</p></td>
				<td align="left" bgcolor="#4685CA"><p class="blanco">Familia</p></td>
				<td width="70" align="left" bgcolor="#4685CA"><p class="blanco">Problema</p></td>
				<td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
			</tr>
			{foreach item=ts from=$tra_ytd_entrada_prod }
				<tr id="id_cl-{$$cl[solicit_cliente]}">
					<td>
						<span title="Detalle: {$$ts[detalle]} / Nro Caja: {$$ts[nro_caja_tye]} /  Productos por Caja: {$$ts[productos_por_caja_tye]} / Volumen: {$$ts[volumen_tye]}">
							{$$ts[producto]}
						</span>
					</td>
					<td> <span>{$$ts[marca]}</span></td>
					<td> <span>{$$ts[familia]} | {$$ts[subfamilia]} </span></td>
					<td> <span>{$$ts[problema]}</span></td>
					<td>
						<a href="#">
							<img id="id_gastos-{$$gd[id]}" class="del_gasto" src="/img/iconos/delete.gif" alt="quitar" border="0" />
						</a>
						<a href="#">VER</a>
					</td>
				</tr>
			{/foreach}
		</table>

		{foreach item=ts from=$tra_ytd_entrada_prod }
		<form class="box-entrada" name="add_hotel" action="/tra_ytd_entrada/{$id_tra_carga_mercaderia_transito}.html" method="post" enctype="multipart/form-data" >
			<div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
				<div class="izq">
					<div class="campania">
						<label class="primerElement">Producto:</label>
						<input type="text" value='{$$ts[producto]}'  title="{$$ts[detalle]}" />
					</div>
					<div class="campania">
						<label class="primerElement">Marca:</label>
						<select name="marca" class="cliente">
							{foreach item=ma from=$marcas}
								<option value="{$$ma[id_pro_marca]}" {if $$ma['id_pro_marca'] == $$ts['id_pro_marca'] } selected="selected" {/if} >
									{$$ma[marca]}
								</option>
							{/foreach}
						</select>
					</div>
				</div>
				<div class="der">
					<div class="campania">
						<label class="primerElement">Problema:</label>
						<select name="problema" class="cliente">
							{foreach item=pr from=$problemas}
								<option value="{$$pr[id_sis_problemas]}" {if $$pr['id_sis_problemas'] == $$ts['id_sis_problemas'] } selected="selected" {/if} >
									{$$pr[problema]}
								</option>
							{/foreach}
						</select>
					</div>
					<div class="campania">
						<label class="primerElement">Familia:</label>
						<select name="familia" class="cliente">
							{foreach item=fam from=$familias}
								<option value="{$$fam[id_pro_subfamilia]}" {if $$fam['id_pro_subfamilia'] == $$ts['id_pro_subfamilia'] } selected="selected" {/if} >
									{$$fam[familia]} / {$$fam[subfamilia]}
								</option>
							{/foreach}
						</select>
					</div>
				</div>
				<input name="first_time" type="hidden" value="{$first_time}" />
				<input name="id_tra_ytd_entrada_prod" type="hidden" value="{$$ts[id_tra_ytd_entrada_prod_tmp]}" />
				<input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
				<input name="id_tabla" type="hidden" value="{$id_tabla}" />
				<input name="prod_tmp" type="hidden" value="{$prod_tmp}" />
				<input name="agregar_prod" class="agregar" type="submit" value="Agregar" />

			</div>
		</form>
		{/foreach}

		<form class="box-entrada" name="add_hotel" action="/tra_ytd_entrada/{$id_tra_carga_mercaderia_transito}.html" method="post" enctype="multipart/form-data" >
			<div class="enviar_proceso">
				{foreach item=ts from=$tra_ytd_entrada_prod }
					<input name="id_prod[]" type="hidden" value="{$$ts[id_tra_ytd_entrada_prod_tmp]}" />
				{/foreach}
				<input name="id_tabla" type="hidden" value="{$id_tabla}" />
				<input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
				<input name="id_tra_carga_mercaderia_transito" type="hidden" value="{$id_tra_carga_mercaderia_transito}" />
				<input name="enviar" class="enviar" type="submit" value="Enviar al siguiente Paso" />
			</div>
		</form>
	</div>
	<div style="width:741px; height:46px; float:right;" class="png_bg"></div>
	<br style="clear:both;" />
</div>
