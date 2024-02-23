<?php
    

        
    include "conexionBD.php";

    /*
    
    
            Registrar un equipo Kalstein bajo un propietario
            por medio de su UID
            
    
    */
function borrarVarsPOST(){
    
    echo '<script>if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}</script>';
    
    
}
    
    if(!empty($_POST["uid"]) && !empty($_POST["username"])){
        
        //Si no estan vacias ejecutar la peticion
        
        $uid = $_POST["uid"];
        $username = $_POST["username"];
        
        //Preparar la peticion para verificar que no eset ya registarado bajo otro cliente
        $sqlQuery = ConexionBD::conectarBD()->prepare("SELECT * FROM wp_prodClientDiagSysApp WHERE UIDprod=\"$uid\"");
        
        if($sqlQuery->execute()){
            
            $data = $sqlQuery->fetch();
            
            if(!empty($data["UIDprod"])){
                
                //Si devolvio contenido es porque ya esta registrado
                borrarVarsPOST();
                echo '<div class="centerDiv"><div class="alert alert-danger" role="alert">El producto ya ha sido registrado por otro cliente!</div></div>';
                
                
            }else{
                
                /*Buscar el UID en la tabla intermedia y asignarlo en la tabla de diagnostico con el 
                usuario propietario*/
                $sqlQuerySearch = ConexionBD::conectarBD()->prepare("SELECT * FROM wp_prodRegApp WHERE prod_uid=\"$uid\"");
                
                if($sqlQuerySearch->execute()){
                    
                    $dataProd = $sqlQuerySearch->fetch();
                    
                    if(!empty($dataProd["prod_uid"])){
                        
                        //Si no viene vacio es porque si existe el uid y luego se afilia al cliente.
                        //OJO: $username ya se recupero al inicio del 1er IF
                        $descrip = $dataProd["prod_descrip"];
                        $uid = $dataProd["prod_uid"];
                        $modelo = $dataProd["prod_model"];
                        $img = $dataProd["prod_img"];
                        
                        //Insertar el registro bajo el cliente
                        $sqlRegProd = ConexionBD::conectarBD()->prepare("INSERT INTO wp_prodClientDiagSysApp (owner_user, model, descrip, img_link, UIDprod) VALUES (\"$username\",\"$modelo\",\"$descrip\",\"$img\",\"$uid\")");
                            
                        //Ejecutar el INSERT
                        if($sqlRegProd->execute()){
                            
                            //Registrado exitosamente
                            borrarVarsPOST();
                            echo '<div class="centerDiv"><div class="alert alert-success" role="alert">El producto fue registrado exitosamente!</div></div>';

                        }else{
                            
                            borrarVarsPOST();
                            echo '<div class="centerDiv"><div class="alert alert-danger" role="alert">Ha ocurrido un error de servidor!</div></div>';
                        }
                        
                        
                    }else{
                        
                        //Si viene vacio es porque no existe el uid
                        borrarVarsPOST();
                        echo '<div class="centerDiv"><div class="alert alert-danger" role="alert">El UID de producto no existe!</div></div>';
                        
                    }
                    
                    
                    
                }else{
                    
                    borrarVarsPOST();
                    echo '<div class="centerDiv"><div class="alert alert-danger" role="alert">Ha ocurrido un error de servidor!</div></div>';

                }
                
            
                
            }
            

            
        }else{
            
            borrarVarsPOST();
            echo '<div class="centerDiv"><div class="alert alert-danger" role="alert">Ha ocurrido un error de servidor!</div></div>';
        }
    
    
    
    
    }
    

?>