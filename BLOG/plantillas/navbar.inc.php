<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';

Conexion:: abrir_conexion();
$usuarios = repositorioUsuario::obtener_todos(Conexion::obtener_conexion());
$total_usuarios = repositorioUsuario::obtener_numero_usuarios(Conexion::obtener_conexion());

?>
<!-- BARRA NAVEGACIO -->
<nav class="navbar navbar-default navbar-static-top">  <!-- per definir la barra -->
    <div class="container">   <!-- contenidor on a dins hi coloquem els items -->
        <div class="navbar-header"> <!-- dir que serà el header de la barra -->

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only"> este boton despliega la barra de navegacion </span> 
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> 

            <a class="navbar-brand" href=" <?php echo SERVIDOR ?>">EvaGonzalezFlo</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <?php
                if (!ControlSesion::sesion_iniciada())
                {
            ?>
                    <ul class="nav navbar-nav">
                        <li> <a href="<?php echo RUTA_ENTRADA ?>"> <i class="fa fa-spinner fa-spin fa-pulse"></i>Entrades </a></li>
                        <li> <a href="<?php echo RUTA_FAVORITS ?>"> <i class="bi-star-fill"></i>Favorits </a></li>
                        <li> <a href="<?php echo RUTA_AUTORS ?>"> <i class="bi-vector-pen"></i> Autors </a></li>
                    </ul>
            <?php
                }
            ?>
            <ul class=" nav navbar-nav navbar-right">
                <?php
                if (ControlSesion::sesion_iniciada()) { //si ha iniciat sessio
                    ?>
                    <li>
                        <a href ="<?php echo RUTA_PERFIL; ?>"> 
                            <i class="bi-person-fill"></i>
                            <?php echo ' ' . $_SESSION['nombre_usuario']; ?>
                        </a>
                    </li>
                    
                    <li>
                        <a href ="<?php echo RUTA_GESTOR ?>"> 
                           <i class="bi-grid-fill"></i> Gestor
                            
                        </a>
                    </li>
                
                    <li>
                        <a href ="<?php echo RUTA_LOGOUT ?>">
                            <span class="glyphicon glyphicon-log-out"></span> Tancar sessió
                        </a>
                    </li>


                    <?php
                } else { //si NO iniciat sessio
                    ?>
                    <li> 
                        <a href="#"> 
                            <i class="bi-person-fill"></i>
                            <?php
                            echo $total_usuarios;
                            ?>
                        </a>
                    </li>
                    <li> 
                        <a href="<?php echo RUTA_LOGIN ?>"> 
                            <span class="glyphicon glyphicon-log-in"></span> Iniciar sessió </p>     
                        </a>
                    </li>
                    <li> 
                        <a href="<?php echo RUTA_REGISTRO ?>">  
                            <i class="bi-person-plus-fill"></i> Registre 
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>    
        </div>
    </div>
</nav>
