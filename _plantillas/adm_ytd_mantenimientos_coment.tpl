<link href="/css/formCommon.css" rel="stylesheet" type="text/css" />
<link href="/css/adm_ytd_mantenimientos.css" rel="stylesheet" type="text/css" />



<div style="width:994px; height:23px; background:url(img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;">
</div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="ger_planificacion_gastos" id="proc-{$id_proccess}"> <!-- lo uso para ver el id del proceso -->
        <div class="flash_error"></div>
        <div class="flash_notice"></div>
        {if $flash_error != '' } <div class="disp_error"> {$flash_error} </div>{/if}
        {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
        {template tpl="menu_izq"}
        <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
            <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
            <hr />

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
                    <div class="archivo">
                                <label class="archivo"> Archivo/s </label>
                                {foreach item=file from=$get_files }
                                    <span> {$$file[nombre]} </span>
                                {/foreach}
                    </div>
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
                {foreach item=gd from=$gast_detalles }
                <tr id="id_gastos-{$$gd[id]}">
                    <td> <span class="cuenta">{$$gd[cuenta]}</span> </td>
                    <td> <span class="descripcion">{$$gd[descripcion]}</span> </td>
                    <td> <span class="detalle">{$$gd[detalle]}</span> </td>
                    <td> <span class="proveedor">{$$gd[proveedor]}</span> </td>
                    <td> <span class="mes">{$$gd[mes]}</span> </td>
                    <td> <span class="monto">{$$gd[monto]}</span> </td>
                    <td>
                        <a href="#">
                            <img id="id_gastos-{$$gd[id]}" class="del_gasto" src="img/iconos/delete.gif" alt="quitar" border="0" />
                        </a> 
                        <a href="#">
                            <img id="id_gastos-{$$gd[id]}" class="edit_gasto" src="img/iconos/edit.gif" alt="editar" border="0" />
                        </a>
                    </td>
                </tr>
                {/foreach}
            </table>
            
            <hr />
            <form class="box-coment" name="box_coment" action="/adm_ytd_mantenimientos_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
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



            <form class="box-entrada" name="add_hotel" action="/adm_ytd_mantenimientos.html" method="post" enctype="multipart/form-data" >
                <div class="enviar_proceso">
                    <!-- <a class="enviar" href="/enviado.html">Enviar al siguiente Paso</a> -->
                    <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                    <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                    <input name="enviar" class="enviar" type="submit" value="Enviar al siguiente Paso" />
                    <!-- <button class="enviar" type="button">Enviar al siguiente Paso</button> -->
                </div>
            </form>
        </div>
    </div>
    <div style="width:741px; height:46px; float:right;" class="png_bg"></div>
    <br style="clear:both;" />
</div>