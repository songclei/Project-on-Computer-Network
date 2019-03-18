<?php
    include_once("../common.php");
    include_once("../user.php");

    $username = $_POST['username'];
    $password = $_POST['password'];
    $ret = checkUser($username, $password);

    // login success
    if ($ret['status'] === 0) {
        $smarty3->display("./html/header.html");
    }
    // login fail
    else {
        $smarty3->display("./html/login.html");
    }
?>
