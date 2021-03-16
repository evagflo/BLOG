<?php

class Entrada 
{
    // identitats o atributs
    private $id; // crear atribut que s'anomena ID i per aixo es veu que esta en verd
    private $autor_id;
    private $url;
    private $titulo;
    private $texto;
    private $fecha;
    private $activa;

    //constructor
    public function __construct ($id, $autor_id, $url, $titulo, $texto, $fecha, $activa) 
    {
        $this-> id = $id;
        $this-> autor_id = $autor_id;
        $this-> url = $url;
        $this-> titulo = $titulo;
        $this-> texto = $texto;
        $this-> fecha = $fecha;
        $this -> activa = $activa;
    }
    
    //GETERS
   public function obtener_entrada_id()
  {
    return $this -> id;  
   }
   
   public function obtener_autor_id()
   {
     return $this -> autor_id;  
   }
   
   public function obtener_url()
   {
     return $this -> url;  
   }
   
   public function obtener_titulo_entrada()
   {
     return $this -> titulo;  
   }
   
   public function obtener_texto_entrada()
   {
     return $this -> texto;  
   }
  
   public function obtener_fecha_entrada()
   {
     return $this -> fecha;  
   }
   
   public function esta_activa_entrada()
   {
     return $this -> activa;  
   }
   
   //SETTERS
    public function cambiar_titulo($titulo)
    {
        $this -> titulo = $titulo;
    }
    public function cambiar_url($texto)
    {
        $this -> url = $url;
    }
    
    public function cambiar_texto($texto)
    {
        $this -> texto = $texto;
    }
    
    public function cambiar_activa($activa)
    {
        $this -> activa = $activa;
    }

}


