<?php
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }
    
    require_once '/conexion.php';

    $consulta = "SELECT * FROM wp_account WHERE account_correo = '$email'";
    $resultConsulta = $conexion->query($consulta);
    $row = mysqli_fetch_array($resultConsulta);
    $count = mysqli_num_rows($resultConsulta);
    $html = "";

    if ($count > 0){
        $name = $row[3];
        $lastname = $row[4];
        $imgPerfil = $row[12];
        if ($imgPerfil == ''){
            $urlImagePerfil = 'Iconos/'.$firstLyricsName.'/'.$firstLyricsName.''.$firstLyricsLastname.'.png';
        }else{
            $urlImagePerfil = 'upload/'.$imgPerfil;
        }

        $html.="
            <div class='dropdown' style='padding-top: 1rem;'>
                <a class='btn dropdown-toggle profileContent' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false' style='border: 1px solid #233280;'>
                    <div class='profileImg'>
                    <img src='https://kalstein.us/wp-content/plugins/kalsteinPerfiles/src/images/$urlImagePerfil' width='50' height='50'>
                    </div>                        
                    <div class='profileName'>
                        <p style='font-size: 0.9em;'>$name</p> 
                    </div>    
                </a>
            
                <ul class='dropdown-menu'>
                <li><a class='dropdown-item' href='https://kalstein.us/dashboard/'>Dashboard</a></li>
                <li><a class='dropdown-item' href='#' id='btnLogout'>Logout</a></li>
                </ul>
            </div>
        ";
    }else{
        $html.="
        <span class='spanLogin'>Hi, <a href='https://kalstein.us/login/' class='aLogin'>Login here!</a></span><span class='spanSignup'>or <a href='https://kalstein.us/signup/' class='aSignup'>Sign up here!</a></span>
        ";
    }

    echo $html;
    $conexion->close();