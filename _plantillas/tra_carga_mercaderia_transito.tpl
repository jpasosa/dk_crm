<link href="/css/tra_carga_mercaderia_transito.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/meio.mask.min.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(function($) {
        $('input[name="precio[]"]').setMask();  // ALTO
        $.mask.masks.decimal = {mask : '99,999999', type : 'reverse', defaultValue: '000'}
        $('input[name="precio[]"]').setMask();
        $.mask.masks = $.extend($.mask.masks, {decimal: { mask: '999' }});
    });
</script>

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
		<form class="box-entrada" name="add_hotel" action="/tra_carga_mercaderia_transito/{$id_tra_packing_list}.html" method="post" enctype="multipart/form-data" >
			<div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
				<div class="izq">
					<div class="campania">
						<label class="primerElement">Proveedor:</label>
						<input class="ultimoElement" name="proveedor_nombre" readonly="readonly" type="text" value='{$tra_packing_list["nombre"]}'  alt="Proveedor" />
						<input name="proveedor" type="hidden" value='{$tra_packing_list["id_cpr_proveedores"]}' />
					</div>
				</div>
				<div class="der">
					<div class="campania">
						<label class="primerElement">Packing List:</label>
						<input name="packing_list" type="text" readonly="readonly" value='{$tra_packing_list["nombre_trapackinglist"]}'  alt="Packing List" />
					</div>
				</div>
				<div class="izq clear"><p class="azul bold">ENTREGA</p></div>
				<div class="izq clear">
					<div class="campania">
						<label >Fecha Envío:</label>
						<input name="fecha_envio" type="text" readonly="readonly" value='{$tra_packing_list["fecha_envio"]|date_format:"d/m/Y"}'  alt="" />
					</div>
				</div>
				<div class="der">
					<div class="campania">
						<label>Fecha Llegada:</label>
						<input name="fecha_llegada" type="text" readonly="readonly" value='{$tra_packing_list["fecha_envio"]|date_format:"d/m/Y"}'  alt="Fecha Llegada" />
					</div>
				</div>
				<div class="observacionesChico clear">
					<label> Observaciones: </label>
					<textarea name="observaciones">{$tabla[0]['observaciones']}</textarea>
				</div>
				<input name="first_time" type="hidden" value="{$first_time}" />
				<input name="id_tra_packing_list" type="hidden" value="{$id_tra_packing_list}" /> <!-- el id principal de la tabla anterior, de tra_packing_list -->
				<input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
				<input name="id_tabla" type="hidden" value="{$id_tabla}" />
				{if $first_time == 'true'}
   					<input type="hidden" name="precio[]" value="{$$p[precios]}">
				{else}
   					{foreach item=p from=$precios }
						<input type="hidden" name="precio[]" value="{$$p}">
					{/foreach}
				{/if}
				<input name="agregar" class="agregar" type="submit" value="Agregar Observación" />
			</div>
		</form>

		<form class="box-entrada" action="/tra_carga_mercaderia_transito/{$id_tra_packing_list}.html" method="post" enctype="multipart/form-data" >
			<table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
				<tr>
					<td align="left" bgcolor="#4685CA"><p class="blanco">Producto</p></td>
						<td align="left" bgcolor="#4685CA"><p class="blanco">Precio</p></td>
						<td align="left" bgcolor="#4685CA"><p class="blanco">Foto</p></td>
						<td align="left" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
					</tr>
					{if $tabla_sec['error'] == false }
						{foreach item=tpl from=$tabla_sec_anterior_prod }
							<tr id="id_cl-{$$cl[solicit_cliente]}">
								<td> <span title="{$$tpl[detalle]}  |  Productos por Caja: {$$tpl[productos_por_caja_tpl]}  |  Alto: {$$tpl[alto_tpl]}   |  Ancho: {$$tpl[ancho_tpl]}  | Fondo: {$$tpl[fondo_tpl]} |  Volumen:  {$$tpl[volumen_tpl]} ">{$$tpl[producto]}</span></td>
								<td>
									<span>
										<input type="text" name="precio[]" alt="decimal" value="{$$tpl[precio_nuevo]}" style="width: 80px;">
										<input name="agregar_precio" type="submit" value="ok" />
									</span>
								</td>
								<td>
									<span>
							                  <input type="file" class="inline" name="foto[]" value="" />
							                  <!-- <input type="submit" class="inline" name="subir_foto" value="ok" /> -->
									</span>
								</td>
								<td>
									<a href="#">
										<img id="id_gastos-{$$gd[id]}" class="del_gasto" src="/img/iconos/delete.gif" alt="quitar" border="0" />
									</a>
								</td>
							</tr>
						{/foreach}
					{/if}
			</table>

			<input name="first_time" type="hidden" value="{$first_time}" />
			<input name="id_tra_packing_list" type="hidden" value="{$id_tra_packing_list}" /> <!-- el id principal de la tabla anterior, de tra_packing_list -->
			<input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
			<input name="id_tabla" type="hidden" value="{$id_tabla}" />
			<!-- <inpuut type="hidden" name="precio[]" value="" /> -->
		</form>

		<!-- VA A CREAR LOS REGISTROS YA CARGADOS DE LA TABLA SECUNDARIA -->
		<form class="box-entrada" name="add_hotel" action="/tra_carga_mercaderia_transito/{$id_tra_packing_list}.html" method="post" enctype="multipart/form-data" >
			<div class="box-entrada padding10" height="40" colspan="5" bgcolor="#D2E1F2">
				<input name="first_time" type="hidden" value="{$first_time}" />
				<input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
				<input name="id_tabla" type="hidden" value="{$id_tabla}" />
				<input name="datos_pasados" type="hidden" value="{$datos_pasados}" />
				<input name="id_tra_packing_list" type="hidden" value="{$id_tra_packing_list}" /> <!-- el id principal de la tabla anterior, de tra_packing_list -->
				{if $first_time == 'true'}
   					<input type="hidden" name="precio[]" value="{$$p[precios]}">
				{else}
   					{foreach item=p from=$precios }
						<input type="hidden" name="precio[]" value="{$$p}">
					{/foreach}
				{/if}
				<input name="salvar_datos" class="agregar" type="submit" value="Salvar Datos" />
			</div>
		</form>

		<form class="box-entrada" name="add_hotel" action="/tra_carga_mercaderia_transito/{$id_tra_packing_list}.html" method="post" enctype="multipart/form-data" >
			<div class="enviar_proceso">
				<input name="id_tra_packing_list" type="hidden" value="{$id_tra_packing_list}" />
				<input name="id_tabla" type="hidden" value="{$id_tabla}" />
				<input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
				<input name="enviar" class="enviar" type="submit" value="Enviar al siguiente Paso" />
			</div>
		</form>
	</div>
	<div style="width:741px; height:46px; float:right;" class="png_bg"></div>
	<br style="clear:both;" />
</div>
