<?php
        
    include "conexionBD.php";


    if(!empty($_POST["uid"])){
        
        //Si no esta vacia ejecutar la peticion
        
        $uid = $_POST["uid"];
        
        //Preparar la peticion
        $sqlQuery = ConexionBD::conectarBD()->prepare("SELECT * FROM wp_prodClientDiagSysApp WHERE UIDprod=\"$uid\"");
        
        if($sqlQuery->execute()){
            
            $data = $sqlQuery->fetch();
            
                //Si el UID es valido, verificar que no se este ejecutando previamente un diagnostico
                if(!empty($data["UIDprod"])){
                    
                    $statusNow = $data["diag_status"];
                    
                    if($statusNow!="EXECUTING"){
                        
                        $sqlStart = ConexionBD::conectarBD()->prepare("UPDATE wp_prodClientDiagSysApp SET diag_init=\"1\" WHERE UIDprod = \"$uid\"");
                    
                            if($sqlStart->execute()){

                                echo "OK";

                            }else{

                                echo "FAIL_SERVER";
                            }

                        
                    }else{
                        
                        echo "DENIED";
                        
                    }
                    
                    
                   
                    
                }else{
                    
                    //Si el uid no es valido
                    echo "NOT_VALID";
                    
                }
            
        }else{
            
            //Falla de servidor de BD
            echo "FAIL_SERVER";
            
        }
        
    }else{
        
        echo "VOID";
        
    }



?>