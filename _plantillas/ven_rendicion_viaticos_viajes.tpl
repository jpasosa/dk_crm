<link href="/css/ven_rendicion_viaticos_viajes.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" /><!-- para del datepicker -->
<script type="text/javascript" src="/js/ven_rendicion_viaticos_viajes/abm.js"></script>
<script type="text/javascript" src="/js/meio.mask.min.js" charset="utf-8"></script>
<script type="text/javascript">
    // call setMask function on the document.ready event
    jQuery(function($) {
        $('input[name="monto"]').setMask();
        $.mask.masks.decimal = {mask : '99,999999', type : 'reverse', defaultValue: '000'}
        $('input[name="monto"]').setMask();
        $.mask.masks = $.extend($.mask.masks, {decimal: { mask: '999' }});

        $('input[name="monto_real"]').setMask();
        $.mask.masks.decimal = {mask : '99,999999', type : 'reverse', defaultValue: '000'}
        $('input[name="monto_real"]').setMask();
        $.mask.masks = $.extend($.mask.masks, {decimal: { mask: '999' }});
    });
</script>

<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="form1" id="proc-{$id_proces}"> <!-- lo uso para ver el id del proceso -->
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }
    <div class="disp_error"> {$flash_error} </div> <!-- estos vienen del controlador -->                    
    {/if}
    {if $flash_notice != '' }
    <div class="disp_notice"> {$flash_notice} </div> <!-- estos vienen del controlador -->                    
    {/if}
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
        <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
        <hr />
        <h1 class="azul bold">
            <span class="txt22 normal">Rendición de viáticos viajes</span>
        </h1>
        <hr />
        <p class="txt10 uppercase">
            Fecha de inicio del trámite:
            <span class="azul">{$fecha_actual}</span>
        </p>

        <!-- TABLA PRINCIPAL -->
        <form class="box-entrada" name="add_hotel" action="/ven_rendicion_viaticos_viajes.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="fecha_inicio">
                    <label> Fecha Inicio: </label>
                    {if $tabla[0]['fecha_inicio'] == '' }
                        <input id="fecha_inicio" name="fecha_inicio" class="fecha_inicio" type="text" value=''  readonly="true" alt="Fecha Inicio" />
                    {else}
                        <input id="fecha_inicio" name="fecha_inicio" class="fecha_inicio" type="text" readonly="true" value='{$tabla[0]["fecha_inicio"]|date_format:"d/m/Y"}'  alt="Fecha Inicio" />
                    {/if}
                </div>
                <div class="fecha_fin">
                    <label> Fecha Fin: </label>
                    {if $tabla[0]['fecha_fin'] == '' }
                        <input id="fecha_fin" name="fecha_fin" class="fecha_fin" type="text" value=''  readonly="true" alt="Fecha fin" />
                    {else}
                        <input id="fecha_fin" name="fecha_fin" class="fecha_fin" type="text" readonly="true" value='{$tabla[0]["fecha_fin"]|date_format:"d/m/Y"}'  alt="Fecha fin" />
                    {/if}
                </div>
                <div class="observaciones">
                        <label> Observaciones: </label>
                        <textarea name="observaciones" readonly="true">{$tabla[0]['observaciones']}</textarea>
                </div>
            </div>
        </form>

        <!-- CLIENTES -->
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="350" bgcolor="#4685CA"><p class="blanco">Cliente </p></td>
                <td width="122" align="left" bgcolor="#4685CA"><p class="blanco">País</p></td>
                <td width="123" align="center" bgcolor="#4685CA"><p class="blanco">Ciudad</p></td>
            </tr>
            {foreach item=cl from=$tabla_sec_clientes }
                <tr id="id_cl-{$$cl[solicit_cliente]}">
                    <td><span>{$$cl[usuario]}</span></td>
                    <td><span class="pais">{$$cl[pais]}</span></td>
                    <td> <span>{$$cl[provincia]}</span></td>
                </tr>
            {/foreach}
        </table>
        
        
        <p>
            Monto: <span class="monto_total azul">{$suma_de_montos[0][MontoTot]}</span>
        </p>
        
        <!-- GASTOS -->
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="145" bgcolor="#4685CA"><p class="blanco">Referencia </p></td>
                <td width="358" align="left" bgcolor="#4685CA"><p class="blanco">Detalle</p></td>
                <td width="92" align="center" bgcolor="#4685CA"><p class="blanco">Monto</p></td>
                <td width="92" align="center" bgcolor="#4685CA"><p class="blanco">Monto Real</p></td>
                <td width="92" align="center" bgcolor="#4685CA"><p class="blanco">Diferencia</p></td>
                <td width="52" align="center" bgcolor="#4685CA"><p class="blanco">Archivo</p></td>
                <td width="52" align="center" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
            </tr>
            {foreach item=gast from=$tabla_sec_gastos }
                <form class="box-entrada" name="add_monto" action="/ven_rendicion_viaticos_viajes/{$id_tabla_proc_solicitud}.html" method="post" enctype="multipart/form-data" >     
                    <tr id="id_gast-{$$gast[id_ven_rendicion_viaticos_viajes_gast]}">
                        <td><span id="ref-{$$gast[id_ref]}" class="referencia">{$$gast[referencia]}</span></td>
                        <td><span class="detalle">{$$gast[detalle]}</span></td>
                        <td><span class="monto">{$$gast[monto]|number_format:2:",":""}</span></td>
                        <td>
                            <input name="monto_real" class="monto" type="text" style="width: 50px;" alt="decimal" value="{$$gast[monto_real]|number_format:2:",":""}" />
                            <input name="agregar_monto" class="agregar_monto" style="width: 50px;" type="submit" value="ok" />
                        </td>
                        <td><span class="monto">{$$gast[diferencia]|number_format:2:",":""}</span></td>
                        <td align="center">
                            {if $$gast['archivo'] == '' }
                                <span>no hay archivo subido </span>
                            {else}
                                <span>{$$gast[archivo]} </span>
                            {/if}
                            
                            <input type="file" class="archivo" name="archivo" />
                            <input name="subir_archivo" class="subir_archivo" type="submit" value="Subir Archivo" />
                        </td>
                        <td align="center">
                            <a href="#"><img id="id_gast-{$$gast[id_ven_rendicion_viaticos_viajes_gast]}" class="del_gasto" src="/img/iconos/delete.gif" alt="quitar" border="0" /></a>
                            <a href="#"><img id="id_gast-{$$gast[id_ven_rendicion_viaticos_viajes_gast]}" class="edit_gasto" src="/img/iconos/edit.gif" alt="editar" border="0" /></a>
                        </td>
                    </tr>
                    <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                    <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                    <input name="id_tabla_proc_solicitud" class="id_tabla_proc_solicitud" type="hidden" value="{$id_tabla_proc_solicitud}" />
                    <input name="id_tabla_gast" type="hidden" value="{$$gast[id_ven_rendicion_viaticos_viajes_gast]}" />
                </form>
            {/foreach}    
        </table>
        <!-- AGREGO GASTO -->
        <form class="box-entrada" name="add_hotel" action="/ven_rendicion_viaticos_viajes/{$id_tabla_proc_solicitud}.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="referencia">
                    <label> Referencia: </label>
                    <select name="referencia" class="referencia">
                            {foreach item=ref from=$referencias}
                                <option value="{$$ref[id_valor]}" {if $$ref['id_valor'] == $referencia } selected {/if}> {$$ref[valor]} </option>
                            {/foreach}    
                    </select>
                </div>
                <div class="detalle">
                    <label> Detalle: </label>
                    <input name="detalle" class="detalle" type="text" value="{$detalle}"  />
                </div>
                <div class="monto">
                    <label> Monto Real: </label>
                    <input name="monto" class="monto" type="text" value="{$monto}" alt="decimal" />
                </div>
                
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="id_tabla_proc_solicitud" type="hidden" value="{$id_tabla_proc_solicitud}" />
                <input name="agregar_ref" class="agregar_ref" type="submit" value="Agregar Referencia" />
            </div>
        </form>
        <form class="box-entrada" name="add_hotel" action="/ven_rendicion_viaticos_viajes/{$id_tabla_proc_solicitud}.html" method="post" enctype="multipart/form-data" >
            <div class="enviar_proceso">
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla_proc_solicitud" type="hidden" value="{$id_tabla_proc_solicitud}" />
                <input name="enviar" class="enviar" type="submit" value="Enviar al siguiente Paso" />
            </div>
        </form>
    </div>
    </div> <!-- cierro div class form1 id del proceso -->
    <div style="width:741px; height:46px; float:right;" class="png_bg"></div>
    <br style="clear:both;" />
</div>
