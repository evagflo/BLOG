<?php
include_once 'app/Conexion.inc.php';

include_once 'app/Usuari.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/Comentario.inc.php';

include_once 'app/repositorioUsuario.inc.php';
include_once 'app/repositorioEntrada.inc.php';
include_once 'app/repositorioComentario.inc.php';

$componentes_url = parse_url($_SERVER['REQUEST_URI']);

$ruta = $componentes_url ['path'];
$partes_ruta = explode('/', $ruta);// separa les aprts de larray on hi ha el simbol '/'
$partes_ruta = array_filter($partes_ruta); // forma tratada-> qualsevol part de lstring que contingui un espai en buit serà eliminada
$partes_ruta = array_slice($partes_ruta,0); //trocear array

$ruta_elegida='vistas/404.php';

if ( $partes_ruta[0] == 'BLOG')
{
//    echo $partes_ruta[0];
//    echo $partes_ruta[1];
//    echo $partes_ruta[2];
//    echo count($partes_ruta);
    if (count($partes_ruta) == 1)
    {
        $ruta_elegida='vistas/home.php'; // hem entrat al home
    }
    else if (count($partes_ruta) == 2)
    {
        switch ($partes_ruta[1])
        {
            case 'login2': 
                $ruta_elegida = 'vistas/login2.php';
                break;
            
            case 'logout':
                $ruta_elegida = 'vistas/logout.php';
                break;
            
            case 'registro':
                $ruta_elegida = 'vistas/registro.php';
                break;
            
//            case 'registro':
//                $ruta_elegida = 'vistas/registro.php';
//                break;   
            case 'gestor':
                $ruta_elegida = 'vistas/gestor.php';
                $gestor_actual='';
                break;
            
            case 'nueva-entrada':
                $ruta_elegida = 'vistas/nueva-entrada.php';
            break;
        
            case 'borrar_entrada':
                $ruta_elegida = 'scripts/borrar_entrada.php';
            break;
        
//            case 'relleno':
//                $ruta_elegida = 'scripts/script-relleno.php';
//            break; 
        
            case 'editar-entrada':
                $ruta_elegida = 'vistas/editar-entrada.php';
            break;
        
            case 'recuperar-clave':
                $ruta_elegida = 'vistas/recuperar-clave.php';
            break;
        
            case 'generar-url-secreta2':
                $ruta_elegida = 'scripts/generar-url-secreta2.php';
            break;
        
            case 'mail': 
                $ruta_elegida = 'vistas/prueba_mail.php';
            break;
        
            case 'cambio-clave-correcto': 
                $ruta_elegida = 'vistas/cambio-clave-correcto.php';
            break;
            
            case 'buscar':
                $ruta_elegida = 'vistas/buscar.php';
            break;
        
            case 'perfil':
                $ruta_elegida = 'vistas/perfil.php';
            break;
        
                
        } 
    }
    else if (count($partes_ruta) == 3)
    {
        
        if ($partes_ruta [1] == 'registro-correcto')
        {
            $nombre= $partes_ruta[2];
            
            $ruta_elegida = 'vistas/registro-correcto.php';
            
        }
        if ($partes_ruta[1]=='entrada')
        {
            // existeix entrada , sino error 404
            $url=$partes_ruta[2];
            Conexion:: abrir_conexion();
            
            $entrada= repositorioEntrada::obtener_entrada_por_url(Conexion:: obtener_conexion(),$url);
             
            
            if ($entrada != null)
            {
                
                $autor = repositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(),$entrada -> obtener_autor_id());
              
               
                $comentarios = repositorioComentario::obtener_comentarios(Conexion::obtener_conexion(),$entrada -> obtener_autor_id());
               
                $entradas_al_azar= repositorioEntrada::obtener_entradas_al_azar(Conexion::obtener_conexion(),3);
                $ruta_elegida ='vistas/entrada.php';
               
                
            }
            
        }
        if ($partes_ruta[1] == 'gestor')
        {
            switch($partes_ruta[2])
            {
                case 'entradas':
                    $gestor_actual='entradas';
                    $ruta_elegida= 'vistas/gestor.php';
                    break;
                case 'comentarios':
                    $gestor_actual='comentarios';
                    $ruta_elegida= 'vistas/gestor.php';
                    break;
                case 'favoritos':
                    $gestor_actual='favoritos';
                    $ruta_elegida= 'vistas/gestor.php';
                    break;
                
                
            }
        }
        
        if ($partes_ruta[1] == 'recuperacion-clave')
        {
            $url_personal=$partes_ruta[2];
            $ruta_elegida='vistas/recuperacion-clave.php';
        }

    }
     
}

include_once $ruta_elegida;

?>
