<link href="/css/cpr_pedidos_ej_busqueda.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/meio.mask.min.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(function($) {
        $('input[name="precio_deseado"]').setMask();
        $.mask.masks.decimal = {mask : '99,999999', type : 'reverse', defaultValue: '000'}
        $('input[name="precio_deseado"]').setMask();
        $.mask.masks = $.extend($.mask.masks, {decimal: { mask: '999' }});
    });
</script>

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
        <h1 class="azul bold"><span class="txt22 normal">Pedidos de ejemplos de búsqueda</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p class="txt10 uppercase">Empleado:<span class="azul">{$nombre_empleado}</span></p>
        <p class="txt10 uppercase">Area:<span class="azul">{$area}</span></p>


        <!-- BOX DE ENTRADA. TABLA PRINCIPAL -->
        <form class="box-entrada" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="campania">
                        <label class="primerElement">Pedido:</label>
                        {if $tabla[0]['nombre_pedido'] == '' }
                            <input name="nombre_pedido" type="text" readonly="readonly" value='{$nombre_pedido}' alt="Pedido" />
                        {else}
                            <input name="nombre_pedido" type="text" readonly="readonly" value='{$tabla[0]["nombre_pedido"]}' alt="Pedido" />
                        {/if}
                    </div>
            </div>
        </form>

        <!-- LISTADO DE PRODUCTOS -->
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Nombre</p></td>
                <td width="250" align="left" bgcolor="#4685CA"><p class="blanco">Detalle</p></td>
                <td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Cantidad</p></td>
                <td width="45" align="left" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=ts from=$tabla_sec }
                    <tr id="id_cl-{$$cl[solicit_cliente]}">
                        <td> <span>{if $$ts['nombre'] != ''} {$$ts[nombre]} {else} Subiendo archivos y fotos actualmente. Recuerde agregar el registro al final.{/if} </span> </td>
                        <td> <span>{if $$ts['detalle'] != ''} {$$ts[detalle]} {else} sin detalle {/if}</span></td>
                        <td> <span>{if $$ts['cantidad'] != ''} {$$ts[cantidad]} {else} sin cantidad {/if}</span></td>
                        <td>
                        <a href="#">
                            <img id="id_gastos-{$$gd[id]}" class="del_gasto" src="img/iconos/delete.gif" alt="quitar" border="0" />
                        </a>
                        <a href="#">
                            <img id="id_gastos-{$$gd[id]}" class="edit_gasto" src="img/iconos/edit.gif" alt="editar" border="0" />
                        </a>
                        </td>
                   </tr>
                {/foreach}
            {/if}

        </table>

        <!-- PRODUCTOS, BOX DE ENTRADA -->
        <form class="box-entrada" action="/cpr_pedidos_ej_busqueda.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <!-- tengo que tener el nombre_pedido -->
                {if $tabla[0]['nombre_pedido'] == '' }
                    <input name="nombre_pedido" type="hidden" value='{$nombre_pedido}' alt="Pedido" />
                {else}
                    <input name="nombre_pedido" type="hidden" value='{$tabla[0]["nombre_pedido"]}' alt="Pedido" />
                {/if}
                <div class="izq clear"><p class="primerElement azul bold">DETALLES:</p></div>
                <div class="izq clear">
                    <div class="campania">
                        <label>Nombre:</label>
                        <input name="nombre" type="text" value=''  alt="Nombre" />
                    </div>
                    <div class="campania">
                        <label>Detalle:</label>
                        <input name="detalle" type="text" value=''  alt="Detalle" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label>Cantidad:</label>
                        <input name="cantidad" type="text" value=''  alt="Cantidad" />
                    </div>
                    <div class="campania">
                        <label>Precio Deseado:</label>
                        <input name="precio_deseado" type="text" value=''  alt="decimal" />
                    </div>
                </div>
                <div class="observacionesChico clear">
                    <label> Observaciones: </label>
                    <textarea name="observaciones"></textarea>
                </div>

                <!-- FOTO -->
                <div class="archivo">
                    <label class="block"> Foto : </label>
                    <input type="file" class="inline" name="foto" value="" />
                    <input type="submit" class="inline" name="subir_foto" value="Subir Foto" />
                </div>
                <div class="archivos clear">
                    {foreach item=fot from=$fotos}
                        {if $$fot != ''}
                            <div class="file marginLat10">
                                <a class="file_name" id="file_name-{$$fot[id]}" href="/upload_archivos/cpr_pedidos_ej_busqueda/{$$fot[nombre]}">
                                    <span>Foto: {$$fot}</span>
                                </a>
                                <a class="del_file" id="file-{$$fot[id]}" href="#" style="float:left;">
                                    <img border="0" id="id_gastos-" class="del_foto"  alt="quitar" src="/img/iconos/delete.gif" >
                                </a>
                            </div>
                        {/if}
                    {/foreach}
                </div>

                <!-- ARCHIVO -->
                <div class="archivo">
                    <label class="block"> Archivo : </label>
                    <input type="file" class="inline" name="archivo" value="" />
                    <input type="submit" class="inline" name="subir_archivo" value="Subir Archivo" />
                </div>
                <div class="archivos clear">
                    {foreach item=arch from=$archivos}
                        {if $$arch != ''}
                            <div class="file marginLat10">
                                <a class="file_name" id="file_name-{$$arch[id]}" href="/upload_archivos/cpr_pedidos_ej_busqueda/{$$arch[nombre]}">
                                    <span>Archivo: {$$arch}</span>
                                </a>
                                <a class="del_archivo" id="file-{$$arch[id]}" href="#" style="floet:left;">
                                    <img border="0"  id="id_gastos-" class="del_archivo"  alt="quitar" src="/img/iconos/delete.gif">
                                </a>
                            </div>
                        {/if}
                    {/foreach}
                </div>
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="reg_sec_nuevo" type="hidden" value="{$reg_sec_nuevo}" />
                <input name="actual_key" type="hidden" value="{$actual_key}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="id_tabla_sec" type="hidden" value="{$id_tabla_sec}" />
                <input name="agregar_prod" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>
        <form class="box-entrada" action="/cpr_pedidos_ej_busqueda.html" method="post" enctype="multipart/form-data" >
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
