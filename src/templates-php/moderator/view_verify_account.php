<header class="header" data-header>

    <?php

        include 'navbar.php';
    
    ?>
    <script>
        let page = "home";

        document.querySelector('#link-' + page).classList.add("active");
        document.querySelector('#link-' + page).removeAttribute("style");
    </script>
</header>

<style>
    input[type="checkbox"] {
        width: 20px;
        height: 20px;
        border-radius: 12px;
        margin: 0;
    }
    h6 {
    display: flex;
    align-items: center;
    gap: 10px;
    }
    .card-header {
        background-color: white;
    }
</style>

<main>   
    <article class="container article">
        <?php

            require __DIR__.'/../../../php/conexion.php';

            
            function getCountry($iso, $conexion){
                $queryPaises = "SELECT en FROM wp_paises WHERE iso = '$iso'";
                $resultPaises = $conexion->query($queryPaises);

                return $resultPaises->fetch_array()[0];
            }
            
            if(isset($_GET['accid'])){
                $val_acc_id = $_GET['accid'];
            }
            else {
                $val_acc_id = '';
            }

            $queryAction = "SELECT type, action_mod FROM wp_mod_moves WHERE type = 'account' AND action_id = '$val_acc_id'";
            $resultAction = $conexion->query($queryAction);

            if ($resultAction->num_rows > 0){
                if ($acc_id != $resultAction->fetch_assoc()['action_mod']){
                    echo "
                    <script>
                        alert('another user is in this taks');
                        window.location.href = 'https://dev.kalstein.plus/plataforma/moderator/accounts';
                    </script>
                    ";
                }
            }
            else{
                $queryModMove = "INSERT INTO wp_mod_moves (type, action_mod, action_id) VALUES ('account', '$acc_id', '$val_acc_id')";
                $resultModMove = $conexion->query($queryModMove);
            }

            $query = "SELECT * FROM wp_account WHERE account_aid = '$val_acc_id'";
            $result = $conexion->query($query);
            
            if($result->num_rows > 0){
                $row = mysqli_fetch_array($result);
                $idAcc = $row[1];
                $emailAcc = $row[2];
                $name = $row[3];
                $lastname = $row[4];
                $rolAccount = $row[5];
                $addressAcc = $row[6];
                $locationAcc = $row[7];
                $countryAcc = $row[8];
                $zipcodeAcc = $row[9];
                $phoneAcc = $row[10];
                $imgPerfil = $row[12];
                $birthdayAcc = $row[13];
                if ($birthdayAcc == '0000-00-00'){
                    $newBirthdayAcc = '0000-00-00';
                }else{
                    $newBirthdayAcc = date('Y-m-d', strtotime($birthdayAcc));
                }
                $createAt = $row[16];
                
                $document = $row[14];
                $imageDocument = $row[15];

                $queryCompany = "SELECT * FROM wp_company WHERE company_account_correo = '$idAcc'";
                $rsQuery = $conexion->query($queryCompany);
                $row2 = mysqli_fetch_array($rsQuery);

                $roleCompany = $row2[2];
                $nameCompany = $row2[3];
                $adressCompany = $row2[4];
                $stateCompany = $row2[5];
                $countryCompany = $row2[6];
                $phoneCompany = $row2[7];
                $zipcodeCompany = $row2[8];
                $websiteCompany = $row2[9];
                $rifCompany = $row2[10];
                $imgrifCompany = $row2[11];

                $countryAcc = getCountry($countryAcc, $conexion);
                $countryCompany = getCountry($countryCompany, $conexion);

                echo "
                <input type='hidden' id='acc_id' value='$val_acc_id'>
                <input type='hidden' id='e-mail' value='$idAcc'>
                <div class='card'>
                    <div class='card-header'>
                        <h4>
                        <i class="fa-solid fa-user"></i>User legal data
                        </h4>
                        <p>Por favor, revisa la información legal del usuario y marca con un check las que estén válidas.</p>
        
                        <div class='row'>
                            <div class='col-xsm-12 col-sm-6'>
                                
                                <h6>Name <input class='d-inline' type='checkbox' id='nombre'></h6>
                                $name $lastname
                            
                            </div>
                            <div class='col-xsm-12 col-sm-6'>
        
                                <h6>Country and Passport <input class='d-inline' type='checkbox' id='passport'></h6>
                                $countryAcc<br>
                                Register: $document
                                <a target='_blank' style='display: inline; text-decoration: underline' href='https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/images/images-verify/$imageDocument'>
                                    <img style='border: 1px solid #999' width=200px src='https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/images/images-verify/$imageDocument'>
                                </a>
                                <br>
                            
                            </div>
                        </div>
                    </div>
                    <div class='card-body'>
                        
                        <h4>
                            User Company data
                        </h4>
                        <p>Por favor, revisa la información de la empresa y marca con un check las que estén válidas.</p>
        
                        <div class='row mb-3' style='border-bottom: 1px solid rgba(33, 40, 50, 0.125);'>
        
                            <div class='col-xsm-12 col-sm-6'>
            
                                <h6>Company Name <input class='d-inline' type='checkbox' id='name-b'></h6>
                                $nameCompany
                                
                                <br>
                                <br>
                                
                                <h6>Location</h6>
                                <span style='display: flex;
                                align-items: center;
                                gap: 10px;'><b>Country:</b> $countryCompany <input class='d-inline' type='checkbox' id='country-b'><br></span> 
                                <span style='display: flex;
                                align-items: center;
                                gap: 10px;'><b>Zip Code:</b> $zipcodeCompany <input class='d-inline' type='checkbox' id='zipcode-b'> <br></span>
                                <span style='display: flex;
                                align-items: center;
                                gap: 10px;'><b>Address:</b> $adressCompany <input class='d-inline' type='checkbox' id='adress-b'> <br></span>
                            
                            </div>
                            <div class='col-xsm-12 col-sm-6'>
            
                                <h6>Phone <input class='d-inline' type='checkbox' id='phone-b'></h6>
                                $phoneCompany
                
                                <br>
                                <br>
                
                                <h6>Website <input class='d-inline' type='checkbox' id='web-b'></h6>
                                $websiteCompany

                                <h6>RIF <input class='d-inline' type='checkbox' id='rif-b'></h6>
                                Register: $rifCompany
                                <a target='_blank' style='display: inline; text-decoration: underline' href='https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/images/images-verify/$imgrifCompany'>
                                    <img style='border: 1px solid #999' width=200px src='https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/images/images-verify/$imgrifCompany'>
                                </a>
                            <br>
                            <br>
                            </div>

                            <div class='row'>
                            <h5>Pricing</h5>
                            <div class='col-sm-6'>

                                <label for='' style='margin-top: 20px; font-weight: 900;'>Descuento Gilson</label>
                                <input class='d-inline' type='number' id='discountGilson' value='$discountGilson'>

                            </div>
                            <div class='col-sm-6'>
                                <p><b>Last update <i class='fas fa-clock'></i></b>: $date</p>
                            </div>
                        </div>
        
                        </div>
        
                        <textarea class='mx-auto my-2' style='width: 100%; height: 150px;' placeholder='Especifica porqué se está denegando la información' id='message'></textarea>
                        <div id='btnValidate' class='mx-auto'>
                            <button type='button' class='btn btn-danger btn-block p-2 px-4 mx-auto'>
                                <h4 class='text-white pb-0'>Denegate</h4>
                            </button>
                        </div>
        
                    </div>
                </div>";

            }
            else{
                echo "no data found";
            }
        ?>

        
    </article>
</main>