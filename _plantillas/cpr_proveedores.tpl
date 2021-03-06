<link href="/css/cpr_alta_proveedores.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/cpr_alta_proveedores/del_file.js"></script>

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
        <h1 class="azul bold"><span class="txt22 normal">Alta de Proveedores</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$date}</span></p>
        <p>Sector:<span class="azul">{$area}</span></p>
        <p>Nombre:<span class="azul">{$nombre_empleado}</span></p>
        <form class="box-entrada" name="add_hotel" action="/cpr_proveedores.html" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10" height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Nombre:</label>
                        <input name="nombre" type="text" value='{$tabla[0]["nombre"]}'  alt="Nombre" />
                    </div>
                    <div class="campania">
                        <label>Dirección:</label>
                        <input name="direccion" type="text" value='{$tabla[0]["direccion"]}'  alt="Dirección" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement">Clave de Indentificación:</label>
                        <input name="clave_ident" type="text" value='{$tabla[0]["clave_identificacion_tributaria"]}'  alt="Clave de Identificación" />
                    </div>
                    <div class="campania">
                        <label>Tipo:</label>
                        <select name="tipo">
                            <option value="Resposable Inscripto" {if $tabla[0]["tipo"] == "Responsable Inscripto" } selected {/if}>Resposable Inscripto</option>
                            <option value="Tipo UNO" {if $tabla[0]["tipo"] == "Tipo UNO" } selected {/if}>Tipo UNO</option>
                            <option value="Tipo DOS" {if $tabla[0]["tipo"] == "Tipo DOS" } selected {/if} >Tipo DOS</option>
                        </select>
                    </div>
                </div>
                <div class="observacionesChico clear">
                    <label> Observaciones: </label>
                    <textarea name="observaciones">{$tabla[0]['observaciones_proveedores']}</textarea>
                </div>
                <div class="archivo">
                    <label class="block"> Adjuntar Archivos : </label>
                    <input type="file" class="inline" name="archivo" value="" />
                    <input type="submit" class="inline" name="subir_archivo" value="Subir Archivo" />
                </div>
                {if $files['error'] == false }
                    <div class="archivos clear">
                        {foreach item=n from=$files}
                            <div class="file marginLat10">
                                <a class="file_name" id="file_name-{$$n[id]}" href="/upload_archivos/cpr_alta_proveedores/{$$n[nombre]}" target="_blank">
                                    <span>Archivo: {$$n[nombre]}</span>
                                </a>
                                <a class="del_file" id="file-{$$n[id]}" href="#">
                                    <img border="0" alt="quitar" src="img/iconos/delete.gif" class="del_gasto" id="id_gastos-">
                                </a>
                            </div>
                        {/foreach}
                    </div>
                {/if}
                <input name="first_time" type="hidden" value="{$first_time}" />
                <input name="id_tabla_proc" type="hidden" value="{$id_tabla_proc}" />
                <input name="id_tabla" type="hidden" value="{$id_tabla}" />
                <input name="agregar" class="agregar" type="submit" value="Agregar" />
            </div>
        </form>

        <form class="box-entrada" name="add_hotel" action="/cpr_proveedores.html" method="post" enctype="multipart/form-data" >
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
