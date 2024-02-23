<?php

	session_start();
	unset($_SESSION['emailAccount']);
	session_destroy();
	session_write_close();

	session_name('sessionidwoo47');
	session_start();
	unset($_SESSION['model-to-open-in-platform']);
	session_destroy();
	session_write_close();

?>