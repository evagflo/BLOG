<?php

include_once 'app/Conexion.inc.php';
include_once 'app/repositorioUsuario.inc.php';
include_once 'app/ValidadorRegistro.inc.php';
include_once 'app/Usuari.inc.php';
include_once 'app/redireccion.inc.php';

if (isset($_POST['enviar']))
{
    Conexion:: abrir_conexion();  
    
    $validador= new ValidadorRegistro ($_POST['nombre'],$_POST['email'],$_POST['clave1'],$_POST['clave2'],Conexion:: obtener_conexion());
    
   
  
    if ($validador -> registro_valido())
    {
          
        $usuario1 = new Usuari('',$validador-> obtener_nombre(),
                $validador-> obtener_email(),
                password_hash($validador-> obtener_clave(),PASSWORD_DEFAULT),
                '' , 
                ''); // ve de la public funvtion __contruct al Usuari.inc.php
        $usuario_insertado = repositorioUsuario :: insertar_usuario (Conexion :: obtener_conexion(),$usuario1);
   
     
        if ($usuario1) // true si sha insertat
        {
    
          //1. informar a lusuario que s'ha registrat correctament. 
           //echo $usuario1->obtener_nombre();
            //redireccion::redirigir(SERVIDOR);
            redireccion::redirigir(RUTA_REGISTRO_CORRECTO.'/'. $usuario1->obtener_nombre());// ruta de la web registro-correcto.php
        }
        else
        {
           // print"else";
        }
            
    
    }  
Conexion:: cerrar_conexion();   
   
}

$titulo = 'Registre';
// crear inici
include_once 'plantillas/documento-declaracion.inc.php';
// Barra de navegació
include_once 'plantillas/navbar.inc.php';
?>

<!-- COS -->  
<div class="container">
    <div class="jumbotron">
        <h1 class="text-center"> Formulari de registre</h1>
    </div>
</div> 

<div class="container">
    <div class ="row">
        <div class="col-md-6 text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panle-title"> 
                        Instruccions
                    </h3>
                </div>
                <div class="panel-body">
                    <br>
                    <p class='text-justify'>
                        Per registrar-te al Blog has d'introduir un nom d'usuari, un email i una contrasenya.
                        L'email ha de ser real perquè hauras de gestionar la teva conta.
                        Et recomanem que la contrasenya contingui caracters en minúscula.
                    </p>
                    <br>
                    <a href= "<?php echo RUTA_LOGIN ?>" > Ja ets usuari? </a>
                    <br>
                    <br>
                    <a href=# > Has oblidat la teva contrasenya? </a>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panle-title"> 
                        Introdueix les teves dades
                    </h3>
                </div>
                <div class="panel-body">
                    <form role='form' method='post'action='<?php echo RUTA_REGISTRO ?>'> <!-- ENVIAR DE MANERA AUTOMATICA LA INFO AL MATEIX DOCUMENT PER PODER VALIDAR ELS CAMPS, I EN EL CAS QUE SIGUI CORRECTA HO ENVIARA A LA PAGINA REGISTRO_ACCION.PHP -->  
                    <?php
                        if (isset($_POST['enviar']))
                        {
                           include_once 'app/registro_validado.inc.php'; // ha apretat -> registre validat
                        }
                        else
                        {
                            include_once 'app/registro_vacio.inc.php';// NOha apretat -> registre buit
                        }
                    ?>
                    </form>    
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include_once 'plantillas/documento-cierre.inc.php';
?>

