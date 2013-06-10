<div style="width:994px; height:23px; background:url(/img/fondos/bg_cuenta_top.jpg) center top no-repeat; margin:0 auto;"></div>
<div id="fondoCatalogo" style="background:url(/img/fondos/bg_cuenta.jpg) center top repeat-y;">
    {template tpl="menu_izq"}
    <div id="derecha" class="catalogo" style="background:url(/img/fondos/bg_cuenta.jpg) right top repeat-y;" >
        <div id="hilo"> Bienvenido: {$nombre_empleado}</div>
        <hr />
        <h1 class="azul bold">{$id_area_nombre}</h1>
        <hr />
        
        <p class="rojo txt18">Alarmas</p>
        
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="367" bgcolor="#CC0000"><p class="blanco bold">Tarea</p></td>
                <td width="66" align="center" bgcolor="#CC0000"><p class="blanco">Inicio</p></td>
                <td width="66" align="center" bgcolor="#CC0000"><p class="blanco">Vence</p></td>
                <td width="69" align="center" bgcolor="#CC0000"><p class="blanco">Pasaron</p></td>
                <td width="69" align="center" bgcolor="#CC0000"><p class="blanco">Prioridad</p></td>
            </tr>
            <tr>
                <td width="367" bgcolor="#fdafaf"><p class="blanco bold">TAREAS PROPIAS</p></td>
                <td width="66" align="center" bgcolor="#fdafaf"><p class="blanco"></p></td>
                <td width="66" align="center" bgcolor="#fdafaf"><p class="blanco"></p></td>
                <td width="69" align="center" bgcolor="#fdafaf"><p class="blanco"></p></td>
                <td width="69" align="center" bgcolor="#fdafaf"><p class="blanco"></p></td>
            </tr>
            {foreach item=proc from=$all_proc[rojo][propia] }
                <tr>
                    <td><a href="/{$$proc[proceso_proceso]}/{$$proc[id_tabla_proc]}.html">{$$proc[proceso_nombre]}</a></td>
                    <td align="center" class="txt11">{$$proc[fecha_inicio]}</td>
                    <td align="center" class="txt11">{$$proc[fecha_vence]}</td>
                    <td align="center" class="txt11">{$$proc[pasaron_dias]}</td>
                    <td align="center" class="txt11">{$$proc[prioridad]}</td>
                </tr>
            {/foreach}
            <tr>
                <td width="367" bgcolor="#fdafaf"><p class="blanco bold">TAREAS DE TERCEROS</p></td>
                <td width="66" align="center" bgcolor="#fdafaf"><p class="blanco"></p></td>
                <td width="66" align="center" bgcolor="#fdafaf"><p class="blanco"></p></td>
                <td width="69" align="center" bgcolor="#fdafaf"><p class="blanco"></p></td>
                <td width="69" align="center" bgcolor="#fdafaf"><p class="blanco"></p></td>
            </tr>
            {foreach item=proc from=$all_proc[rojo][terceros] }
                <tr>
                    <td><a style="color:#4B4B4B;" href="/{$$proc[proceso_proceso]}/{$$proc[id_tabla_proc]}.html">{$$proc[proceso_nombre]}</a></td>
                    <td align="center" class="txt11">{$$proc[fecha_inicio]}</td>
                    <td align="center" class="txt11">{$$proc[fecha_vence]}</td>
                    <td align="center" class="txt11">{$$proc[pasaron_dias]}</td>
                    <td align="center" class="txt11">{$$proc[prioridad]}</td>
                </tr>
            {/foreach}

        </table>
        <br /><br />
        <p class="amarillo txt18">Tareas Ultimo día</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="367" bgcolor="#d4ec0b"><p class="blanco bold">Tarea</p></td>
                <td width="66" align="center" bgcolor="#d4ec0b"><p class="blanco">Inicio</p></td>
                <td width="66" align="center" bgcolor="#d4ec0b"><p class="blanco">Vence</p></td>
                <td width="69" align="center" bgcolor="#d4ec0b"><p class="blanco">Restan</p></td>
                <td width="69" align="center" bgcolor="#d4ec0b"><p class="blanco">Prioridad</p></td>
            </tr>
            <tr>
                <td width="367" bgcolor="#ecf4a5"><p class="blanco bold">TAREAS PROPIAS</p></td>
                <td width="66" align="center" bgcolor="#ecf4a5"><p class="blanco"></p></td>
                <td width="66" align="center" bgcolor="#ecf4a5"><p class="blanco"></p></td>
                <td width="69" align="center" bgcolor="#ecf4a5"><p class="blanco"></p></td>
                <td width="69" align="center" bgcolor="#ecf4a5"><p class="blanco"></p></td>
            </tr>
            {foreach item=proc from=$all_proc[amarillo][propia] }
                <tr>
                    <td><a style="color:#4B4B4B;"href="/{$$proc[proceso_proceso]}/{$$proc[id_tabla_proc]}.html">{$$proc[proceso_nombre]}</a></td>
                    <td align="center" class="txt11">{$$proc[fecha_inicio]}</td>
                    <td align="center" class="txt11">{$$proc[fecha_vence]}</td>
                    <td align="center" class="txt11">{$$proc[restan_dias]}</td>
                    <td align="center" class="txt11">{$$proc[prioridad]}</td>
                </tr>
            {/foreach}

            <tr>
                <td width="367" bgcolor="#ecf4a5"><p class="blanco bold">TAREAS DE TERCEROS</p></td>
                <td width="66" align="center" bgcolor="#ecf4a5"><p class="blanco"></p></td>
                <td width="66" align="center" bgcolor="#ecf4a5"><p class="blanco"></p></td>
                <td width="69" align="center" bgcolor="#ecf4a5"><p class="blanco"></p></td>
                <td width="69" align="center" bgcolor="#ecf4a5"><p class="blanco"></p></td>
            </tr>
            {foreach item=proc from=$all_proc[amarillo][terceros] }
                <tr>
                    <td><a style="color:#4B4B4B;"href="/{$$proc[proceso_proceso]}/{$$proc[id_tabla_proc]}.html">{$$proc[proceso_nombre]}</a></td>
                    <td align="center" class="txt11">{$$proc[fecha_inicio]}</td>
                    <td align="center" class="txt11">{$$proc[fecha_vence]}</td>
                    <td align="center" class="txt11">{$$proc[restan_dias]}</td>
                    <td align="center" class="txt11">{$$proc[prioridad]}</td>
                </tr>
            {/foreach}

        </table>
        <br /><br />


        <!-- <hr class="punteado" style="margin:16px 0 19px 0;" /> -->
        <p class="verde txt18">Tareas Pendientes</p>
        
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="367" bgcolor="#009966"><p class="blanco bold">Tarea</p></td>
                <td width="66" align="center" bgcolor="#009966"><p class="blanco">Inicio</p></td>
                <td width="66" align="center" bgcolor="#009966"><p class="blanco">Vence</p></td>
                <td width="69" align="center" bgcolor="#009966"><p class="blanco">Restan</p></td>
                <td width="69" align="center" bgcolor="#009966"><p class="blanco">Prioridad</p></td>

            </tr>
            <tr>
                <td width="367" bgcolor="#bdf9b9"><p class="blanco bold">TAREAS PROPIAS</p></td>
                <td width="66" align="center" bgcolor="#bdf9b9"><p class="blanco"></p></td>
                <td width="66" align="center" bgcolor="#bdf9b9"><p class="blanco"></p></td>
                <td width="69" align="center" bgcolor="#bdf9b9"><p class="blanco"></p></td>
                <td width="69" align="center" bgcolor="#bdf9b9"><p class="blanco"></p></td>
            </tr>
            {foreach item=proc from=$all_proc[verde][propia] }
                <tr>
                    <td><a style="color:#4B4B4B;"href="/{$$proc[proceso_proceso]}/{$$proc[id_tabla_proc]}.html">{$$proc[proceso_nombre]}</a></td>
                    <td align="center" class="txt11">{$$proc[fecha_inicio]}</td>
                    <td align="center" class="txt11">{$$proc[fecha_vence]}</td>
                    <td align="center" class="txt11">{$$proc[restan_dias]}</td>
                    <td align="center" class="txt11">{$$proc[prioridad]}</td>
                </tr>
            {/foreach}


            <tr>
                <td width="367" bgcolor="#bdf9b9"><p class="blanco bold">TAREAS DE TERCEROS</p></td>
                <td width="66" align="center" bgcolor="#bdf9b9"><p class="blanco"></p></td>
                <td width="66" align="center" bgcolor="#bdf9b9"><p class="blanco"></p></td>
                <td width="69" align="center" bgcolor="#bdf9b9"><p class="blanco"></p></td>
                <td width="69" align="center" bgcolor="#bdf9b9"><p class="blanco"></p></td>
            </tr>
            {foreach item=proc from=$all_proc[verde][terceros] }
                <tr>
                    <td><a style="color:#4B4B4B;"href="/{$$proc[proceso_proceso]}/{$$proc[id_tabla_proc]}.html">{$$proc[proceso_nombre]}</a></td>
                    <td align="center" class="txt11">{$$proc[fecha_inicio]}</td>
                    <td align="center" class="txt11">{$$proc[fecha_vence]}</td>
                    <td align="center" class="txt11">{$$proc[restan_dias]}</td>
                    <td align="center" class="txt11">{$$proc[prioridad]}</td>
                </tr>
            {/foreach}

        </table>
        <br /><br />

        <p class="azul txt18">Notificaciones</p>
        <table width="642" border="0" cellpadding="0" cellspacing="0" class="formulario">
            <tr>
                <td width="367" bgcolor="#2DA1DC"><p class="blanco bold">Tarea</p></td>
                <td width="66" align="center" bgcolor="#2DA1DC"><p class="blanco">Inicio</p></td>
                <td width="66" align="center" bgcolor="#2DA1DC"><p class="blanco">Fin</p></td>
                <td width="69" align="center" bgcolor="#2DA1DC"><p class="blanco">Aprobada</p></td>

            </tr>
            {foreach item=proc from=$all_proc[azul] }
                <tr>
                    <td><a style="color:#4B4B4B;"href="/{$$proc[proceso_proceso]}/{$$proc[id_tabla_proc]}.html">{$$proc[proceso_nombre]}</a></td>
                    <td align="center" class="txt11">{$$proc[fecha_inicio]}</td>
                    <td align="center" class="txt11">{$$proc[fecha_fin]}</td>
                    <td align="center" class="txt11">{$$proc[aprobada]}</td>
                </tr>
            {/foreach}
        </table>
    </div>
    <div style="width:741px; height:46px; float:right;" class="png_bg"></div>
    <br style="clear:both;" />
</div>

  