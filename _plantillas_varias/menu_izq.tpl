<div id="izquierda" style="width:247px;">
<ul id="menuCategoriasIzq">
<li class="first"><a href="#" class="active">► Tareas</a>
<ul>
{foreach item=nf from=$new_forms }
    <li><a href="{$$nf[link]}.html" class="subactive">» {$$nf[nombre]}</a></li>
{/foreach}
</ul>
</li>
<li><a href="#">► Informes</a>
<ul>
<li><a href="#" class="sub">» Agenda</a></li>
</ul>
</li>



</ul>
</div>