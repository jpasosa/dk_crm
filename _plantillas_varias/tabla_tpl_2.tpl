{tabla}
<table border="0" cellspacing="0" cellpadding="0">
{/tabla}


  <tr> 
  
{superior_izquierdo}
    <td width="20" height="20" align="center" valign="middle" bgcolor="#FF0000">1</td>
{/superior_izquierdo}

{superior_intermedio}
    <td width="100" align="center" valign="middle" bgcolor="#990000">2</td>
{/superior_intermedio}

{superior_centro}
    <td width="20" align="center" valign="middle" bgcolor="#9900CC">3</td>
{/superior_centro}

    <td width="100" bgcolor="#0000FF"></td>

{superior_derecho}
    <td width="20" align="center" valign="middle" bgcolor="#CC66CC">4</td>
{/superior_derecho} </tr>

  <tr>
  
{intermedio_izquierdo}
    <td height="50" align="center" valign="middle" bgcolor="#FFFF00">5</td>
{/intermedio_izquierdo}


{contenido}
    <td valign="top" bgcolor="#000000">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" bgcolor="#33FF66">{$titulo}</td>
        </tr>
        <tr>
          <td align="center" bgcolor="#33CC33">{$texto}</td>
        </tr>
        <tr>
          <td align="center" bgcolor="#339966">{$fecha_alta|date_format:"d/m/Y h:i:s"}</td>
        </tr>
        <tr>
          <td align="center" bgcolor="#339999"><a href="{$link}">link</a></td>
        </tr>
      </table>
    </td>
{/contenido}


{intermedio_centro}
    <td align="center" valign="middle" bgcolor="#FFCC99">6</td>
{/intermedio_centro}


{contenido_vacio}
    <td valign="top" bgcolor="#000000">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="30" align="center" bgcolor="#336666"><span  style="color: #FFFFFF">NO</span></td>
        </tr>
      </table>
    </td>
{/contenido_vacio}


{intermedio_derecho}
    <td align="center" valign="middle" bgcolor="#FFCC00">7</td>
{/intermedio_derecho} </tr>

  <tr>

{medio_izquierdo}
    <td height="20" align="center" valign="middle" bgcolor="#00CC33">8</td>
{/medio_izquierdo}


{medio_intermedio}
    <td align="center" valign="middle" bgcolor="#FF00FF">9</td>
{/medio_intermedio}

{medio_centro}
    <td align="center" valign="middle" bgcolor="#006666">10</td>
{/medio_centro}

    <td bgcolor="#0000FF"></td>

{medio_derecho}
    <td align="center" valign="middle" bgcolor="#00FF99">11</td>
{/medio_derecho}

  </tr>
  <tr>
    <td height="50" bgcolor="#0000FF"></td>
    <td bgcolor="#000000"></td>
    <td bgcolor="#0000FF"></td>
    <td bgcolor="#000000"></td>
    <td bgcolor="#0000FF"></td>
  </tr>
  <tr>

{inferior_izquierdo}
    <td height="20" align="center" valign="middle" bgcolor="#663300">12</td>
{/inferior_izquierdo}

{inferior_intermedio}
    <td align="center" valign="middle" bgcolor="#663333">13</td>
{/inferior_intermedio}

{inferior_centro}
    <td align="center" valign="middle" bgcolor="#660066">14</td>
{/inferior_centro}

    <td bgcolor="#0000FF"></td>

{inferior_derecho}
    <td align="center" valign="middle" bgcolor="#6633FF">15</td>
{/inferior_derecho}

 </tr>
</table>
