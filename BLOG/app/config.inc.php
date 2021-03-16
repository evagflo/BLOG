<?php
// info DATABASE
$nom_servidor = 'localhost'; //tambe podriem posar el numero de serivor del 127.0.0.1
$db_usuari = 'eva';
$db_password = 'eva';
$nom_database = 'blog';

define('NOMBRE_SERVIDOR','locahost:8888');
define('NOMBRE_USUARIO','eva');
define('PASSWORD','eva');
define('NOMBRE_DB','blog');


// rutas de la web
define("SERVIDOR","http://localhost:8888/BLOG");
define("RUTA_REGISTRO",SERVIDOR."/registro");
define("RUTA_REGISTRO_CORRECTO",SERVIDOR."/registro-correcto");
define("RUTA_LOGIN",SERVIDOR."/login2");
define("RUTA_LOGOUT",SERVIDOR."/logout");
define("RUTA_RECUPERAR_CLAVE",SERVIDOR."/recuperar-clave");
define ("RUTA_GENERAR_URL_SECRETA",SERVIDOR."/generar-url-secreta2");

define ("RUTA_PERFIL",SERVIDOR."/perfil");


define("RUTA_PRUEBA_MAIL",SERVIDOR."/mail");
define("RUTA_RECUPERACION_CLAVE",SERVIDOR."/recuperacion-clave");
define("RUTA_CAMBIO_CLAVE_CORRECTO",SERVIDOR."/cambio-clave-correcto");


define("RUTA_ENTRADA",SERVIDOR."/entrada");
define("RUTA_NUEVA_ENTRADA",SERVIDOR."/nueva-entrada");
define("RUTA_BORRAR_ENTRADA",SERVIDOR."/borrar_entrada");
define("RUTA_EDITAR_ENTRADA",SERVIDOR."/editar-entrada");

define("RUTA_FAVORITS",SERVIDOR."/favorits");
define("RUTA_AUTORS",SERVIDOR."/autors");
define("RUTA_GESTOR",SERVIDOR."/gestor");
define("RUTA_ENTRADES",SERVIDOR."/entrades");
define("RUTA_BUSCAR",SERVIDOR."/buscar");

//
define("RUTA_GESTOR_ENTRADAS",RUTA_GESTOR."/entradas");
define("RUTA_GESTOR_COMENTARIOS",RUTA_GESTOR."/comentarios");
define("RUTA_GESTOR_FAVORITOS",RUTA_GESTOR."/favoritos");


//recursos

define("RUTA_CSS",SERVIDOR."/CSS/");
define("RUTA_JS",SERVIDOR."/js/");
define("DIRECTORIO_RAIZ",realpath(__DIR__)."/..");








