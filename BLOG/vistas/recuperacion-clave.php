<?php
include_once 'app/repositorioUsuario.inc.php';
include_once 'app/repositorioRecuperacionClave.inc.php';
include_once 'app/redireccion.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/ValidadorRecuperarClave.php';

Conexion::abrir_conexion();

if (repositorioRecuperacionClave::url_secreta_existe(Conexion::obtener_conexion(),$url_personal))
{
    $id_usuario=repositorioRecuperacionClave::obtener_id_usuario_mediante_url_secreta(Conexion::obtener_conexion(),$url_personal);
   // echo 'id usuari solicitant = '.$id_usuario ;
}
else
{
    redireccion::redirigir(SERVIDOR);
}

if (isset($_POST['guardar-clave']))
{
   //validar clave1
   //comprobar que la clau2 coincideix
    $clave1=$_POST['clave'];
    $clave2= $_POST['clave2'];
    $validador_clave= new ValidadorRecuperarClave($clave1,$clave2);
    //TRANSACCION: CANVI DE CLAU I ELIMINAR LA URL
    if ($validador_clave -> registro_valido())
    {
        
        $clave_validada= $validador_clave -> obtener_clave();  
        $clave_cifrada=password_hash($clave_validada, PASSWORD_DEFAULT);
        //$actualizada= repositorioUsuario::actualizar_clave(Conexion::obtener_conexion(),$id_usuario,$clave_cifrada);
        $actualizada= repositorioUsuario::actualizar_clave_borrar_url(Conexion::obtener_conexion(),$id_usuario,$clave_cifrada,$url_personal);
       
    }
    if($actualizada)
    {
        
        redireccion::redirigir(RUTA_CAMBIO_CLAVE_CORRECTO);
        //redireccion::redirigir(RUTA_LOGIN);// com al login que ha canviat la contrasenya mes link per iniciar sesio
    }
    else 
     {
        echo 'no funciona';
        //redirigir al login}
    }
}
Conexion::cerrar_conexion();

$titulo='Recuperació de la contrasenya...';
// crear inici
include_once 'plantillas/documento-declaracion.inc.php';
// Barra de navegació
include_once 'plantillas/navbar.inc.php';
?>

<div class='container'>
    <div class='row'>
        <div class='col-md-3'>
        </div>
        <div class='col-md-6'>
            <div class=' panel panel-default'>
                <div class='panel-heading text-center'>
                    <h2>Recuperació de la contrasenya</h2>
                </div>
                <div class='panel-body'>
                    <form role='form' method='post' action='<?php echo RUTA_RECUPERACION_CLAVE."/".$url_personal?>'>
                        <?php
                        if (isset($_POST['guardar-clave']))
                        {
                            
                           include_once 'app/recuperacio-clau-validat.inc.php'; // ha apretat -> registre validat
                        }
                        else
                        {
                           
                            include_once 'app/recuperacio-clau-buit.inc.php';// NOha apretat -> registre buit
                        }
                    ?>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
