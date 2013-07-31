<link href="/css/tra_packing_list.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" /><!-- para del datepicker -->
<script> $(function() {$( "#fecha_envio" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>
<script> $(function() {$( "#fecha_llegada" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>
<script type="text/javascript" src="/js/tra_packing_list/abm.js"></script>
<script type="text/javascript" src="/js/meio.mask.min.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(function($) {
        $('input[name="alto"]').setMask();  // ALTO
        $.mask.masks.decimal = {mask : '99,999999', type : 'reverse', defaultValue: '000'}
        $('input[name="alto"]').setMask();
        $.mask.masks = $.extend($.mask.masks, {decimal: { mask: '999' }});
        $('input[name="ancho"]').setMask(); // ANCHO
        $.mask.masks.decimal = {mask : '99,999999', type : 'reverse', defaultValue: '000'}
        $('input[name="ancho"]').setMask();
        $.mask.masks = $.extend($.mask.masks, {decimal: { mask: '999' }});
        $('input[name="fondo"]').setMask(); // FONDO
        $.mask.masks.decimal = {mask : '99,999999', type : 'reverse', defaultValue: '000'}
        $('input[name="fondo"]').setMask();
        $.mask.masks = $.extend($.mask.masks, {decimal: { mask: '999' }});
        $('input[name="peso"]').setMask(); // PESO
        $.mask.masks.decimal = {mask : '99,999999', type : 'reverse', defaultValue: '000'}
        $('input[name="peso"]').setMask();
        $.mask.masks = $.extend($.mask.masks, {decimal: { mask: '999' }});
    });
</script>





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
		<h1 class="azul bold"><span class="txt22 normal">Tra Packing List</span></h1>
		<hr />
		<p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul"> {$date}</span></p>
		<form class="box-entrada" name="add_hotel" action="/tra_packing_list.html" method="post" enctype="multipart/form-data" >
			<div class="box-entrada padding10" height="40" colspan="5" bgcolor="#D2E1F2">
				<div class="izq">
					<div class="campania">
						<label class="primerElement">Proveedor:</label>
						<select class="ultimoElement" name="proveedor">
							{foreach item=pr from=$proveedores}
                                			<option value="{$$pr[id_valor]}" {if $$pr['id_valor'] == $tabla[0]["id_cpr_proveedores"] } selected {/if}> {$$pr[valor]} </option>
                            			{/foreach}
						</select>
					</div>
				</div>
				<div class="der">
					<div class="campania">
						<label class="primerElement">Tra Packing List:</label>
						{if $first_time == 'true'}
							<input name="nombre_trapackinglist" type="text" readonly="readonly" value='valor automático'  title="Código del Packing List" />
						{else}
							<input name="nombre_trapackinglist" type="text" readonly="readonly" value='{$tabla[0]["nombre_trapackinglist"]}'  title="Código del Packing List" />
						{/if}
					</div>
				</div>
				<div class="izq clear"><p class="azul bold">ENTREGA</p></div>
				<div class="izq clear">
					<div class="campania">
						<label  class="primerElement" >Fecha Envío:</label>
						{if $tabla[0]['fecha_envio'] == '' }
							<input name="fecha_envio" id="fecha_envio" type="text" value=''  alt="Cantidad Días" />
						{else}
                            			<input id="fecha_envio" name="fecha_envio" type="text" value='{$tabla[0]["fecha_envio"]|date_format:"d/m/Y"}'  alt="Fecha" />
						{/if}
					</div>
				</div>
				<div class="der">
					<div class="campania">
						<label  class="primerElement">Fecha Llegada:</label>
						{if $tabla[0]['fecha_llegada'] == '' }
							<input name="fecha_llegada" id="fecha_llegada" type="text" value=''  alt="Cantidad Días" />
						{else}
                            			<input id="fecha_llegada" name="fecha_llegada" type="text" value='{$tabla[0]["fecha_llegada"]|date_format:"d/m/Y"}'  alt="Fecha" />
						{/if}
					</div>
				</div>
				<div class="observacionesChico">
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
				<td align="left" bgcolor="#4685CA"><p class="blanco">Referencia</p></td>
				<td align="left" bgcolor="#4685CA"><p class="blanco">Producto</p></td>
				<td align="left" bgcolor="#4685CA"><p class="blanco">Detalle</p></td>
				<td width="70" align="left" bgcolor="#4685CA"><p class="blanco">Nro. Caja</p></td>
				<td width="40" align="left" bgcolor="#4685CA"><p class="blanco">x caja</p></td>
				<td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Volumen</p></td>
				<td width="40" align="left" bgcolor="#4685CA"><p class="blanco">Peso Kg.</p></td>
				<td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
			</tr>
			{if $tabla_sec['error'] == false }
				{foreach item=ts from=$tabla_sec }
					<tr id="id_prod-{$$ts[id_tra_packing_list_prod]}">
						<td><span id="{$$ts[id_pro_productos]}" class="referencia">{$$ts[referencia]}</span></td>
						<td> <span class="producto">{$$ts[producto]}</span></td>
						<td> <span class="detalle">{$$ts[detalle]}</span></td>
						<td> <span class="nro_caja_tpl">{$$ts[nro_caja_tpl]}</span></td>
						<td> <span class="productos_por_caja_tpl">{$$ts[productos_por_caja_tpl]}</span></td>
						<td>
							<span class="volumen_tpl" title="Alto: {$$ts[alto_tpl]} | Ancho: {$$ts[ancho_tpl]} | Fondo: {$$ts[fondo_tpl]}">
								{$$ts[volumen_tpl]}
							</span>
						</td>
						<td> <span class="peso_tpl">{$$ts[peso_tpl]}</span></td>
						<input name="alto_tpl" type="hidden" value="{$$ts[alto_tpl]}" />
						<input name="ancho_tpl" type="hidden" value="{$$ts[ancho_tpl]}" />
						<input name="fondo_tpl" type="hidden" value="{$$ts[fondo_tpl]}" />
						<td>
							<a href="#">
								<img id="id_prod-{$$ts[id_tra_packing_list_prod]}" class="del_prod" src="/img/iconos/delete.gif" alt="quitar" border="0" />
							</a>
							<a href="#">
								<img id="id_prod-{$$ts[id_tra_packing_list_prod]}" class="edit_prod" src="/img/iconos/edit.gif" alt="editar" border="0" />
							</a>
						</td>
					</tr>
				{/foreach}
			{/if}
		</table>

		<!-- BOX DE ENTRADA DE LOS PRODUCTOS -->
		<form class="box-entrada" name="add_hotel" action="/tra_packing_list.html" method="post" enctype="multipart/form-data" >
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
						<input name="nro_caja" class="nro_caja" type="text" value="{$nro}"  />
					</div>
					<div class="campania">
						<label> x caja: </label>
						<input class="ultimoElement productos_por_caja" name="productos_por_caja" type="text" value="{$cantCaja}" />
					</div>
				</div>
				<div class="der">
					<div class="campania">
						<label class="primerElement">Alto: </label>
						<input name="alto" class="alto" alt="decimal" type="text" value="{$alto}"  />
					</div>
					<div class="campania">
						<label>Ancho: </label>
						<input name="ancho" class="ancho" alt="decimal" type="text" value="{$ancho}"  />
					</div>
					<div class="campania">
						<label> Fondo: </label>
						<input name="fondo" class="fondo" alt="decimal" type="text" value="{$fondo}"  />
					</div>
					<div class="campania">
						<label> Peso Kg.: </label>
						<input name="peso" class="peso" alt="decimal" type="text" value="{$peso}"  />
					</div>
				</div>
				<input name="first_time" type="hidden" value="{$first_time}" />
				<input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
				<input name="id_tabla" type="hidden" value="{$id_tabla}" />
				<input name="agregar_prod" class="agregar" type="submit" value="Agregar" />
			</div>
		</form>

		<form class="box-entrada" name="add_hotel" action="/tra_packing_list.html" method="post" enctype="multipart/form-data" >
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
