<link href="/css/ave_comparacion_hoteles.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" /><!-- para del datepicker -->
<script> $(function() {$( "#fecha_inicio" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>
<script> $(function() {$( "#fecha_fin" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>
<script type="text/javascript" src="/js/ave_comparacion_hoteles/abm.js"></script>
<script type="text/javascript" src="/js/meio.mask.min.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(function($) {
        $('input[name="costo"]').setMask();
        $.mask.masks.decimal = {mask : '99,999999', type : 'reverse', defaultValue: '000'}
        $('input[name="costo"]').setMask();
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
        <h1 class="azul bold"><span class="txt22 normal">Asistente de ventas</span> | Comparación Hoteles</h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite: <span class="azul">{$date}</span></p>
        <hr />
        <form class="box-entrada" name="add_observaciones" action="/ave_comparacion_hoteles.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" bgcolor="#D2E1F2">
                <div class="pais_ciudad">
                    <label> País / Ciudad: </label>
                    <select name="pais_ciudad" class="pais_ciudad">
                        {foreach item=pc from=$pais_ciudad}
                            <option value="{$$pc[id_valor]}" {if $$pc['id_valor'] == $tabla[0]['id_sis_provincia'] } selected {/if}> {$$pc[valor_sec]} | {$$pc[valor]}  </option>
                        {/foreach}    
                    </select>
                </div>
                <div class="fecha_inicio">
                    <label> Fecha Inicio: </label>
                    {if $tabla[0]['fecha_inicio'] == '' }
                        <input id="fecha_inicio" name="fecha_inicio" class="fecha_inicio" type="text" value=''  alt="Fecha Inicio" />
                    {else}
                        <input id="fecha_inicio" name="fecha_inicio" class="fecha_inicio" type="text" value='{$tabla[0]["fecha_inicio"]|date_format:"d/m/Y"}'  alt="Fecha Inicio" />
                    {/if}
                </div>
                <div class="fecha_fin">
                    <label> Fecha Fin: </label>
                    {if $tabla[0]['fecha_fin'] == '' }
                        <input id="fecha_fin" name="fecha_fin" class="fecha_fin" type="text" value=''  alt="Fecha fin" />
                    {else}
                        <input id="fecha_fin" name="fecha_fin" class="fecha_fin" type="text" value='{$tabla[0]["fecha_fin"]|date_format:"d/m/Y"}'  alt="Fecha fin" />
                    {/if}
                </div>
                <div class="observaciones">
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
        <p class="azul txt18" style="margin:0px 0 10px 0;">Hoteles:</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="70" bgcolor="#4685CA"><p class="blanco">Hotel </p></td>
                <td width="200" align="left" bgcolor="#4685CA"><p class="blanco">Comentario</p></td>
                <td width="50" align="center" bgcolor="#4685CA"><p class="blanco">Costo</p></td>
                <td width="60" align="center" bgcolor="#4685CA"><p class="blanco">Archivo</p></td>
                <td width="10" align="center" bgcolor="#4685CA"><p class="blanco">Accion</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=ho from=$tabla_sec }
                <tr id="id_hotel-{$$ho[id_ave_comparacion_hoteles_opc]}">
                    <td><span class="hotel">{$$ho[hotel]}</span></td>
                    <td><span class="comentario">{$$ho[comentario]}</span></td>
                    <td align="center"><span class="costo">{$$ho[costo]|number_format:2:",":""}</span></td>
                    <td class="archivo" id="{$$ho[id_ave_comparacion_hoteles_opc]}">
                        {if $$ho['archivo'] != "" }
                            <a href="/upload_archivos/ave_comparacion_hoteles/{$$ho[archivo]}" target="_blank">
                                <span class="archivo">{$$ho[archivo]}</span>
                            </a>
                            <a class="del_file" id="file-{$$ho[id_ave_comparacion_hoteles_opc]}" href="#" style="">
                                <img border="0" alt="quitar" src="img/iconos/delete.gif" class="del_gasto" id="id_gastos-">
                            </a>
                        {else}
                            <span class="archivo">no existe archivo.</span>
                        {/if} 
                    </td>
                    <td>
                        <a href="#" style="float:right;">
                            <img id="id_hotel-{$$ho[id_ave_comparacion_hoteles_opc]}" class="del_hotel" src="img/iconos/delete.gif" alt="quitar" border="0" />
                        </a> 
                        <a href="#" style="float:right;">
                            <img id="id_hotel-{$$ho[id_ave_comparacion_hoteles_opc]}" class="edit_hotel" src="img/iconos/edit.gif" alt="editar" border="0" />
                        </a>
                    </td>
                </tr>
                {/foreach}
            {/if}
        </table>
        <!-- NUEVO HOTEL -->
        <form class="box-entrada" name="add_hotel" action="/ave_comparacion_hoteles.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="hotel">
                    <label> hotel: </label>
                    <input name="hotel" class="hotel" type="text" value="{$hotel}"  />
                </div>
                <div class="comentario">
                    <label> comentario: </label>
                    <input name="comentario" class="comentario" type="text" value="{$comentario}" />
                </div>
                <div class="costo">
                    <label> costo: </label>
                    <input name="costo" class="costo" type="text" value="{$costo}" id="decimal" alt="decimal" />
                </div>
                <div class="archivo">
                    <label class="archivo"> Archivo </label>
                    <input type="file" class="archivo" name="archivo" value="" />
                </div>
                 <input name="first_time" type="hidden" value="{$first_time}" />
                 <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                 <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                 <input class="nombre_archivo" name="nombre_archivo" type="hidden" value="" />
                 <input name="agregar_hotel" class="agregar_hotel" type="submit" value="Agregar" />
            </div>
        </form>
        <form class="box-entrada" name="add_hotel" action="/ave_comparacion_hoteles.html" method="post" enctype="multipart/form-data" >
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
