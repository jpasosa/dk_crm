<link href="/css/adm_pedido_caja_chica.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/adm_pedido_caja_chica/abm_search.js"></script>
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

<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
    {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(/img/fondos/bg_cuenta.jpg) right top repeat-y;">
        <div id="hilo"> Bienveniudo:   {$nombre_empleado}</div>
        <hr />
        <h1 class="azul bold"><span class="txt22 normal">Administración  |  Pedido Caja Chica</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul"> {$date}</span></p>
        <hr />
        <p>Sector:<span class="azul"> {$area}</span></p>
        <p>Monto total: <span class="azul"> {$monto_total}</span></p>
        <form class="box-entrada" action="/adm_pedido_caja_chica.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" bgcolor="#D2E1F2">
                    <div class="observaciones padding10">
                        <label> Observaciones: </label>
                        <textarea name="observaciones" rows="2">{$tabla[0][observaciones]}</textarea>
                    </div>
                    <input name="first_time" type="hidden" value="{$first_time}" />
                    <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                    <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                    <input name="agregar" class="agregar_observaciones" type="submit" value="Agregar" />
            </div>
        </form>
        <hr />
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario" colspan="7">
            <tr>
                <td  class="tableTitle"><p class="blanco cuenta">Cuenta </p></td>
                <td  class="tableTitle"><p class="blanco">Descripción</p></td>
                <td  class="tableTitle"><p class="blanco detalla">Detalle</p></td>
                <td  class="tableTitle"><p class="blanco proveedor">Proveedor</p></td>
                <td  class="tableTitle"><p class="blanco factura">Factura</p></td>
                <td  class="tableTitle"><p class="blanco area">Area</p></td>
                <td  class="tableTitle"><p class="blanco monto">Monto</p></td>
                <td  class="tableTitle"><p class="blanco accion">Acción</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=gd from=$tabla_sec }
                    <tr id="id_gastos-{$$gd[id_adm_pedido_caja_chica_detalle]}">
                        <td> <span class="cuenta">{$$gd[cuenta]}</span> </td>
                        <td> <span class="descripcion">{$$gd[descripcion]}</span> </td>
                        <td> <span class="detalle">{$$gd[detalle]}</span> </td>
                        <td> <span id="{$$gd[id_cpr_proveedores]}" class="proveedor" >{$$gd[nombre]}</span> </td>
                        <td> <span class="factura">{$$gd[factura]}</span> </td>
                        <td> <span id="{$$gd[id_sis_areas]}" class="area">{$$gd[area]}</span> </td>
                        <td> <span class="monto">{$$gd[monto]|number_format:2:",":""}</span> </td>
                        <td>
                            <a href="#">
                                <img id="id_gastos-{$$gd[id_adm_pedido_caja_chica_detalle]}" class="del_gasto" src="/img/iconos/delete.gif" alt="quitar" border="0" />
                            </a>
                            <a href="#">
                                <img id="id_gastos-{$$gd[id_adm_pedido_caja_chica_detalle]}" class="edit_gasto" src="/img/iconos/edit.gif" alt="editar" border="0" />
                            </a>
                        </td>
                    </tr>
                {/foreach}
            {/if}
        </table>
        <form class="box-entrada" action="/adm_pedido_caja_chica.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="cuenta">
                        <label> Cuenta: </label>
                        <input name="cuenta" class="cuenta" type="text" value="{$cuenta}"  />
                    </div>
                    <div class="detalle">
                        <label> Detalle: </label>
                        <input name="detalle" class="detalle" type="text" value="{$detalle}" />
                    </div>
                    <div class="factura">
                        <label> Factura: </label>
                        <input name="factura" class="factura" type="text" value="{$mes}" />
                    </div>
                    <div class="monto">
                        <label> Monto: </label>
                        <input name="monto" id="decimal" class="monto" type="text" value="{$monto}" alt="decimal" />
                    </div>
                </div>
                <div class="der">
                    <div class="descripcion">
                        <label> Descripción: </label>
                        <input name="descripcion" class="descripcion" type="text" value="{$descripcion}" />
                    </div>
                    <div class="proveedor">
                        <label> Proveedor: </label>
                        <select name="proveedor" class="proveedor">
                            {foreach item=pr from=$proveedores}
                                <option value="{$$pr[id_valor]}" {if $$pr['id_valor'] == $proveedor } selected {/if}> {$$pr[valor]} </option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="area">
                        <label> Area: </label>
                        <select name="area" class="area">
                            {foreach item=ar from=$sel_area}
                                <option value="{$$ar[id_valor]}" {if $$ar['id_valor'] == $area } selected {/if}> {$$ar[valor]} </option>
                            {/foreach}
                        </select>
                    </div>

                </div>
                <div class="archivo">
                    <label class="block"> Archivo : </label>
                    <input type="file" class="inline" name="archivo" value="" id="file"/>
                    <input type="submit" class="inline" name="subir_archivo"value="Subir Archivo" />
                </div>
                <div class="archivos">
                    {if $file != null }
                        <div class="file">
                            <a class="file_name" id="file_name-{$id_tabla}" href="/upload_archivos/adm_pedido_caja_chica/{$file}">
                                <span>{$file}</span>
                            </a>
                            <a class="del_file" id="file-{$id_tabla}" href="#" style="float:left;">
                                <img border="0" alt="quitar" src="/img/iconos/delete.gif" class="del_gasto" id="id_gastos-">
                            </a>
                        </div>
                    {/if}
                </div>
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar_gasto" class="agregar_gasto" type="submit" value="Agregar" />
            </div>
        </form>
        <form class="box-entrada" name="" action="/adm_pedido_caja_chica.html" method="post" enctype="multipart/form-data" >
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
