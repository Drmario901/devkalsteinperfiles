<?php 
	session_start();
	unset($_SESSION['privateEmailAccount']);
	session_destroy();