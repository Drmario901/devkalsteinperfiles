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
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="bootstrap.bundle.min.js"></script>
    
    <!--Google Materials-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
    
    <!-- Main Jquery code-->
    <script src="mainSource.js"></script>
    
    <style>
        .bottom-icon {
            vertical-align: bottom;
        }
        .bg-kalstein {
            background-color: #213280!important;
        }
    </style>
    
</head>
<body>

<!--NavBar--> 
<nav class="navbar navbar-dark bg-kalstein">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" id="diagsys" href="#"><span class="bottom-icon material-symbols-outlined">
            build</span>Diagnosticar
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="register" href="#"><span class="bottom-icon material-symbols-outlined">
            add_to_photos
          </span>Registrar Equipo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="exit" href="#"><span class="bottom-icon material-symbols-outlined">
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
        <?php echo $_SESSION["user_tag"] ?>
      </span>
    </div>
  </div>
</nav>
<!--.NavBar--> 

<!--Main Wrapper-->
<div id="content" class="container flex-wrap p3 rounded-3 shadow-lg p-3" style="background-color:#FFFFFF;">
    <!-- PAGE CONTENT -->
</div>
<!--.Main Wrapper-->

</body>
</html>
