<?php

    session_start();  

    if(isset($_GET["pag"]) && isset($_SESSION["user_tag"])){
            
            
            echo "Bienvenidos: ".$_SESSION["user_tag"]. " pagina: ".$_GET["pag"];
            

        }else{
            
            //El login ya esta hecho. Aqui hay que poner es el link que devuelva a la seccion
            //del login
            echo "Inicia sesion bro!";
            
        }
        
?>

<script>
    var user_tag = '<?php $test = $_SESSION['user_tag']; ?>'; 
    console.log(user_tag)
</script>


