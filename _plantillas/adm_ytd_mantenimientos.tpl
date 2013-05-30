<!-- Estilos -->
<link href="css/formCommon.css" rel="stylesheet" type="text/css" />
<link href="css/adm_ytd_mantenimientos.css" rel="stylesheet" type="text/css" />
<!-- <script type="text/javascript" src="js/adm_ytd_mantenimientos/abm.js"></script> -->
<link href="css/jquery-ui.css" rel="stylesheet" type="text/css" /><!-- para del datepicker -->
<script type="text/javascript" src="js/adm_ytd_mantenimientos/del_file.js"></script>
<script> $(function() {$( "#fecha_inicio" ).datepicker({ dateFormat: 'dd/mm/yy' });});</script>

<div style="width:994px; height:23px; background:url(img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;">
</div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
        <div class="flash_error"></div> <!-- estos van a saltar por AJAX -->
        <div class="flash_notice"></div>
        {if $flash_error != '' }
            <div class="disp_error"> {$flash_error} </div> <!-- estos vienen del controlador -->                    
        {/if}
        {if $flash_notice != '' }
            <div class="disp_notice"> {$flash_notice} </div> <!-- estos vienen del controlador -->                    
        {/if}
        {template tpl="menu_izq"}
        <div id="derecha" class="catalogo" style="background:url(img/fondos/bg_cuenta.jpg) right top repeat-y;" >
            <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
            <hr />

            <h1 class="azul bold"><span class="txt22 normal">Administración</span> | YTD Mantenimientos </h1>
            <hr />
            <p class="txt10 uppercase">Fecha de inicio del trámite: <span class="azul">{$date}</span></p>
            <hr />
            <form class="box-entrada" name="add_observaciones" action="/adm_ytd_mantenimientos.html" method="post" enctype="multipart/form-data" >
                <div class="box-entrada" height="40" bgcolor="#D2E1F2">
                    <div class="asunto">
                        <label> Asunto: </label>
                        <input name="asunto" class="asunto" value="{$tabla[0][asunto]}">
                    </div>
                    <div class="observaciones">
                        <label> Observaciones: </label>
                        <textarea name="observaciones" rows="2">{$tabla[0][observaciones]}</textarea>
                    </div>
                    <div class="fecha_inicio">
                        <label> Fecha Inicio: </label>
                        {if $tabla[0][fecha_inicio] == '' }
                            <input name="fecha_inicio" id="fecha_inicio" class="fecha_inicio" value="" />
                        {else}
                            <input name="fecha_inicio" id="fecha_inicio" class="fecha_inicio" value='{$tabla[0][fecha_inicio]|date_format:"d/m/Y"}' />
                        {/if}
                    </div>
                    <div class="x_tiempo">
                        <label> Tiempo: </label>
                        <input name="x_tiempo" class="x_tiempo" value="{$tabla[0][cada_x_tiempo]}" />
                    </div>

                    <div class="periodicidad">
                        <label> Periodicidad </label>
                        <select name="periodicidad" class="periodicidad">
                            {foreach item=pe from=$sel_period}
                                <option value="{$$pe[id_valor]}" {if $$pe['id_valor'] == $tabla[0]['id_sis_periodicidad'] } selected {/if}> {$$pe[valor]} </option>
                            {/foreach}     
                        </select>
                    </div>
                    <div class="archivo">
                                <label class="archivo"> Archivo </label>
                                <input type="file" class="archivo" name="archivo" value="quepasavieja" />
                    </div>
                    <input name="subir_archivo" class="subir_archivo" type="submit" value="Subir Archivo" />
                    {if $files['error'] == false }
                        <div class="archivos">
                            {foreach item=n from=$files}
                                <div class="file">
                                    <a class="file_name" id="file_name-{$$n[id]}" href="/upload_archivos/adm_ytd_mantenimientos/{$$n[nombre]}">
                                        <span>Archivo: ({$$n[nombre]})</span>
                                    </a>
                                    <a class="del_file" id="file-{$$n[id]}" href="#" style="floet:left;">
                                        <img border="0" alt="quitar" src="img/iconos/delete.gif" class="del_gasto" id="id_gastos-">
                                    </a>
                                </div>
                            {/foreach}
                        </div>
                    {/if}
                    <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                    <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                    <input name="agregar_mantenimiento" class="agregar_mantenimiento" type="submit" value="Agregar Mantenimiento" />
                </div>
            </form>
            <hr />

            <p class="azul txt18" style="margin:0px 0 10px 0;">Mantenimientos anteriores:</p>
            <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario" colspan="7">
                <tr>
                    <td  width="100" bgcolor="#4685CA"><p class="blanco">Fecha </p></td>
                    <td  width="100" align="left" bgcolor="#4685CA"><p class="blanco">Resultado</p></td>
                    <td  width="100"  bgcolor="#4685CA"><p class="blanco">Detalle</p></td>
                    <td  width="100"  bgcolor="#4685CA"><p class="blanco">Costo</p></td>
                    <td  width="100"  bgcolor="#4685CA"><p class="blanco">Adjuntos</p></td>
                </tr>



                <!-- traigo de la base de datos, los hoteles cargados -->
                {foreach item=gd from=$gast_detalles }
                <tr id="id_gastos-{$$gd[id]}">
                    <td> <span class="cuenta">{$$gd[cuenta]}</span> </td>
                    <td> <span class="descripcion">{$$gd[descripcion]}</span> </td>
                    <td> <span class="detalle">{$$gd[detalle]}</span> </td>
                    <td> <span class="proveedor">{$$gd[proveedor]}</span> </td>
                    <td> <span class="mes">{$$gd[mes]}</span> </td>
                    <td> <span class="monto">{$$gd[monto]}</span> </td>
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
            </table>
            
            <form class="box-entrada" name="add_hotel" action="/adm_ytd_mantenimientos.html" method="post" enctype="multipart/form-data" >
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