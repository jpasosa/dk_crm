<link href="/css/adm_pedido_pagos_adelantos.css" rel="stylesheet" type="text/css" />
<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }<div class="disp_error"> {$flash_error}</div>{/if}
    {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice}</div>{/if}
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
        <div id="hilo"> Bienvenido : {$nombre_empleado}</div>
        <hr />
        <h1 class="azul bold"><span class="txt22 normal">Pedido de Pagos / Adelantos</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$fecha_inicio}</span></p>
        <hr/>
        <p>Sector : <span class="azul">{area_inicio}</span></p>
        <p>Nombre : <span class="azul">{$nombre_inicio}</span></p>
        <form class="box-entrada">
            <div class="box-entrada paddingLat10" height="40" colspan="5" bgcolor="#D2E1F2">
                <label class="block">Asunto : </label>
                <input class="marginCero" id="asunto" type="text" readonly="readonly" value="{$tabla[0]['asunto']}"/>
                <div class="observacionesGrande">
                    <label class="block">Pedido : </label>
                    <textarea class="marginCero" readonly="readonly">{$tabla[0]['pedido']}</textarea>
                </div>
                {if $files['error'] == false }
                    <div class="archivos">
                        {foreach item=n from=$nombres_archivos}
                            <div class="file">
                                <a class="file_name" id="file_name-{$$n[id]}" href="/upload_archivos/adm_pedido_pagos_adelantos/{$$n[nombre]}">
                                    <span>Archivo: {$$n[nombre]}</span>
                                </a>
                            </div>
                        {/foreach}
                    </div>
                {/if}
            </div>
        </form>
        <hr/>
        <form class="box-coment" name="box_coment" action="/adm_pedido_pagos_adelantos_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
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