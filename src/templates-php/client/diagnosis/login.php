<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--Quitar cuando ua este listo-->
  <!--<meta http-equiv="refresh" content="5" >-->
  
  <title>Kalstein | Diagnosis App </title>
   
    <!--JQuery-->
          <script src="jquery-3.7.0.min.js"></script>
    <!--END JQUERY-->
    
    <!--Bootstrap 5 sin modificaciones-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">
    
    <!-- Latest compiled Bootstrap JavaScript -->
    <script src="bootstrap.bundle.min.js"></script>
    
    <!--Google Icons Materials-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <style>
        
        .bottom-icon{
            
            vertical-align: bottom;
            
        }
        
        .btn-primary {
            color: #fff;
            background-color: #213280;
            border-color: #213280;
        }
    
    
    </style>
    
</head>

<body>
   
    <!--Div principal-->
    <div class="container flex-wrap p-3">
        
        <div class="d-flex justify-content-center text-center pt-1 mt-1">   
          
          <form class="p-5 mt-2 rounded-3 shadow-lg" method="post">
          <img style="width:339px; heigth:40px;" class="img-fluid" src="logo_kalstein.png" alt="Responsive image">
          <br><br>
              <p><b>Diagnosis App</b></p>
            <div class="input-group">
                      <span class="input-group-text"><span class="bottom-icon material-symbols-outlined">person</span></span>
                      <input type="text" class="form-control" id="user" placeholder="Usuario" name="loginuser">
             </div> 
            <br>

            <div class="input-group">
                      <span class="input-group-text"><span class="bottom-icon material-symbols-outlined">lock</span></span>
                      <input type="password" class="form-control" id="pwd" placeholder="Clave" name="loginpswd">
             </div>
             <br>
            <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary" name="btnLogin" value="Login" data-i18n="client:login">Login</button>
            </div>
            <br>
            <a style="color:black;" href="#"><p data-i18n="client:registrate">Registrate</p></a>
            
                  
          </form>
                  
    </div>
        
    </div>
    
</body>


</html>