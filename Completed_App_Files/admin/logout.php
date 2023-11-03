<?php
session_start();//session is a way to store information (in variables) to be used across multiple pages.

unset($_SESSION['user_is_logged_in']);

session_destroy(); 

header("Location: ../index.php");//use for the redirection to some page  


?>