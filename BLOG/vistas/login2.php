<?php

include_once 'app/Conexion.inc.php';
include_once 'app/repositorioUsuario.inc.php';
include_once 'app/ValidadorRegistro.inc.php';
include_once 'app/Usuari.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/redireccion.inc.php';

if (isset($_POST['login']))

    {
    Conexion::abrir_conexion();
    $validador= new ValidadorLogin ( $_POST['email'], $_POST['clave'], Conexion::obtener_conexion());
  
 
    
    if ($validador -> obtener_error() === '' && 
            !is_null($validador -> obtener_usuario())) // hem pogut recuperar lusuario i tot es correcte
    {
        echo "Inicio session ok";
        ControlSesion::iniciar_sesion($validador->obtener_usuario() -> obtener_id(),
                $validador->obtener_usuario() -> obtener_nombre());
        redireccion::redirigir(SERVIDOR);
    }
    else
    {
        echo $validador -> obtener_error();
    }
    Conexion::cerrar_conexion();
} 

$titulo = 'Login';
// crear inici
include_once 'plantillas/documento-declaracion.inc.php';
// Barra de navegació
include_once 'plantillas/navbar.inc.php';

?>


<div class="container">
    <div clarr="row">
        <div class=" col-md-3">  
        </div>
        <div class=" col-md-6">  
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h2>Iniciar sessió</h2>
                </div>
                <div class="panel-body">
                    <form role=" form" method="post" action="<?php echo RUTA_LOGIN ?>">
                        <h4 class='text-center'> Introdueix les teves dades </h4>
                        <br>
                        <label for='usuari' class='sr-only'> Correu electrònic </label>
                        <input type ="email" name="email" id="email" class="form-control" placeholder="Correu electrònic" 
                               <?php 
                               if (isset($_POST['login']) && isset($_POST['email']) && !empty ($_POST['email']))
                               {
                                   echo 'value = "'. $_POST['email'].'"';
                               }
                               ?>
                               required > 
                        <br>
                        <label for='clave' class='sr-only'> Contrasenya </label>
                        <input type ="password" name="clave" id="clave" class="form-control" placeholder="Contrasenya" required> 
                        <br>
                        <?php
                        if (isset($_POST['login']))
                        {
                            $validador -> mostrar_error();
                        }
                        ?>
                        <button type='submit' name='login' class=' btn btn-primary btn-block'> Iniciar sessió</button>
                    </form>
                    <br>
                    <br>
                    <div class='text-center'>
                        <a href=<?php echo RUTA_RECUPERAR_CLAVE ?>> Heu perdut la contrasenya? </a>
                        <a href= <?php echo RUTA_REGISTRO ?> > Registra't</a>


                    </div>
                </div>
            </div> 
        </div>
        <div class=" col-md-3">  
        </div>
    </div>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>


