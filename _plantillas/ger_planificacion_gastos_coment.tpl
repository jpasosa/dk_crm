<link href="/css/ger_planificacion_gastos.css" rel="stylesheet" type="text/css" />

<!-- <link href="/css/formCommon.css" rel="stylesheet" type="text/css" /> -->
<!-- <script type="text/javascript" src="js/ger_planificacion_gastos/abm-search.js"></script> -->
<!-- <script type="text/javascript" src="js/meio.mask.min.js" charset="utf-8"></script> -->


<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    <div class="ger_planificacion_gastos" id="proc-{$id_tabla_proc}"> <!-- lo uso para ver el id del proceso -->
        <div class="flash_error"></div>
        <div class="flash_notice"></div>
        {if $flash_error != '' }<div class="disp_error"> {$flash_error} </div>{/if}
        {if $flash_notice != '' }<div class="disp_notice"> {$flash_notice} </div>{/if}
        {template tpl="menu_izq"}
        <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
            <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
            <hr />
            <h1 class="azul bold">Planificación de Gastos</h1>
            <hr />
            <p class="txt10 uppercase">Fecha de inicio del trámite: <span class="azul">{$fecha_inicio}</span></p>
            <hr />
            <p>Empleado: <span class="azul">{$nombre_inicio}</span></p>
            <p>
                Monto: <span class="monto_total azul">{$monto_total}</span>
            </p>
            <form class="box-entrada" method="post">
                <div class="box-entrada" height="40" bgcolor="#D2E1F2">
                    <div class="observaciones">
                        <label> Observaciones: </label>
                        <textarea name="observaciones" rows="2" readonly="true">{$tabla[0][observaciones]}</textarea>
                    </div>
                </div>
            </form>
            <hr />
            <p class="azul txt18" style="margin:0px 0 10px 0;">Planilla de Gastos:</p>
            <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario" colspan="7">
                {if $tabla_sec['error'] != true }
                    <tr>
                        <td  width="100" bgcolor="#4685CA"><p class="blanco">Cuenta </p></td>
                        <td  width="100" align="left" bgcolor="#4685CA"><p class="blanco">Descripción</p></td>
                        <td  width="100"  bgcolor="#4685CA"><p class="blanco">Detalle</p></td>
                        <td  width="100"  bgcolor="#4685CA"><p class="blanco">Proveedor</p></td>
                        <td  width="100"  bgcolor="#4685CA"><p class="blanco">Mes</p></td>
                        <td  width="100"  bgcolor="#4685CA"><p class="blanco">Monto</p></td>
                    </tr>
                    {foreach item=pg from=$tabla_sec }
                        <tr>
                            <td> <span class="cuenta">{$$pg[cuenta]}</span> </td>
                            <td> <span class="descripcion">{$$pg[descripcion]}</span> </td>
                            <td> <span class="detalle">{$$pg[detalle]}</span> </td>
                            <td> <span class="proveedor">{$$pg[nombre]}</span> </td>
                            <td> <span class="mes">{$$pg[mes]}</span> </td>
                            <td> <span class="monto">{$$pg[monto]|number_format:2:",":""}</span> </td>
                        </tr>
                    {/foreach}
                {else}
                    No existen registros cargados en la Base de Datos.
                {/if}
            </table>
            <hr />
            <form class="box-coment" name="box_coment" action="/ger_planificacion_gastos_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
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
    </div>
    <div style="width:741px; height:46px; float:right;" class="png_bg"></div>
    <br style="clear:both;" />
</div>

