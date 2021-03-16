<?php

include_once 'app/Conexion.inc.php';

include_once 'app/Usuari.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/Comentario.inc.php';

include_once 'app/repositorioUsuario.inc.php';
include_once 'app/repositorioEntrada.inc.php';
include_once 'app/repositorioComentario.inc.php';

Conexion::abrir_conexion();

for ($usuarios=0; $usuarios <100; $usuarios++)
{
   $nombre= sa(10);
   $email= sa(5).'@'.sa(3);
   $password= password_hash('123456',PASSWORD_DEFAULT);
  
   $usuario = new Usuari ('',$nombre, $email, $password, '','');
   
   repositorioUsuario::insertar_usuario(Conexion::obtener_conexion(),$usuario);

}

for ($entradas =0 ; $entradas<100; $entradas++)
{
    $titulo =sa(10);
    $url= $titulo;
    $texto = lorem();
    $autor =rand(1,100);
    
    $entrada= New Entrada ('',$autor,$url,$titulo,$texto,'','');
    
    repositorioEntrada::insertar_entrada(Conexion::obtener_conexion(),$entrada);

}

for ($comentarios =0 ; $comentarios<100; $comentarios++)
{
    $titulo =sa(10);
    $texto = lorem();
    $autor =rand(1,100);
    $entrada=rand(1,100);
    
    $comentario= New Comentario ('',$autor,$entrada,$titulo,$texto,'');
    
    repositorioComentario::insertar_comentario(Conexion::obtener_conexion(),$comentario);

}



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

function lorem()
{
    $lorem ='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam faucibus posuere sem ac rhoncus. Vestibulum non nunc diam. Integer ultricies, augue a auctor auctor, turpis nunc gravida nunc, quis scelerisque dolor augue non nunc. Nullam eget odio tellus. In dapibus mauris commodo urna imperdiet imperdiet. Phasellus sagittis massa nec porttitor fringilla. Integer condimentum nibh quam, volutpat iaculis ex mollis non. Donec ultricies, purus et interdum feugiat, dolor ex pharetra urna, at egestas nibh eros vitae tellus. In eu dictum turpis. Cras faucibus eleifend urna, ut ultrices sem aliquam in. Quisque vitae eros hendrerit, sagittis orci at, facilisis magna. Fusce ac tellus eu orci facilisis congue sit amet ut magna. Pellentesque vel tempor sem. Etiam venenatis aliquet magna, at maximus tortor. Nunc faucibus blandit purus, eu vehicula sapien ornare vel.

Donec in tincidunt metus, ut posuere ipsum. Donec tortor ante, dictum et facilisis ut, sodales vitae magna. Duis odio diam, pretium quis quam in, sagittis lobortis urna. Proin ullamcorper urna leo, ut rutrum nulla condimentum a. Nullam pharetra rhoncus libero quis tincidunt. Nulla sed odio mauris. In non gravida libero. Donec vitae pretium dolor.

Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla vel venenatis velit, nec porttitor neque. Integer non viverra magna, ac tincidunt libero. Aenean eu facilisis elit. Quisque et nunc congue, dapibus lectus vitae, congue est. Phasellus sit amet pharetra turpis. Integer id erat at ipsum aliquam placerat. Nullam congue metus sit amet mi maximus, ut elementum augue consectetur. Aliquam ultricies interdum ipsum id sodales. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas quis aliquet nibh. Integer eget accumsan magna. Vivamus massa lacus, sollicitudin eget viverra vel, suscipit at nisi. Nam mattis blandit neque, eu suscipit turpis. Aliquam nec finibus nulla, sit amet varius risus. Mauris quis facilisis purus.

Nulla nisl est, ultricies non varius a, facilisis quis erat. Ut iaculis molestie pulvinar. Nullam eget pharetra lorem, nec rhoncus ipsum. Aenean ac finibus ligula. Vestibulum augue nunc, volutpat in orci a, rhoncus aliquet velit. Proin metus tellus, pulvinar quis efficitur vitae, blandit quis lacus. Donec scelerisque neque sed felis ullamcorper laoreet.

Curabitur tortor sapien, tempus non ligula non, convallis luctus felis. Suspendisse potenti. Phasellus vitae est maximus mauris interdum dignissim vitae non neque. Nulla sed risus aliquet, tincidunt tortor sagittis, vestibulum enim. Donec vitae aliquet felis, nec tincidunt justo. Suspendisse scelerisque quis lorem eget venenatis. Cras vel imperdiet lectus, sed porttitor enim. Nam ac erat gravida lorem porta lacinia eget at lectus.

';
    return $lorem;
}

Conexion::cerrar_conexion();
?>
