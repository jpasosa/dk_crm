<link href="/css/ven_orden_pedidos.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/ven_orden_pedidos/abm-search.js"></script>

<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
    <div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
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
            <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p><hr />
            <p>Carga Orden:<span class="azul">{if $nombre_cliente != '' }CLIENTE{else}VENDEDOR{/if}</span></p>
            <hr/>
            {if $nombre_cliente != '' }
                <p>Cliente: <span class="azul">{$nombre_cliente}</span></p>
            {else}
                <p>Vendedor:<span class="azul">{$nombre_empleado}</span></p>
            {/if}
            <form class="box-entrada" action="/ven_orden_pedidos.html" method="post" enctype="multipart/form-data" >
                <div class="box-entrada" height="40" bgcolor="#D2E1F2">
                    <div class="cliente">
                        <label> Cliente: </label>
                        <select name="cliente" class="cliente">
                            {foreach item=vc from=$ven_cliente_sucursales}
                                <option value="{$$vc[id_ven_cliente_sucursales]}" {if $$vc['id_ven_cliente_sucursales'] == $tabla[0]['id_ven_cliente_sucursales'] } selected {/if}>
                                    {$$vc[empresa]}  |  {$$vc[nombre_sucursal]}  
                                </option>
                            {/foreach}    
                        </select>
                    </div>
                    <div class="pais">
                        <label> País / Ciudad: </label>
                        <select name="pais" class="pais">
                            {foreach item=pr from=$paises}
                                <option value="{$$pr[id_sis_provincia]}" {if $$pr['id_sis_provincia'] == $pais } selected {/if}>
                                    {$$pr[pais]}  |  {$$pr[provincia]}
                                </option>
                            {/foreach}    
                        </select>
                    </div>
                    <div class="direccion">
                        <label> Dirección: </label>
                        <select name="direccion" class="direccion">
                            {foreach item=dir from=$clientes_direcciones}
                                <option value="{$$dir[id_ven_cliente_sucursales]}" {if $$dir['id_ven_cliente_sucursales'] == $tabla[0]['id_ven_cliente_sucursales'] } selected {/if}>
                                    {$$dir[direccion_vc]}
                                </option>
                            {/foreach}    
                        </select>
                    </div>
                    <div class="observaciones padding10">
                        <label> Observaciones: </label>
                        <textarea name="observaciones" rows="2">{$tabla[0][observacion]}</textarea>
                    </div>
                    <input name="direccion" type="hidden" value="{$direccion}" />
                    <input name="first_time" type="hidden" value="{$first_time}" />
                    <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                    <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                    <input name="agregar" class="agregar_gasto" type="submit" value="Agregar" />
                </div>
            </form>
            <hr />
            <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario" colspan="7">
                <tr>
                    <td  class="tableTitle"><p class="blanco referencia">Referencia </p></td>
                    <td  class="tableTitle"><p class="blanco producto">Producto</p></td>
                    <td  class="tableTitle"><p class="blanco cantidad">Cantidad</p></td>
                    <td  class="tableTitle"><p class="blanco unidades">Unidades</p></td>
                    <td  class="tableTitle"><p class="blanco precio">Precio</p></td>
                    <td  class="tableTitle"><p class="blanco foto">Foto</p></td>
                    <td  class="tableTitle"><p class="blanco accion">Accion</p></td>
                </tr>
                <!-- Traigo datos de base secundaria - Pedidos de PRODUCTOS -->
                {if $tabla_sec['error'] == false }
                    {foreach item=ped from=$tabla_sec }
                        <tr id="id_tabla_sec-{$$ped[id_ven_orden_pedidos_prod]}">
                            <td> <span id="{$$ped[id_pro_productos]}" class="referencia">{$$ped[referencia]}</span> </td>
                            <td> <span class="producto">{$$ped[producto]}</span> </td>
                            <td> <span class="cantidad">{$$ped[cantidad]}</span> </td>
                            <td> <span class="unidades">{$$ped[productos_por_caja]}</span> </td>
                            <td> <span class="precio">{$$ped[precio]}</span> </td>
                            <td>
                                <a href="#">
                                    <img class="view_image" src="/img/iconos/lupa.jpg" alt="ver" border="0" />
                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    <img id="id_tabla_sec-{$$ped[id_ven_orden_pedidos_prod]}" class="del_tabla_sec" src="/img/iconos/delete.gif" alt="quitar" border="0" />
                                </a> 
                                <a href="#">
                                    <img id="id_tabla_sec-{$$ped[id_ven_orden_pedidos_prod]}" class="edit_tabla_sec" src="/img/iconos/edit.gif" alt="editar" border="0" />
                                </a>
                            </td>
                        </tr>
                    {/foreach}
                {/if}
            </table>
            <form class="box-entrada" action="/ven_orden_pedidos.html" method="post" enctype="multipart/form-data" >
                <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                    <div class="izq">
                        <div class="referencia">
                            <label> referencia: </label>
                            <select name="referencia" class="referencia">
                                {foreach item=pr from=$pro_productos_select}
                                    <option value="{$$pr[id_pro_productos]}" {if $$pr['id_pro_productos'] == $referencia } selected {/if}> {$$pr[referencia]} </option>
                                {/foreach}    
                            </select>
                        </div>
                        <div class="cantidad">
                            <label> Cantidad: </label>
                            <input name="cantidad" class="cantidad" type="text" value="{$cantidad}" />
                        </div>
                        <div class="precio">
                            <label> precio: </label>
                            <input name="precio" id="decimal" class="precio" type="text" value="{$precio}" alt="decimal" />
                        </div>
                    </div>
                    <div class="der">
                        <div class="producto">
                            <label> Producto: </label>
                            <select name="producto" class="producto">
                                {foreach item=prod from=$pro_productos_select}
                                    <option value="{$$prod[id_pro_productos]}" {if $$prod['id_pro_productos'] == $producto } selected {/if}> {$$prod[producto]} </option>
                                {/foreach}    
                            </select>
                            <!-- <input name="producto" class="producto" type="text" /> -->
                        </div>
                        <input name="max" type="hidden" value="{$max}" />
                        <input name="min" type="hidden" value="{$min}" />
                        <input name="first_time" type="hidden" value="{$first_time}" />
                        <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                        <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                    </div>
                    <input name="agregar_prod" class="agregar_gasto" type="submit" value="Agregar" />
                </div>
            </form>
            
            <form class="box-entrada" name="add_hotel" action="/ven_orden_pedidos.html" method="post" enctype="multipart/form-data" >
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
