<link href="/css/adm_pedido_compras.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/adm_pedido_compras/del_file.js"></script>
<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
    {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;">
        <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
        <hr />
        <h1 class="azul bold"><span class="txt22 normal">Administración</span> | Pedido de Compras</h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <hr />
        <p>Sector:<span class="azul">{$area}</span></p>
        <form class="box-entrada" name="agregar" action="/adm_pedido_compras.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <label class="block primerElement">Asunto : </label>
                <input name="asunto" class="marginCero" id="asunto" type="text" value="{$tabla[0][asunto]}"/>
                <label class="block">Pedido : </label>
                <textarea name="pedido" class="marginCero">{$tabla[0][pedido]}</textarea>
                <div class="archivo">
                    <label class="block"> Archivo : </label>
                    <input type="file" class="inline" name="archivo" value="" />
                    <input type="submit" class="inline" name="subir_archivo" value="Subir Archivo" />
                </div>
                {if $files['error'] == false }
                    <div class="archivos">
                        {foreach item=n from=$files}
                            <div class="file">
                                <a class="file_name" id="file_name-{$$n[id]}" href="/upload_archivos/adm_pedido_compras/{$$n[nombre]}" target="_blank">
                                    <span>{$$n[nombre]}</span>
                                </a>
                                <a class="del_file" id="file-{$$n[id]}" href="#" style="">
                                    <img border="0" alt="quitar" src="img/iconos/delete.gif" class="del_gasto" id="id_gastos-">
                                </a>
                            </div>
                        {/foreach}
                    </div>
                {/if}
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="agregar" type="submit" id="enviar" class="enviar" value="Agregar"/>
            </div>
        </form>
        <form class="box-entrada" name="add_hotel" action="/adm_pedido_compras.html" method="post" enctype="multipart/form-data" >
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

