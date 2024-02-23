<?php

    include "conexionBD.php";

    /*
            
        Obtener los productos registrados del cliente
        El nombre del cliente viene en la variable
        
        $_POST["username"];
    
    */

    if(!empty($_POST["username"])){
        
        //1.Si la variable no viene vacia
        $usernameClient = $_POST["username"];
        
        //Preparar la peticion
        $sqlQuery = ConexionBD::conectarBD()->prepare("SELECT * FROM wp_prodClientDiagSysApp WHERE owner_user=\"$usernameClient\"");
        
        //Ejecutar la peticion
        if($sqlQuery->execute()){
            
            //Si se ejecuta correctamente la peticion
            $prodsClient = $sqlQuery->fetchAll();
            
            $prodsArray = array();

                foreach($prodsClient as $key => $value){

                    $prodsArray[] = array("id"=>$value["id"],
                                     "modelo"=>$value["model"],
                                      "uid"=>$value["UIDprod"],
                                      "descrip"=>$value["descrip"],
                                      "imglink"=>$value["img_link"]);

                }


                $JSON_Array_String = json_encode($prodsArray);
            
                echo $JSON_Array_String;
            
        }else{
            
            //Si ocurrio un error al ejecutar la peticion
            echo "FAIL";
        }
          
        
    }else{
        
        //2. Si la variable viene vacia
        echo "VOID";
        
    }


?>