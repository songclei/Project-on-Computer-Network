<?php
    include_once("../lib/common.php");
    include_once("../lib/user.php");
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $ret = checkUser($username, $password);

    // login success
    if ($ret['status'] === 0) {
        $_SESSION['uid'] = $ret['uid'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = intval($ret['role']);
        header("Location: ./index.php"); 
        exit();
    }
    // login fail
    else {
        header("Location: ./login.php");
        exit();
    }
?>
