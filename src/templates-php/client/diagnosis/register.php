<?php
    
    $userTag = $_SESSION["user_tag"];

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
    
    
    <style>
        
        .bottom-icon{
            
            vertical-align: bottom;
            
        }
        
        .bg-kalstein{
            
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
         <a class="nav-link" href="index.php?pag=diagsys"><span class="bottom-icon material-symbols-outlined">
            build</span>Diagnosticar
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php?pag=register"><span class="bottom-icon material-symbols-outlined">
            add_to_photos
          </span>Registrar Equipo<span class="visually-hidden">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?pag=exit"><span class="bottom-icon material-symbols-outlined">
            logout
          </span>Logout</a>
        </li>
      </ul>
       <!--User Icon-->
      <span class="navbar-text">
        <span class="bottom-icon material-symbols-outlined">
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

<!--Main wrapper-->
<div class="container flex-wrap p3 rounded-3 shadow-lg p-3" style="background-color:#FFFFFF;">

        <div class="d-flex justify-content-center">
            <p class="lead">Registra tu equipo</p>
        </div>
        <form class="p-3 mt-1" method="post">

            <div class="input-group">
                      <span class="input-group-text"><span class="bottom-icon material-symbols-outlined">view_in_ar</span></span>
                      <input type="text" class="form-control" placeholder="UID de producto" name="uid">
             </div> 
            <br>

            <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary bg-kalstein" name="username" value="<?php echo $userTag;?>">Registrar</button>
            </div>
            <br>
            
            <?php   
    
                include "controllerRegister.php";
            
            ?>
        </form>

</div>

<!--.Main Wrapper-->




</body>