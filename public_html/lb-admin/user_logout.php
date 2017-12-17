<?php

ob_start();

session_start();



unset($_SESSION['current_user']);



header("location:customer_info.php");



ob_flush();







?>