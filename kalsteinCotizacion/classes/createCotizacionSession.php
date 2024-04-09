<?php

    session_start();

        $productSession = $_POST['consulta'];

        $_SESSION['productSession'] = $productSession;