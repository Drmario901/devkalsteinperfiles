<?php

    include "conexionBD.php";



     if(!empty($_POST["uid"])){
         
         $uid = $_POST["uid"];
         
        //Preparar la peticion
        $sqlQuery = ConexionBD::conectarBD()->prepare("SELECT * FROM wp_prodClientDiagSysApp WHERE UIDprod=\"$uid\"");
         
        if($sqlQuery->execute()){
            
            $data = $sqlQuery->fetch();
            
            if(!empty($data["UIDprod"])){
                
                $diagres=$data["diag_res"];     //Es preferible preguntar por el resultado del diagnostico
                                               //pues el resultado aparece cuando el diagnostico termina
                                                //el dispositivo al recibir la orden limpia la columna "diag_res"
                if($diagres==""){
                    
                    echo "WAIT";
                    
                }else{
                    
                    //Si devuelve contenido quiere decir que ya esta disponible el resultado
                    //del diagnostico, asi que luego de tomarlo se puede limpiar la columna
                    //de diagnostico de ese dispositivo para que quede en blanco. Disponible
                    //para cuando se haga otro diagnostico
                    
                    $sqlCleanDiagRes = ConexionBD::conectarBD()->prepare("UPDATE wp_prodClientDiagSysApp SET diag_res=\"\" WHERE UIDprod=\"$uid\"");
                    
                        //Ejecutar la peticion
                        if($sqlCleanDiagRes->execute()){
                            
                            //Si se ejecuta correctamente
                            echo $diagres;

                        }else{
                            
                            //Si no se ejecuta 
                            echo "FAIL_SERVER";
                        }
                    
                    
                }
                
            }else{
                
                 echo "FAIL_SERVER";
                
            }
            
        }else{
            
            echo "FAIL_SERVER";
            
        }
         
     }else{
        
         echo "VOID";
         
     }


?>