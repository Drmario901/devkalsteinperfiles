<header class="header" data-header>
    <?php

        include 'navbar.php';
    
    ?>
    <script>
        let page = "bitacora";

        document.querySelector('#link-' + page).classList.add("active");
        document.querySelector('#link-' + page).removeAttribute("style");
    </script>
</header>
<main>   
    <article class="container article">

        <div class="row">
            <nav class='nav nav-borders my-quotes-nav'>
                <a class='nav-link active ms-0' href='#' id='btnModAccounts'>Acounts</a>
                <a class='nav-link' href='#' id='btnModProducts'>Products</a>
                <a class='nav-link' href='#' id='btnModQuotes'>Quotes</a>
            </nav>
             <!-- SECTION ACCOUNT -->                    
            <div class='row gap-2' style='margin-top: 2rem !important; width: 100%;'>
                <div class="col">
                    <div class="row h-100 d-flex align-items-start" style='border: 1px solid #c9c9c9; border-radius: 1rem; padding: 1rem;'>
                        <div style='display: grid; place-items: center;'>
                            <i class="fa-solid fa-users" style="font-size: 2em; width: 60px; height: 60px; background-color: #dadada; border-radius: 100%; padding: 0.7rem; display: flex; align-items: center; justify-content: center;"></i>
                        </div>
                        <div>
                            <h6 class='text-center mt-3'>Total Accounts</h6>
                            <?php
                                $consultTotalAccount = "SELECT * FROM wp_account";
                                $resultTotalAccount = $conexion->query($consultTotalAccount);
                                $countTotalAccount = mysqli_num_rows($resultTotalAccount);
                                echo "<p class='text-center'>$countTotalAccount</p>"; 
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row h-100 d-flex align-items-start" style='border: 1px solid #c9c9c9; border-radius: 1rem; padding: 1rem;'>
                        <div style='display: grid; place-items: center;'>
                            <i class="fa-solid fa-user" style="font-size: 2em; width: 60px; height: 60px; background-color: #dadada; border-radius: 100%; padding: 0.7rem; display: flex; align-items: center; justify-content: center;"></i>
                        </div>
                        <div>
                            <h6 class='text-center mt-3'>Client Accounts</h6>
                            <?php
                                $consultTotalAccountClient = "SELECT * FROM wp_account WHERE account_rol_aid = '1'";
                                $resultTotalAccountClient = $conexion->query($consultTotalAccountClient);
                                $countTotalAccountClient = mysqli_num_rows($resultTotalAccountClient);
                                echo "<p class='text-center' style='display: flex; flex-direction: column; align-items: center; gap: 5px; justify-content: space-between;'>$countTotalAccountClient <a href='#' style='color: #fff !important; background-color: #213280; text-align: center; width: fit-content;' class='btn btn-primary bottom-0' id='btnViewMoreAccClient' data-bs-toggle='modal' data-bs-target='#modalClientAcc'>View more</a></p>"; 
                            ?>
                        </div>
                    </div>
                </div>
                <button style="display: none;" id="btnViewHistoryActivityAccount" data-bs-toggle="modal" data-bs-target="#modalHistoryActivityAccount"></button>
                <div class="col">
                    <div class="row h-100 d-flex align-items-start" style='border: 1px solid #c9c9c9; border-radius: 1rem; padding: 1rem;'>
                        <div style='display: grid; place-items: center;'>
                            <i class="fa-solid fa-user-tie" style="font-size: 2em; width: 60px; height: 60px; background-color: #dadada; border-radius: 100%; padding: 0.7rem; display: flex; align-items: center; justify-content: center;"></i>
                        </div>
                        <div">
                            <h6 class='text-center mt-3'>Manufacturer Accounts</h6>
                            <?php
                                $consultTotalAccountClient = "SELECT * FROM wp_account WHERE account_rol_aid = '3'";
                                $resultTotalAccountClient = $conexion->query($consultTotalAccountClient);
                                $countTotalAccountClient = mysqli_num_rows($resultTotalAccountClient);
                                echo "<p class='text-center' style='display: flex; flex-direction: column; align-items: center; gap: 5px; justify-content: space-between;'>$countTotalAccountClient <a href='#' style='color: #fff !important; background-color: #213280; text-align: center; width: fit-content;' class='btn btn-primary bottom-0' id='btnViewMoreAccManufacturer' data-bs-toggle='modal' data-bs-target='#modalManufacturerAcc'>View more</a></p>"; 
                            ?>
                        </div>
                    </div>
                <div class="col">
                    <div class="row h-100 d-flex align-items-start" style='border: 1px solid #c9c9c9; border-radius: 1rem; padding: 1rem;'>
                        <div style='display: grid; place-items: center;'>
                            <i class="fa-solid fa-user-group" style='font-size: 2em; width: 60px; height: 60px; background-color: #dadada; border-radius: 100%; padding: 0.7rem; display: flex; align-items: center; justify-content: center;'></i>
                        </div>
                        <div >
                            <h6 class='text-center mt-3'>Distribuitor Accounts</h6>
                            <?php
                                $consultTotalAccountClient = "SELECT * FROM wp_account WHERE account_rol_aid = '2'";
                                $resultTotalAccountClient = $conexion->query($consultTotalAccountClient);
                                $countTotalAccountClient = mysqli_num_rows($resultTotalAccountClient);
                                echo "<p class='text-center' style='display: flex; flex-direction: column; align-items: center; gap: 5px; justify-content: space-between;'>$countTotalAccountClient <a href='#' style='color: #fff !important; background-color: #213280; text-align: center; width: fit-content;' class='btn btn-primary bottom-0' id='btnViewMoreAccDistribuitor' data-bs-toggle='modal' data-bs-target='#modalDistribuitorAcc'>View more</a></p>"; 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class='row gap-2 d-flex justify-content-between' style='margin-top: 2rem !important; width: 100%;'>
                <div class="col">
                    <div class="row h-100 d-flex align-items-start" style='border: 1px solid #c9c9c9; border-radius: 1rem; padding: 1rem;'>
                        <div style='display: grid; place-items: center;'>
                            <i class="fa-solid fa-user-clock" style='font-size: 2em; width: 60px; height: 60px; background-color: #dadada; border-radius: 100%; padding: 0.7rem; display: flex; align-items: center; justify-content: center;'></i>
                        </div>
                        <div>
                            <h6 class='text-center mt-3'>Rental & Sales Accounts</h6>
                            <?php
                                $consultTotalAccountClient = "SELECT * FROM wp_account WHERE account_rol_aid = '5'";
                                $resultTotalAccountClient = $conexion->query($consultTotalAccountClient);
                                $countTotalAccountClient = mysqli_num_rows($resultTotalAccountClient);
                                echo "<p class='text-center' style='display: flex; flex-direction: column; align-items: center; gap: 5px; justify-content: space-between;'>$countTotalAccountClient <a href='#' style='color: #fff !important; background-color: #213280; text-align: center; width: fit-content;' class='btn btn-primary bottom-0' id='btnViewMoreAccRental' data-bs-toggle='modal' data-bs-target='#modalRentalAcc'>View more</a></p>"; 
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row h-100 d-flex align-items-start" style='border: 1px solid #c9c9c9; border-radius: 1rem; padding: 1rem;'>
                        <div style='display: grid; place-items: center;'>
                            <i class="fa-solid fa-users-gear" style='font-size: 2em; width: 60px; height: 60px; background-color: #dadada; border-radius: 100%; padding: 0.7rem; display: flex; align-items: center; justify-content: center;'></i>
                        </div>
                        <div>
                            <h6 class='text-center mt-3'>Technical Support Accounts</h6>
                            <?php
                                $consultTotalAccountClient = "SELECT * FROM wp_account WHERE account_rol_aid = '4'";
                                $resultTotalAccountClient = $conexion->query($consultTotalAccountClient);
                                $countTotalAccountClient = mysqli_num_rows($resultTotalAccountClient);
                                echo "<p class='text-center' style='display: flex; flex-direction: column; align-items: center; gap: 5px; justify-content: space-between;'>$countTotalAccountClient <a href='#' style='color: #fff !important; background-color: #213280; text-align: center; width: fit-content;' class='btn btn-primary bottom-0' id='btnViewMoreAccTechnical' data-bs-toggle='modal' data-bs-target='#modalTechnicalAcc'>View more</a></p>"; 
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row h-100 d-flex align-items-start" style='border: 1px solid #c9c9c9; border-radius: 1rem; padding: 1rem;'>
                        <div style='display: grid; place-items: center;'>
                            <i class="fa-solid fa-user-astronaut" style='font-size: 2em; width: 60px; height: 60px; background-color: #dadada; border-radius: 100%; padding: 0.7rem; display: flex; align-items: center; justify-content: center;'></i>
                        </div>
                        <div>
                            <h6 class='text-center mt-3'>Scientist Accounts</h6>
                            <?php
                                $consultTotalAccountClient = "SELECT * FROM wp_account WHERE account_rol_aid = '6'";
                                $resultTotalAccountClient = $conexion->query($consultTotalAccountClient);
                                $countTotalAccountClient = mysqli_num_rows($resultTotalAccountClient);
                                echo "<p class='text-center' style='display: flex; flex-direction: column; align-items: center; gap: 5px; justify-content: space-between;'>$countTotalAccountClient <a href='#' style='color: #fff !important; background-color: #213280; text-align: center; width: fit-content;' class='btn btn-primary bottom-0' id='btnViewMoreAccScientist' data-bs-toggle='modal' data-bs-target='#modalScientistAcc'>View more</a></p>"; 
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row h-100 d-flex align-items-start" style='border: 1px solid #c9c9c9; border-radius: 1rem; padding: 1rem;'>
                        <div style='display: grid; place-items: center;'>
                            <i class="fa-solid fa-user-large-slash" style='font-size: 2em; width: 60px; height: 60px; background-color: #dadada; border-radius: 100%; padding: 0.7rem; display: flex; align-items: center; justify-content: center;'></i>
                        </div>
                        <div>
                            <h6 class='text-center mt-3'>Undetermined Accounts</h6>
                            <?php
                                $consultTotalAccountClient = "SELECT * FROM wp_account WHERE account_rol_aid = '0'";
                                $resultTotalAccountClient = $conexion->query($consultTotalAccountClient);
                                $countTotalAccountClient = mysqli_num_rows($resultTotalAccountClient);
                                echo "<p class='text-center' style='display: flex; flex-direction: column; align-items: center; gap: 5px; justify-content: space-between;'>$countTotalAccountClient <a href='#' style='color: #fff !important; background-color: #213280; text-align: center; width: fit-content;' class='btn btn-primary bottom-0' id='btnViewMoreAccUndetermined' data-bs-toggle='modal' data-bs-target='#modalUndeterminedAcc'>View more</a></p>"; 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class='row d-flex align-items-end my-3'>
                <!-- FILTERS -->
                
                <div class='col-6'>
                    <label class='small mb-1'>Status</label>
                    <select class='form-select' id='log-filter' style='height: 2.8em; outline: 1px solid #213280; font-size: 0.9em;'>
                        
                    <option value='all' selected>All</option>
                    <option value='a_aproved'> Account Validated </option>
                    <option value='a_denied' > Account Denied </option>
                    <option value='p_aproved'> Product Validated </option>
                    <option value='p_denied' > Product Denied </option>
                    <option value='q_aproved'> Quote Processed </option>
                    <option value='q_denied' > Quote Cancelled </option>
                    
                </select>
                </div>
                <div class='col-6 px-0'>
                    <input type='text' id='log-search-term' class='inputSearchQuote' style='margin-bottom: 0 !important; width: 100% !important; border-radius: 5px;' placeholder='Search...'>
                </div>
            </div>
    
            <!-- TABLE -->
            <div id="tbl-log">
            </div>
    
            <!-- PAGINATION -->
            <div class='pagination' style='display: flex; align-items: center; gap: 10px;'>
                <input type="hidden" id="log-tbl-p" value="1">
                <div id="log-tbl-p-label">Page: 1</div>
                
                <button id="log-tbl-prev" style='padding: 10px; border: 1px solid #444; border-radius: 5px;'>« Previous</button>
                <button id="log-tbl-next" style='padding: 10px; border: 1px solid #444; border-radius: 5px;'>Next »</button>
            </div>
        </div>
                <!-- <div class='col-xl-2'>
                    <label class='small mb-1'>Status</label>
                    <select class='form-select' aria-label='Default select example' id='binnacle-filter' style='height: 2.8em; outline: 1px solid #213280; font-size: 0.9em;'>
                        <option value='all' selected>All</option>
                        <option value='a_aproved'> Account Validated </option>
                        <option value='a_denied' > Account Denied </option>
                        <option value='p_aproved'> Product Validated </option>
                        <option value='p_denied' > Product Denied </option>
                        <option value='q_aproved'> Quote Processed </option>


                        <option value='q_denied' > Quote Cancelled </option>
                    </select>
                </div>
                <div class='col-xl-6 input-wrapper-p'>
                    <label class='small mb-1 d-block' for='inputSearchQuote'>&nbsp;</label>
                    <div class="d-flex flex-row">
                        <input type='text' id='aditional-searhc-term' class='inputSearchQuote'>
                        <button id='btnSearchQuote' class='btnSearchQuote'>Search</button>
                    </div>
                    <i class='fa-solid fa-magnifying-glass second-glass'></i>
                </div> -->
            </div>
            <div class="row">

            </div>
            <div class="row">
                
            </div>

            <div id="tbl-binnacle">
            </div>

            <!-- Modal Client Account-->
            <div class="modal modal-xl fade" id="modalClientAcc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Clients Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="tblClientAcc">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal Distribuitor Account-->
            <div class="modal modal-xl fade" id="modalDistribuitorAcc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Clients Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="tblDistribuitorAcc">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal Manufacturer Account-->
            <div class="modal modal-xl fade" id="modalManufacturerAcc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Clients Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="tblManufacturerAcc">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal Rental & Sales Account-->
            <div class="modal modal-xl fade" id="modalRentalAcc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Rental & Sales Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="tblRentalAcc">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal Technical Support Account-->
            <div class="modal modal-xl fade" id="modalTechnicalAcc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Technical Support Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="tblTechnicalAcc">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal Scientist Account-->
            <div class="modal modal-xl fade" id="modalScientistAcc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Scientist Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="tblScientistAcc">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal Undetermined Account-->
            <div class="modal modal-xl fade" id="modalUndeterminedAcc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Undetermined Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="tblUndeterminedAcc">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal Histoy Account -->
            <div class="modal" id="modalHistoryActivityAccount" tabindex="1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <h6>Activity history</h6>
                            </div>
                            <div class="col-6" style="border-right: 1px solid #c9c9c9;">
                                <div class="row">
                                    <div class="col-12">
                                        Quotes
                                    </div>
                                    <div class="col-12">
                                        <div class="tblHistoryQuote">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6" style="border-left: 1px solid #c9c9c9">
                                <div class="row">
                                    <div class="col-12">
                                        Activity
                                    </div>
                                    <div class="col-12">
                                        <div class="tblHistoryQuote">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</main>