<link href="/css/ven_cliente.css" rel="stylesheet" type="text/css" />

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
        <h1 class="azul bold"><span class="txt22 normal">Alta de Clientes</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$fecha_inicio}</span></p>
        <hr />
        <p>Sector:<span class="azul">{$area_inicio}</span></p>
        <p>Empleado:<span class="azul">{$nombre_inicio}</span></p>
        <form class="box-entrada" name="add_hotel" action="/ven_cliente.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq ultimoElement">
                    <div class="campania">
                        <label> Empresa: </label>
                        <input readonly="readonly" name="empresa" type="text" value="{$tabla[0][empresa]}"  />
                    </div>
                    <div class="campania">
                        <label> Sitio Web: </label>
                        <input readonly="readonly" name="sitioWeb" type="text" value="{$tabla[0][sitio_web]}"  />
                    </div>
                    <div class="campania">
                        <label> CUIT: </label>
                        <input readonly="readonly" name="cuit" type="text" value="{$tabla[0][identificacion_tributaria]}"  />
                    </div>
                </div>
                <div class="der ultimoElement">
                    <div class="campania">
                        <label> Teléfono: </label>
                        <input readonly="readonly" name="telefono" type="text" value="{$tabla[0][telefono]}"  />
                    </div>
                    <div class="campania">
                        <label> Mail solicitante: </label>
                        <input readonly="readonly" name="mail" type="text" value="{$tabla[0][mail_solicitante]}"  />
                    </div>
                    <div class="campania">
                        <label> País / Ciudad: </label>
                        <select disabled="disabled" name="provincia">
                            {foreach item=pais from=$paises}
                                <option value="{$$pais[id_sis_provincia]}" {if $$pais['id_sis_provincia'] == $tabla[0]['id_sis_provincia'] } selected {/if}> {$$pais[pais]} | {$$pais[provincia]}  </option>
                            {/foreach}    
                        </select>
                    </div>
                </div>
            <div class="observacionesChico clear">
                <label> Observaciones: </label>
                <textarea readonly="readonly" name="observaciones">{$tabla[0]['observaciones']}</textarea>
            </div> 
            </div>   
        </form>
        <p class="azul bold">SUCURSALES</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="188" bgcolor="#4685CA"><p class="blanco">Nombre </p></td>
                <td width="310" align="left" bgcolor="#4685CA"><p class="blanco">Dirección</p></td>
                <td width="149" align="left" bgcolor="#4685CA"><p class="blanco">Teléfono</p></td>
            </tr>
                {foreach item=ts from=$tabla_suc }
                    <tr id="id_cl-{$$cl[solicit_cliente]}">
                        <td><span>{$$ts[nombre_sucursal]}</span></td>
                        <td><span>{$$ts[direccion]}</span></td>
                        <td> <span>{$$ts[telefono]}</span></td>
                    </tr>
                {/foreach}
        </table>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario marginTop20">
            <tr>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Nombre</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Apellido</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Sucursal</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Sector</p></td>
                <td align="left" bgcolor="#4685CA"><p class="blanco">Puesto</p></td>
            </tr>
            {foreach item=cont from=$tabla_contactos }
                <tr id="id_cl-{$$cl[solicit_cliente]}">
                    <td> <span title="{$$cont[mail]} | {$$cont[telefono_contacto]} | {$$cont[celular]}">{$$cont[nombre]}</span></td>
                    <td><span>{$$cont[apellido]}</span></td>
                    <td> <span>{$$cont[nombre_sucursal]}</span></td>
                    <td> <span>{$$cont[sector]}</span></td>
                    <td> <span>{$$cont[puesto]}</span></td>
                </tr>
            {/foreach}
        </table>
        <form class="box-coment" name="box_coment" action="/ven_cliente_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
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
