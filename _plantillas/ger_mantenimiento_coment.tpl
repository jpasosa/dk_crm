<link href="/css/ger_mantenimiento.css" rel="stylesheet" type="text/css" />

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
        <h1 class="azul bold"><span class="txt22 normal">Mantenimientos</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$fecha_inicio}</span></p>
        <p class="txt10 uppercase">Nombre:<span class="azul">{$area_inicio}</span></p>
        <form class="box-entrada">
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Tipo:</label>
                        <select name="pais" disabled="disabled">
                            <option value="{$tabla_mant[0][id_sis_mantenimiento_opciones]}">{$tabla_mant[0][mantenimiento]}</option>
                        </select>
                    </div>
                </div>
                <div class="observacionesChico clear">
                    <label> Detalle: </label>
                    <textarea readonly="yes" name="inicio">{$tabla[0]['detalle']}</textarea>
                </div>
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Inicio:</label>
                        <input readonly="readonly" name="inicio" type="text" value="{$tabla[0][fecha_inicio]|date_format:"d/m/Y"}"  alt="Inicio" />
                    </div>
                </div>
                <div class="izq clear">
                    <div class="campania">
                        <label>Periodicidad:</label>
                        <select name="periodicidad" disabled="disabled">
                            <option value="{$tabla[0][id_sis_periodicidad]}">{$tabla[0][periodicidad]}</option>
                        </select>
                    </div>
                </div>
                <div class="izq">
                    <div class="campania inputChico">
                        <label>Cada:</label>
                        <input class="ultimoElement" readonly="yes" name="cada" type="text" value="{$tabla[0]['cada_x_tiempo']}"  alt="Cada" />
                    </div>
                </div>
                <div class="izq paddingBot20">
                    <p class"clear">Archivos : </p>
                    {if $files['error'] == false }
                        <div class="archivos clear">
                            {foreach item=n from=$files}
                                <div class="file marginLat10">
                                    <a class="file_name" id="file_name-{$$n[id]}" href="/upload_archivos/ger_mantenimiento/{$$n[nombre]}" target="_blank">
                                    <span>Archivo: {$$n[nombre]}</span>
                                    </a>
                                </div>
                            {/foreach}
                        </div>
                    {/if}
                </div>
                <div class="der paddingBot20">
                    <p class"clear">Mails : </p>
                    <div class="archivos">
                        {foreach item=n from=$nombres_mail}
                            <div class="file marginLat10">
                                <a class="file_name" id="file_name-{$$n[id]}" href="/upload_archivos/adm_ytd_mantenimientos/{$$n[nombre]}">
                                <span>Mail: Mail 1</span>
                                </a>
                                <a class="del_file" id="file-{$$n[id]}" href="#" style="floet:left;">
                                <img border="0" alt="quitar" src="img/iconos/delete.gif" class="del_gasto" id="id_gastos-">
                                </a>
                            </div>
                        {/foreach}
                    </div>                
                </div>
            </div>
        </form>
        <form class="box-coment" name="box_coment" action="/ger_mantenimiento_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
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
