<link href="/css/cpr_visitas_fabricas.css" rel="stylesheet" type="text/css" />

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
        <h1 class="azul bold"><span class="txt22 normal">Organizar visitas fabricas y exposiciones</span></h1>
        <hr />
        <p class="txt10 uppercase">Fecha de inicio del trámite:<span class="azul">{$fecha_inicio}</span></p>
        <p>Sector:<span class="azul">{$area_inicio}</span></p>
        <p>Empleado:<span class="azul">{$nombre_inicio}</span></p>
        <form class="box-entrada" method="post" enctype="multipart/form-data" >
            <div class="box-entrada padding10   " height="40" colspan="5" bgcolor="#D2E1F2">
                <div class="izq">
                    <div class="campania">
                        <label class="primerElement">Fábrica:</label>
                        <input readonly="readonly" name="fabrica" type="text" value='{$tabla[0]["fabrica"]}'  alt="Fábrica" />
                    </div>
                    <div class="campania">
                        <label>País / Ciudad:</label>
                        <select name="provincia" disabled="disabled">
                            <option> {$tabla[0]["pais"]} | {$tabla[0]["provincia"]} </option>
                        </select>
                    </div>
                    <div class="campania">
                        <label>Costo:</label>
                        <input readonly="readonly" name="costo" type="text" value='{$tabla[0]["costo"]|number_format:2:",":""}'  alt="Costo" />
                    </div>
                </div>
                <div class="der">
                    <div class="campania">
                        <label class="primerElement">Fecha Inicio:</label>
                        <input readonly="readonly"  type="text" value='{$tabla[0]["fecha_inicio"]|date_format:"d/m/Y"}'  alt="Fecha Inicio" />
                    </div>
                    <div class="campania">
                        <label>Fecha Fin:</label>
                        <input readonly="readonly" type="text" value='{$tabla[0]["fecha_fin"]|date_format:"d/m/Y"}'  alt="Fecha Fin" />
                    </div>

                </div>
                <div class="observacionesChico clear">
                    <label> Observaciones: </label>
                    <textarea readonly="readonly" class="ultimoElement" name="observaciones">{$tabla[0]['observaciones']}</textarea>
                </div>
            </div>
        </form>

        <form class="box-coment" name="box_coment" action="/cpr_visitas_fabricas_coment/{$id_tabla_proc}.html" method="post" enctype="multipart/form-data" >
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
