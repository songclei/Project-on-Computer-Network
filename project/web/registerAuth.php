<?php
    include_once("../lib/common.php");
    include_once("../lib/user.php");
    session_start();

    $param = $_POST;
    $ret = addUser($param);
    
    if ($ret['status'] === 0) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['uid'] = $ret['uid'];
        $_SESSION['role'] = 0;
        header("Location: ./index.php");
        exit();
    }
    else {
        header("Location: ./register.php");
        exit();
    }
?>
