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

        <br>
        <br>
        <br>
        <br>

        <div class="row">
            <nav class='nav nav-borders my-quotes-nav'>
                <a class='nav-link active ms-0' href='#' id='btnModAccounts' data-i18n="moderator:accounts" >Acounts</a>
                <a class='nav-link' href='#' id='btnModProducts' data-i18n="moderator:products">Products</a>
                <a class='nav-link' href='#' id='btnModQuotes' data-i18n="moderator:quotes">Quotes</a>
            </nav>
             <!-- SECTION ACCOUNT -->                    
            <div class='row' style='margin-top: 2rem !important;'>
                <div class="col-6">
                    <div class="row" style='border: 1px solid #c9c9c9; border-radius: 1rem;'>
                        <div class="col-5" style='display: grid; place-items: center;'>
                            <i class="fa-solid fa-users" style="font-size: 2em;"></i>
                        </div>
                        <div class="col-7">
                            <h6 data-i18n="moderator:totalAccounts">Total Accounts</h6>
                            <?php
                                $consultTotalAccount = "SELECT * FROM wp_account";
                                $resultTotalAccount = $conexion->query($consultTotalAccount);
                                $countTotalAccount = mysqli_num_rows($resultTotalAccount);
                                echo "<p>$countTotalAccount</p>"; 
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row" style='border: 1px solid #c9c9c9; border-radius: 1rem;'>
                        <div class="col-5" style='display: grid; place-items: center;'>
                            <i class="fa-solid fa-user" style="font-size: 2em;"></i>
                        </div>
                        <div class="col-7">
                            <h6>Client Accounts</h6>
                            <?php
                                $consultTotalAccountClient = "SELECT * FROM wp_account WHERE account_rol_aid = '1'";
                                $resultTotalAccountClient = $conexion->query($consultTotalAccountClient);
                                $countTotalAccountClient = mysqli_num_rows($resultTotalAccountClient);
                                echo "<p>$countTotalAccountClient <a href='#' style='float: right; color: #fff !important; background-color: #213280;' class='btn btn-primary' id='btnViewMoreAccClient' data-bs-toggle='modal' data-bs-target='#modalClientAcc'>View more</a></p>"; 
                            ?>
                        </div>
                    </div>
                </div>
            <div>
                <button style="display: none;" id="btnViewHistoryActivityAccount" data-bs-toggle="modal" data-bs-target="#modalHistoryActivityAccount"></button>
            <div class="row" style='margin-top: 1rem !important;'>
                <div class="col-6">
                    <div class="row" style='border: 1px solid #c9c9c9; border-radius: 1rem;'>
                        <div class="col-5" style='display: grid; place-items: center;'>
                            <i class="fa-solid fa-user-tie" style="font-size: 2em;"></i>
                        </div>
                        <div class="col-7">
                            <h6 data-i18n="moderator:manufacturerAccounts">Manufacturer Accounts</h6>
                            <?php
                                $consultTotalAccountClient = "SELECT * FROM wp_account WHERE account_rol_aid = '3'";
                                $resultTotalAccountClient = $conexion->query($consultTotalAccountClient);
                                $countTotalAccountClient = mysqli_num_rows($resultTotalAccountClient);
                                echo "<p>$countTotalAccountClient <a href='#' style='float: right; color: #fff !important; background-color: #213280;' class='btn btn-primary' id='btnViewMoreAccManufacturer' data-bs-toggle='modal' data-bs-target='#modalManufacturerAcc'>View more</a></p>"; 
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row" style='border: 1px solid #c9c9c9; border-radius: 1rem;'>
                        <div class="col-5" style='display: grid; place-items: center;'>
                            <i class="fa-solid fa-user-group" style="font-size: 2em;"></i>
                        </div>
                        <div class="col-7">
                            <h6 data-i18n="moderator:distribuitorAccounts">Distribuitor Accounts</h6>
                            <?php
                                $consultTotalAccountClient = "SELECT * FROM wp_account WHERE account_rol_aid = '2'";
                                $resultTotalAccountClient = $conexion->query($consultTotalAccountClient);
                                $countTotalAccountClient = mysqli_num_rows($resultTotalAccountClient);
                                echo "<p>$countTotalAccountClient <a href='#' style='float: right; color: #fff !important; background-color: #213280;' class='btn btn-primary' id='btnViewMoreAccDistribuitor' data-bs-toggle='modal' data-bs-target='#modalDistribuitorAcc'>View more</a></p>"; 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style='margin-top: 1rem !important;'>
                <div class="col-6">
                    <div class="row" style='border: 1px solid #c9c9c9; border-radius: 1rem;'>
                        <div class="col-5" style='display: grid; place-items: center;'>
                            <i class="fa-solid fa-user-clock" style="font-size: 2em;"></i>
                        </div>
                        <div class="col-7">
                            <h6 data-i18n="moderator:rentalSale" >Rental & Sales Accounts</h6>
                            <?php
                                $consultTotalAccountClient = "SELECT * FROM wp_account WHERE account_rol_aid = '5'";
                                $resultTotalAccountClient = $conexion->query($consultTotalAccountClient);
                                $countTotalAccountClient = mysqli_num_rows($resultTotalAccountClient);
                                echo "<p>$countTotalAccountClient <a href='#' style='float: right; color: #fff !important; background-color: #213280;' class='btn btn-primary' id='btnViewMoreAccRental' data-bs-toggle='modal' data-bs-target='#modalRentalAcc'>View more</a></p>"; 
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row" style='border: 1px solid #c9c9c9; border-radius: 1rem;'>
                        <div class="col-5" style='display: grid; place-items: center;'>
                            <i class="fa-solid fa-users-gear" style="font-size: 2em;"></i>
                        </div>
                        <div class="col-7">
                            <h6 data-i18n="moderator:technicalSupportAccounts" >Technical Support Accounts</h6>
                            <?php
                                $consultTotalAccountClient = "SELECT * FROM wp_account WHERE account_rol_aid = '4'";
                                $resultTotalAccountClient = $conexion->query($consultTotalAccountClient);
                                $countTotalAccountClient = mysqli_num_rows($resultTotalAccountClient);
                                echo "<p>$countTotalAccountClient <a href='#' style='float: right; color: #fff !important; background-color: #213280;' class='btn btn-primary' id='btnViewMoreAccTechnical' data-bs-toggle='modal' data-bs-target='#modalTechnicalAcc'>View more</a></p>"; 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style='margin-top: 1rem !important;'>
                <div class="col-6">
                    <div class="row" style='border: 1px solid #c9c9c9; border-radius: 1rem;'>
                        <div class="col-5" style='display: grid; place-items: center;'>
                            <i class="fa-solid fa-user-astronaut" style="font-size: 2em;"></i>
                        </div>
                        <div class="col-7">
                            <h6 data-i18n="moderator:scientisAccounts">Scientist Accounts</h6>
                            <?php
                                $consultTotalAccountClient = "SELECT * FROM wp_account WHERE account_rol_aid = '6'";
                                $resultTotalAccountClient = $conexion->query($consultTotalAccountClient);
                                $countTotalAccountClient = mysqli_num_rows($resultTotalAccountClient);
                                echo "<p>$countTotalAccountClient <a href='#' style='float: right; color: #fff !important; background-color: #213280;' class='btn btn-primary' id='btnViewMoreAccScientist' data-bs-toggle='modal' data-bs-target='#modalScientistAcc'>View more</a></p>"; 
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row" style='border: 1px solid #c9c9c9; border-radius: 1rem;'>
                        <div class="col-5" style='display: grid; place-items: center;'>
                            <i class="fa-solid fa-user-large-slash" style="font-size: 2em;"></i>
                        </div>
                        <div class="col-7">
                            <h6 data-i18n="moderator:undeterminedAccounts">Undetermined Accounts</h6>
                            <?php
                                $consultTotalAccountClient = "SELECT * FROM wp_account WHERE account_rol_aid = '0'";
                                $resultTotalAccountClient = $conexion->query($consultTotalAccountClient);
                                $countTotalAccountClient = mysqli_num_rows($resultTotalAccountClient);
                                echo "<p>$countTotalAccountClient <a href='#' style='float: right; color: #fff !important; background-color: #213280;' class='btn btn-primary' id='btnViewMoreAccUndetermined' data-bs-toggle='modal' data-bs-target='#modalUndeterminedAcc'>View more</a></p>"; 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class='row'>
                <!-- FILTERS -->
                
                <div class='col-6 col-sm-12'>
                    <label class='small mb-1' data-i18n="moderator:labelStatus">Status</label>
                    <select class='form-select' id='log-filter' style='height: 2.8em; outline: 1px solid #213280; font-size: 0.9em;'>
                        
                    <option value='all' selected data-i18n="moderator:optionAll" >All</option>
                    <option value='a_aproved' data-i18n="moderator:optionAccountValidated"> Account Validated </option>
                    <option value='a_denied' data-i18n="moderator:optionAccountDenied"> Account Denied </option>
                    <option value='p_aproved' data-i18n="moderator:optionProductValidated"> Product Validated </option>
                    <option value='p_denied' data-i18n="moderator:optionProductDenied"> Product Denied </option>
                    <option value='q_aproved' data-i18n="moderator:optionQuoteProcessed"> Quote Processed </option>
                    <option value='q_denied' data-i18n="moderator:optionQuoteCancelled"> Quote Cancelled </option>
                    
                </select>
                </div>
                <div class='col-6 col-sm-12 input-wrapper-p'>
                    <input type='text' id='log-search-term' class='inputSearchQuote'>
                </div>
            </div>
    
            <!-- TABLE -->
            <div id="tbl-log">
            </div>
    
            <!-- PAGINATION -->
            <div class="d-flex flex-row justify-content-left">
                <input type="hidden" id="log-tbl-p" value="1">
                <div id="log-tbl-p-label">Page: 1</div>
                
                <button id="log-tbl-prev">« Previous</button>
                <button id="log-tbl-next">Next »</button>
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel" data-i18n="moderator:clientAccounts" >Clients Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-i18n="moderator:close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="tblClientAcc">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-i18n="moderator:close">Close</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal Distribuitor Account-->
            <div class="modal modal-xl fade" id="modalDistribuitorAcc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" data-i18n="moderator:clientAccounts">Clients Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="tblDistribuitorAcc">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-i18n="moderator:close">Close</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal Manufacturer Account-->
            <div class="modal modal-xl fade" id="modalManufacturerAcc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" data-i18n="moderator:clientAccounts">Clients Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="tblManufacturerAcc">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-i18n="moderator:close">Close</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal Rental & Sales Account-->
            <div class="modal modal-xl fade" id="modalRentalAcc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" data-i18n="moderator:rentalSale">Rental & Sales Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="tblRentalAcc">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-i18n="moderator:close">Close</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal Technical Support Account-->
            <div class="modal modal-xl fade" id="modalTechnicalAcc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" data-i18n="moderator:technicalSupportAccounts">Technical Support Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-i18n="moderator:close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="tblTechnicalAcc">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-i18n="moderator:close">Close</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal Scientist Account-->
            <div class="modal modal-xl fade" id="modalScientistAcc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" data-i18n="moderator:scientisAccounts">Scientist Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-i18n="moderator:close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="tblScientistAcc">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-i18n="moderator:close">Close</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal Undetermined Account-->
            <div class="modal modal-xl fade" id="modalUndeterminedAcc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" data-i18n="moderator:undeterminedAccounts">Undetermined Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-i18n="moderator:close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="tblUndeterminedAcc">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-i18n="moderator:close">Close</button>
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
                                <h6 data-i18n="moderator:activityHistory">Activity history</h6>
                            </div>
                            <div class="col-6" style="border-right: 1px solid #c9c9c9;">
                                <div class="row">
                                    <div class="col-12" data-i18n="moderator:quotes">
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
                                    <div class="col-12" data-i18n="moderator:activity">
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-i18n="moderator:close">Close</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</main>