dk_crm
======

CRM realizado para Sitekirke desarrollos



-- Archivo de Configuración:
// _configuraciones/bases.php

$bases['tipo_base'] = 'mysql';

$bases['servidor']  = 'localhost';
$bases['base']      = 'nombre_de_la_base_de_datos';
$bases['usuario']   = 'user';
$bases['clave']     = 'pass';

-- Configuración para Framework utlizado

SISTEMAS UNIX:

// .htaccess 
<IfModule mod_rewrite.c>
    RewriteEngine on
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*\.html)$ index.php [QSA,L]
</IfModule>
 
SISTEMAS WINDOWS:

 // .htaccess 
RewriteEngine On
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*\.html)$ /index.php [L]
