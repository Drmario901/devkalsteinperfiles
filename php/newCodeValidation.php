<?php
    session_start();
    $numRandom = mt_rand(000000, 999999);
    $_SESSION["codeVerification"] = $numRandom;
    $_SESSION["codeTimeOut"] = time();