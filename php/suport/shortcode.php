<?php
    session_start();

    include 'translateText.php';
    translateText();
    class shortcodePerfiles{
        function login(){
            $html = "
                <script src='https://kit.fontawesome.com/3cff919dc3.js' crossorigin='anonymous'></script>
                <div class='container'>
                    <div class='row align-items-start'>
                        <div class='col'>
                            <div class='card' style='min-width: 18rem; max-width: 26rem; margin: 0 auto; margin-top: 10rem; -webkit-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); -moz-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75);'>
                                <img src='https://kalstein.co.ve/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein.png' class='card-img-top' style='width: 200px; margin: 0 auto; margin-top: 4rem; margin-bottom: 2rem;'>
                                <div class='card-body'>
                                    <h5 class='card-title text-center fs-5' data-i17n='client:tipoServicio'>Hi, we're glad to see you again!</h5>
                                    <div class='col-md' style='margin-top: 1rem;'>
                                        <div class='form-floating input-wrapper'>
                                            <input type='email' class='form-control' id='emailUser' placeholder='name@example.com' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                            <label for='emailUser' data-i17n='client:tipoServicio' >Email address</label>                               
                                        </div>
                                        <div class='emailError' style='display: none;'><p style='color: #de3a46; font-weight: bold;' data-i17n='client:tipoServicio'>Email is not valid</p></div>
                                        <div id='c-password' style='margin-top: 1rem; display: none;'>
                                            <div class='form-floating input-wrapper-p'>
                                                <input type='password' class='form-control' id='passwordGrid' placeholder='name@example.com' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                                <label for='passwordGrid' data-i17n='client:tipoServicio'>Password</label>
                                                <i class='fa-sharp fa-solid fa-eye'></i>
                                            </div>
                                            <p style='margin-top: 0.5rem; margin-left: 10px; font-size: 1.2em;'><span class='forgotpw' style='color: #213280; cursor: pointer; font-weight: bold;'><a href='#' data-i17n='client:tipoServicio'>Forgot password?</a></span></p>
                                        </div>
                                        <button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnContinueLogIn'>Continue</button>
                                        <button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem; display: none;' id='btnContinueLogIn2' data-i17n='client:tipoServicio'>Continue</button>
                                    </div>
                                    <p style='margin-top: 1rem; margin-bottom: 4rem; font-size: 1.2em;' data-i17n='client:tipoServicio'>Don't have an account? <span class='singup' style='color: #213280; cursor: pointer; font-weight: bold;'><a href='https://dev.kalstein.plus/signup/'>Sign Up</a></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ";
    
            return $html;
        }

        function signup(){
            $html = "
                <script src='https://kit.fontawesome.com/3cff919dc3.js' crossorigin='anonymous'></script>
                <div class='container'>
                    <div class='row align-items-start'>
                        <div class='col'>
                            <div class='card' style='min-width: 18rem; max-width: 26rem; margin: 0 auto; margin-top: 10rem; -webkit-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); -moz-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75);'>
                                <img src='https://kalstein.co.ve/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein.png' class='card-img-top' style='width: 200px; margin: 0 auto; margin-top: 4rem; margin-bottom: 2rem;'>
                                <div class='card-body'>
                                    <h5 class='card-title text-center fs-5' data-i17n='client:tipoServicio' >Create your account</h5>
                                    <div class='col-md' style='margin-top: 1rem;'>
                                        <div class='form-floating input-wrapper c-email'>
                                            <input type='email' class='form-control' id='emailUser' placeholder='name@example.com' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                            <label for='emailUser' data-i17n='client:tipoServicio'>Email address</label>                               
                                        </div>
                                        <div class='emailError'  style='display: none;'><p style='color: #de3a46; font-weight: bold;' data-i17n='client:tipoServicio' >Email is not valid</p></div>
                                        <div class='availableMail'  style='display: none;'><p style='color: #229e1e; font-weight: bold;' data-i17n='client:tipoServicio'>Available Mail</p></div>
                                        <div class='mailExists'  style='display: none;'><p style='color: #de3a46; font-weight: bold;' data-i17n='client:tipoServicio'>This email is already registered, try logging in.</p></div>
                                        <div id='c-password' style='margin-top: 1rem; display: none;'>
                                            <div class='form-floating input-wrapper-p'>
                                                <input type='password' class='form-control' id='passwordGrid' placeholder='name@example.com' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                                <label for='passwordGrid' data-i17n='client:tipoServicio'>Password</label>
                                                <i class='fa-sharp fa-solid fa-eye'></i>
                                            </div>
                                            <div class='container required-info'>
                                                <p>Your password must containt:</p>
                                                <div class='container subRequired-info'>
                                                    <p class='p01' data-i17n='client:tipoServicio'>• At least 8 characters</p>
                                                    <p class='p02' data-i17n='client:tipoServicio'>• Lower case letters (a-z)</p>
                                                    <p class='p03' data-i17n='client:tipoServicio'>• Upper case letters (A-Z)</p>
                                                    <p class='p04' data-i17n='client:tipoServicio'>• Numbers (0-9)</p>
                                                    <p class='p05' data-i17n='client:tipoServicio'>• Special characters (!@#$%^&*)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='c-codeVerification' style='display: none;'>
                                            <p style='font-size: 1.3em; text-align: justify;' data-i17n='client:tipoServicio'>We have sent an email to <span class='spanEmail' style='font-weight: bold;'></span> with the verification code.</p>
                                            <hr>
                                            <div class='form-floating'>
                                                <input type='text' class='form-control' id='txtCodeVerification' placeholder='name@example.com' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                                <label for='txtCodeVerification' data-i17n='client:tipoServicio'>Code Verification</label>                               
                                            </div>
                                            <div class='codeExpired' style='display: none;'><p style='color: #de3a46; font-weight: bold;' data-i17n='client:tipoServicio'>The validation code has expired, request a new code.</p></div>
                                            <div class='codeError' style='display: none;'><p style='color: #de3a46; font-weight: bold;' data-i17n='client:tipoServicio'>Validation code is invalid.</p></div>
                                            <p class='newCode' style='cursor: pointer; margin-top: 0.5rem; margin-left: 10px; font-size: 1.2em;' data-i17n='client:tipoServicio'>Request new validation code here!</p>
                                        </div>
                                        <button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnContinueSignUp' data-i17n='client:tipoServicio'>Continue</button>
                                        <button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem; display: none;' id='btnContinueSignUp2' data-i17n='client:tipoServicio'>Continue</button>
                                        <button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem; display: none;' id='btnContinueSignUp3' data-i17n='client:tipoServicio'>Continue</button>
                                    </div>
                                    <p class='redirectLogin' style='margin-top: 1rem; margin-bottom: 4rem; font-size: 1.2em;'>Already have an account? <span class='singup' style='color: #213280; cursor: pointer; font-weight: bold;'><a href='https://kalstein.co.ve/login/'>Log in</a></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ";
    
            return $html;
        }

        function register(){
            $html = "
                <script src='https://kit.fontawesome.com/3cff919dc3.js' crossorigin='anonymous'></script>
                <div class='container'>
                    <div class='card w-75 mb-3' style='margin: 0 auto; margin-top: 2rem; -webkit-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); -moz-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); padding: 1rem;'>
                        <div class='card-body'>
                            <h5 class='card-title' style='text-align: center; font-size: 2em; font-weight: bold;'>Assistant</h5>
                            <p class='card-text' style='text-align: justify; font-size: 1.2em;'>Thank you for being part of our Kalstein France platform, now help us to customize your profile according to your needs.</p>
                            <div class='c-01'>
                                <div class='progress' role='progressbar' aria-label='Basic example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='margin-bottom: 2rem;'>
                                    <div class='progress-bar' style='width: 1%; background-color: #213280;'></div>
                                </div>
                                <div class='row'>
                                    <div class='col-sm-6 mb-3 mb-sm-0'>
                                        <div class='form-floating input-wrapper'>
                                            <input type='text' class='form-control' id='nameUser' placeholder='Juan' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                            <label for='nameUser'>Name</label>                               
                                        </div>
                                    </div>
                                    <div class='col-sm-6'>
                                        <div class='form-floating input-wrapper'>
                                            <input type='text' class='form-control' id='lastnameUser' placeholder='Peréz' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                            <label for='lastnameUser'>Last name</label>                               
                                        </div>
                                    </div>
                                </div>
                                <div class='row' style='margin-top: 2rem;'>
                                    <div class='col-sm-3'></div>
                                    <div class='col-sm-6'>
                                        <p class='card-text' style='text-align: center; font-size: 1.5em; font-weight: bold;'>How will you make use of our platform?</p>
                                        <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em;' id='cmbPrimary'>
                                            <option value='0' selected>Choose an option</option>
                                            <option value='1'>Quoting, purchasing or consuming resources provided by the platform</option>
                                            <option value='2'>Advertising and selling your products</option>
                                            <option value='3'>To impart knowledge in the scientific field, to give courses, etc...</option>
                                            <option value='4'>Provision of technical services</option>
                                        </select>
                                    </div>
                                    <div class='col-sm-3'></div>
                                </div>
                                <div class='row'>
                                    <div class='col-sm-2'></div>
                                    <div class='col-sm-8'></div>
                                    <div class='col-sm-2'><button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnNext1'>Next</button></div>
                                </div>
                            </div>
                            <div class='c-client01' style='display: none;'>
                                <div class='progress' role='progressbar' aria-label='Basic example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='margin-bottom: 2rem;'>
                                    <div class='progress-bar' style='width: 50%; background-color: #213280;'></div>
                                </div>
                                <div class='row'>
                                    <div class='col-sm-6 mb-3 mb-sm-0'>
                                        <div class='form-floating input-wrapper'>
                                            <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 0.9em;' id='countryUser'>

                                            </select>
                                            <label for='countryUser'>Country</label>                               
                                        </div>
                                    </div>
                                    <div class='col-sm-6'>
                                        <div class='form-floating input-wrapper'>
                                            <input type='text' class='form-control' id='stateUser' placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                            <label for='stateUser'>State</label>                                
                                        </div>
                                    </div>
                                </div>
                                <div class='row' style='margin-top: 2rem;'>
                                    <div class='col-sm-6 mb-3 mb-sm-0'>
                                        <div class='form-floating input-wrapper'>
                                            <input type='text' class='form-control' id='addressUser' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                            Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                            <label for='addressUser'>Address</label>                               
                                        </div>
                                    </div>
                                    <div class='col-sm-6'>
                                        <div class='form-floating input-wrapper'>
                                            <input type='text' class='form-control' id='zipcodeUser' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                            Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                            <label for='zipcodeUser'>Zipcode</label>                            
                                        </div>
                                    </div>
                                </div>
                                <div class='row' style='margin-top: 2rem;'>
                                    <div class='col-sm-6 mb-3 mb-sm-0'>
                                        <div class='form-floating input-wrapper'>                                                
                                            <input type='text' class='form-control' id='phoneUser' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                            <label for='phoneUser'>Phone</label>                                           
                                        </div>
                                    </div>
                                    <div class='col-sm-6'>

                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-sm-2'><button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnPreviusClient1'>Previus</button></div>
                                    <div class='col-sm-8'></div>
                                    <div class='col-sm-2'><button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnNextClient1'>Next</button></div>
                                </div>
                            </div>
                            <div class='c-client02' style='display: none;'>
                                <div class='progress' role='progressbar' aria-label='Basic example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='margin-bottom: 2rem;'>
                                    <div class='progress-bar' style='width: 75%; background-color: #213280;'></div>
                                </div>
                                <div class='row' style='margin-top: 2rem;'>
                                    <div class='col-sm-3'></div>
                                    <div class='col-sm-6'>
                                        <p class='card-text' style='text-align: center; font-size: 1.5em; font-weight: bold;'>Do you own or belong to a company?</p>
                                        <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em;' id='question-business'>
                                            <option value='0' selected>Choose an option</option>
                                            <option value='1'>Yes</option>
                                            <option value='2'>No</option>
                                        </select>
                                    </div>
                                    <div class='col-sm-3'></div>
                                </div>
                                <div class='row' style='margin-top: 1rem; display: none;' id='c-optionsQuestionBusiness'>
                                    <div class='col-sm-3'></div>
                                    <div class='col-sm-6'>
                                        <div class='form-floating input-wrapper'>
                                            <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 0.9em;' id='jobRole'>
                                                <option value='0' selected>Choose an option</option>
                                                <option value='1'>Engineer</option>
                                                <option value='2'>Engineering Management</option>
                                                <option value='3'>Designer</option>
                                                <option value='4'>Purchasing / Buyer / Finance</option>
                                                <option value='5'>Program / Project Management</option>
                                                <option value='6'>Operations / MRO Management</option>
                                                <option value='7'>Executive Leadership (CXO, VP, founder, etc.)</option>
                                                <option value='8'>Sales & Marketing</option>
                                                <option value='9'>Other</option>
                                            </select>
                                            <label for='jobRole'>Job Role</label>                               
                                        </div>
                                    </div>
                                    <div class='col-sm-3'></div>
                                </div>
                                <div class='row'>
                                    <div class='col-sm-2'><button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnPreviusClient2'>Previus</button></div>
                                    <div class='col-sm-8'></div>
                                    <div class='col-sm-2'>
                                        <button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnNextClient2'>Next</button>
                                        <button type='button' class='btn btnEndingClient' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem; display: none;' id='btnEndingClient'>Ending</button>
                                    </div>
                                </div>
                            </div>
                            <div class='c-client03' style='display: none;'>
                                <div class='progress' role='progressbar' aria-label='Basic example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='margin-bottom: 2rem;'>
                                    <div class='progress-bar' style='width: 100%; background-color: #213280;'></div>
                                </div>
                                <div class='row'>
                                    <div class='col-sm-6 mb-3 mb-sm-0'>
                                        <div class='form-floating input-wrapper'>
                                            <input type='text' class='form-control' id='BusinessName' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                            Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                            <label for='BusinessName'>Business Name</label>                               
                                        </div>
                                    </div>
                                    <div class='col-sm-6'>
                                        <div class='form-floating input-wrapper'>
                                            <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 0.9em;' id='countryBusiness'>

                                            </select>
                                            <label for='countryBusiness'>Business Country</label>                               
                                        </div>
                                    </div>
                                </div>
                                <div class='row' style='margin-top: 2rem;'>
                                    <div class='col-sm-6 mb-3 mb-sm-0'>
                                        <div class='form-floating input-wrapper'>
                                            <input type='text' class='form-control' id='stateBusiness' placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                            <label for='stateBusiness'>Business State</label>                               
                                        </div>
                                    </div>
                                    <div class='col-sm-6'>
                                        <div class='form-floating input-wrapper'>
                                            <input type='text' class='form-control' id='addressBusiness' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                            Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                            <label for='addressBusiness'>Business Address</label>                               
                                        </div>                                        
                                    </div>
                                </div>
                                <div class='row' style='margin-top: 2rem;'>
                                    <div class='col-sm-6 mb-3 mb-sm-0'>
                                        <div class='form-floating input-wrapper'>  
                                            <input type='text' class='form-control' id='zipcodeBusiness' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                            Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                            <label for='zipcodeBusiness'>Business Zipcode</label>                                
                                        </div>
                                    </div>
                                    <div class='col-sm-6'>
                                        <div class='form-floating input-wrapper'>                                           
                                            <input type='text' class='form-control' id='phoneBusiness' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                            <label for='phoneBusiness'>Business Phone</label>                                        
                                        </div>    
                                    </div>                                    
                                </div>
                                <div class='row' style='margin-top: 2rem;'>
                                    <div class='col-sm-6 mb-3 mb-sm-0'>
                                        <div class='form-floating input-wrapper'>                                           
                                            <input type='text' class='form-control' id='websiteBusiness' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                            <label for='websiteBusiness'>Business Website</label>                                        
                                        </div>    
                                    </div>
                                    <div class='col-sm-6'>

                                    </div>                                   
                                </div>                                
                                <div class='row'>
                                    <div class='col-sm-2'><button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnPreviusClient3'>Previus</button></div>
                                    <div class='col-sm-8'></div>
                                    <div class='col-sm-2'><button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnEndingClient'>Ending</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ";

            return $html;
        }

        function dashboard(){
            $html = '
            
            <header class="header" data-header>
            <div class="container">
        
            <h1>
            <img src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein_blanco.png" alt="Kalstein" width="100" height="40">
          </h1>
        
        
              <button class="menu-toggle-btn icon-box" data-menu-toggle-btn aria-label="Toggle Menu">
                <span class="material-symbols-rounded  icon">menu</span>
              </button>
        
              <nav class="navbar">
                <div class="container">
        
                  <ul class="navbar-list">
        
                    <li>
                      <a href="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/templates-php/suport/dashboard.php" class="navbar-link active icon-box" style="color: white;">
                        <span class="material-symbols-rounded  icon">grid_view</span>
        
                        <span>Home</span>
                      </a>
                    </li>
        
                    <li>
                      <a href="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/templates-php/suport/report.php" class="navbar-link icon-box" style="color: white;">
                        <span class="material-symbols-rounded  icon">folder</span>
        
                        <span>listado</span>
                      </a>
                    </li>
                    
                    <li>
                      <a href="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/templates-php/suport/report_add.php" class="navbar-link icon-box" style="color: white;">
                        <span class="material-symbols-rounded  icon">list</span>
        
                        <span>reportar falla</span>
                      </a>
                    </li>
        
                    <li>
                      <a href="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/templates-php/suport/reports_mod.php" class="navbar-link icon-box" style="color: white;">
                        <span class="material-symbols-rounded  icon">bar_chart</span>
        
                        <span>modificacion de reportes</span>
                      </a>
                    </li>
        
        
                  </ul>
        
                  <ul class="user-action-list">
        
                    <li>
                      <a href="#" class="notification icon-box" style="color: white;">
                        <span class="material-symbols-rounded  icon">logout</span>
                        <span>Logout</span>
                      </a>
                    </li>
        
                    <li>
                      <a href="#" class="header-profile">
        
                        <figure class="profile-avatar">
                          <img src="./assets/images/avatar-1.jpg" alt="Elizabeth Foster" width="32" height="32">
                        </figure>
        
                        <div>
                          <p class="profile-title">Elizabeth F</p>
        
                          <p class="profile-subtitle">Admin</p>
                        </div>
        
                      </a>
                    </li>
        
                  </ul>
        
                </div>
              </nav>
        
            </div>
          </header>
        
        
        
        
        
          <main>
            <article class="container article">
        
              <h2 class="h2 article-title">Hi Elizabeth</h2>
        
              <p class="article-subtitle">Welcome to Dashboard!</p>
        
              <!-- 
                - #HOME
              -->
        
              <section class="home">
        
                <div class="card profile-card">
        
                  <button class="card-menu-btn icon-box" aria-label="More" data-menu-btn>
                    <span class="material-symbols-rounded  icon">more_horiz</span>
                  </button>
        
                  <ul class="ctx-menu">
        
                    <li class="ctx-item">
                      <button class="ctx-menu-btn icon-box">
                        <span class="material-symbols-rounded  icon" aria-hidden="true">edit</span>
        
                        <span class="ctx-menu-text">Edit</span>
                      </button>
                    </li>
        
                    <li class="ctx-item">
                      <button class="ctx-menu-btn icon-box">
                        <span class="material-symbols-rounded  icon" aria-hidden="true">cached</span>
        
                        <span class="ctx-menu-text">Refresh</span>
                      </button>
                    </li>
        
                    <li class="divider"></li>
        
                    <li class="ctx-item">
                      <button class="ctx-menu-btn red icon-box">
                        <span class="material-symbols-rounded  icon" aria-hidden="true">delete</span>
        
                        <span class="ctx-menu-text">Deactivate</span>
                      </button>
                    </li>
        
                  </ul>
        
                  <div class="profile-card-wrapper">
        
                    <figure class="card-avatar">
                      <img src="./assets/images/avatar-1.jpg" alt="Elizabeth Foster" width="48" height="48">
                    </figure>
        
                    <div>
                      <p class="card-title">Elizabeth Foster</p>
        
                      <p class="card-subtitle">Web & Graphic Designer</p>
                    </div>
        
                  </div>
        
                  <ul class="contact-list">
        
                    <li>
                      <a href="mailto:xyz@mail.com" class="contact-link icon-box">
                        <span class="material-symbols-rounded  icon">mail</span>
        
                        <p class="text">xyz@mail.com</p>
                      </a>
                    </li>
        
                    <li>
                      <a href="tel:00123456789" class="contact-link icon-box">
                        <span class="material-symbols-rounded  icon">call</span>
        
                        <p class="text">+00 123-456-789</p>
                      </a>
                    </li>
        
                  </ul>
        
        
                </div>
        
                <div class="card-wrapper">
        
                  <div class="card task-card">
        
                    <div class="card-icon icon-box green">
                      <span class="material-symbols-rounded  icon">task_alt</span>
                    </div>
        
                    <div>
                      <data class="card-data" value="21">21</data>
        
                      <p class="card-text">Reports Completed</p>
                    </div>
        
                  </div>
        
                  <div class="card task-card">
        
                    <div class="card-icon icon-box blue">
                      <span class="material-symbols-rounded  icon">drive_file_rename_outline</span>
                    </div>
        
                    <div>
                      <data class="card-data" value="21">21</data>
        
                      <p class="card-text">Reports Inprogress</p>
                    </div>
        
                  </div>
        
                </div>
        
                <div class="card revenue-card">

                <button class="card-menu-btn icon-box" aria-label="More" data-menu-btn>
                  <span class="material-symbols-rounded  icon">more_horiz</span>
                </button>
      
                <ul class="ctx-menu">
                  <li class="ctx-item">
                    <button class="ctx-menu-btn icon-box">
                      <span class="material-symbols-rounded  icon" aria-hidden="true">cached</span>
      
                      <span class="ctx-menu-text">Refresh</span>
                    </button>
                  </li>
      
                </ul>
      
                <p class="card-title">Customers Activity</p>
      
                <canvas id="chart_green">
               </canvas>
                <div class="divider card-divider"></div>
      
                <ul class="revenue-list">
      
                  <li class="revenue-item icon-box">
      
                    <span class="material-symbols-rounded  icon  green">trending_up</span>
      
                    <div>
                      <data class="revenue-item-data" value="15">15%</data>
      
                      <p class="revenue-item-text">Prev Week</p>
                    </div>
      
                  </li>
      
                  <li class="revenue-item icon-box">
      
                    <span class="material-symbols-rounded  icon  red">trending_down</span>
      
                    <div>
                      <data class="revenue-item-data" value="10">10%</data>
      
                      <p class="revenue-item-text">Prev Month</p>
                    </div>
      
                  </li>
      
                </ul>
      
              </div>
      
               
        
              </section>
        
        
              <!-- 
                - #TASKS
              -->
            

              
      
        
               
        
            </article>
          </main>
        

          <!-- 
            - #FOOTER
          -->
        
          <footer class="footer">
            <div class="container">
        
              <ul class="footer-list">
        
                <li class="footer-item">
                  <a href="#" class="footer-link">About</a>
                </li>
        
                <li class="footer-item">
                  <a href="#" class="footer-link">Privacy</a>
                </li>
        
                <li class="footer-item">
                  <a href="#" class="footer-link">Terms</a>
                </li>
        
                <li class="footer-item">
                  <a href="#" class="footer-link">Developers</a>
                </li>
        
                <li class="footer-item">
                  <a href="#" class="footer-link">Support</a>
                </li>
        
                <li class="footer-item">
                  <a href="#" class="footer-link">Careers</a>
                </li>
        
              </ul>
        
              <p class="copyright">
                &copy; 2022 <a href="#" class="copyright-link">codewithsadee</a>. All Rights Reserved
              </p>
        
            </div>
        
  </footer>
        
         
        
        
    
    
            ';
            return $html;
        }

function reports(){
    $html='
    <header class="header" data-header>
    <div class="container">

    <h1>
    <img src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein_blanco.png" alt="Kalstein" width="100" height="40">
  </h1>


      <button class="menu-toggle-btn icon-box" data-menu-toggle-btn aria-label="Toggle Menu">
        <span class="material-symbols-rounded  icon">menu</span>
      </button>

      <nav class="navbar">
        <div class="container">

          <ul class="navbar-list">

            <li>
              <a href="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/templates-php/suport/dashboard.php" class="navbar-link active icon-box" style="color: white;">
                <span class="material-symbols-rounded  icon">grid_view</span>

                <span>Home</span>
              </a>
            </li>

            <li>
              <a href="https://dev.kalstein.plus/plataforma/wp-content/plugin/kalsteinPerfiles/src/templates-php/suport/listOrderProcessed.php" class="navbar-link icon-box" style="color: white;">
                <span class="material-symbols-rounded  icon">folder</span>

                <span>listado</span>
              </a>
            </li>
            
            <li>
              <a href="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/template-php/suport/report.php" class="navbar-link icon-box" style="color: white;">
                <span class="material-symbols-rounded  icon">list</span>

                <span>reportar falla</span>
              </a>
            </li>

            <li>
              <a href="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/templates-php/suport/reports_mod.php" class="navbar-link icon-box" style="color: white;">
                <span class="material-symbols-rounded  icon">bar_chart</span>

                <span>modificacion de reportes</span>
              </a>
            </li>


          </ul>

          <ul class="user-action-list">

            <li>
              <a href="#" class="notification icon-box" style="color: white;">
                <span class="material-symbols-rounded  icon">logout</span>
                <span>Logout</span>
              </a>
            </li>

            <li>
              <a href="#" class="header-profile">

                <figure class="profile-avatar">
                  <img src="./assets/images/avatar-1.jpg" alt="Elizabeth Foster" width="32" height="32">
                </figure>

                <div>
                  <p class="profile-title">Elizabeth F</p>

                  <p class="profile-subtitle">Admin</p>
                </div>
              </a>
            </li>

          </ul>

        </div>
      </nav>

    </div>
  </header>
        <br>
        <br>
    <nav class="nav nav-borders">
    <a class="nav-link" href="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/templates-php/suport/stock_suport.php" target="__blank">Products stock</a>
    <a class="nav-link" href="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/templates-php/suport/stock-add.php" target="__blank">Add product</a>
    <a class="nav-link active ms-0" href="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/templates-php/suport/stock-edit.php" target="__blank">Edit product</a>
    <hr class="mt-0 mb-4">
    </nav>
    <br>
        <br>
        <input class="form-control mb-5" type="date" id="dateFrom">
        <input class="form-control mb-5" type="date" id="dateTo">
      
        <select class="form-control mb-5" id="estatus">
        <option>selecione estado</option>
        <option value="solventado">solvente</option>
        <option value="pendiente">pendiente</option>
        <option value="cancelado">cancelado</option>
        <option value="insolvente">insolvente</option>
        </select>
         
        <input  class="form-control mb-5" type="number" id="searchreport" >
      
        <div id="report-fails" class="table-responsive" width="100" ></div>
       

      '
  ; 
return $html;
        }
        function reports_add(){
          $html='
          <header class="header" data-header>
          <div class="container">
      
          <h1>
          <img src="/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein_blanco.png" alt="Kalstein" width="100" height="40">
        </h1>
      
      
            <button class="menu-toggle-btn icon-box" data-menu-toggle-btn aria-label="Toggle Menu">
              <span class="material-symbols-rounded  icon">menu</span>
            </button>
      
            <nav class="navbar">
              <div class="container">
      
                <ul class="navbar-list">
      
                  <li>
                    <a href="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/templates-php/suport/dashboard.php" class="navbar-link active icon-box" style="color: white;">
                      <span class="material-symbols-rounded  icon">grid_view</span>
      
                      <span>Home</span>
                    </a>
                  </li>
      
                  <li>
                    <a href="https://dev.kalstein.plus/plataforma/wp-content/plugin/kalsteinPerfiles/src/templates-php/suport/listOrderProcessed.php" class="navbar-link icon-box" style="color: white;">
                      <span class="material-symbols-rounded  icon">folder</span>
      
                      <span>listado</span>
                    </a>
                  </li>
                  
                  <li>
                    <a href="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/template-php/suport/report.php" class="navbar-link icon-box" style="color: white;">
                      <span class="material-symbols-rounded  icon">list</span>
      
                      <span>reportar falla</span>
                    </a>
                  </li>
      
                  <li>
                    <a href="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/templates-php/suport/reports_mod.php" class="navbar-link icon-box" style="color: white;">
                      <span class="material-symbols-rounded  icon">bar_chart</span>
      
                      <span>modificacion de reportes</span>
                    </a>
                  </li>
      
      
                </ul>
      
                <ul class="user-action-list">
      
                  <li>
                    <a href="#" class="notification icon-box" style="color: white;">
                      <span class="material-symbols-rounded  icon">logout</span>
                      <span>Logout</span>
                    </a>
                  </li>
      
                  <li>
                    <a href="#" class="header-profile">
      
                      <figure class="profile-avatar">
                        <img src="./assets/images/avatar-1.jpg" alt="Elizabeth Foster" width="32" height="32">
                      </figure>
      
                      <div>
                        <p class="profile-title">Elizabeth F</p>
      
                        <p class="profile-subtitle">Admin</p>
                      </div>
      
                    </a>
                  </li>
      
                </ul>
      
              </div>
            </nav>
      
          </div>
        </header>
        <br>
        <br>
        <br>
        <br>
       <div class="container">
        <div class="row well">
          <div class="col-sm-9 lead">
            <h2 class="text-info">¿Cómo abrir un nuevo Ticket?</h2>
            <p>Para abrir un nuevo ticket deberá de llenar todos los campos de el siguiente formulario. Usted podra verificar el estado de su ticket mediante el <strong>Ticket ID</strong> que se le proporcionara a usted cuando llene y nos envie el siguiente formulario.</p>
          </div>
        </div><!--fin row 1-->

        <div class="row">
          <div class="col-sm-12">
            <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title text-center"><strong><i class="fa fa-ticket"></i>&nbsp;&nbsp;&nbsp;Ticket</strong></h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-4 text-center">
                    <br><br><br>
                    <p class="text-primary text-justify">Por favor llene todos los datos de este formulario para abrir su ticket. El <strong>Ticket ID</strong> será enviado a la dirección de correo electronico proporcionada en este formulario.</p>
                  </div>
                  <div class="col-sm-8">
                        <fieldset>
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Nombre" required="" pattern="[a-zA-Z ]{1,30}" name="name_ticket" title="Nombre Apellido" value="" >
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                              <input type="email" class="form-control" id="Rnombre" placeholder="Email" name="email_ticket" title="Ejemplo@dominio.com" >
                              <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                            </div> 
                        </div>
                      </div>

                      <div class="form-group">
                        <label  class="col-sm-2 control-label">category</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                              <select class="form-control" id="Rcategory">
                              </select>
                              <span class="input-group-addon"><i class="fa fa-users"></i></span>
                            </div> 
                        </div>
                      </div>

                      <div class="form-group">
                        <label  class="col-sm-2 control-label">Producto</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                              <select class="form-control" id="Rproduct">
                              </select>
                              <span class="input-group-addon"><i class="fa fa-users"></i></span>
                            </div> 
                        </div>
                      </div>
                      <div class="form-group">
                      <label  class="col-sm-2 control-label">requerimiento</label>
                      <div class="col-sm-10">
                          <div class="input-group">
                            <select class="form-control" id="Rnivel">
                            <option value="0">seleccione nivel de requerimiento</option>
                            <option value="bajo">bajo</option>
                            <option value="medio">medio</option>
                            <option value="alto">alto</option>
                            </select>
                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                          </div> 
                      </div>
                    </div>
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">descripcion del problema</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" rows="3" placeholder="describa el problema que presenta su producto" name="mensaje_ticket" required="" id="Rdescription"></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="button" class="btn btn-info" id="registrar">Abrir ticket</button>
                        </div>
                      </div>
                           </fieldset> 
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
       '; 
      return $html;
        }
        
        function reports_mod(){
          $html='
          <header class="header" data-header>
          <div class="container">
      
          <h1>
          <img src="https://kalstein.us/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein_blanco.png" alt="Kalstein" width="100" height="40">
        </h1>
      
      
            <button class="menu-toggle-btn icon-box" data-menu-toggle-btn aria-label="Toggle Menu">
              <span class="material-symbols-rounded  icon">menu</span>
            </button>
      
            <nav class="navbar">
              <div class="container">
      
                <ul class="navbar-list">
      
                  <li>
                    <a href="http://127.0.0.1/wp-local/home/" class="navbar-link active icon-box" style="color: white;">
                      <span class="material-symbols-rounded  icon">grid_view</span>
      
                      <span>Home</span>
                    </a>
                  </li>
      
                  <li>
                    <a href="http://127.0.0.1/wp-local/list_report/" class="navbar-link icon-box" style="color: white;">
                      <span class="material-symbols-rounded  icon">folder</span>
      
                      <span>listado</span>
                    </a>
                  </li>
                  
                  <li>
                    <a href="http://127.0.0.1/wp-local/addreport/" class="navbar-link icon-box" style="color: white;">
                      <span class="material-symbols-rounded  icon">list</span>
      
                      <span>reportar falla</span>
                    </a>
                  </li>
      
                  <li>
                    <a href="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/templates-php/suport/reports_mod.php" class="navbar-link icon-box" style="color: white;">
                      <span class="material-symbols-rounded  icon">bar_chart</span>
      
                      <span>modificacion de reportes</span>
                    </a>
                  </li>
      
      
                </ul>
      
                <ul class="user-action-list">
      
                  <li>
                    <a href="#" class="notification icon-box" style="color: white;">
                      <span class="material-symbols-rounded  icon">logout</span>
                      <span>Logout</span>
                    </a>
                  </li>
      
                  <li>
                    <a href="#" class="header-profile">
      
                      <figure class="profile-avatar">
                        <img src="./assets/images/avatar-1.jpg" alt="Elizabeth Foster" width="32" height="32">
                      </figure>
      
                      <div>
                        <p class="profile-title">Elizabeth F</p>
      
                        <p class="profile-subtitle">Admin</p>
                      </div>
      
                    </a>
                  </li>
      
                </ul>
      
              </div>
            </nav>
      
          </div>
        </header>
        <br>
        <br>
        <br>
        <br>
        <div class="container tm-mt-big tm-mb-big">
         <div class="row">
         <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
               INGRESO DE REPORTES
         <div class="card-body">
       
          
    <select class="form-control mb-5" id="dataEdit">

    </select>
          <input type="text" name="nombre" id="Anombre" class="form-control mb-5" placeholder="nombre">
          <input type="text" name="usuario" id="Ausuario" class="form-control mb-5" placeholder="usuario">
          <input type="text" name="Tipo_US" id="ATipo_US" class="form-control mb-5" placeholder="Tipo Usuario">
          <input type="text" name="Product" id="Aproduct" class="form-control mb-5" placeholder="Productos">
          <input type="text" name="Tipo_US" id="Acategory" class="form-control mb-5" placeholder="category">
          <input type="text" name="description" id="Adescription" class="form-control mb-5" placeholder="Descripcion">
          <input type="text" name="nivel" id="Anivel" class="Aform-control mb-5" placeholder="nivel">
          <input type="text" name="estado" id="Aestado" class="Aform-control mb-5" placeholder="estado">
          <input type="text" name="fecha" id="Afecha" class="Aform-control mb-5" placeholder="fecha">

         
          <select class="form-control mb-5" id="statusEdit">
           <option value="0">cambiar estado</option>
           <option value="cancelado">cancelar</option>
           <option value="insolvente">insolvente</option>
           <option value="solventado">solvente</option>
           </select>

           <hr>
           <button class="btn btn-info btn-block" type="button" name="actualizar" id="actualizar" >actualizar</Button
       </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
      '; 
      return $html;
        }
        function manuales(){
          $html='
          <header class="header" data-header>
          <div class="container">
      
          <h1>
          <img src="https://kalstein.us/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein_blanco.png" alt="Kalstein" width="100" height="40">
        </h1>
      
      
            <button class="menu-toggle-btn icon-box" data-menu-toggle-btn aria-label="Toggle Menu">
              <span class="material-symbols-rounded  icon">menu</span>
            </button>
      
            <nav class="navbar">
              <div class="container">
      
                <ul class="navbar-list">
      
                  <li>
                    <a href="http://127.0.0.1/wp-local/home/" class="navbar-link active icon-box" style="color: white;">
                      <span class="material-symbols-rounded  icon">grid_view</span>
      
                      <span>Home</span>
                    </a>
                  </li>
      
                  <li>
                    <a href="http://127.0.0.1/wp-local/list_report/" class="navbar-link icon-box" style="color: white;">
                      <span class="material-symbols-rounded  icon">folder</span>
      
                      <span>listado</span>
                    </a>
                  </li>
                  
                  <li>
                    <a href="http://127.0.0.1/wp-local/addreport/" class="navbar-link icon-box" style="color: white;">
                      <span class="material-symbols-rounded  icon">list</span>
      
                      <span>reportar falla</span>
                    </a>
                  </li>
      
                  <li>
                    <a href="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/templates-php/suport/reports_mod.php" class="navbar-link icon-box" style="color: white;">
                      <span class="material-symbols-rounded  icon">bar_chart</span>
      
                      <span>modificacion de reportes</span>
                    </a>
                  </li>
      
      
                </ul>
      
                <ul class="user-action-list">
      
                  <li>
                    <a href="#" class="notification icon-box" style="color: white;">
                      <span class="material-symbols-rounded  icon">logout</span>
                      <span>Logout</span>
                    </a>
                  </li>
      
                  <li>
                    <a href="#" class="header-profile">
      
                      <figure class="profile-avatar">
                        <img src="./assets/images/avatar-1.jpg" alt="Elizabeth Foster" width="32" height="32">
                      </figure>
      
                      <div>
                        <p class="profile-title">Elizabeth F</p>
      
                        <p class="profile-subtitle">Admin</p>
                      </div>
      
                    </a>
                  </li>
      
                </ul>
      
              </div>
            </nav>
      
          </div>
        </header>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="_df_book" height="500" webgl="true" backgroundcolor="teal"
              source="example-assets/books/intro.pdf"
              id="df_manual_book">
      </div>
';
return $html;
        }

    }
    