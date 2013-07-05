<link href="/css/rh_pedido_vacaciones.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/rh_pedido_vacaciones/del_file.js"></script>
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" /><!-- para del datepicker -->
<script> $(function() {$( "#fecha_inicio" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>
<script> $(function() {$( "#fecha_fin" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>

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
        <h1 class="azul bold"><span class="txt22 normal">Pedido de Vacaciones</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p class="txt10 uppercase">Sector: <span class="azul">{$area}</span>
        </p>
        <p class="txt10 uppercase">Empleado: <span class="azul">{$nombre_empleado}</span>
        </p>
        <form class="box-entrada" name="add_hotel" action="/rh_pedido_vacaciones.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label>Fecha Inicio:</label>
                        {if $tabla[0]['fecha_inicio'] == '' }
                            <input id="fecha_inicio" name="fecha_inicio" class="fecha_inicio" type="text" value=''  alt="Fecha Inicio" />
                        {else}
                            <input id="fecha_inicio" name="fecha_inicio" class="fecha_inicio" type="text" value='{$tabla[0]["fecha_inicio"]|date_format:"d/m/Y"}'  alt="Fecha" />
                        {/if}
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label>Cantidad de Días:</label>
                        <input name="cantidad_dias" type="text" value="{$tabla[0]['cantidad_dias']}"  alt="Cantidad Días" />
                    </div>
                </div>
                <div class="izq">
                    <div class="campania">
                        <label>Fecha Fin:</label>
                        {if $tabla[0]['fecha_fin'] == '' }
                            <input id="fecha_fin" name="fecha_fin" class="fecha_inicio" type="text" value=''  alt="Fecha Fin" />
                        {else}
                            <input id="fecha_fin" name="fecha_fin" class="fecha_inicio" type="text" value='{$tabla[0]["fecha_fin"]|date_format:"d/m/Y"}'  alt="Fecha" />
                        {/if}
                    </div>
                </div>
                <div class="observacionesChico">
                    <label> Observaciones: </label>
                    <textarea name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
                <div class="archivo">
                    <label class="block"> Archivo : </label>
                    <input type="file" class="inline" name="archivo" value="" />
                    <input type="submit" class="inline" name="subir_archivo" value="Subir Archivo" />
                </div>
                {if $files['error'] == false }
                    <div class="archivos">
                        {foreach item=n from=$files}
                            <div class="file marginLat10">
                                <a class="file_name" id="file_name-{$$n[id]}" href="/upload_archivos/rh_pedido_vacaciones/{$$n[nombre]}">
                                    <span>Archivo: {$$n[nombre]}</span>
                                </a>
                                <a class="del_file" id="file-{$$n[id]}" href="#" style="floet:left;">
                                    <img border="0" alt="quitar" src="img/iconos/delete.gif" class="del_gasto" id="id_gastos-" />
                                </a>
                            </div>
                        {/foreach}
                    </div>
                {/if}
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>
        <form class="box-entrada" name="add_hotel" action="/rh_pedido_vacaciones.html" method="post" enctype="multipart/form-data" >
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
