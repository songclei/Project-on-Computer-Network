<?php
    include_once("../lib/common.php");
    session_start();
    unset($_SESSION['uid']);
    unset($_SESSION['username']);
    header("Location: index.php");
    exit();
?>
