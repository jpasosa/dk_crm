<link href="/css/adm_ytd_mantenimientos.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" /><!-- para del datepicker -->
<script> $(function() {$( "#fecha" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>
<script type="text/javascript" src="/js/meio.mask.min.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(function($) {
        $('input[name="costo"]').setMask();
        $.mask.masks.decimal = {mask : '99,999999', type : 'reverse', defaultValue: '000'}
        $('input[name="costo"]').setMask();
        $.mask.masks = $.extend($.mask.masks, {decimal: { mask: '999' }});
    });
</script>

<div style="width:994px; height:23px; background:url(img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;">
</div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
        <div class="flash_error"></div>
        <div class="flash_notice"></div>
        {if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
        {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
        {template tpl="menu_izq"}
        <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
            <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
            <hr />
            <p>Sector:<span class="azul"> {$area_inicio}</span></p>
            <p>Nombre:<span class="azul"> {$nombre_inicio}</span></p>
            <h1 class="azul bold"><span class="txt22 normal">Administración</span> | YTD Mantenimientos </h1>
            <hr />
            <p class="txt10 uppercase">Fecha de inicio del trámite: <span class="azul">{$fecha_inicio}</span></p>
            <hr />
            <form class="box-entrada" name="add_observaciones" action="/adm_ytd_mantenimientos.html" method="post" enctype="multipart/form-data" >
                <div class="box-entrada" height="40" bgcolor="#D2E1F2">
                    <div class="asunto">
                        <label> Asunto: </label>
                        <input name="asunto" class="asunto" value="{$tabla[0][asunto]}" readonly="true">
                    </div>
                    <div class="observaciones">
                        <label> Observaciones: </label>
                        <textarea name="observaciones" readonly="true">{$tabla[0][observaciones]}</textarea>
                    </div>
                    <div class="fecha_inicio">
                        <label> Fecha Inicio: </label>
                        <input name="fecha_inicio" id="fecha_inicio" readonly="true" class="fecha_inicio" value="{$tabla[0][fecha_inicio]|date_format:"d/m/Y"}" />
                    </div>
                    <div class="x_tiempo">
                        <label> Tiempo: </label>
                        <input name="x_tiempo" class="x_tiempo" readonly="true" value="{$tabla[0][cada_x_tiempo]}" />
                    </div>

                    <div class="periodicidad">
                        <label> Periodicidad </label>
                        <input name="periodicidad" class="periodicidad" readonly="true" value="{$tabla[0][periodicidad]}" />
                    </div>
                    


                {if $files['error'] == false }
                    <div class="archivos">
                        {foreach item=n from=$files}
                            <div class="file">
                                <a class="file_name" target="_blank" id="file_name-{$$n[id]}" href="/upload_archivos/adm_ytd_mantenimientos/{$$n[nombre]}">
                                    <span>Archivo: {$$n[nombre]}</span>
                                </a>
                            </div>
                        {/foreach}
                    </div>
                {/if}


                    <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                    <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                    <input name="new_tabla_proc" type="hidden" value="{$new_tabla_proc}" />
                </div>
            </form>
            <hr />

            <p class="azul txt18" style="margin:0px 0 10px 0;">Mantenimientos anteriores:</p>
            <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario" colspan="7">
                <tr>
                    <td  width="100" bgcolor="#4685CA"><p class="blanco">Fecha </p></td>
                    <td  width="100" align="left" bgcolor="#4685CA"><p class="blanco">Resultado</p></td>
                    <td  width="100"  bgcolor="#4685CA"><p class="blanco">Detalle</p></td>
                    <td  width="100"  bgcolor="#4685CA"><p class="blanco">Costo</p></td>
                    <td  width="100"  bgcolor="#4685CA"><p class="blanco">Adjuntos</p></td>
                </tr>



                <!-- traigo de la base de datos, los hoteles cargados -->
                {foreach item=rec from=$recordatorios }
                <tr id="id_gastos-{$$gd[id]}">
                    <td> <span class="cuenta">{$$rec[fecha]|date_format:"d/m/Y"}</span> </td>
                    <td> <span class="descripcion">{$$rec[resultado]}</span> </td>
                    <td> <span class="detalle">{$$rec[detalle]}</span> </td>
                    <td> <span class="proveedor">{$$rec[costo]}</span> </td>
                    <td> <span class="mes">{$$rec[archivo_1]}</span> </td>
                </tr>
                {/foreach}
            </table>
            
        <!-- MANTENIMIENTO -->
        <form class="box-entrada" name="add_mantenimiento" action="/adm_ytd_mantenimientos_recordatorio/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                
                <div class="fecha">
                    <label> fecha: </label>
                    <input name="fecha" class="fecha" type="text" value="{$costo}" id="fecha" alt="decimal" />
                </div>
                <div class="resultado">
                    <label> resultado: </label>
                    <input type="radio" name="resultado" id="correcto" value="1" />
                    <label for="correcto">OK / Correcto</label>
                    <input type="radio" name="resultado" id="incorrecto" value="0" />
                    <label for="incorrecto">Mal</label>
                </div>
                
                <div class="costo">
                    <label> costo: </label>
                    <input name="costo" class="costo" type="text" value="{$costo}" id="decimal" alt="decimal" />
                </div>

                <div class="detalle">
                    <label> detalle: </label>
                    <textarea name="detalle" class="detalle" type="text" value="{$comentario}"></textarea>
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
                 <input name="add_mant" class="add_mant" type="submit" value="Modificar Mantenimiento" />
            </div>
        </form>            




            <form class="box-entrada" name="add_hotel" action="/adm_ytd_mantenimientos_recordatorio/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
                <div class="enviar_proceso">
                    <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                    <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                    <input name="cerrar_mant" class="enviar" type="submit" value="Cerrar Mantenimiento" />
                </div>
            </form>
    </div>
    <div style="width:741px; height:46px; float:right;" class="png_bg"></div>
    <br style="clear:both;" />
</div>