<link href="/css/adm_propuestas_mejoras.css" rel="stylesheet" type="text/css" />
<div style="width:994px; height:23px; background:url(img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }<div class="disp_error"> {$flash_error}</div>{/if}
    {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
        <div id="hilo"> Bienvenido: {$nombre_empleado}</div> 
        <hr />
        <h1 class="azul bold"><span class="txt22 normal">Propuestas de Mejoras</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <hr/>
        <p>Sector:<span class="azul">DISEÑO</span></p>
        <p>Nombre:<span class="azul">JUAN CARLOS</span></p>
        <form class="box-entrada">
            <div class="box-entrada paddingLat10" height="40" colspan="5" bgcolor="#D2E1F2">
                <label class="block">Asunto : </label>
                <input class="marginCero" id="asunto"type="text" value="AIRE ACONDICIONADO"/>
                <div class="observacionesGrande">
                    <label class="block">Mejora : </label>
                    <textarea>COMPRAR CALEFACTOR PARA EL DEPOSITO</textarea>
                </div>
                <div class="archivo">
                    <label class="block"> Archivo : </label>
                    <input type="file" class="inline"name="archivo" value="quepasavieja" />
                    <input type="submit" class="inline" name="subir_archivo"value="Subir Archivo" />
                </div>
                <div class="archivos">
                    {foreach item=n from=$nombres_archivos}
                        <div class="file">
                            <a class="file_name" id="file_name-{$$n[id]}" href="/upload_archivos/adm_ytd_mantenimientos/{$$n[nombre]}">
                            <span>Archivo: Archivo 1</span>
                            </a>
                            <a class="del_file" id="file-{$$n[id]}" href="#" style="floet:left;">
                            <img border="0" alt="quitar" src="img/iconos/delete.gif" class="del_gasto" id="id_gastos-">
                            </a>
                        </div>
                    {/foreach}
                </div>
                <input type="submit" id="agregar" class="agregar" value="Agregar"/>
            </div>
        </form>
        <form class="box-entrada" name="add_hotel" action="/adm_pedido_pagos_adelantos.html" method="post" enctype="multipart/form-data" >
                <div class="enviar_proceso">
                    <!-- <a class="enviar" href="/enviado.html">Enviar al siguiente Paso</a> -->
                    <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                    <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                    <input name="enviar" class="enviar" type="submit" value="Enviar al siguiente Paso" />
                    <!-- <button class="enviar" type="button">Enviar al siguiente Paso</button> -->
                </div>
        </form>
    </div>
    </div><!-- cierro div class form1 id del proceso -->
    <div style="width:741px; height:46px; float:right;" class="png_bg"></div>
    <br style="clear:both;" />
</div>