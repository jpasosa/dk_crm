<link href="/css/ave_comparacion_aerolineas.css" rel="stylesheet" type="text/css" />

<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
    {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
    {template tpl="menu_izq"}

    <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
        <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
        <hr />
        <h1 class="azul bold"><span class="txt22 normal">Asistente de ventas</span> | Comparación de Aerolíneas</h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite: <span class="azul">{$fecha_inicio}</span></p>
        <hr />
        <form class="box-entrada" name="add_observaciones" action="/ave_comparacion_aerolineas.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" bgcolor="#D2E1F2">
                <div class="pais_ciudad">
                    <label> País / Ciudad: </label>
                    <select name="pais_ciudad" disabled="disabled" class="pais_ciudad">
                        {foreach item=pc from=$pais_ciudad}
                            <option value="{$$pc[id_valor]}" {if $$pc['id_valor'] == $tabla[0]['id_sis_provincia'] } selected {/if}> {$$pc[valor_sec]} | {$$pc[valor]}  </option>
                        {/foreach}    
                    </select>
                </div>
                <div class="fecha_inicio">
                    <label> Fecha Inicio: </label>
                    {if $tabla[0]['fecha_inicio'] == '' }
                        <input id="fecha_inicio" name="fecha_inicio" class="fecha_inicio" type="text" readonly="true" value=''  alt="Fecha Inicio" />
                    {else}
                        <input id="fecha_inicio" name="fecha_inicio" class="fecha_inicio" type="text" readonly="true" value='{$tabla[0]["fecha_inicio"]|date_format:"d/m/Y"}'  alt="Fecha Inicio" />
                    {/if}
                </div>
                <div class="fecha_fin">
                    <label> Fecha Fin: </label>
                    {if $tabla[0]['fecha_fin'] == '' }
                        <input id="fecha_fin" name="fecha_fin" class="fecha_fin" type="text" readonly="true" value=''  alt="Fecha fin" />
                    {else}
                        <input id="fecha_fin" name="fecha_fin" class="fecha_fin" type="text" readonly="true" value='{$tabla[0]["fecha_fin"]|date_format:"d/m/Y"}'  alt="Fecha fin" />
                    {/if}
                </div>
                <div class="observaciones">
                    <label> Observaciones: </label>
                    <textarea name="observaciones" readonly="true">{$tabla[0][observaciones]}</textarea>
                </div>
            </div>
        </form>

        <hr />
        <p class="azul txt18" style="margin:0px 0 10px 0;">Aerolíneas:</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="70" bgcolor="#4685CA"><p class="blanco">Aerolineas </p></td>
                <td width="200" align="left" bgcolor="#4685CA"><p class="blanco">Comentario</p></td>
                <td width="50" align="center" bgcolor="#4685CA"><p class="blanco">Costo</p></td>
                <td width="60" align="center" bgcolor="#4685CA"><p class="blanco">Archivo</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                <!-- traigo de la base de datos, los hoteles cargados -->
                {foreach item=ho from=$tabla_sec }
                <tr id="id_hotel-{$$ho[id_ave_comparacion_aerolineas_opc]}">
                    <td>
                        <!-- <input type="text" class="campo" name="hotel" value="{$$ho[hotel]}" readonly="true" /> -->
                        <span class="hotel">{$$ho[aerolinea]}</span>
                    </td>
                    <td>
                        <!-- <input type="text" class="campo" name="comentario" value="{$$ho[comentario]}" readonly="true" /> -->
                        <span class="comentario">{$$ho[comentario]}</span>
                    </td>
                    <td align="center">
                        <!-- <input type="text" class="campo" name="costo" value="{$$ho[costo]}" readonly="true" /> -->
                        <span class="costo">{$$ho[costo]|number_format:2:",":""}</span>
                    </td>
                    <td class="archivo">
                        {if $$ho['archivo'] != "" }
                            <a href="/upload_archivos/ave_comparacion_hoteles/{$$ho[archivo]}" target="_blank">
                                <span class="archivo">{$$ho[archivo]}</span>
                            </a>
                        {else}
                            <span class="archivo">no existe archivo.</span>
                        {/if} 
                    </td>
                </tr>
                {/foreach}
            {/if}
        </table>
        <form class="box-coment" name="box_coment" action="/ave_comparacion_aerolineas_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
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
