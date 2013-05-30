<link href="/css/adm_pedido_caja_chica.css" rel="stylesheet" type="text/css" />
<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>

<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="flash_error"></div>
    <div class="flash_notice"></div>
    {if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
    {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(/img/fondos/bg_cuenta.jpg) right top repeat-y;">
        <div id="hilo"> Bienvenido:   {$nombre_empleado}</div>
        <hr />
        <h1 class="azul bold"><span class="txt22 normal">Pedido de Compras</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$fecha_inicio}</span></p>
        <hr />
        <p>Sector: <span class="azul">{$area_inicio}</span></p>
        <p>Empleado:<span class="azul">{$nombre_inicio}</span></p>
        <p>Monto total:<span class="azul">{$monto_total}</span></p>
        <form class="box-entrada">
            <div class="box-entrada" height="40" bgcolor="#D2E1F2">
                <div class="observaciones padding10">
                    <label> Observaciones: </label>
                    <textarea name="observaciones" rows="2" readonly="yes">{$tabla[0][observaciones]}</textarea>
                </div>
                <div class="archivos clear">
                    <div class="file">
                        <a class="file_name" href="/upload_archivos/adm_pedido_caja_chica/{$tabla[0]['archivo']}" target="_blank">
                            <span>Archivo: {$tabla[0]['archivo']}</span>
                        </a>
                    </div>
                </div>
                <!-- <input name="id_tabla" type="hidden" value="{$id_tabla}" /> -->
                <!-- <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" /> -->
                <!-- <input name="observacion" type="hidden" value="{$observaciones[0][observaciones]}" /> -->
                <!-- <input name="new_observacion" type="hidden" value="{$new_observacion}" /> -->
            </div>
        </form>
        <hr />
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario" colspan="7">
            <tr>
                <td  class="tableTitle"><p class="blanco cuenta">Cuenta </p></td>
                <td  class="tableTitle"><p class="blanco">Descripción</p></td>
                <td  class="tableTitle"><p class="blanco detalla">Detalle</p></td>
                <td  class="tableTitle"><p class="blanco proveedor">Proveedor</p></td>
                <td  class="tableTitle"><p class="blanco factura">Factura</p></td>
                <td  class="tableTitle"><p class="blanco area">Area</p></td>
                <td  class="tableTitle"><p class="blanco monto">Monto</p></td>
            </tr>
            <!-- traigo de la base de datos, los gastos cargados, si ex que existen -->
            {if $tabla_sec['error'] == false }
                {foreach item=gd from=$tabla_sec }
                    <tr id="id_gastos-{$$gd[id]}">
                        <td> <span class="cuenta">{$$gd[cuenta]}</span> </td>
                        <td> <span class="descripcion">{$$gd[descripcion]}</span> </td>
                        <td> <span class="detalle">{$$gd[detalle]}</span> </td>
                        <td> <span class="proveedor">{$$gd[nombre]}</span> </td>
                        <td> <span class="area">{$$gd[factura]}</span> </td>
                        <td> <span class="mes">{$$gd[area]}</span> </td>
                        <td> <span class="monto">{$$gd[monto]|number_format:2:",":""}</span> </td>
                    </tr>
                {/foreach}
            {/if}
        </table>
        <form class="box-entrada">
            <div class="archivos padding10">
                {foreach item=n from=$nombres_archivos}
                    <div class="file">
                        <a class="file_name" id="file_name-{$$n[id]}" href="    /upload_archivos/adm_ytd_mantenimientos/{$$n[nombre]}">
                            <span>Archivo: Archivo 1</span>
                        </a>
                        <a class="del_file" id="file-{$$n[id]}" href="#" style="floet:left;">
                            <img border="0" alt="quitar" src="img/iconos/delete.gif" class="del_gasto" id="id_gastos-">
                        </a>
                    </div>
                {/foreach}
            </div>
        </form>  
        <form class="box-coment" name="box_coment" action="/adm_pedido_caja_chica_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
            <div class="title"> Comentarios: </div>
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
