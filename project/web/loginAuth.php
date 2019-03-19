<?php
    include_once("../common.php");
    include_once("../user.php");

    $username = $_POST['username'];
    $password = $_POST['password'];
    $ret = checkUser($username, $password);

    // login success
    if ($ret['status'] === 0) {
        header("Location: ./index.php"); 
    }
    // login fail
    else {
        header("Location: ./login.php");
    }
?>
