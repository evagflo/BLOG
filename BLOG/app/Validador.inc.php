<?php

abstract class Validador
{
    protected $aviso_inicio;
    protected $aviso_cierre;
    
    protected $titulo;
    protected $url;
    protected $texto;
    
    protected $error_titulo;
    protected $error_url;
    protected $error_texto;
    
    function __construct ()
    {
        
    }
    
    protected function variable_iniciada($variable) { // la variable s'ha completat?
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }
    
    protected function validar_titulo($conexion, $titulo)
    {
         echo $titulo;
        if(!$this->variable_iniciada($titulo))
        {
            return "Has d'escriure un títol.";
        }
        else
        {
            $this-> titulo = $titulo;
        }
        
        if(strlen($titulo) > 255)
        {
            return "El títol no pot ocupar més de 255 caràcters.";
        }
        
        if (repositorioEntrada::titulo_existe($conexion, $titulo))
        {
           
            return "Ja existeix una entrada amb aquest títol. Sisplau escull un títol diferent." ;
        }
    }
    
    protected function validar_url($conexion, $url)
    {
        if (!$this -> variable_iniciada($url) )
        {
            return "Has d'escriure una URL.";
        }
        else
        {
            $this -> url = $url;
        }
        
        $url_tratada= str_replace(' ','',$url);
        $url_tratada= preg_replace('/\s+/','',$url_tratada); // expressio regular que detecta espai ens alguna codificació que php no compren
        
        if(strlen($url) != strlen($url_tratada)) //treu espais en blanc
        {
            return "La URL no pot contenir espais en blanc.";
        }
        
        if (repositorioEntrada::url_existe($conexion, $url))
        {
         return "Ja existeix una entrada amb aquesta URL. Sisplau escull una URL diferent." ;
        }
    }
    
    protected function validar_texto($texto)
    {
        if( !$this -> variable_iniciada($texto))
        {
            return  "El contingut del text no pot estar buit.";
        }
        else
        {
            $this -> texto = $texto;
        }
    }
    
    public function obtener_titulo()
    {
        return $this -> titulo;
    }
    
    public function obtener_url()
    {
        return $this -> url;
    }
    
    public function obtener_texto()
    {
        return $this -> texto;
    }
    
    public function mostrar_titulo()
    {
        if ($this-> titulo !== "")
        {
            echo 'value = "' . $this->titulo . '"';
        
        }
    }
    
    public function mostrar_url()
    {
        if ($this-> url !== "")
        {
            echo 'value = "' . $this->url . '"';
        }   
    }
    
    public function mostrar_texto()
    {
        if($this->texto !== "" && strlen(trim($this->texto)) > 0)
        {
            echo $this -> texto;
        }
    }
    
    public function mostrar_error_titulo()
    {
        if ($this->error_titulo !== "")
        {
            echo $this -> aviso_inicio . $this -> error_titulo . $this -> aviso_cierre;
        
        }
    }
    
    public function mostrar_error_url()
    {
        if ($this->error_url !== "")
        {
            echo $this -> aviso_inicio . $this -> error_url . $this -> aviso_cierre;
        }
    }
    
    public function mostrar_error_texto()
    {
        if ($this->error_texto !== "")
        {
            echo $this -> aviso_inicio . $this -> error_texto . $this -> aviso_cierre;
        }
    }
    
    public function entrada_valida()
    {
        if ($this -> error_titulo == "" && $this -> error_url == "" &&  $this -> error_texto == "" )
        {
            return true ;
        }
        else
        {
            return false ;
        }
    }
    
    
}
?>
