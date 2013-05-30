<link href="/css/adm_audit_stock_limpieza.css" rel="stylesheet" type="text/css" />
<link href="/css/jquery-ui.css" rel="stylesheet" type="text/css" /><!-- para del datepicker -->
<script type="text/javascript" src="/js/adm_audit_stock_limpieza/del_file.js"></script>
<script> $(function() {$( "#fecha" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>


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
        <h1 class="azul bold"><span class="txt22 normal">Administración | Auditorias físicas Stock y limpieza</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul"> {$date}</span></p>
        <form class="box-entrada" name="add_hotel" action="/adm_audit_stock_limpieza.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada paddingLat10" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="observacionesGrande">
                    <label class="block">Observaciones : </label>
                    <textarea name="observaciones">{$tabla[0][observaciones]}</textarea>
                </div>
                <label class="block">Fecha : </label>
                {if $tabla[0]['fecha'] == '' }
                    <input id="fecha" name="fecha" class="fecha_inicio" type="text" value=''  alt="Fecha Inicio" />
                {else}
                    <input id="fecha" name="fecha" class="fecha_inicio" type="text" value='{$tabla[0]["fecha"]|date_format:"d/m/Y"}'  alt="Fecha" />
                {/if}
                <div class="archivo">
                    <label class="block"> Archivo : </label>
                    <input type="file" class="inline" name="archivo" value="" />
                    <input type="submit" class="inline" name="subir_archivo" value="Subir Archivo" />
                </div>
                <div class="archivos">
                    {if $tabla[0]['archivo'] != '' }
                        <div class="file">
                            <a class="file_name" id="file_name-{$tabla[0][id_adm_audit_stock_limpieza]}" href="/upload_archivos/adm_audit_stock_limpieza/{$tabla[0][archivo]}" target="_blank">
                                <span>{$tabla[0][archivo]}</span>
                            </a>
                            <!-- <a class="file_name" id="file_name-{$tabla[0][id_adm_audit_stock_limpieza]}" href="/bajar_archivo/directorio/{$tabla[0][archivo]}" target="_blank">
                                <span>{$tabla[0][archivo]}</span>
                            </a> -->
                            <a class="del_file" id="file-{$tabla[0][id_adm_audit_stock_limpieza]}" href="#" style="floet:left;">
                                <img border="0" alt="quitar" src="img/iconos/delete.gif" class="del_gasto" >
                            </a>
                        </div>
                    {/if}
                </div>
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input type="submit" name="agregar" id="agregar" class="enviar" value="Agregar" />
            </div>
        </form>
        <form class="box-entrada" name="add_hotel" action="/adm_audit_stock_limpieza.html" method="post" enctype="multipart/form-data" >
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
