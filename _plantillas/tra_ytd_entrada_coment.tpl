<link href="/css/tra_ytd_entrada.css" rel="stylesheet" type="text/css" />

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
        <h1 class="azul bold"><span class="txt22 normal">Carga de Mercadería en Tránsito</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$fecha_inicio}</span></p>
        <p>Empleado:<span class="azul">{$nombre_inicio}</span></p>
        <form class="box-entrada" name="add_hotel" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Proveedor:</label>
                            <input class="ultimoElement" name="proveedor_nombre" readonly="readonly" type="text" value='{$tabla[0]["nombre"]}'  alt="Proveedor" />
                    </div>
                    <div class="campania">
                        <label class="primerElement">Packing List:</label>
                        <input name="packing_list" type="text" readonly="readonly" value="{$tabla[0]['nombre_trapackinglist']}"  alt="Packing List" />
                    </div>
                </div>
                <div class="observacionesChico clear">
                    <label> Observaciones: </label>
                    <textarea name="observaciones" readonly="readonly">{$tabla[0]['observaciones']}</textarea>
                </div>
            </div>
        </form>

        <div class="marginTop20"><p class="azul bold">CONTROL DE PRODUCTOS</p></div>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Producto</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Marca</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Familia</p></td>
                <td width="70" align="left" bgcolor="#4685CA"><p class="blanco">Problema</p></td>
                <td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
            </tr>
            {foreach item=ts from=$tabla_sec }
                <tr id="id_cl-{$$cl[solicit_cliente]}">
                    <td>
                        <span title="Detalle: {$$ts[detalle]} / Nro Caja: {$$ts[nro_caja_tye]} /  Productos por Caja: {$$ts[productos_por_caja_tye]} / Volumen: {$$ts[volumen_tye]}">
                            {$$ts[producto]}
                        </span>
                    </td>
                    <td> <span>{$$ts[marca]}</span></td>
                    <td> <span>{$$ts[familia]} | {$$ts[subfamilia]} </span></td>
                    <td> <span>{$$ts[problema]}</span></td>
                    <td> <a href="#">ver</a> </td>
                </tr>
            {/foreach}
        </table>


        <form class="box-coment" name="box_coment" action="/tra_ytd_entrada_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
            <div class="title"> Comentarios: </div>
            {if $all_comments['error'] != true }
                {foreach item=com from=$all_comments }
                    <div class="coment_ant">
                        <div class="fecha"> {$$com[fecha_alta]} </div>
                        <div class="area"> {$$com[area]} </div>
                        <div class="estado"> {$$com[estado]} </div>
                        <div class="comentario"> {$$com[comentario]} </div>
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
                    <textarea name="comentario" rows="2" redonly="true"></textarea>
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
