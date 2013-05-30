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
        <h1 class="azul bold"><span class="txt22 normal">YTD Entradas</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$fecha_inicio}</span></p>
        <p>Nombre:<span class="azul">{$nombre_inicio}</span></p>
        <p>Packing List:<span class="azul">546521</span></p>
        <div class="marginTop20">
            <p>Control de Productos</p>
        </div>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Referencia</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Marca</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Familia</p></td>
                <td width="70" align="left" bgcolor="#4685CA"><p class="blanco">Subfamilia</p></td>
                <td width="70" align="left" bgcolor="#4685CA"><p class="blanco">Ref. Prod.</p></td>
                <td width="70" align="left" bgcolor="#4685CA"><p class="blanco">Problema</p></td>
                <td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Nro. Caja</p></td>
                <td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Unidad x Bulto</p></td>
                <td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Acción</p></td>
                <td width="50" align="left" bgcolor="#4685CA"><p class="blanco">Foto</p></td>
            </tr>
            {if $tabla_sec['error'] == false }
                {foreach item=ts from=$tabla_sec }
                    <tr id="id_cl-{$$cl[solicit_cliente]}">
                        <td><span>{$$ts[referencia]}</span></td>
                        <td> <span>{$$ts[marca]}</span></td>
                        <td> <span>{$$ts[familia]}</span></td>
                        <td> <span>{$$ts[subfamilia]}</span></td>
                        <td> <span>{$$ts[refProd]}</span></td>
                        <td> <span>{$$ts[problema]}</span></td>
                        <td> <span>{$$ts[nroCaja]}</span></td>
                        <td> <span>{$$ts[unidadXBulto]}</span></td>
                        <td>
                        <a href="#">
                            <img id="id_gastos-{$$gd[id]}" class="del_gasto" src="img/iconos/delete.gif" alt="quitar" border="0" />
                        </a> 
                        <a href="#">
                            <img id="id_gastos-{$$gd[id]}" class="edit_gasto" src="img/iconos/edit.gif" alt="editar" border="0" />
                        </a>
                        </td>
                        <td> <span><a>[VER]</a></span></td>
                    </tr>
                {/foreach}
            {/if}
        </table>
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="observacionesChico clear">
                    <label> Observaciones: </label>
                    <textarea readonly="yes" name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
                <div class="archivos">
                    {foreach item=n from=$nombres_archivos}
                        <div class="file marginLat10">
                            <a class="file_name" id="file_name-{$$n[id]}" href="/upload_archivos/adm_ytd_mantenimientos/{$$n[nombre]}">
                            <span>Archivo: Archivo 1</span>
                            </a>
                            <a class="del_file" id="file-{$$n[id]}" href="#" style="floet:left;">
                            <img border="0" alt="quitar" src="img/iconos/delete.gif" class="del_gasto" id="id_gastos-">
                            </a>
                        </div>
                    {/foreach}
                </div>
            </div>
        </form>
        <form class="box-coment" name="box_coment" action="/form_example_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
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
