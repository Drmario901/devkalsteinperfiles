<?php
    require __DIR__ . '/../../../../php/conexion.php';
    
    session_start();
    $email = $_SESSION['emailAccount'];
    $existingTagQuery = "SELECT user_tag FROM wp_account WHERE account_correo = '$email'";
    
    $resultado = mysqli_query($conexion, $existingTagQuery);
    
    if ($resultado) {
        $row = mysqli_fetch_assoc($resultado);
        
        if ($row) {
            $userTag = $row['user_tag'];
        } else {
            echo "Tag de usuario no encontrado";
        }
        
        
        mysqli_free_result($resultado);
    } 
    
    mysqli_close($conexion);

?>
    <input type="hidden" style="color: #000 !important" type="text" id="remitenteId" class="form-control" name="remitente"  value="<?php echo $userTag?>" readonly></div>
<div class="container bootdey">
<div class="email-app">
    <nav>
        <ul class="nav">
            <a href="#" id="inbox-compose" style="color: #fff" class="btn btn-danger btn-block">Nuevo mensaje</a>
            <li class="nav-item">
                <a class="nav-link" href="#" id="inbox-inbox"><i class="fa fa-inbox"></i> Inbox <span class="badge badge-danger">4</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="inbox-sent"><i class="fa fa-rocket"></i>Enviados</a>
            </li>
        </ul>
    </nav>
    <main class='p-4'>
        <p class="text-center">Componer un mensaje</p>
        <form id="messageForm">
            <div class="form-row mb-3">
                <label for="to" class="col-2 col-sm-1 col-form-label">De:</label>
                <div class="col-10 col-sm-11">
                <input style="color: #000 !important" type="text" class="form-control" name="remitente"  value="<?php echo $userTag?>" readonly>
                </div>
            </div>
            <div class="form-row mb-3">
                <label for="to" class="col-2 col-sm-1 col-form-label">Para:</label>
                <div class="col-10 col-sm-11">
                    <br>
                <li class='nav-item dropdown' style='margin-left: -1.5mm; width: 100%'>
                    <input style="color: #000 !important" class='form-control' id='destinatarioId' type='search' name="destinatario" placeholder='User tag' value="<?php echo isset($_GET['compose'])? $_GET['compose'] : '';?>">
                    <ul class='custom-dropdown-menu'>
                    </ul>
                </li>
                </div>
            </div>
            <div class="form-row mb-3">
                <br>
                <label for="cc" class="col-2 col-sm-1 col-form-label">Asunto:</label>
                <div class="col-10 col-sm-11">
                    <br>
                    <?php $subject = (isset($_GET['subject']) && $_GET['subject'] != "")? " value='Re: ".$_GET['subject']."'" : ''; ?>
                    <input style="color: #000 !important" type="text" id="asunto" name="asunto" placeholder="Asunto"<?php echo $subject?>>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-sm-11 ml-auto">
                    </div>
                </div>
                <div class="form-group mt-4">
                    <textarea style="color: #000 !important" id="contenido" name="contenido" rows="12" placeholder="Escribe tu mensaje aquí"></textarea>
                </div>
                <br>
                <div class="form-group">
                    <center><button type="submit" id="sendMessage" class="btn btn-success">Enviar</button></center>
                </div>
            </div>
        </div>
    </main>
</div>
</div>

<style>
    .custom-dropdown-menu {
    display: none;
    position: absolute;
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 10px;
    list-style: none;
}

.dropdown:hover .custom-dropdown-menu {
    display: block;
}

.dropdown-button {
    background-color: #f1f1f1;
    border: 1px solid #ccc;
    padding: 5px 10px;
    cursor: pointer;
}
</style>