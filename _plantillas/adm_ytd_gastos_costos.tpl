<link href="/css/adm_ytd_gastos_costos.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/adm_ytd_gastos_costos/abm_search.js"></script>
<script type="text/javascript" src="/js/meio.mask.min.js" charset="utf-8"></script>
<script type="text/javascript">
    // call setMask function on the document.ready event
    jQuery(function($) {
        $('input[name="monto"]').setMask();
        $.mask.masks.decimal = {mask : '99,999999', type : 'reverse', defaultValue: '000'}
        $('input[name="monto"]').setMask();
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
        <h1 class="azul bold"><span class="txt22 normal">YTD Gastos / Costos</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p class="txt10 uppercase">Empleado:<span class="azul">{$nombre_empleado}</span></p>
        <form class="box-entrada" name="add_hotel" action="/adm_ytd_gastos_costos.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="observacionesChico">
                    <label class="primerElement"> Observaciones: </label>
                    <textarea name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>
        <p class="azul bold">MONTO TOTAL : <span>${$monto_total}</span></p>


        <!-- LISTA DETALLES -->
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Cuenta</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Descripción</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Detalle</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Proveedor</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Factura</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Area</p></td>
                <td width="45" align="left" bgcolor="#4685CA"><p class="blanco">Monto</p></td>
                <td width="45" align="left" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=ts from=$tabla_sec }
                    <tr id="id_detalle-{$$ts[id_adm_ytd_gastos_costos_detalle]}">
                        <td><span id="{$$ts[id_sis_cuentas]}" class="cuenta">{$$ts[cuenta]}</span></td>
                        <td> <span class="descripcion">{$$ts[descripcion]}</span></td>
                        <td> <span class="detalle">{$$ts[detalle]}</span></td>
                        <td> <span id="{$$ts[id_crp_proveedores]}" class="proveedor">{$$ts[nombre]}</span></td>
                        <td> <span class="factura">{$$ts[factura]}</span></td>
                        <td> <span id="{$$ts[id_sis_areas]}" class="area">{$$ts[area]}</span></td>
                        <td> <span class="monto">{$$ts[monto]|number_format:2:",":""}</span></td>
                        <td>
                            <a href="#">
                                <img id="id_detalle-{$$ts[id_adm_ytd_gastos_costos_detalle]}" class="del_detalle" src="/img/iconos/delete.gif" alt="quitar" border="0" />
                            </a>
                            <a href="#">
                                <img id="id_detalle-{$$ts[id_adm_ytd_gastos_costos_detalle]}" class="edit_detalle" src="/img/iconos/edit.gif" alt="editar" border="0" />
                            </a>
                        </td>
                    </tr>
                {/foreach}
            {/if}
        </table>


        <!-- BOX ENTRADA DETALLES -->
        <form class="box-entrada" name="add_hotel" action="/adm_ytd_gastos_costos.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Cuenta:</label>
                        <select name="cuenta" class="cuenta">
                            {foreach item=cuenta from=$sis_cuentas}
                                <option value="{$$cuenta[id_sis_cuentas]}" {if $$cuenta['id_sis_cuentas'] == $cuenta } selected {/if}> {$$cuenta[cuenta]} </option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="campania">
                        <label>Descripción:</label>
                        <select name="descripcion" class="descripcion" >
                            {foreach item=cuenta from=$sis_cuentas}
                                <option value="{$$cuenta[id_sis_cuentas]}" {if $$cuenta['id_sis_cuentas'] == $cuenta } selected {/if}> {$$cuenta[descripcion]} </option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="campania">
                        <label>Detalle:</label>
                        <input name="detalle" class="detalle" type="text" value=''  alt="Detalle" />
                    </div>
                    <div class="campania">
                        <label>Proveedor:</label>
                        <select name="proveedor" class="proveedor">
                                {foreach item=pr from=$crp_proveedores}
                                    <option value="{$$pr[id_crp_proveedores]}" {if $$pr['id_crp_proveedores'] == $proveedor } selected {/if}> {$$pr[nombre]} </option>
                                {/foreach}
                            </select>
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement" >Factura:</label>
                        <input name="factura" class="factura" type="text" value=''  alt="Factura" />
                    </div>
                    <div class="campania">
                        <label>Area:</label>
                        <select name="area" class="area">
                            {foreach item=area from=$sis_areas}
                                <option value="{$$area[id_sis_areas]}" {if $$area['id_sis_areas'] == $area } selected {/if}> {$$area[area]} </option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="campania">
                        <label>Monto:</label>
                        <input name="monto" class="monto" type="text" value=''  alt="decimal" />
                    </div>
                </div>
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar_det" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>
        <form class="box-entrada" name="add_hotel" action="/adm_ytd_gastos_costos.html" method="post" enctype="multipart/form-data" >
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
