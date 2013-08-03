<link href="/css/tra_carga_mercaderia_transito.css" rel="stylesheet" type="text/css" />

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
        <form class="box-entrada" name="add_hotel" action="/tra_carga_mercaderia_transito/{$id_tra_packing_list}.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Proveedor:</label>
                        <input class="ultimoElement" readonly="readonly" type="text" value='{$tabla[0]["nombre"]}' />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement">Packing List:</label>
                        <input type="text" readonly="readonly" value='{$tabla[0]["nombre_trapackinglist"]}'  alt="Packing List" />
                    </div>
                </div>
                <div class="izq clear"><p class="azul bold">ENTREGA</p></div>
                <div class="izq clear">
                    <div class="campania">
                        <label >Fecha Envío:</label>
                        <input type="text" readonly="readonly" value='{$tabla[0]["fecha_envio"]|date_format:"d/m/Y"}'  alt="" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label>Fecha Llegada:</label>
                        <input type="text" readonly="readonly" value='{$tabla[0]["fecha_llegada"]|date_format:"d/m/Y"}' />
                    </div>
                </div>
                <div class="observacionesChico clear">
                    <label> Observaciones: </label>
                    <textarea name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
            </div>
        </form>

        <form class="box-entrada" action="/tra_carga_mercaderia_transito/{$id_tra_packing_list}.html" method="post" enctype="multipart/form-data" >
            <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
                <tr>
                    <td align="left" bgcolor="#4685CA"><p class="blanco">Producto</p></td>
                        <td align="left" bgcolor="#4685CA"><p class="blanco">Precio</p></td>
                        <td align="left" bgcolor="#4685CA"><p class="blanco">Foto</p></td>
                    </tr>
                    {if $tabla_sec['error'] == false }
                        {foreach item=tpl from=$tabla_sec }
                            <tr id="id_cl-{$$cl[solicit_cliente]}">
                                <td> <span title="{$$tpl[detalle]}  |  Productos por Caja: {$$tpl[productos_por_caja_tcmt]}  |  Alto: {$$tpl[alto_tcmt]}   |  Ancho: {$$tpl[ancho_tcmt]}  | Fondo: {$$tpl[fondo_tcmt]} |  Volumen:  {$$tpl[volumen_tcmt]} ">{$$tpl[producto]}</span></td>
                                <td>
                                    <span>{$$tpl[precio_tcmt]}</span>
                                </td>
                                <td>
                                    <span>
                                        <a href="#">ver foto</a>
                                    </span>
                                </td>
                            </tr>
                        {/foreach}
                    {/if}
            </table>

            <input name="first_time" type="hidden" value="{$first_time}" />
            <input name="id_tra_packing_list" type="hidden" value="{$id_tra_packing_list}" /> <!-- el id principal de la tabla anterior, de tra_packing_list -->
            <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
            <input name="id_tabla" type="hidden" value="{$id_tabla}" />
            <!-- <inpuut type="hidden" name="precio[]" value="" /> -->
        </form>

        <form class="box-coment" name="box_coment" action="/tra_carga_mercaderia_transito_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
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













