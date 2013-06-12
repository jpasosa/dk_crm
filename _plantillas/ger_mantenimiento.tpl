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
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p class="txt10 uppercase">Nombre:<span class="azul">{$area_empleado}</span></p>
        <form class="box-entrada" name="add_hotel" action="/ger_mantenimiento.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Tipo:</label>
                        <select name="pais">
                            {foreach item=mant from=$mantenimientos}
                                <option value="{$$mant[id]}"> {$$mant[nombre]} </option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="observacionesChico clear">
                    <label> Detalle: </label>
                    <textarea name="detalle">{$tabla[0]['detalle']}</textarea>
                </div>
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Inicio:</label>
                        {if $tabla[0][fecha_inicio] == '' }
                            <input name="fecha_inicio" id="fecha_inicio" class="fecha_inicio" value="" />
                        {else}
                            <input name="fecha_inicio" id="fecha_inicio" class="fecha_inicio" value='{$tabla[0][fecha_inicio]|date_format:"d/m/Y"}' />
                        {/if}
                    </div>
                </div>
                <div class="izq clear">
                    <div class="campania">
                        <label>Periodicidad:</label>
                        <select name="periodicidad">
                            {foreach item=pe from=$sel_period}
                                <option value="{$$pe[id_valor]}" {if $$pe['id_valor'] == $tabla[0]['id_sis_periodicidad'] } selected {/if}> {$$pe[valor]} </option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="izq">
                    <div class="campania inputChico">
                        <label>Cada:</label>
                        <input name="cada_x_tiempo" type="text" value=''  alt="" />
                    </div>
                </div>
                <div class="archivo">
                    <label class="block"> Archivo : </label>
                    <input type="file" class="inline" name="archivo" value="quepasavieja" />
                    <input type="submit" class="inline" name="subir_archivo" value="Subir Archivo" />
                </div>
                <div class="archivos clear">
                    {foreach item=n from=$nombres_archivos}
                        <div class="file marginLat10">
                            <a class="file_name" id="file_name-{$$n[id]}" href="/upload_archivos/ger_mantenimiento/{$$n[nombre]}">
                            <span>Archivo: {$$n[nombre]}</span>
                            </a>
                            <a class="del_file" id="file-{$$n[id]}" href="#" style="floet:left;">
                            <img border="0" alt="quitar" src="img/iconos/delete.gif" class="del_gasto" id="id_gastos-">
                            </a>
                        </div>
                    {/foreach}
                </div>
                <div class="archivo">
                    <label class="block"> Mail externo : </label>
                    <input type="file" class="inline" name="mail" value="" />
                    <input type="submit" class="inline" name="subir_mail" value="Subir Mail" />
                </div>
                <div class="archivos clear">
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
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar_fechas" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>
        <form class="box-entrada" name="add_hotel" action="/ger_mantenimiento.html" method="post" enctype="multipart/form-data" >
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
