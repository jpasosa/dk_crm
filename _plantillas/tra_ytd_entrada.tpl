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
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p class="txt10 uppercase">Nombre:<span class="azul">DISEÑO</span></p>
        <p class="txt10 uppercase">Packing List:<span class="azul">546521</span></p>
        <div class="marginTop20">
            <p class="azul bold">CONTROL DE PRODUCTOS</p>
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
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Referencia:</label>
                        <input name="referencia" type="text" value=''  alt="Referencia" />
                    </div>
                    <div class="campania">
                        <label>Marca:</label>
                        <input name="marca" type="text" value=''  alt="Marca" />
                    </div>
                    <div class="campania">
                        <label>Familia:</label>
                        <input name="familia" type="text" value=''  alt="Familia" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement">Subfamilia:</label>
                        <input name="subfamilia" type="text" value=''  alt="Subfamilia" />
                    </div>
                    <div class="campania">
                        <label>Problema:</label>
                        <select name="problema">
                            <option>Mercaderia Rota</option>
                            <option>Faltante</option>
                            <option>Sobrante</option>
                            <option>Mercadería en mal estado de fábrica</option>
                            <option>Mercadería en mal estado</option>
                            <option>Muy sucio</option>
                            <option>Difiere con la foto</option>
                            <option>Otros (cargar a mano)</option>
                        </select>
                    </div>
                    <div class="campania">
                        <label>Nro. Caja:</label>
                        <input name="nroCaja" type="text" value=''  alt="Nro. Caja" />
                    </div>                    
                </div>
                <div class="observacionesChico clear">
                    <label> Observaciones: </label>
                    <textarea name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
                <div class="archivo">
                    <label class="block"> Foto : </label>
                    <input type="file" class="inline" name="archivo" value="quepasavieja" />
                    <input type="submit" class="inline" name="subir_archivo" value="Subir Foto" />
                </div>
                <div class="archivos clear">
                    {foreach item=n from=$nombres_archivos}
                        <div class="file marginLat10">
                            <a class="file_name" id="file_name-{$$n[id]}" href="/upload_archivos/adm_ytd_mantenimientos/{$$n[nombre]}">
                            <span>Foto: Foto 1</span>
                            </a>
                            <a class="del_file" id="file-{$$n[id]}" href="#" style="floet:left;">
                            <img border="0" alt="quitar" src="img/iconos/delete.gif" class="del_gasto" id="id_gastos-">
                            </a>
                        </div>
                    {/foreach}
                </div>
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar_fechas" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>
        <form class="box-entrada" name="add_hotel" action="/form_example.html" method="post" enctype="multipart/form-data" >
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
