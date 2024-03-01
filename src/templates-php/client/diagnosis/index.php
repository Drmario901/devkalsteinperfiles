<div id='c-panel10' style='display: none;'>
<?php
    
//session_start();  //Borrar al finalizar todo porque en el archivo del hosting ya esta este comando
//$_SESSION["user_tag"] = "Junior";
    
    if(isset($_GET["pag"]) && isset($_SESSION["user_tag"])){
            
            
                
            if($_GET["pag"] == "login" || $_GET["pag"] == "register"
              || $_GET["pag"] == "exit" || $_GET["pag"] == "diagsys" || $_GET["pag"] == "diag"  ){

                include $_GET["pag"].".php";

            }else{

                /*Mostrar error 404 si no se coloca ninguna pagina
                valida*/
                include "error404.php";
            }

                
            

        }else{
            
            //El login ya esta hecho. Aqui hay que poner es el link que devuelva a la seccion
            //del login
            echo "Inicia sesion !";
            
        }
        
?>