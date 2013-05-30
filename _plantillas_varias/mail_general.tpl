<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="texto">
        <br />
        <br />
		PLANTILLA MAIL
        <br />
        <br />
    	Nombre de ejemplo: {$nombre_ejemplo}
        <br />
        Versión: {$#version}
        <br />
        {foreach item=nombre from=$nombres}
      		{$$nombre['nombre']}, {$$nombre['apellido']}<br />
		{/foreach}
        <br />
        Imagen: {mail_img name="logo.png" dir="img/"}
    </td>
  </tr>
</table>
