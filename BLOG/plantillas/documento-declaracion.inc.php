 <?php
    
     include_once 'app/config.inc.php';
   ?>
        
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">
    
    <head>
    <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- arxius CSS incluits amb bootstrap-->
         
    <link href="<?php echo RUTA_CSS ?>bootstrap.min.css" rel="stylesheet">    
    <link href="<?php echo RUTA_CSS ?>font-awesome.min.css" rel="stylesheet">   
    <link href="<?php echo RUTA_CSS ?>estilos.css" rel="stylesheet" >
    <link href="fontawesome/css.all.css" rel="stylesheet" >
    
   <!-- ICONS-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
         
        <?php
        if (!isset ($titulo) || empty($titulo))
        {
            $titulo='Blog Eva';
        }
            echo " <title> $titulo </title>"; // '' interpreten literalment el q hi ha a adins pero " " interpreta si hi ha alguna variable
        ?>
       
       
    </head>
    
    <body>
  

