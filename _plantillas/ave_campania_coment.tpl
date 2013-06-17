<link href="/css/ave_campania.css" rel="stylesheet" type="text/css" />

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
        <h1 class="azul bold"><span class="txt22 normal">Armado de Campaña</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Campaña:</label>
                        <input readonly="yes" name="campania" type="text" value=''  alt="Campaña" />
                    </div>
                    <div class="campania">
                        <label>Motivo:</label>
                        <input readonly="yes"  class="ultimoElement" name="motivo" type="text" value=''  alt="Motivo" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement">Fecha Inicio:</label>
                        <input readonly="yes"  name="fechaInicio" type="text" value=''  alt="Fecha inicio" />
                    </div>
                    <div class="campania">
                        <label>Hora:</label>
                        <input readonly="yes"  class="ultimoElement" name="hora" type="text" value=''  alt="Hora" />
                    </div>                  
                </div>
                <div class="izq clear"><p class="azul bold">MAILING</p></div>
                <div class="izq clear">
                    <div class="campania">
                        <label>Fecha de Inicio:</label>
                        <input readonly="yes"  name="fechaInicioMailing" type="text" value=''  alt="Fecha de Inicio" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label>Asunto:</label>
                        <input readonly="yes"  name="asunto" type="text" value=''  alt="Asunto" />
                    </div>                    
                </div>
                <div class="observacionesChico clear">
                    <label> Texto: </label>
                    <textarea readonly="yes"  name="texto">{$tabla[0]['observaciones']}</textarea>
                </div>
                <div class="archivos clear">
                    {foreach item=n from=$nombres_mail}
                        <div class="file marginLat10">
                            <a class="file_name" id="file_name-{$$n[id]}" href="/upload_archivos/adm_ytd_mantenimientos/{$$n[nombre]}">
                            <span>Mail: Mail 1</span>
                            </a>
                            <a class="del_file" id="file-{$$n[id]}" href="#" style="floet:left;">
                            <img border="0" alt="quitar" src="img/iconos/delete.gif" class="del_gasto" id="id_gastos-">
                            </a>
                        </div>
                    {/foreach}
                </div>
            </div>
        </form>
        <p class="azul bold">LLAMADAS A CLIENTES</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td bgcolor="#4685CA"><p class="blanco">Cliente </p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Contacto</p></td>
                <td width="92" align="center" bgcolor="#4685CA"><p class="blanco">Horario</p></td>
                <td width="52" align="center" bgcolor="#4685CA"><p class="blanco">Accion</p></td>
            </tr>
            {foreach item=gast from=$clientes_gastos }
            <tr id="id_gast-{$$gast[id]}">
                <td><span id="ref-{$$gast[id_ref]}">{$$gast[cliente]}</span></td>
                <td><span >{$$gast[contacto]}</span></td>
                <td align="center"><span>{$$gast[Horario]|number_format:2:",":""}</span></td>
                <td align="center">
                    <a href="#"><img id="id_gast-{$$gast[id]}" src="img/iconos/delete.gif" alt="quitar" border="0" /></a>
                    <a href="#"><img id="id_gast-{$$gast[id]}" src="img/iconos/edit.gif" alt="editar" border="0" /></a>
                </td>
            </tr>
            {/foreach}
            <tr id="id_gast-{$$gast[id]}">
                <td><span id="ref-{$$gast[id_ref]}">Distribuidora</span></td>
                <td><span >Pablo Torres</span></td>
                <td align="center"><span>15:30hs</span></td>
                <td align="center">
                    <a href="#"><img id="id_gast-{$$gast[id]}" src="img/iconos/delete.gif" alt="quitar" border="0" /></a>
                    <a href="#"><img id="id_gast-{$$gast[id]}" src="img/iconos/edit.gif" alt="editar" border="0" /></a>
                </td>
            </tr>    
        </table>
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Cliente:</label>
                        <select name="cliente" value=''  alt="Cliente" />
                            <option>OPTION1</option>
                            <option>OPTION2</option>
                        </select>
                    </div>   
                    <div class="campania">
                        <label>Contacto:</label>
                        <select class="ultimoElement" name="contacto" value=''  alt="Contacto" />
                            <option>OPTION1</option>
                            <option>OPTION2</option>
                        </select>
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement">Horario:</label>
                        <input name="horario" type="text" value=''  alt="Horario" />
                    </div>                                   
                </div>       
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar_fechas" class="agregar" type="submit" value="Agregar" />
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
