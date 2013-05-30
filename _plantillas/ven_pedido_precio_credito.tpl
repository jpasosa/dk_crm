<link href="/css/ven_pedido_precio_credito.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/ven_pedido_precio_credito/del_file.js"></script>

<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
    {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(/img/fondos/bg_cuenta.jpg) right top repeat-y;">
        <div id="hilo"> Bienvenido:  {$nombre_empleado}</div>
	     
        <hr />
        <h1 class="azul bold">
            <span class="txt22 normal">Ventas | Pedido de precio / Crédito especial</span>
        </h1>
        <hr />
        <p class="txt10 uppercase"> Fecha de inicio del trámite: <span class="azul">{$date}</span> </p>
        <hr />
        <p>Cliente:<span class="azul">ver esto, como se loguea e inserta acá</span></p>
        <p>Empleado:<span class="azul">{$nombre_empleado}</span></p>
        <form class="box-entrada" action="/ven_pedido_precio_credito.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="ven_cliente">
                    <label> Cliente: </label>
                    <select name="ven_cliente" class="ven_cliente">
                        {foreach item=vc from=$ven_cliente}
                            <option value="{$$vc[id_ven_cliente_contacto]}" {if $$vc['id_ven_cliente_contacto'] == $tabla[0]['id_ven_cliente_contacto'] } selected {/if}> {$$vc[apellido]} | {$$vc[nombre_sucursal]}  |  {$$vc[empresa]}  </option>
                        {/foreach}    
                    </select>
                </div>
                <label class="block primerElement">Pedido : </label>
                <textarea class="marginCero" name="pedido">{$tabla[0]['pedido']}</textarea>
                <div class="archivo">
                    <label class="block"> Archivo : </label>
                    <input type="file" class="inline" name="archivo" value="" />
                    <input name="subir_archivo" type="submit" class="inline"  value="Subir Archivo" />
                </div>
                {if $files['error'] == false }
                    <div class="archivos">
                        {foreach item=n from=$files}
                            <div class="file">
                                <a class="file_name" id="file_name-{$$n[id]}" target="_blank" href="/upload_archivos/ven_pedido_precio_credito/{$$n[nombre]}">
                                    <span>Archivo: ({$$n[nombre]})</span>
                                </a>
                                <a class="del_file" id="file-{$$n[id]}" href="#" style="floet:left;">
                                    <img border="0" alt="quitar" src="/img/iconos/delete.gif" class="del_gasto" id="id_gastos-">
                                </a>
                            </div>
                        {/foreach}
                    </div>
                {/if}
                <input name="agregar" type="submit" id="enviar" class="enviar" value="Agregar" />
	</div>
            <input name="first_time" type="hidden" value="{$first_time}" />
            <input name="id_tabla" type="hidden" value="{$id_tabla}" />
            <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
        </form>
        <form class="box-entrada" action="/ven_pedido_precio_credito.html" method="post" enctype="multipart/form-data" >
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

