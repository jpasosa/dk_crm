<link href="/css/estilos.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="texto"><span class="texto_rojo_negrita">Formulario()</span>
        	<br />
            
            <hr />
            
            {html_form name="formuario1"}

                Usuario general: {html_select name="usuario_general" options=$opciones selected=$seleccionado_uno style="" separator="<br />"}

                <br /><br />
    
                Usuarios habilitados: {html_error name="id"}<br />
    
                {html_checkboxes name="usuarios_habilitados" options=$opciones selected=$seleccionado style="input2" separator="<br />"}
    
                <br /><br />
    
                Usuario administrador:<br />
    
                {html_radios name="administrador" options=$opciones selected=$seleccionado_uno style="input3" separator="<br />"}
    
                <br /><br />
    
                Nombre:<br />
    
                {html_input name="nombre" value=$valor_inicial style="input2" width="100"}
    
                <br /><br />

                <input name="" type="submit" />
    
                <br /><br />
    
                {$recepcion_control}
                
                <br /><br />

            {/html_form}
                
            <hr />

			{html_form name="formuario2"}
    
                E-Mail:<br />
    
                {html_input name="email" value=$valor_inicial2 style="input2" width="200"}
    
                <br /><br />
    
                Numero:<br />
    
                {html_input name="numero" value=$valor_inicial2 style="input2" width="80"}
    
                <br /><br />
    
                Clave:<br />
    
                {* en este caso de definio la etiqueta html_error para mostrar el error en un lugar espesífico *}
    
                {html_error name="clave"}
                {html_password name="clave" style="input2" width="80"}
    
                <br /><br />
    
                {html_file name="archivo" style="input2" width="100"}
    
                <br /><br />
    
                Descripcion:<br />
    
                {html_textarea name="descripcion" value=$valor_inicial style="input2" width="200" height="50"}
    
                <br /><br />
    
                {* si no se define html_captcha_input el campo de ingreso de datos se mostrará a la derecha de la imagen *}
    
          {html_captcha_img} {html_captcha style="input2"}<br />
    
                <br /><br />
    
                {html_errores}
                
                <br /><br />
                
                <input name="" type="submit" />
                
            {/html_form}
            
            <hr />

        </td>
    </tr>
</table>
