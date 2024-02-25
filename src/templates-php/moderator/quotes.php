
<header class="header" data-header>
    <?php

        include 'navbar.php';
    
    ?>
    <script>
        let page = "quote";

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

            <!-- PRODUCTOS -->
            <div class="row">
                <div class="col-xl-10">

                </div>
                <div class="col-xl-2">
                    <button type='button' style='color: #444; font-size: 20px; border-bottom: 2px solid #444;' id='btnGenerateCSV' data-bs-toggle='modal' data-bs-target='#filtroModal'>Export <i class="fa-solid fa-file-csv"></i></button>
                </div>
            </div>
            <div class='row'>
                <div class='col-xl-2'>
                    <label class='small mb-1' for='dateFrom'>From</label>
                    <input type='date' id='dateFrom'
                        style='height: 2.8em; outline: 1px solid #213280; font-size: 0.9em;'>
                </div>
                <div class='col-xl-2'>
                    <label class='small mb-1' for='dateTO'>To</label>
                    <input type='date' id='dateTO' style='height: 2.8em; outline: 1px solid #213280; font-size: 0.9em;'>
                </div>
                <div class='col-xl-2'>
                    <label class='small mb-1' for='cmbStatus'>Status</label>
                    <select class='form-select' aria-label='Default select example' id='cmbStatus'
                        style='height: 2.8em; outline: 1px solid #213280; font-size: 0.9em;'>
                        <option value='a'>All</option>
                        <option value='0'>Pending</option>
                        <option value='1' selected>Process</option>
                        <option value='2'>Cancel</option>
                        <option value='3'>Processed</option>
                        <option value='4'>Cancelled</option>
                    </select>
                </div>
                <div class='col-xl-6 input-wrapper-p'>
                    <label class='small mb-1 d-block' for='inputSearchQuote'>&nbsp;</label>
                    <div class="d-flex flex-row">
                        <input type='text' id='inputSearchQuote' class='inputSearchQuote'>
                        <button id='btnSearchQuote' class='btnSearchQuote'>Search</button>
                    </div>
                    <i class='fa-solid fa-magnifying-glass second-glass'></i>
                </div>
            </div>

            <div id="tblQuoteClient">
            </div>

            <!-- Modal -->
            <div class='modal modal-lg fade' id='filtroModal' tabindex='-1' aria-labelledby='modelInfoClientQuote' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title fs-5' id='modelInfoClientQuote'>Export CSV Data</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <div class="row" style='border-bottom: 1px solid #c9c9c9;'>
                            <div class="col-4" style='border-right: 1px solid #c9c9c9;'>
                                <div class="row">
                                    <div class="col-12">
                                        <p style='text-align: center; font-weight: bold;'>Today</p>
                                    </div>
                                    <div class="col-12">
                                        <p style='font-weight: bold;'>Types of clients</p>
                                        <select class="form-select" aria-label="Default select example" id='cmbTypeClient'>
                                            <option selected style='text-align: center;' value="0">-- Select --</option>
                                            <option value="1">All</option>
                                            <option value="2">R1</option>
                                            <option value="3">R2</option>
                                            <option value="4">R3</option>
                                        </select>
                                        <br>
                                    </div>
                                    <hr style="background-color: #c9c9c9;">
                                    <div class="col-12">
                                        <p style='font-weight: bold;'>Day shifts</p>
                                        <select class="form-select" aria-label="Default select example" id='cmbDayShifts'>
                                            <option selected style='text-align: center;' value='0'>-- Select --</option>
                                            <option value="1">Every Day</option>
                                            <option value="2">Morning</option>
                                            <option value="3">Afternoon</option>
                                            <option value="4">Evening</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="row">                                    
                                    <div class="col-12">
                                        <p style='text-align: center; font-weight: bold;'>Date range</p>
                                    </div>
                                    <div class="col-12">         
                                        <div class="row">
                                            <div class="col-7" style='border-right: 1px solid #c9c9c9;'>                                            
                                                <p style='font-weight: bold;'>Date</p>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p>From</p>
                                                        <input type="date" name="" id="dateFromCSV" class='date' lang="en" datetime="2023-03-08T00:00:00Z">
                                                        <p>To</p>
                                                        <input type="date" name="" id="dateToCSV" class='date' lang="en" datetime="2023-03-08T00:00:00Z">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-5">                                                
                                                <p style='font-weight: bold; margin-top: 3.5rem;' >Types of clients</p>
                                                <select class="form-select" aria-label="Default select example" id='cmbTypeClient2'>
                                                    <option selected style='text-align: center;' value="0">-- Select --</option>
                                                    <option value="1">All</option>
                                                    <option value="2">R1</option>
                                                    <option value="3">R2</option>
                                                    <option value="4">R3</option>
                                                </select>
                                            </div>
                                        </div>                               
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row d-flex justify-content-center">
                            <div class="col-5"></div>
                            <div class="col-2 d-flex justify-content-center">
                                <a href='#' class='navbar-link icon-box' style='color: #fff !important; background-color: #213280 !important; margin: 0 auto; text-align: center;' id='btnExportAllDataCSV'>EXPORT</a>
                            </div>
                            <div class="col-5"></div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                    </div>
                </div>
            </div>
        </div>
    </article>
</main>