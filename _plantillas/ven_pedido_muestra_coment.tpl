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
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$fecha_inicio}</span></p>
        <p class="txt10 uppercase">Empleado:<span class="azul"> {$nombre_inicio}</span></p>
        <p class="txt10 uppercase">Area:<span class="azul"> {$area_inicio}</span></p>
        <form class="box-entrada" name="add_hotel" action="" method="post" enctype="multipart/form-data" >
                <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                    <div class="izq">
                        <div class="campania">
                            <label> Cliente: </label>
                            <select name="id_ven_cliente" disabled="disabled">
                                <option value="{$tabla[0]['id_ven_cliente']}" > {$tabla[0]['empresa']} </option>
                            </select>
                        </div>
                    </div>
                    <div class="observacionesChico clear">
                        <label> Observaciones: </label>
                        <textarea name="observaciones" readonly="readonly">{$tabla[0]['observaciones']}</textarea>
                    </div>
                    <input name="first_time" type="hidden" value="{$first_time}" />
                    <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                    <input name="id_tabla" type="hidden" value="{$id_tabla}" />                              
                </div>    
        </form>


        <!-- LISTADO DE LAS MUESTRAS -->
        <p class="azul bold">MUESTRAS</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="188" bgcolor="#4685CA"><p class="blanco">Referencia </p></td>
                <td width="310" align="left" bgcolor="#4685CA"><p class="blanco">Producto</p></td>
                <td width="149" align="left" bgcolor="#4685CA"><p class="blanco">Cantidad</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=ts from=$tabla_sec }
                    <tr id="id_tabla_sec-{$$ts[id_ven_pedido_muestra_prod]}">
                        <td><span id="{$$ts[id_pro_productos]}" class="referencia">{$$ts[referencia]}</span></td>
                        <td><span class="referencia">{$$ts[producto]}</span></td>
                        <td> <span class="cantidad">{$$ts[cantidad]}</span></td>
                    </tr>
                {/foreach}
            {/if}
        </table>
        <hr/>
        <form class="box-coment" name="box_coment" action="/ven_pedido_muestra_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
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