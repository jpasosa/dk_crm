<link href="/css/ven_store_check.css" rel="stylesheet" type="text/css" />

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
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$fecha_inicio}</span></p>
        <p class="txt10 uppercase">Empleado:<span class="azul">{$nombre_inicio}</span></p>
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="campania">
                    <label class="primerElement">Sucursal:</label>
                    <input readonly="readonly" name="sucursal" type="text" value="{$tabla[0]['empresa']}, {$tabla[0]['nombre_sucursal']}" alt="Sucursal" />
                </div>
                <div class="observacionesChico clear">
                    <label> Observaciones: </label>
                    <textarea readonly="readonly" name="observaciones">{$tabla[0]['vstore_observaciones']}</textarea>
                </div>
                <div class="archivos clear">
                    {if $files['error'] == false }
                    <div class="archivos">
                        {foreach item=n from=$files}
                            <div class="file">
                                <a class="file_name" target="_blank" href="/upload_archivos/ven_store_check/{$$n[nombre]}" target="_blank">
                                    <span>Archivo: {$$n[nombre]}</span>
                                </a>
                            </div>
                        {/foreach}
                    </div>
                {/if}
                </div>
            </div>
        </form>
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
                        <input name="exhibiendo_mercaderia" disabled="disabled"
                                    type="radio" {if $tabla[0]['exhibiendo_mercaderia'] == 'EX' } checked="checked" {/if} value="EX" />
                    </td>
                    <td align="center">
                        <input name="exhibiendo_mercaderia" disabled="disabled"
                                    type="radio" {if $tabla[0]['exhibiendo_mercaderia'] == 'MB' } checked="checked" {/if} value="MB" />
                    </td>
                    <td align="center">
                        <input name="exhibiendo_mercaderia" disabled="disabled"
                                    type="radio" {if $tabla[0]['exhibiendo_mercaderia'] == 'B' } checked="checked" {/if} value="B" />
                    </td>
                    <td align="center">
                        <input name="exhibiendo_mercaderia" disabled="disabled"
                                    type="radio" {if $tabla[0]['exhibiendo_mercaderia'] == 'M' } checked="checked" {/if} value="M" />
                    </td>
                    <td align="center">
                        <input name="exhibiendo_mercaderia" disabled="disabled"
                                    type="radio" {if $tabla[0]['exhibiendo_mercaderia'] == 'MM' } checked="checked" {/if} value="MM" />
                    </td>
            </tr>
            <tr>
                <td align="left" bgcolor="#D2E1F2"><p>La mercadería esta en un lugar importante en el negocio</p></td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="mercaderia_lugar" disabled="disabled"
                                    type="radio"  {if $tabla[0]['mercaderia_lugar'] == 'EX' } checked="checked" {/if} value="EX" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="mercaderia_lugar" disabled="disabled"
                                    type="radio"  {if $tabla[0]['mercaderia_lugar'] == 'MB' } checked="checked" {/if} value="MB" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="mercaderia_lugar" disabled="disabled"
                                    type="radio"  {if $tabla[0]['mercaderia_lugar'] == 'B' } checked="checked" {/if} value="B" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="mercaderia_lugar" disabled="disabled"
                                    type="radio"  {if $tabla[0]['mercaderia_lugar'] == 'M' } checked="checked" {/if} value="M" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="mercaderia_lugar" disabled="disabled"
                                    type="radio"  {if $tabla[0]['mercaderia_lugar'] == 'MM' } checked="checked" {/if} value="MM" />
                    </td>
            </tr>
            <tr>
                <td align="left" bgcolor="#D2E1F2"><p>Hay una buena cantidad de productos</p></td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="buena_cantidad_productos" disabled="disabled"
                                    type="radio" {if $tabla[0]['buena_cantidad_productos'] == 'EX' } checked="checked" {/if} value="EX" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="buena_cantidad_productos" disabled="disabled"
                                    type="radio" {if $tabla[0]['buena_cantidad_productos'] == 'MB' } checked="checked" {/if} value="MB" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="buena_cantidad_productos" disabled="disabled"
                                    type="radio" {if $tabla[0]['buena_cantidad_productos'] == 'B' } checked="checked" {/if} value="B" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="buena_cantidad_productos" disabled="disabled"
                                    type="radio" {if $tabla[0]['buena_cantidad_productos'] == 'M' } checked="checked" {/if} value="M" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="buena_cantidad_productos" disabled="disabled"
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
                        <input name="poner_punto_venta" disabled="disabled"
                                    type="radio" {if $tabla[0]['poner_punto_venta'] == 1 } checked="checked" {/if} value="true" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="poner_punto_venta" disabled="disabled"
                                    type="radio" {if $tabla[0]['poner_punto_venta'] == 0 } checked="checked" {/if} value="false" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2"></td>
                    <td align="center" bgcolor="#D2E1F2"></td>
                    <td align="center" bgcolor="#D2E1F2"></td>
            </tr>
            <tr >
                <td align="left" bgcolor="#D2E1F2"><p>Se puede poner un banner</p></td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="poner_banner" disabled="disabled"
                                    type="radio" {if $tabla[0]['poner_banner'] == 1 } checked="checked" {/if} value="true" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2">
                        <input name="poner_banner" disabled="disabled"
                                    type="radio" {if $tabla[0]['poner_banner'] == 0 } checked="checked" {/if} value="false" />
                    </td>
                    <td align="center" bgcolor="#D2E1F2"></td>
                    <td align="center" bgcolor="#D2E1F2"></td>
                    <td align="center" bgcolor="#D2E1F2"></td>
            </tr>
        </table>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario marginTop20">
            <tr>
                <td width="145" bgcolor="#4685CA"><p class="blanco">Referencia </p></td>
                <td width="358" align="left" bgcolor="#4685CA"><p class="blanco">Producto</p></td>
                <td width="92" align="center" bgcolor="#4685CA"><p class="blanco">Precio</p></td>
                <td width="92" align="center" bgcolor="#4685CA"><p class="blanco">Cantidad</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=prod from=$tabla_sec }
                    <tr>
                        <td><span class="referencia">{$$prod[referencia]}</span></td>
                        <td><span class="detalle">{$$prod[producto]}</span></td>
                        <td><span class="monto">{$$prod[vstore_precio]|number_format:2:",":""}</span></td>
                        <td><span class="cantidad">{$$prod[cantidad]}</span></td>
                    </tr>
                {/foreach}
            {/if}
        </table>
        <form class="box-coment" name="box_coment" action="/ven_store_check_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
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
