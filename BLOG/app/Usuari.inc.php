<?php

class Usuari 
{
    // identitats o atributs
    private $id; // crear atribut que s'anomena ID i per aixo es veu que esta en verd
    private $nombre;
    private $email;
    private $password;
    private $data_registre;
    private $activo;

   //constructor
   public function __construct($id,$nombre,$email,$password,$data_registre,$activo)
   {
        $this ->id= $id; // l'atribut de la classe sea el mateix que el del coonstructor
        $this ->nombre= $nombre;
        $this ->email= $email;
        $this ->password= $password;
        $this ->activo= $activo;
        $this-> data_registre= $data_registre;
       
   }
   
   //getters and setters ens permeten obtenir informacions
   // no permeten fer canvis en les variables
   // el public function es = a crear un afuncio que jo anomeno com vull i dins de corchetes poso lo que ha de fer
   
//GETERS
   public function obtener_id()
  {
     return $this -> id;  
   }
   public function obtener_nombre()
   {
     return $this -> nombre;  
   }
   public function obtener_email()
   {
     return $this -> email;  
   }
   public function obtener_password()
   {
     return $this -> password;  
   }
   public function obtener_data_registro()
   {
     return $this -> data_registre;  
   }
   public function esta_activo()
   {
     return $this -> activo;  
   }
//SETTERS

    public function cambiar_nombre($nombre)
    {
        $this -> nombre = $nombre;
    }
    public function cambiar_email($email)
    {
        $this -> email = $email;
    }
    public function cambiar_password($password)
    {
        $this -> password = $password;
    }
    public function cambiar_estado($activo)
    {
        $this -> activo = $activo;
    }
    
   
   
}
