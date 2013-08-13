<link href="/css/ger_otros_pedidos.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/ger_otros_pedidos/del_file.js"></script>

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
        <h1 class="azul bold"><span class="txt22 normal">Otros Pedidos</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p>Sector:<span class="azul">{$area}</span></p>
        <p>Nombre:<span class="azul">{$nombre_empleado}</span></p>
        <form class="box-entrada" action="/ger_otros_pedidos.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="cliente">
                    <label> Cliente: </label>
                    <select name="cliente" class="cliente">
                            {foreach item=vc from=$ven_cliente_contacto}
                                <option value="{$$vc[id_ven_cliente]}" {if $$vc['id_ven_cliente'] == $id_ven_cliente } selected {/if}>
                                    {$$vc[nombre_sucursal]} |  {$$vc[apellido]}, {$$vc[nombre]}
                                </option>
                            {/foreach}
                        </select>
                </div>
                <div class="area">
                    <label> Area: </label>
                    <select name="area" class="area">
                            {foreach item=pr from=$areas}
                                <option value="{$$pr[id_valor]}" {if $$pr['id_valor'] == $area } selected {/if}> {$$pr[valor]} </option>
                            {/foreach}
                    </select>
                </div>
                <div class="asunto">
                    <label>Asunto: </label>
                    <input name="asunto" type="text" value="{$tabla[0]['asunto']}" />
                </div>
                <div class="pedido">
                    <label>Pedido : </label>
                    <textarea name="pedido">{$tabla[0]['pedido']}</textarea>
                </div>
                <div class="archivo">
                    <label class="block"> Archivo : </label>
                    <input type="file" class="inline" name="archivo" value="" />
                    <input type="submit" class="inline" name="subir_archivo" value="Subir Archivo" />
                </div>
                {if $files['error'] == false }
                    <div class="archivos">
                        {foreach item=n from=$files}
                            <div class="file">
                                <a class="file_name" target="_blank" id="file_name-{$$n[id]}" href="/upload_archivos/ger_otros_pedidos/{$$n[nombre]}">
                                    <span>Archivo: {$$n[nombre]}</span>
                                </a>
                                <a class="del_file" id="file-{$$n[id]}" href="#" style="floet:left;">
                                    <img border="0" alt="quitar" src="img/iconos/delete.gif" class="del_gasto" id="id_gastos-">
                                </a>
                            </div>
                        {/foreach}
                    </div>
                {/if}
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input type="submit" name="agregar" id="enviar" class="enviar" value="Agregar" />
            </div>
        </form>
        <form class="box-entrada" name="add_hotel" action="/ger_otros_pedidos.html" method="post" enctype="multipart/form-data" >
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