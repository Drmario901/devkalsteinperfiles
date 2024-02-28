<header class="header" data-header>
   <?php
        session_start(); 
        if (isset($_SESSION['emailAccount'])){
         $email = $_SESSION['emailAccount'];
 
        }
        include 'navbar.php';
    
    ?>
    <script>
        let page = "inbox";
        document.querySelector('#link-' + page).classList.add("active");
        document.querySelector('#link-' + page).removeAttribute("style");
    </script>
</header>

<br>
<br>
<br>
<br>
<br>
<div class="container bootdey">
<div class="email-app">
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="https://testing.kalstein.digital/index.php/distributor/inbox/" data-i18n="rentalsale:aInbox"><i class="fa fa-inbox"></i> Inbox <span class="badge badge-danger">4</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://testing.kalstein.digital/index.php/distributor/inbox/sent" data-i18n="rentalsale:aSent"><i class="fa fa-rocket"></i> Sent</a>
            </li>
        </ul>
    </nav>
    <main>
        <p class="text-center" data-i18n="rentalsale:pCompMsg">Compose a Message</p>
        <form id="messageForm">
            <div class="form-row mb-3">
                <label for="to" class="col-2 col-sm-1 col-form-label" data-i18n="rentalsale:labelFrom">From:</label>
                <div class="col-10 col-sm-11">
                <input style="color: #000 !important" type="text" id="remitenteId" class="form-control" name="remitente"  value="<?php echo $email?>" readonly>
                </div>
            </div>
            <div class="form-row mb-3">
                <label for="to" class="col-2 col-sm-1 col-form-label" data-i18n="rentalsale:labelTo">To:</label>
                <div class="col-10 col-sm-11">
                    <br>
                <input style="color: #000 !important" type="text" class="form-control" id="destinatarioId" name="destinatario" placeholder="Email" data-placeholder="inputEmail">
                </div>
            </div>
            <div class="form-row mb-3">
                <br>
                <label for="cc" class="col-2 col-sm-1 col-form-label" data-i18n="rentalsale:labelSubject">Subject:</label>
                <div class="col-10 col-sm-11">
                    <br>
                   <input style="color: #000 !important" type="text" id="asunto" name="asunto" placeholder="Subject" data-placeholder="inputSubject">
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-sm-11 ml-auto">
                    </div>
                </div>
                <div class="form-group mt-4">
                    <textarea style="color: #000 !important" id="contenido" name="contenido" rows="12" placeholder="Type a message here" data-placeholder="txtMsgHere"></textarea>
                </div>
                <br>
                <div class="form-group">
                    <center><button type="submit" id="sendMessage" class="btn btn-success" data-i18n="rentalsale:btnSend">Send</button></center>
                </div>
            </div>
        </div>
    </main>
</div>
</div>