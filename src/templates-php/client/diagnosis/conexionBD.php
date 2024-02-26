<?php

    /*
    
    El link utilizado para las pruebas en el hosting sera:
    
    https://plataforma.kalstein.net/test/HolaMundo.php

    Nombres de las tablas a usar:
    
    
    
    */ 
    
    class ConexionBD{

    
    public static function conectarBD(){
        
        
        
        $link = new PDO("mysql:host=localhost;dbname=he270716_wp_es","he270716",".Kx7*WTp@{,g");
        $link->exec("set names utf8");
        
        return $link;
    
    
    }
    
    

}
    


?>