<link href="/css/ven_store_check.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/ven_store_check/abm_search.js"></script>
<script type="text/javascript" src="/js/meio.mask.min.js" charset="utf-8"></script>
<script type="text/javascript">
    // call setMask function on the document.ready event
    jQuery(function($) {
        $('input[name="precio"]').setMask();
        $.mask.masks.decimal = {mask : '99,999999', type : 'reverse', defaultValue: '000'}
        $('input[name="precio"]').setMask();
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
        <h1 class="azul bold"><span class="txt22 normal">Formularios de Store Check</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p>Sector: <span class="azul">{$area}</span></p>
        <p>Empleado:<span class="azul">{$nombre_empleado}</span></p>
        <form class="box-entrada" action="/ven_store_check.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10" height="40" colspan="5" bgcolor="#D2E1F2">
                <label class="primerElement">Cliente:</label>
                <select name="ven_cliente_sucursales" class="cliente">
                    {foreach item=vcs from=$ven_cliente_sucursales}
                        <option value="{$$vcs[id_ven_cliente_sucursales]}" {if $$vcs['id_ven_cliente_sucursales'] == $tabla[0]['id_ven_cliente_sucursales'] } selected {/if}> {$$vcs[empresa]} / {$$vcs[nombre_sucursal]}</option>
                    {/foreach}    
                </select>
                <div class="observacionesChico clear">
                    <label> Observaciones: </label>
                    <textarea name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
                <div class="archivo">
                    <label class="block"> Archivo: </label>
                    <input type="file" class="inline"name="archivo" value="" />
                    <input type="submit" class="inline" name="subir_archivo" value="Subir Archivo" />
                </div>
                <div class="archivos clear">
                    {if $files['error'] == false }
                        {foreach item=file from=$files}
                            <div class="file marginLat10">
                                <a class="file_name" id="file_name-{$$file[id]}" href="/upload_archivos/ven_store_check/{$$file[nombre]}" target="_blank">
                                    <span>Archivo: {$$file[nombre]}</span>
                                </a>
                                <a class="del_file" id="file-{$$file[id]}" href="#" style="floet:left;">
                                    <img border="0" alt="quitar" src="img/iconos/delete.gif" class="del_gasto" id="id_gastos-">
                                </a>
                            </div>
                        {/foreach}
                    {/if}   
                </div>
            </div>
            <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario" colspan="7">
                <tr>
                    <td width="275" bgcolor="#4685CA"><p class="blanco">Informe </p></td>
                    <td align="center" bgcolor="#4685CA"><p class="blanco">Excelente</p></td>
                    <td align="center" bgcolor="#4685CA"><p class="blanco">Muy Bueno</p></td>
                    <td align="center" bgcolor="#4685CA"><p class="blanco">Bueno</p></td>
                    <td align="center" bgcolor="#4685CA"><p class="blanco">Malo</p></td>
                    <td align="center" bgcolor="#4685CA"><p class="blanco">Muy Malo</p></td>
                </tr>
                <tr>
                    <td align="left"><p>Se esta exhibiendo la mercadería</p></td>
                    <td align="center">
                        <input name="exhibiendo_mercaderia"
                                    type="radio" {if $tabla[0]['exhibiendo_mercaderia'] == 'EX' } checked="checked" {/if} value="EX" />
                    </td>
                    <td align="center">
                        <input name="exhibiendo_mercaderia"
                                    type="radio" {if $tabla[0]['exhibiendo_mercaderia'] == 'MB' } checked="checked" {/if} value="MB" />
                    </td>
                    <td align="center">
                        <input name="exhibiendo_mercaderia"
                                    type="radio" {if $tabla[0]['exhibiendo_mercaderia'] == 'B' } checked="checked" {/if} value="B" />
                    </td>
                    <td align="center">
                        <input name="exhibiendo_mercaderia"
                                    type="radio" {if $tabla[0]['exhibiendo_mercaderia'] == 'M' } checked="checked" {/if} value="M" />
                    </td>
                    <td align="center">
                        <input name="exhibiendo_mercaderia"
                                    type="radio" {if $tabla[0]['exhibiendo_mercaderia'] == 'MM' } checked="checked" {/if} value="MM" />
                    </td>
                </tr>
                <tr>
                    <td align="left" bgcolor="#D2E1F2"><p>La mercadería esta en un lugar importante en el negocio</p></td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="mercaderia_lugar"
                                    type="radio"  {if $tabla[0]['mercaderia_lugar'] == 'EX' } checked="checked" {/if} value="EX" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="mercaderia_lugar"
                                    type="radio"  {if $tabla[0]['mercaderia_lugar'] == 'MB' } checked="checked" {/if} value="MB" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="mercaderia_lugar"
                                    type="radio"  {if $tabla[0]['mercaderia_lugar'] == 'B' } checked="checked" {/if} value="B" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="mercaderia_lugar"
                                    type="radio"  {if $tabla[0]['mercaderia_lugar'] == 'M' } checked="checked" {/if} value="M" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="mercaderia_lugar"
                                    type="radio"  {if $tabla[0]['mercaderia_lugar'] == 'MM' } checked="checked" {/if} value="MM" />
                    </td>
                </tr>
                <tr>
                    <td align="left" bgcolor="#D2E1F2"><p>Hay una buena cantidad de productos</p></td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="buena_cantidad_productos"
                                    type="radio" {if $tabla[0]['buena_cantidad_productos'] == 'EX' } checked="checked" {/if} value="EX" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="buena_cantidad_productos"
                                    type="radio" {if $tabla[0]['buena_cantidad_productos'] == 'MB' } checked="checked" {/if} value="MB" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="buena_cantidad_productos"
                                    type="radio" {if $tabla[0]['buena_cantidad_productos'] == 'B' } checked="checked" {/if} value="B" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="buena_cantidad_productos"
                                    type="radio" {if $tabla[0]['buena_cantidad_productos'] == 'M' } checked="checked" {/if} value="M" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="buena_cantidad_productos"
                                    type="radio" {if $tabla[0]['buena_cantidad_productos'] == 'MM' } checked="checked" {/if} value="MM" />
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#4685CA"></td>
                    <td align="center" bgcolor="#4685CA"><p class="blanco">SI</p></td>
                    <td align="center" bgcolor="#4685CA"><p class="blanco">NO</p></td>
                    <td align="center" bgcolor="#4685CA"></td>
                    <td align="center" bgcolor="#4685CA"></td>
                    <td align="center" bgcolor="#4685CA"></td>
                </tr>
                <tr>
                    <td align="left" bgcolor="#D2E1F2"><p>Se puede poner un punto de venta</p></td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="poner_punto_venta"
                                    type="radio" {if $tabla[0]['poner_punto_venta'] == 1 } checked="checked" {/if} value="true" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="poner_punto_venta"
                                    type="radio" {if $tabla[0]['poner_punto_venta'] == 0 } checked="checked" {/if} value="false" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2"></td>
                    <td align="center" bgcolor="#D2E1F2"></td>
                    <td align="center" bgcolor="#D2E1F2"></td>
                </tr>
                <tr >
                    <td align="left" bgcolor="#D2E1F2"><p>Se puede poner un banner</p></td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="poner_banner"
                                    type="radio" {if $tabla[0]['poner_banner'] == 1 } checked="checked" {/if} value="true" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="poner_banner"
                                    type="radio" {if $tabla[0]['poner_banner'] == 0 } checked="checked" {/if} value="false" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2"></td>
                    <td align="center" bgcolor="#D2E1F2"></td>
                    <td align="center" bgcolor="#D2E1F2"></td>
                </tr>
            </table>
            <div class="box-entrada">
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>

        <!-- LISTADO DE PRODUCTOS -->
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario marginTop20">
            <tr>
                <td width="145" bgcolor="#4685CA"><p class="blanco">Referencia </p></td>
                <td width="358" align="left" bgcolor="#4685CA"><p class="blanco">Producto</p></td>
                <td width="92" align="center" bgcolor="#4685CA"><p class="blanco">Precio</p></td>
                <td width="52" align="center" bgcolor="#4685CA"><p class="blanco">Cantidad</p></td>
                <td width="52" align="center" bgcolor="#4685CA"><p class="blanco">Accion</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=prod from=$tabla_sec }
                    <tr id="id_prod-{$$prod[id_ven_store_check_prod]}">
                        <td><span id="{$$prod[id_pro_productos]}" class="referencia">{$$prod[referencia]}</span></td>
                        <td><span class="detalle">{$$prod[producto]}</span></td>
                        <td><span class="precio">{$$prod[vstore_precio]|number_format:2:",":""}</span></td>
                        <td><span class="cantidad">{$$prod[cantidad]}</span></td>
                        <td align="center">
                            <a href="#">
                                <img id="id_gast-{$$prod[id_ven_store_check_prod]}" class="del_prod" src="/img/iconos/delete.gif" alt="quitar" border="0" />
                            </a>
                            <a href="#">
                                <img id="id_gast-{$$prod[id_ven_store_check_prod]}" class="edit_prod" src="/img/iconos/edit.gif" alt="editar" border="0" />
                            </a>
                        </td>
                    </tr>
                {/foreach}
            {/if}
        </table>

        <!-- ENTRADA DE LOS PRODUCTOS -->
        <form class="box-entrada" name="add_hotel" action="/ven_store_check.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Referencia:</label>
                        <select name="referencia" class="referencia">
                                {foreach item=pr from=$pro_productos_select}
                                    <option value="{$$pr[id_pro_productos]}" {if $$pr['id_pro_productos'] == $referencia } selected {/if}> {$$pr[referencia]} </option>
                                {/foreach}    
                            </select>
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement">Producto:</label>
                        <select name="producto" class="producto">
                            {foreach item=prod from=$pro_productos_select}
                                <option value="{$$prod[id_pro_productos]}" {if $$prod['id_pro_productos'] == $producto } selected {/if}> {$$prod[producto]} </option>
                            {/foreach}    
                        </select>
                    </div>
                </div>
                <div class="inputChico">
                    <label >Precio:</label>
                    <input class="precio" name="precio" type="text" value=''  alt="decimal" />
                </div>
                <div class="inputChico">
                    <label >Cantidad:</label>
                    <input class="cantidad" name="cantidad" type="text" value=''  alt="Cantidad" />
                </div>   
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar_prod" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>
        <form class="box-entrada" name="add_hotel" action="/ven_store_check.html" method="post" enctype="multipart/form-data" >
            <div class="enviar_proceso">
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="enviar" class="enviar" type="submit" value="Enviar al siguiente Paso" />
            </div>
        </form>
    </div>
    <div style="width:741px; height:46px; float:right;" class="png_bg"></div>
    <br style="clear:both;" />
</div>
