<?php
    $uidProd=$_GET["uid"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kalstein | Diagnosis App</title>
   
    <!--JQuery-->
          <script src="jquery3.7.1.min.js"></script>
    <!--END JQUERY-->
    
    <!--Bootstrap 5 sin modificaciones-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">
    
    <!-- Latest compiled Bootstrap JavaScript -->
    <script src="bootstrap.bundle.min.js"></script>
    
    <!--Google Materials-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
    
    <!-- Main Jquery code-->
    <script src="diagSource.js"></script>
    
    <style>
        
        .bottom-icon{
            
            vertical-align: bottom;
            
        }
        
        .bg-kalstein{
            
            background-color: #213280!important
            
        }
        
        .progress-bar{
            
         background-color: #213280!important
        }
        
        .centerDiv{
            
            text-align:center; 
            margin-left:auto; 
            margin-right:auto
            
        }
        
        
    
    </style>
    
</head>

<body>

<!--NavBar--> 
<nav class="navbar navbar-dark bg-kalstein">
  <div class="container-fluid">
    <img src="kalstein_white.png" width="30" height="30" class="d-inline-block align-top" alt="">
    <a class="navbar-brand" href="#">Kalstein | Diagnosis App </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
         <a class="nav-link active" href="index.php?pag=diagsys" data-i18n="client:diagnosticar"><span class="bottom-icon material-symbols-outlined">
            build</span>Diagnosticar
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?pag=register"><span class="bottom-icon material-symbols-outlined">
            add_to_photos
          </span data-i18n="client:RegistrarEquipo">Registrar Equipo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?pag=exit"><span class="bottom-icon material-symbols-outlined" data-i18n="client:logout">
            logout
          </span data-i18n="client:logout">Logout</a>
        </li>
      </ul>
       <!--User Icon-->
      <span class="navbar-text">
        <span class="bottom-icon material-symbols-outlined" data-i18n="client:person">
            person
        </span>
      </span>
       <!--Text User  name-->
      <span class="navbar-text" id="username">
        <?php echo $_SESSION["user_tag"]?>
      </span>
    </div>
  </div>
</nav>
<!--.NavBar--> 
    
    <div class="container flex-wrap p3 rounded-3 shadow-lg p-3" style="background-color:#FFFFFF;">
        <div class="d-flex justify-content-center">
            <p class="lead" data-i18n="client:diagnosing">Diagnosing: </p>
        </div>
        <div class="d-flex justify-content-center">
            <p><small id="uidprod"><?php echo $uidProd; ?></small></p>
            
        </div>
        
        <div id="contentdiag">
            
            
            
        </div>
        
        
    </div>

    

</body>