<link href="/css/cpr_pedidos_muestras.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/cpr_pedidos_muestras/abm.js"></script>

<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
    {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(/img/fondos/bg_cuenta.jpg) right top repeat-y;" >
        <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
        <hr />
        <h1 class="azul bold"><span class="txt22 normal">Pedidos de Muestras</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p class="txt10 uppercase">Empleado:<span class="azul">{$nombre_empleado}</span></p>
        <p class="txt10 uppercase">Area:<span class="azul">{$area}</span></p>
        <form class="box-entrada" action="/cpr_pedidos_muestras.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Proveedor:</label>
                        <input name="proveedor" type="text" value="{$tabla[0]['proveedor']}"  alt="Proveedor" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label>País / Ciudad:</label>
                        <select name="provincia">
                            {foreach item=pais from=$paises}
                                <option value="{$$pais[id_sis_provincia]}" {if $$pais['id_sis_provincia'] == $tabla[0]['id_sis_provincia'] } selected {/if}>
                                    {$$pais[pais]} | {$$pais[provincia]}
                                </option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="campania">
                        <label>Dirección:</label>
                        <input name="direccion" type="text" value='{$tabla[0]["direccion"]}'  alt="direccion" />
                    </div>
                </div>
                <div class="observacionesChico clear">
                    <label> Observaciones: </label>
                    <textarea name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>

        <!-- LISTADO DE PRODUCTOS -->
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Referencia del Producto</p></td>
                <td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Cantidad</p></td>
                <td width="45" align="left" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=ts from=$tabla_sec }
                    <tr id="id_prod-{$$ts[id_cpr_pedidos_muestras_prod]}">
                        <td><span class="referencia_de_producto">{$$ts[referencia_de_producto]}</span></td>
                        <td> <span class="cantidad">{$$ts[cantidad]}</span></td>
                        <td>
                        <a href="#">
                            <img id="id_prod-{$$ts[id_cpr_pedidos_muestras_prod]}" class="del_prod" src="/img/iconos/delete.gif" alt="quitar" border="0" />
                        </a>
                        <a href="#">
                            <img id="id_prod-{$$ts[id_cpr_pedidos_muestras_prod]}" class="edit_prod" src="/img/iconos/edit.gif" alt="editar" border="0" />
                        </a>
                        </td>
                   </tr>
                {/foreach}
            {/if}
        </table>
        <!-- PRODUCTOS, BOX DE ENTRADA -->
        <form class="box-entrada" action="/cpr_pedidos_muestras.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq clear">
                    <div class="campania">
                        <label>Referencia del Producto:</label>
                        <input class="referencia_de_producto" name="referencia_de_producto" type="text" value=''  alt="Nombre" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label>Cantidad:</label>
                        <input class="cantidad" name="cantidad" type="text" value=''  alt="Cantidad" />
                    </div>
                </div>
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar_prod" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>
        <form class="box-entrada" action="/cpr_pedidos_muestras.html" method="post" enctype="multipart/form-data" >
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
