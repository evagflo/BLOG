<?php

include_once 'repositorioEntrada.inc.php';
include_once 'Validador.inc.php';


class ValidadorEntradaEditada extends Validador
{
    private $cambios_realizados;
    private $checkbox;
    
    private $titulo_original;
    private $url_original;
    private $texto_original;
    private $chekcbox_original;
    
    public function __construct ($titulo, $titulo_original,$url, $url_original,
            $texto, $texto_original, $checkbox, $checkbox_original, $conexion)
    {
        $this -> titulo = $this -> devolver_variable_si_iniciada($titulo);
       // echo $this -> titulo;
        $this -> url = $this -> devolver_variable_si_iniciada($url);
        $this -> texto = $this -> devolver_variable_si_iniciada($texto);
        $this -> checkbox = $this -> devolver_variable_si_iniciada($checkbox);
        
        $this -> titulo_original = $this -> devolver_variable_si_iniciada($titulo_original);
       // echo $this -> titulo_original;
        $this -> url_original = $this -> devolver_variable_si_iniciada($url_original);
        $this -> texto_original = $this -> devolver_variable_si_iniciada($texto_original);
        $this -> checkbox_original = $this -> devolver_variable_si_iniciada($checkbox_original);
        
        //canvis...
        
        if ($this -> titulo == $this -> titulo_original &&
            $this -> url == $this -> url_original &&
            $this -> texto == $this -> texto_original &&
            $this -> checkbox == $this -> checkbox_original)
        {
           
            $this -> cambios_realizados = false;
        }
        else
        {
             $this -> cambios_realizados = true;
        }
        
        if ($this -> cambios_realizados)
        {
           // echo ' hi ha canvis';
            
            $this->aviso_inicio = "<br> <div class='alert alert-danger' role='alert'> ";
            $this->aviso_cierre = "</div>";
            
            //titol
            if ( $this -> titulo !== $this-> titulo_original)
            {
                $this -> error_titulo =  $this -> validar_titulo($conexion, $this->titulo);
            }
            else 
            {
                $this -> error_titulo = "";
            }
            
            //url
            if ( $this -> url !== $this-> url_original)
            {
                $this -> error_url =  $this -> validar_url($conexion, $this->url);
            }
            else 
            {
                $this -> error_url = "";
            }
            
            //texto
            if ( $this -> texto !== $this-> texto_original)
            {
                $this -> error_texto =  $this -> validar_texto ($this->titulo);
            }
            else 
            {
                $this -> error_texto = "";
            }
            
        }
        else
        {
            //echo ' no hi ha canvis';
            //redirigir;
        }
        
    }
    
    private function devolver_variable_si_iniciada($variable)
    {
        if ($this -> variable_iniciada($variable))
        {
            return $variable;
        }
        else
        {
            return "";
        }
    }
    
    public function hay_cambios ()
    {
        return $this -> cambios_realizados;
    }
    
    public function obtener_titulo_original()
    {
        return $this -> titulo_original;
    }
    
    public function obtener_url_original()
    {
        return $this -> url_original;
    }
  
    public function obtener_texto_original()
    {
        return $this -> texto_original;
    }
    
    public function obtener_checkbox_original()
    {
        return $this -> checkbox_original;
    }
    
    public function obtener_checkbox()
    {
        return $this -> checkbox;
    }
    
    
    
}
