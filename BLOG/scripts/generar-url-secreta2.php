<?php 

include_once 'app/Conexion.inc.php';
include_once 'app/config.inc.php';

include_once 'app/Usuari.inc.php';
include_once 'app/recuperacionClave.inc.php';

include_once 'app/repositorioUsuario.inc.php';
include_once 'app/repositorioRecuperacionClave.inc.php';

include_once 'app/redireccion.inc.php';

function sa($longitud)
{
    $caracteres='01234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numero_caracteres=strlen($caracteres);
    $string_aleatorio='';
    
    for ($i = 0; $i < $longitud; $i++)
    {
        $string_aletorio.=$caracteres[rand(0,$numero_caracteres - 1)];
    }
    return $string_aletorio;
}

////EVA   
if (isset($_POST['enviar-email'])) // nom boto que tnca formulari
{

   
   Conexion::abrir_conexion();

    $email= $_POST['email'];
   
    // 1. existeix l'email?¿
    if (!repositorioUsuario::email_existe(Conexion::obtener_conexion(),$email)) // torna true o false
    {
       
        redireccion::redirigir(RUTA_RECUPERAR_CLAVE); // si lemail no existeix
    }
    
    // comprobar que no hi hagi cap peticio, cap URL SECRETA JA GENERADA PER LUSUARI
    // vol dir que lemail si que existeix
    $usuario = repositorioUsuario::obtener_usuario_por_email(Conexion::obtener_conexion(),$email);
    $nombre_usuario = $usuario -> obtener_nombre();
    $id_usuario= $usuario -> obtener_id();
    $string_aleatorio= sa(10);
    
    $url_secreta= hash("sha256", $string_aleatorio . $nombre_usuario); //cadena de 64 caracters que es forma amb els strings que li donem

    
    $peticion_generada = repositorioRecuperacionClave::generar_peticion(Conexion::obtener_conexion(),$id_usuario,$url_secreta);
    //($conexion, $id_usuario, $url_secreta)
    
    if ($peticion_generada)
    {
        include_once "vistas/prueba_mail.php";
       
        
    }
    else 
    {
        redireccion::redirigir(SERVIDOR);
    }
    Conexion::cerrar_conexion();
    
}


?>