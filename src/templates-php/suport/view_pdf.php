<?php

include 'navdar.php';?>
        <script>
        let page = "services";

        document.querySelector('#' + page).classList.add("active");
        document.querySelector('#' + page).removeAttribute("style");
    </script>
    <br>
<br>
<br>
<br>
<br>
<br>
<?php
                            

                            require __DIR__.'/../../../php/conexion.php';

                
    
 if (isset($_GET["edit"])) {
     $edit = $_GET["edit"];

                            $consulta = "SELECT * FROM `wp_manuales` where M_id='$edit'";		
                                
                            $resultado = $conexion->query($consulta);	
                                
                            if ($resultado->num_rows > 0) {
                                while ($value = $resultado->fetch_assoc()) {
                                    $id=$value['M_id'];
                                    $pdf=$value['M_pdf'];
                                        
                                        if ($edit == $id){
                                            echo "<div class='_df_book' 
                                            source='http://127.0.0.1/wp-local/wp-content/plugins/kalsteinPerfiles/src/manuales/pdf/$pdf'
                                            ></div>
                                       ";
                                        }
                                        else{ echo "<div class='_df_book' 
                                            source='http://127.0.0.1/wp-local/wp-content/plugins/kalsteinPerfiles/src/manuales/pdf/$pdf'
                                            ></div>";
                                             
                                        }
                                    }
                                       
                                }
                            }else {
                                echo "<div class='_df_book' 
                                source='http://127.0.0.1/wp-local/wp-content/plugins/kalsteinPerfiles/src/manuales/pdf/$pdf'
                                ></div>";
                            }
    
                        ?>
                       

