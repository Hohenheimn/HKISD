<?php
    session_start();
    unset($_SESSION['admin_username']);
    unset($_SESSION['username']);
    header("location: login.php");
?>