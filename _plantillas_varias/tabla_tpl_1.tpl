
{contenido}
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="#99FF99">{$titulo|upper}</td>
        </tr>
        <tr>
          <td bgcolor="#CC9999">{$texto}</td>
        </tr>
        <tr>
          <td bgcolor="#99FFFF">{$fecha_alta|date_format:"d/m/Y h:i:s"}</td>
        </tr>
        <tr>
          <td bgcolor="#FFFF66"><a href="{$link}">link</a></td>
        </tr>
      </table>
{/contenido}


{contenido_vacio}
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="50" bgcolor="#FF0000">SIN DATOS</td>
        </tr>
        <tr>
          <td height="10" bgcolor="#99CCCC"></td>
        </tr>
      </table>
{/contenido_vacio}

