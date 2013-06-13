<link href="/css/ven_pedido_muestra.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/ven_pedido_muestra/abm_search.js"></script>

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
        <h1 class="azul bold"><span class="txt22 normal">Pedido de Muestras</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p class="txt10 uppercase">Empleado:<span class="azul"> {$nombre_empleado}</span></p>
        <p class="txt10 uppercase">Area:<span class="azul"> {$area}</span></p>
        <form class="box-entrada" name="add_hotel" action="/ven_pedido_muestra.html" method="post" enctype="multipart/form-data" >
                <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                    <div class="izq">
                        <div class="campania">
                            <label> Cliente: </label>
                            <select name="id_ven_cliente">
                                {foreach item=vc from=$ven_cliente}
                                <option value="{$$vc[id_ven_cliente]}" {if $$vc['id_ven_cliente'] == $tabla[0]['id_ven_cliente'] } selected {/if}> {$$vc[empresa]} </option>
                            {/foreach}    
                            </select>
                        </div>
                    </div>
                    <div class="observacionesChico clear">
                        <label> Observaciones: </label>
                        <textarea name="observaciones">{$tabla[0]['observaciones']}</textarea>
                    </div>
                    <input name="first_time" type="hidden" value="{$first_time}" />
                    <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                    <input name="id_tabla" type="hidden" value="{$id_tabla}" />                              
                    <input type="submit" name="agregar" class="agregar" value="Agregar"/>
                </div>    
        </form>


        <!-- LISTADO DE LAS MUESTRAS -->
        <p class="azul bold">MUESTRAS</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="188" bgcolor="#4685CA"><p class="blanco">Referencia </p></td>
                <td width="310" align="left" bgcolor="#4685CA"><p class="blanco">Producto</p></td>
                <td width="149" align="left" bgcolor="#4685CA"><p class="blanco">Cantidad</p></td>
                <td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=ts from=$tabla_sec }
                    <tr id="id_tabla_sec-{$$ts[id_ven_pedido_muestra_prod]}">
                        <td><span id="{$$ts[id_pro_productos]}" class="referencia">{$$ts[referencia]}</span></td>
                        <td><span class="referencia">{$$ts[producto]}</span></td>
                        <td> <span class="cantidad">{$$ts[cantidad]}</span></td>
                        <td>
                            <a href="#">
                                <img id="id_tabla_sec-{$$ts[id_ven_pedido_muestra_prod]}" class="del_tabla_sec" src="/img/iconos/delete.gif" alt="quitar" border="0" />
                            </a> 
                            <a href="#">
                                <img id="id_tabla_sec-{$$ts[id_ven_pedido_muestra_prod]}" class="edit_tabla_sec" src="/img/iconos/edit.gif" alt="editar" border="0" />
                            </a>
                        </td>
                    </tr>
                {/foreach}
            {/if}
        </table>
        <!-- INGRESO DE MUESTRAS -->
        <form class="box-entrada" name="add_hotel" action="/ven_pedido_muestra.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label> referencia: </label>
                        <select name="id_pro_producto" class="referencia">
                            {foreach item=pr from=$pro_productos_select}
                                <option value="{$$pr[id_pro_productos]}" {if $$pr['id_pro_productos'] == $referencia } selected {/if}> {$$pr[referencia]} </option>
                            {/foreach}    
                        </select>
                    </div>
                    <div class="campania">
                        <label> Cantidad: </label>
                        <input name="cantidad" class="cantidad" type="text" value=""  />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label> Producto: </label>
                        <select name="producto" class="producto">
                            {foreach item=prod from=$pro_productos_select}
                                <option value="{$$prod[id_pro_productos]}" {if $$prod['id_pro_productos'] == $producto } selected {/if}> {$$prod[producto]} </option>
                            {/foreach}    
                        </select>
                    </div>
                </div>
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />                              
                <input type="submit" name="agregar_suc" class="agregar" value="Agregar"/>
            </div>    
        </form>


        <form class="box-entrada" name="add_hotel" action="/ven_pedido_muestra.html" method="post" enctype="multipart/form-data" >
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
