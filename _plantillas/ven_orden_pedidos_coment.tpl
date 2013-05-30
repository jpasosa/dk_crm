<link href="/css/ven_orden_pedidos.css" rel="stylesheet" type="text/css" />
<div style="width:994px; height:23px; background:url(img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
    <div id="fondoCatalogo" style="background:url(img/fondos/bg_cuenta.jpg) center top repeat-y;">
        <div class="flash_error"></div>
        <div class="flash_notice"></div>
        {if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
        {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
        {template tpl="menu_izq"}
        <div id="derecha" class="catalogo" style="background:url(/img/fondos/bg_cuenta.jpg) right top repeat-y;">
        <div id="hilo">
            {if $nombre_cliente != '' }
                Bienvenido: {$nombre_cliente}
            {else}
                Bienvenido: {$nombre_empleado}
            {/if}
        </div>
        <hr />
        <h1 class="azul bold"><span class="txt22 normal">Orden de Pedidos</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul"> {$fecha_inicio}</span></p>
        <hr />
        <p>Carga Orden:<span class="azul">{if $nombre_cliente != '' } CLIENTE{else} VENDEDOR{/if}</span></p>
        <hr/>
        {if $nombre_cliente != '' }
            <p>Cliente: <span class="azul"> {$nombre_cliente}</span></p>
        {else}
            <p>Vendedor:<span class="azul"> {$nombre_inicio}</span></p>
        {/if}
        <form class="box-entrada">
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="clienteComent">
                    <label> Cliente: </label>
                    <input name="cliente" class="cliente" readonly="readonly" type="text" value="{$tabla[0][empresa]}  |  {$tabla[0][nombre_sucursal]}" />
                </div>
                <div class="paisComent">
                    <label> Pais / Ciudad: </label>
                    <input name="pais" class="pais" readonly="readonly" type="text" value="{$tabla[0][pais]}  |  {$tabla[0][provincia]}" />
                </div>
                <div class="direccionComent">
                    <label> Dirección: </label>
                    <input name="direccion" readonly="readonly" class="direccion" type="text" value="{$tabla[0][direccion]}" />
                </div>
            </div>
        </form>
        <hr />
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario" colspan="7">
            <tr>
                <td  class="tableTitle"><p class="referencia">Referencia </p></td>
                <td  class="tableTitle"><p class="blanco producto">Producto</p></td>
                <td  class="tableTitle"><p class="blanco cantidad">Cantidad</p></td>
                <td  class="tableTitle"><p class="blanco unidades">Unidades</p></td>
                <td  class="tableTitle"><p class="blanco precio">Precio</p></td>
                <td  class="tableTitle"><p class="blanco foto">Foto</p></td>
            </tr>
            <!-- traigo de la base de datos, los gastos cargados, si ex que existen -->
            {if $gast_detalles['error'] == false }
                {foreach item=prod from=$tabla_sec }
                    <tr id="id_gastos-{$$gd[id]}">
                        <td> <span class="referencia">{$$prod[referencia]}</span> </td>
                        <td> <span class="producto">{$$prod[producto]}</span> </td>
                        <td> <span class="cantidad">{$$prod[cantidad]}</span> </td>
                        <td> <span class="unidades">{$$prod[unidades]}</span> </td>
                        <td> <span class="precio">{$$prod[precio]}</span> </td>
                        <td>
                            <a href="#">
                                <img class="view_image" src="/img/iconos/lupa.jpg" alt="ver" border="0" />
                            </a>
                        </td>
                    </tr>
                {/foreach}
            {/if}
        </table>
        <hr/>
        <form class="box-coment" name="box_coment" action="/ven_orden_pedidos_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
            {if $all_comments['error'] != true }
                {foreach item=com from=$all_comments }
                    <div class="coment_ant">
                    <div class="datoComent"> {$$com[fecha_alta]} </div>
                    <div class="datoComent"> {$$com[area]} </div>
                    <div class="datoComent"> {$$com[estado]} </div>
                    <div class="coment"> {$$com[comentario]} </div>
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
                    <textarea name="comentario" rows="2"></textarea>
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
