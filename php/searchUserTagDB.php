<?php 
    require __DIR__ . '../db/conexion.php';

    function getProfileImage($conexion, $userTag)
    {
        $consulta = "SELECT account_url_image_perfil, account_nombre, account_apellido
                    FROM wp_account
                    WHERE user_tag = '$userTag'";
        $resultado = $conexion->query($consulta);
        $row = $resultado->fetch_assoc();

        $imgPerfil = $row['account_url_image_perfil'];

        $name = $row['account_nombre'];
        $lastname = $row['account_apellido'];
        $firstLyricsName = strtoupper($name[0]);
        $firstLyricsLastname = strtoupper($lastname[0]);

        if ($imgPerfil == ''){
            $urlImagePerfil = 'Iconos/'.$firstLyricsName.'/'.$firstLyricsName.''.$firstLyricsLastname.'.png';
        } else {
            $urlImagePerfil = 'upload/'.$imgPerfil;
        }

        return $urlImagePerfil;
    }

    $salida = array(); 
    $numElementos = 0; 

    if (isset($_POST['consulta'])) {
        $inputSearch = $conexion->real_escape_string($_POST['consulta']);
        $consulta = "SELECT * FROM wp_account WHERE account_nombre LIKE '%$inputSearch%' OR user_tag LIKE '%$inputSearch%'";
    
        $respuesta = $conexion->query($consulta);
    
        if ($respuesta->num_rows > 0) {
            echo "<style>
                .user-container {
                    display: flex;
                    align-items: center;
                    margin: 10px;
                    padding: 10px;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    transition: box-shadow 0.3s;
                }

                .user-container:hover {
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                }

                .user-image {
                    max-width: 50px;
                    border-radius: 50%;
                }

                .user-info {
                    margin-left: 10px;
                }

                .user-link {
                    text-decoration: none;
                    color: #333;
                    font-weight: bold;
                }

                .nodatos {
                    text-align: center;
                    margin-top: 20px;
                }
            </style>";

            while ($fila = $respuesta->fetch_assoc()) {
                if ($numElementos >= 5) {
                    break; 
                }
                
                $name = $fila['account_nombre'];
                $userTag = $fila['user_tag'];
                $image = getProfileImage($conexion, $userTag);
                
                if (!empty($name) && !empty($image) && !empty($userTag)) {
                    $elemento = "
                    <li>
                        <div class='user-container'>
                            <img src='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/$image' class='user-image'> 
                            <div class='user-info'>
                                <a class='user-link' href='#' value='$userTag'> $name ($userTag)</a>
                            </div>
                        </div>
                    </li>
                    ";
                    array_push($salida, $elemento);
                    $numElementos++; 
                }
            }
        } else {
            $salida[] = "<div class='nodatos'><h6>No se encontraron datos en tu búsqueda</h6></div>";
        }
    }
    
    echo implode('', $salida);
    
    $conexion->close();
?>
