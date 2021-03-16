<?php

class redireccion
{
    public static function redirigir ($url)
    {
        header('Location:'.$url,true,301);// nova web a on vull anar, i despres si es canvia la direccio  a la varra de navegacio(TRUE OR FALSE)
                                           // codi de redirecció 301 -> ALTRES CODIS:error 404 not found/ error 502...
        exit(); // o die -> que sacabi el codi
        
    }
}
?>
